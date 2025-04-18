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
    <h1 class="h3 mb-3 text-gray-800 font-weight-bold">Daftar Obat</h1>

    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h5 class="font-weight-bold text-primary">Daftar Obat
          <a href="{{ route('obat.create') }}" class="btn btn-primary font-weight-bold">
            + Tambah Obat
          </a>
        </h5>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Nama Obat</th>
                <th>Jenis</th>
                <th>Dosis</th>
                <th>Stok</th>
                <th>Satuan</th>
                <th>Harga</th>
                <th>Expired Date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($obats as $obat)
              <tr>
                <td>{{ $obat->nama_obat }}</td>
                <td>{{ $obat->jenis }}</td>
                <td>{{ $obat->dosis }}</td>
                <td>{{ $obat->stok }}</td>
                <td>{{ $obat->satuan }}</td>
                <td>Rp {{ number_format($obat->harga, 0, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($obat->expired_date)->format('d-m-Y') }}</td>
                <td class="d-flex">
                  <a href="{{ route('obat.edit', $obat->id) }}" class="btn btn-warning btn-sm mr-1" title="Edit">
                    <i class="fas fa-edit"></i>
                  </a>
                  <form action="{{ route('obat.destroy', $obat->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="d-flex justify-content-end mt-3">
          {{ $obats->links() }}
        </div>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
@endsection
