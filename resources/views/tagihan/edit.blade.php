@extends('layouts.main')

@section('content')
<div id="content">
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
          <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
    <h1 class="h3 mb-4 text-gray-800 font-weight-bold">{{ isset($tagihan) ? 'Edit' : 'Tambah' }} Tagihan</h1>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h5 class="font-weight-bold text-primary">Form Tagihan</h5>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ isset($tagihan) ? route('tagihan.update', $tagihan->id) : route('tagihan.store') }}">
          @csrf
          @if(isset($tagihan))
            @method('PUT')
          @endif

          <div class="form-group">
            <label for="rekam_medis_id">Rekam Medis</label>
            <select name="rekam_medis_id" class="form-control @error('rekam_medis_id') is-invalid @enderror">
              <option disabled selected>Pilih Rekam Medis</option>
              @foreach($rekamMedis as $rekam)
                <option value="{{ $rekam->id }}" {{ old('rekam_medis_id', $tagihan->rekam_medis_id ?? '') == $rekam->id ? 'selected' : '' }}>
                  {{ $rekam->id }} - {{ $rekam->pasien->nama ?? 'Pasien tidak ditemukan' }}
                </option>
              @endforeach
            </select>
            @error('rekam_medis_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="form-group">
            <label for="tanggal_tagihan">Tanggal Tagihan</label>
            <input type="date" name="tanggal_tagihan" class="form-control @error('tanggal_tagihan') is-invalid @enderror"
              value="{{ old('tanggal_tagihan', $tagihan->tanggal_tagihan ?? now()->format('Y-m-d')) }}">
            @error('tanggal_tagihan') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="form-group">
            <label for="status_pembayaran">Status Pembayaran</label>
            <select name="status_pembayaran" class="form-control @error('status_pembayaran') is-invalid @enderror">
              <option value="belum_bayar" {{ old('status_pembayaran', $tagihan->status_pembayaran ?? '') == 'belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
              <option value="lunas" {{ old('status_pembayaran', $tagihan->status_pembayaran ?? '') == 'lunas' ? 'selected' : '' }}>Lunas</option>
            </select>
            @error('status_pembayaran') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="form-group">
            <label for="metode_pembayaran">Metode Pembayaran</label>
            <select name="metode_pembayaran" class="form-control @error('metode_pembayaran') is-invalid @enderror">
              <option value="tunai" {{ old('metode_pembayaran', $tagihan->metode_pembayaran ?? '') == 'tunai' ? 'selected' : '' }}>Tunai</option>
              <option value="transfer" {{ old('metode_pembayaran', $tagihan->metode_pembayaran ?? '') == 'transfer' ? 'selected' : '' }}>Transfer</option>
              <option value="kredit" {{ old('metode_pembayaran', $tagihan->metode_pembayaran ?? '') == 'kredit' ? 'selected' : '' }}>Kredit</option>
            </select>
            @error('metode_pembayaran') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="form-group">
              <label for="total_tagihan">Total Tagihan</label>
              <input type="number" step="0.01" name="total_tagihan" class="form-control" 
                  value="{{ old('total_tagihan', number_format($tagihan->total_tagihan ?? 0, 0, '.', '')) }}" readonly>
          </div>

          <button type="submit" class="btn btn-success">{{ isset($tagihan) ? 'Update' : 'Simpan' }}</button>
          <a href="{{ route('tagihan.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
