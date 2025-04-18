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
    <h1 class="h3 mb-4 text-gray-800 font-weight-bold">Tambah User</h1>

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
        <h5 class="font-weight-bold text-primary">Masukkan Data User</h5>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('user.store') }}">
          @csrf

          <div class="form-group">
            <label for="name">Nama User</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
              placeholder="Nama User" value="{{ old('name') }}">
            @error('name')
              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
              placeholder="Email" value="{{ old('email') }}">
            @error('email')
              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
              placeholder="Password">
            @error('password')
              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror"
              placeholder="Konfirmasi Password">
            @error('password_confirmation')
              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
              <option value="" disabled selected>Pilih Role</option>
              <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
              <option value="operator" {{ old('role') == 'operator' ? 'selected' : '' }}>Operator</option>
              <option value="dokter" {{ old('role') == 'dokter' ? 'selected' : '' }}>Dokter</option>
              <option value="kasir" {{ old('role') == 'kasir' ? 'selected' : '' }}>Kasir</option>
            </select>
            @error('role')
              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <button type="submit" class="btn btn-info">Tambah User</button>
          <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
@endsection
