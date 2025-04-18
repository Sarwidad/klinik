<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Klinik</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/fontawesome.min.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon">
          <i class="fas fa-hospital"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Klinik<sup></sup></div>
      </a>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="fas fa-chart-line"></i>
          <span>Dashboard</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
        Menu
      </div>
      @if (Auth::user()->role == 'dokter')
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
          <a class="nav-link" href="{{ route('rekam_medis.index') }}">
            <i class="fas fa-notes-medical"></i>
            <span>Rekam Medis</span>
          </a>
        </li>
      @endif

      @if (Auth::user()->role == 'operator')
        <!-- Nav Item - Pasien -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('pasien.index') }}">
            <i class="fas fa-procedures"></i>
            <span>Pasien</span>
          </a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="{{ route('pegawai.index') }}">
          <i class="fas fa-user-md"></i> 
          <span>Pegawai</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('tindakan.index') }}">
          <i class="fas fa-stethoscope"></i> 
          <span>Tindakan</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('obat.index') }}">
          <i class="fas fa-pills"></i> 
          <span>Obat</span>
        </a>
      </li>
      @endif

      @if (Auth::user()->role == 'kasir')
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
          <a class="nav-link" href="{{ route('tagihan.index') }}">
            <i class="fas fa-file-invoice-dollar"></i>
            <span>Tagihan Pasien</span>
          </a>
        </li>
      @endif

      @if (Auth::user()->role == 'admin')
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link" href="{{ route('user.index') }}">
          <i class="fas fa-users-cog"></i> 
          <span>User</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('pegawai.index') }}">
          <i class="fas fa-user-md"></i> 
          <span>Pegawai</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('tindakan.index') }}">
          <i class="fas fa-stethoscope"></i> 
          <span>Tindakan</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('obat.index') }}">
          <i class="fas fa-pills"></i> 
          <span>Obat</span>
        </a>
      </li>
      @endif

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle">
        </button>
      </div>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      @yield('content')
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Klinik 2025</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
  <!-- Core plugin JavaScript-->
  <script src="{{ asset('js/jquery.easing.min.js') }}"></script>
  <!-- Custom scripts for all pages-->
  <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
  <!-- Page level plugins -->
  <script src="{{ asset('js/Chart.min.js') }}"></script>
  <!-- Page level plugins -->
  <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
  <!-- Page level custom scripts -->
  <script src="{{ asset('js/datatables-demo.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable(); // Sudah mengaktifkan pagination bawaan DataTables
    });
</script>
<script>
    $(document).ready(function() {
        // Inisialisasi Select2 untuk Tindakan
        $('#tindakan_id').select2({
            placeholder: "Pilih Tindakan",  // Placeholder teks
            allowClear: true  // Menyediakan tombol Clear untuk menghapus pilihan
        });

        // Inisialisasi Select2 untuk Obat
        $('#obat_id').select2({
            placeholder: "Pilih Obat",  // Placeholder teks
            allowClear: true  // Menyediakan tombol Clear untuk menghapus pilihan
        });
    });
</script>
</body>

</html>