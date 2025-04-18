@extends('layouts.main')

@section('content')
<!-- Main Content -->
<div id="content">

  <!-- Topbar -->
  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 shadow">
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
      <i class="fa fa-bars"></i>
    </button>

    <ul class="navbar-nav ml-auto">
      <div class="topbar-divider d-none d-sm-block"></div>
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

  <div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800 font-weight-bold">Edit Pasien</h1>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h5 class="font-weight-bold text-primary">Ubah Data Pasien</h5>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('pasien.update', $pasien->id) }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="form-group">
            <label for="nama">Nama Pasien</label>
            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
              value="{{ old('nama', $pasien->nama) }}">
            @error('nama')
              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
              <option value="L" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
              <option value="P" {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('jenis_kelamin')
              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror"
              value="{{ old('tanggal_lahir', $pasien->tanggal_lahir) }}">
            @error('tanggal_lahir')
              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror"
              value="{{ old('alamat', $pasien->alamat) }}">
            @error('alamat')
              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <div class="form-group">
            <label for="no_telepon">No Telepon</label>
            <input type="text" name="no_telepon" id="no_telepon" class="form-control @error('no_telepon') is-invalid @enderror"
              value="{{ old('no_telepon', $pasien->no_telepon) }}">
            @error('no_telepon')
              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <div class="form-group">
            <label for="gol_darah">Golongan Darah</label>
            <select name="gol_darah" id="gol_darah" class="form-control @error('gol_darah') is-invalid @enderror">
              <option value="A" {{ old('gol_darah', $pasien->gol_darah) == 'A' ? 'selected' : '' }}>A</option>
              <option value="B" {{ old('gol_darah', $pasien->gol_darah) == 'B' ? 'selected' : '' }}>B</option>
              <option value="AB" {{ old('gol_darah', $pasien->gol_darah) == 'AB' ? 'selected' : '' }}>AB</option>
              <option value="O" {{ old('gol_darah', $pasien->gol_darah) == 'O' ? 'selected' : '' }}>O</option>
            </select>
            @error('gol_darah')
              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <button type="submit" class="btn btn-primary">Update Pasien</button>
          <a href="{{ route('pasien.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
