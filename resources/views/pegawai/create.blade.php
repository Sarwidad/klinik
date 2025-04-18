@extends('layouts.main')

@section('content')
<!-- Main Content -->
<div id="content">

  <!-- Topbar -->
  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
      <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
      <div class="topbar-divider d-none d-sm-block"></div>
      <!-- Nav Item - User Information -->
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->nama }}</span>
          <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}">
        </a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </div>
      </li>
    </ul>
  </nav>
  <!-- End of Topbar -->

  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800 font-weight-bold">Tambah Pegawai</h1>

    <!-- Flash Messages -->
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Form Card -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h5 class="font-weight-bold text-primary">Masukkan Data Pegawai</h5>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('pegawai.store') }}" enctype="multipart/form-data">
          @csrf

          <div class="form-group">
            <label for="nama">Nama Pegawai</label>
            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
              placeholder="Nama Pegawai" value="{{ old('nama') }}">
            @error('nama')
              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
              <option value="" disabled selected>Pilih Jenis Kelamin</option>
              <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
              <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('jenis_kelamin')
              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror"
              value="{{ old('tanggal_lahir') }}">
            @error('tanggal_lahir')
              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror"
              placeholder="Alamat Pegawai" value="{{ old('alamat') }}">
            @error('alamat')
              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <div class="form-group">
            <label for="no_telepon">No Telepon</label>
            <input type="text" name="no_telepon" id="no_telepon" class="form-control @error('no_telepon') is-invalid @enderror"
              placeholder="No Telepon" value="{{ old('no_telepon') }}">
            @error('no_telepon')
              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>
          <div class="form-group">
              <label for="jabatan">Jabatan</label>
              <input type="text" name="jabatan" id="jabatan" class="form-control @error('jabatan') is-invalid @enderror" placeholder="Masukkan Jabatan" value="{{ old('jabatan') }}">
              @error('jabatan')
                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
              @enderror
          </div>

          <button type="submit" class="btn btn-info">Tambah Pegawai</button>
          <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
@endsection
