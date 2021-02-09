<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DORAWEB</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet"
    href="<?php echo base_url('/'); ?>/adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet"
    href="<?php echo base_url('/'); ?>/adminlte/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="<?php echo base_url('/'); ?>/adminlte/index3.html"
            class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <a class="nav-link btn btn-danger"
          href="<?php echo base_url('/logout') ?>"
          role="button">
          <i class="fas fa-th-large pr-2"></i>LOGOUT
        </a>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar bg-warning elevation-4 position-fixed">
      <!-- Brand Logo -->
      <a href="<?php echo base_url('/'); ?>/adminlte/index3.html"
        class="brand-link">
        <img
          src="<?php echo base_url('/'); ?>/adminlte/dist/img/AdminLTELogo.png"
          alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">DORAWEB</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="info">
            <a href="#" class="d-block pl-3">BERANDA</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <li class="nav-item">
              <a href="<?php echo base_url('dashboard') ?>"
                class="nav-link">
                <i class="nav-icon far fa fa-bars"></i>
                <p>
                  Beranda
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?php echo base_url('dashboard/daftarproduk') ?>"
                class="nav-link">
                <i class="nav-icon far fa fa-bars"></i>
                <p>
                  Daftar Produk
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?= base_url('/dashboard/scanner'); ?>"
                class="nav-link">
                <i class="nav-icon far fa fa-bars"></i>
                <p>
                  Scan Produk
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="<?php echo base_url('/dashboard/tambah-produk') ?>"
                class="nav-link">
                <i class="nav-icon far fa fa-bars"></i>
                <p>
                  Tambah Produk
                </p>
              </a>
            </li>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Dashboard</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <?php echo $this->renderSection('main-content'); ?>

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.1.0-rc
      </div>
      <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script
    src="<?php echo base_url('/'); ?>/adminlte/plugins/jquery/jquery.min.js">
  </script>
  <!-- Bootstrap 4 -->
  <script
    src="<?php echo base_url('/'); ?>/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js">
  </script>
  <!-- AdminLTE App -->
  <script
    src="<?php echo base_url('/'); ?>/adminlte/dist/js/adminlte.min.js">
  </script>
  <!-- AdminLTE for demo purposes -->
  <script
    src="<?php echo base_url('/'); ?>/adminlte/dist/js/demo.js">
  </script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#example').DataTable();
    });
  </script>
</body>

</html>