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
  <link rel="stylesheet" href="../assets/adminlte3/css/adminlte.min.css">
  <link rel="icon" href="../assets/icon_khitan_umum.png" type="image/x-icon">
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap");

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
      min-height: 100vh;
      display: flex;
      justify-content: center;
      flex-direction: column;
    }

    .container-fluid {
      flex: 1;
    }

    .navbar-bottom {
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      background-color: #f8f9fa;
      border-top: 1px solid #ddd;
      padding: 10px;
      margin-top: 100px;
    }

    .navbar-bottom .nav-item .nav-link {
      color: #000;
    }

    .navbar-bottom .nav-item .nav-link:hover {
      color: #007bff;
    }

    .navbar-bottom .nav-item .nav-link i {
      display: block;
      font-size: 18px;
    }

    .navbar-bottom .nav-link.active i {
      color: #007bff;
    }

    .action-icon {
      padding: 9px;
      /* Sesuaikan padding sesuai kebutuhan */
      margin: 2px;
      /* Menambahkan jarak antar ikon */
    }

    .action-icon i {
      font-size: 13px;
      /* Mengatur ukuran ikon */
    }

    .back-button {
      background-color: #3C5B6F;
      color: white;
      border: none;
      padding: 10px 20px;
      cursor: pointer;
      text-decoration: none;
      display: inline-block;
      border-radius: 5px;
    }

    .back-button:hover {
      background-color: #373A40;
      color: #F8F4E1;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini">
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
        <img src="../assets/icon_khitan_umum.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Khitan Umum</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../assets/avatar-3.jpg" class="img-circle elevation-2" alt="User Image">
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
              <a href="../config/logout.php" class="nav-link" onclick="return confirm('Apakah Anda yakin ingin keluar?')">
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