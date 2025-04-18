@extends('layouts.main')

@section('content')
<!-- Main Content -->
<div id="content">
  <!-- Topbar -->
  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
      <i class="fa fa-bars"></i>
    </button>

    <ul class="navbar-nav ml-auto">
      <div class="topbar-divider d-none d-sm-block"></div>
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
          <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}">
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">
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
    <h1 class="h3 mb-3 text-gray-800 font-weight-bold">Daftar Tagihan</h1>

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h5 class="font-weight-bold text-primary">Data Tagihan
          <a href="{{ route('tagihan.create') }}" class="btn btn-primary font-weight-bold">
            + Tambah Tagihan
          </a>
        </h5>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Rekam Medis ID</th>
                <th>Pasien</th>
                <th>Tanggal Tagihan</th>
                <th>Status Pembayaran</th>
                <th>Metode Pembayaran</th>
                <th>Total Tagihan</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($tagihans as $tagihan)
              <tr>
                  <td>{{ $tagihan->rekam_medis_id }}</td>
                  <td>{{ $tagihan->rekamMedis && $tagihan->rekamMedis->pasien ? $tagihan->rekamMedis->pasien->nama : 'Pasien tidak ditemukan' }}</td>
                  <td>{{ \Carbon\Carbon::parse($tagihan->tanggal_tagihan)->format('d-m-Y') }}</td>
                  <td>{{ ucfirst($tagihan->status_pembayaran) }}</td>
                  <td>{{ ucfirst($tagihan->metode_pembayaran) }}</td>
                  <td>Rp. {{ number_format($tagihan->total_tagihan, 0, ',', '.') }}</td>

                  <td class="d-flex">
                      <a href="{{ route('tagihan.edit', $tagihan->id) }}" class="btn btn-warning btn-sm mr-1" title="Edit">
                          <i class="fas fa-edit"></i>
                      </a>
                      <form action="{{ route('tagihan.destroy', $tagihan->id) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus tagihan ini?')">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                              <i class="fas fa-trash-alt"></i>
                          </button>
                      </form>
                      <a href="{{ route('tagihan.cetak', $tagihan->id) }}" target="_blank" class="btn btn-info btn-sm mr-1" title="Cetak">
                        <i class="fas fa-print"></i>
                      </a>
                  </td>
              </tr>
              @endforeach
              </tbody>

          </table>
        </div>
        <div class="d-flex justify-content-end mt-3">
          {{ $tagihans->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
