@extends('layouts.main')

@section('content')
<!-- Main Content -->
<div id="content">
  <!-- Topbar -->
  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
      <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
      <div class="topbar-divider d-none d-sm-block"></div>
      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
          <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}">
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800 font-weight-bold">Daftar Rekam Medis</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="font-weight-bold text-primary">Data Rekam Medis
                <a href="{{ route('rekam_medis.create') }}" class="btn btn-primary font-weight-bold float-right">
                    + Tambah Rekam Medis
                </a>
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Pasien</th>
                            <th>Pegawai</th>
                            <th>Tanggal Periksa</th>
                            <th>Keluhan</th>
                            <th>Diagnosa</th>
                            <th>Catatan</th>
                            <th>Tindakan</th>
                            <th>Obat</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rekamMedis as $rekam)
                        <tr>
                            <td>{{ $rekam->pasien->nama }}</td>
                            <td>{{ $rekam->pegawai->nama }}</td>
                            <td>{{ \Carbon\Carbon::parse($rekam->tanggal_periksa)->format('d-m-Y') }}</td>
                            <td>{{ $rekam->keluhan }}</td>
                            <td>{{ $rekam->diagnosa }}</td>
                            <td>{{ $rekam->catatan ?? '-' }}</td>
                            <td>
                                @foreach ($rekam->tindakans as $tindakan)
                                    <span class="badge badge-info">{{ $tindakan->nama_tindakan }}</span>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($rekam->obats as $obat)
                                    <span class="badge badge-success">{{ $obat->nama_obat }}</span>
                                @endforeach
                            </td>
                            <td class="d-flex">
                                <a href="{{ route('rekam_medis.edit', $rekam->id) }}" class="btn btn-warning btn-sm mr-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('rekam_medis.destroy', $rekam->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                                <a href="{{ route('rekam_medis.cetak', $rekam->id) }}" target="_blank" class="btn btn-info btn-sm mr-1" title="Cetak">
                                    <i class="fas fa-print"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-3">
              {{ $rekamMedis->links() }}
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
@endsection
