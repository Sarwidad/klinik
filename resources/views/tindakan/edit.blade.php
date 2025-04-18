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
    <h1 class="h3 mb-4 text-gray-800 font-weight-bold">Edit Tindakan</h1>

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
        <h5 class="font-weight-bold text-primary">Edit Data Tindakan</h5>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('tindakan.update', $tindakan->id) }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="form-group">
            <label for="nama_tindakan">Nama Tindakan</label>
            <input type="text" name="nama_tindakan" id="nama_tindakan" class="form-control @error('nama_tindakan') is-invalid @enderror"
              placeholder="Nama Tindakan" value="{{ old('nama_tindakan', $tindakan->nama_tindakan) }}">
            @error('nama_tindakan')
              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
              placeholder="Deskripsi Tindakan">{{ old('deskripsi', $tindakan->deskripsi) }}</textarea>
            @error('deskripsi')
              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" step="0.01" name="harga" id="harga" class="form-control @error('harga') is-invalid @enderror"
              placeholder="Harga Tindakan" value="{{ old('harga', $tindakan->harga) }}">
            @error('harga')
              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <button type="submit" class="btn btn-info">Update Tindakan</button>
          <a href="{{ route('tindakan.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
@endsection
