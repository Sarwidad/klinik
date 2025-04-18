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

  <!-- Begin Page Content -->
  <div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800 font-weight-bold">Tambah Obat</h1>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h5 class="font-weight-bold text-primary">Form Data Obat</h5>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('obat.store') }}">
          @csrf

          <div class="form-group">
            <label for="nama_obat">Nama Obat</label>
            <input type="text" name="nama_obat" id="nama_obat" class="form-control @error('nama_obat') is-invalid @enderror"
              value="{{ old('nama_obat') }}" placeholder="Contoh: Paracetamol">
            @error('nama_obat')
              <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <div class="form-group">
            <label for="jenis">Jenis</label>
            <input type="text" name="jenis" id="jenis" class="form-control @error('jenis') is-invalid @enderror"
              value="{{ old('jenis') }}" placeholder="Contoh: Tablet, Kapsul, Sirup">
            @error('jenis')
              <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <div class="form-group">
            <label for="dosis">Dosis</label>
            <input type="text" name="dosis" id="dosis" class="form-control @error('dosis') is-invalid @enderror"
              value="{{ old('dosis') }}" placeholder="Contoh: 500mg, 10ml">
            @error('dosis')
              <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <div class="form-group">
            <label for="stok">Stok</label>
            <input type="number" name="stok" id="stok" class="form-control @error('stok') is-invalid @enderror"
              value="{{ old('stok') }}" placeholder="Contoh: 100">
            @error('stok')
              <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <div class="form-group">
            <label for="satuan">Satuan</label>
            <input type="text" name="satuan" id="satuan" class="form-control @error('satuan') is-invalid @enderror"
              value="{{ old('satuan') }}" placeholder="Contoh: Tablet, Botol">
            @error('satuan')
              <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" name="harga" id="harga" class="form-control @error('harga') is-invalid @enderror"
              value="{{ old('harga') }}" placeholder="Contoh: 10000">
            @error('harga')
              <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <div class="form-group">
            <label for="expired_date">Tanggal Kadaluarsa</label>
            <input type="date" name="expired_date" id="expired_date" class="form-control @error('expired_date') is-invalid @enderror"
              value="{{ old('expired_date') }}">
            @error('expired_date')
              <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <button type="submit" class="btn btn-info">Simpan</button>
          <a href="{{ route('obat.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
