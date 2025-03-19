<?php
session_start();
require '../config/config.php';

// Cek apakah user sudah login, jika tidak arahkan ke halaman login
if (!isset($_SESSION['user'])) {
  header("Location: ../index.php");
  exit();
}

// Mendapatkan halaman saat ini
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Khitan Umum YM3SK</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="../assets/adminlte/dist/css/adminlte.min.css">
  <link rel="icon" href="../assets/images/icon_khitan_umum.png" type="image/x-icon">
  <!-- Font IBM Plex Sans -->
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400&display=swap" rel="stylesheet">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'IBM Plex Sans', sans-serif;
    }

    body {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      background: #f5f6fa;
      font-size: 14px;
      font-weight: 400;
    }

    .form-control {
      font-size: 14px !important;
    }

    .content-wrapper {
      flex: 1;
    }

    .brand-text {
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .navbar {
      background-color: #ffffff !important;
    }

    h3 {
      color: #2D3C28;
      font-weight: bolder;
      font-size: 1.75rem;
    }

    h4 {
      color: #2D3C28;
      font-size: 1.5rem;
    }

    h5 {
      color: #2D3C28;
      font-size: 1.25rem;
    }

    h6 {
      color: #2D3C28;
      font-size: 1rem;
    }

    #form-pendaftaran {
      display: none;
      margin-top: 30px;
    }

    .card-header {
      background-color: #f0f0f0;
    }

    .card-title {
      font-size: 1.25rem;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
    }

    .date-range {
      background-color: black;
      color: white;
      padding: 5px;
      border-radius: 5px;
    }

    .card {
      width: 100%;
    }

    .table-responsive {
      overflow-x: auto;
    }

    @media (min-width: 768px) {
      .row>.col-md-6 {
        display: flex;
        flex-direction: column;
      }
    }

    .select2-container--default .select2-selection--single {
      height: calc(3.5rem + 2px);
      padding: 0.75rem 1rem;
      font-size: 14px;
      line-height: 1.5;
      color: #495057;
      background-color: #fff;
      background-clip: padding-box;
      border: 1px solid #ced4da;
      border-radius: 0.25rem;
      box-shadow: inset 0 0.075rem 0.1rem rgba(0, 0, 0, 0.075);
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
      padding-left: 0.75rem;
      padding-right: 0.75rem;
      padding-top: calc((3.5rem - 1.5rem) / 2);
      padding-bottom: calc((3.5rem - 1.5rem) / 2);
      line-height: 1.5rem;
      color: #495057;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
      height: calc(3.5rem + 2px);
      top: 50%;
      transform: translateY(-50%);
      right: 10px;
    }

    .nav-sidebar .nav-link.active {
      background-color: rgba(98, 111, 71, 0.8) !important;
      color: #ffffff !important;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="dashboard.php" class="brand-link">
        <img src="../assets/images/icon_khitan_umum.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Khitan Umum</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../assets/images/avatar-3.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">
              <?php
              if (isset($_SESSION['user'])) {
                echo $_SESSION['user']['nama_lengkap'];
              }
              ?>
            </a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="dashboard.php" class="nav-link <?= ($current_page == 'dashboard.php') ? 'active' : ''; ?>">
                <i class="nav-icon fas fa-home"></i>
                <p>Home</p>
              </a>
            </li>
            <?php if (in_array($_SESSION['user']['role'], ['master', 'admin'])) : ?>
              <li class="nav-item">
                <a href="pendaftar.php" class="nav-link <?= ($current_page == 'pendaftar.php') ? 'active' : ''; ?>">
                  <i class="nav-icon fas fa-users"></i>
                  <p>Pendaftar</p>
                </a>
              </li>
            <?php endif; ?>
            <?php if ($_SESSION['user']['role'] == 'master') : ?>
              <li class="nav-item">
                <a href="pengaturan.php" class="nav-link <?= ($current_page == 'pengaturan.php') ? 'active' : ''; ?>">
                  <i class="nav-icon fas fa-cogs"></i>
                  <p>Setting</p>
                </a>
              </li>
            <?php endif; ?>
            <li class="nav-item">
              <a href="../../config/logout.php" class="nav-link" onclick="return confirm('Apakah Anda yakin ingin keluar?')">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>Logout</p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>