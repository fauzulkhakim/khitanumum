<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

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
                <img src="assets/avatar-3.jpg" class="img-circle elevation-2" alt="User Image">
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