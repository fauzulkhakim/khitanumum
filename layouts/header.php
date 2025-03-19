<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khitan Umum YM3SK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="panitia/assets/images/icon_khitan_umum.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="panitia/assets/adminlte/dist/css/adminlte.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="panitia/assets/adminlte/plugins/fontawesome-free/css/all.min.css">
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

        .card-outline.card-primary {
            border-color: #2D3C28;
        }

        .btn-primary {
            background-color: #2D3C28;
            border-color: #2D3C28;
        }

        .btn-primary:hover {
            background-color: #1e2a1b;
            border-color: #1e2a1b;
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
    <div class="wrapper d-flex flex-column">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="panitia/assets/images/icon_khitan_umum.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Khitan Umum</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <?php
                    $current_page = basename($_SERVER['PHP_SELF']);
                    ?>
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Form Pendaftaran -->
                        <li class="nav-item">
                            <a href="index.php" class="nav-link <?php echo $current_page == 'index.php' ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-file-signature"></i>
                                <p>Form Pendaftaran</p>
                            </a>
                        </li>
                        <!-- Status -->
                        <li class="nav-item">
                            <a href="status.php" class="nav-link <?php echo $current_page == 'status.php' ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-info-circle"></i>
                                <p>Status</p>
                            </a>
                        </li>
                        <!-- Undangan -->
                        <li class="nav-item">
                            <a href="undangan.php" class="nav-link <?php echo $current_page == 'undangan.php' ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-envelope"></i>
                                <p>Undangan</p>
                            </a>
                        </li>
                        <!-- Admin -->
                        <li class="nav-item">
                            <a href="panitia" class="nav-link">
                                <i class="nav-icon fas fa-sign-in-alt"></i>
                                <p>Admin</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- /.sidebar -->