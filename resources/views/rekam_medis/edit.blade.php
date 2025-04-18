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
  <!-- End of Topbar -->

  <!-- Begin Page Content -->
  <div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800 font-weight-bold">Edit Rekam Medis</h1>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h5 class="font-weight-bold text-primary">Form Edit Rekam Medis</h5>
      </div>
      <div class="card-body">
        <form method="POST" action="{{ route('rekam_medis.update', $rekamMedis->id) }}">
          @csrf
          @method('PUT')

          <div class="form-group">
            <label for="pasien_id">Pasien</label>
            <select name="pasien_id" class="form-control @error('pasien_id') is-invalid @enderror">
              <option disabled selected>Pilih Pasien</option>
              @foreach($pasiens as $pasien)
                <option value="{{ $pasien->id }}" {{ old('pasien_id', $rekamMedis->pasien_id ?? '') == $pasien->id ? 'selected' : '' }}>
                  {{ $pasien->nama }}
                </option>
              @endforeach
            </select>
            @error('pasien_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="form-group">
            <label for="pegawai_id">Pegawai (Dokter)</label>
            <select name="pegawai_id" class="form-control @error('pegawai_id') is-invalid @enderror">
              <option disabled selected>Pilih Pegawai</option>
              @foreach($pegawais as $pegawai)
                <option value="{{ $pegawai->id }}" {{ old('pegawai_id', $rekamMedis->pegawai_id ?? '') == $pegawai->id ? 'selected' : '' }}>
                  {{ $pegawai->nama }}
                </option>
              @endforeach
            </select>
            @error('pegawai_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="form-group">
            <label for="tanggal_periksa">Tanggal Periksa</label>
            <input type="date" name="tanggal_periksa" class="form-control @error('tanggal_periksa') is-invalid @enderror"
              value="{{ old('tanggal_periksa', $rekamMedis->tanggal_periksa ?? '') }}">
            @error('tanggal_periksa') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="form-group">
            <label for="keluhan">Keluhan</label>
            <textarea name="keluhan" class="form-control @error('keluhan') is-invalid @enderror" rows="3">{{ old('keluhan', $rekamMedis->keluhan ?? '') }}</textarea>
            @error('keluhan') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="form-group">
            <label for="diagnosa">Diagnosa</label>
            <textarea name="diagnosa" class="form-control @error('diagnosa') is-invalid @enderror" rows="3">{{ old('diagnosa', $rekamMedis->diagnosa ?? '') }}</textarea>
            @error('diagnosa') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="form-group">
            <label for="catatan">Catatan Tambahan (Opsional)</label>
            <textarea name="catatan" class="form-control @error('catatan') is-invalid @enderror" rows="2">{{ old('catatan', $rekamMedis->catatan ?? '') }}</textarea>
            @error('catatan') <span class="invalid-feedback">{{ $message }}</span> @enderror
          </div>

          <div class="form-group">
              <label for="tindakan_id">Tindakan</label>
              <select name="tindakan_id[]" class="form-control" id="tindakan_id" multiple required>
                  @foreach($tindakans as $tindakan)
                      <option value="{{ $tindakan->id }}" {{ in_array($tindakan->id, old('tindakan_id', $rekamMedis->tindakans->pluck('id')->toArray())) ? 'selected' : '' }}>
                          {{ $tindakan->nama_tindakan }}
                      </option>
                  @endforeach
              </select>
          </div>

          <div class="form-group">
              <label for="obat_id">Obat</label>
              <select name="obat_id[]" class="form-control" id="obat_id" multiple required>
                  @foreach($obats as $obat)
                      <option value="{{ $obat->id }}" {{ in_array($obat->id, old('obat_id', $rekamMedis->obats->pluck('id')->toArray())) ? 'selected' : '' }}>
                          {{ $obat->nama_obat }}
                      </option>
                  @endforeach
              </select>
          </div>

          <button type="submit" class="btn btn-success">Update</button>
          <a href="{{ route('rekam_medis.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
