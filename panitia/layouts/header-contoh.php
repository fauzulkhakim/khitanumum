<?php
require '../config/config.php';
require '../config/cookies.php';
require '../config/data.php';

// Cek apakah user sudah login, jika tidak arahkan ke halaman login
if (!check_login()) {
    header("Location: ../login.php");
    exit();
}

// Ambil role user dari sesi
$user_level = $_SESSION['user']['role'] ?? 'guest';

// Daftar akses halaman berdasarkan role
$role_access = [
    'master' => ['dashboard.php', 'data-ansor.php', 'form.php', 'pengaturan.php', 'data-pribadi.php', 'edit-anggota.php'],

    'admin desa' => ['dashboard.php', 'data-ansor.php', 'form.php', 'data-pribadi.php', 'edit-anggota.php'],

    'admin kecamatan' => ['dashboard.php', 'data-ansor.php', 'form.php', 'data-pribadi.php', 'edit-anggota.php'],

    'user' => ['dashboard.php', 'data-ansor.php', 'data-pribadi.php', 'edit-anggota.php']
];

// Cek apakah user berhak mengakses halaman ini
$current_page = basename($_SERVER['PHP_SELF']);
if (!in_array($current_page, $role_access[$user_level] ?? [])) {
    header("Location: dashboard.php");
    exit();
}

// Mendapatkan user_id dari session login
$user_id = $_SESSION['id'];

// Mendapatkan user_id dari session login
$query = "
SELECT 
    a.*, 
    t.regencies_name AS kabupaten,
    d.districts_name AS kecamatan,
    v.villages_name AS desa,
    rt.rt_name AS rt,
    rw.rw_name AS rw,
    g.golongan_darah_name AS gol_darah,
    p.pernikahan_name AS status_pernikahan,
    tb.tinggi_badan_name AS tinggi_badan,
    bb.berat_badan_name AS berat_badan,
    pe.pekerjaan_name AS pekerjaan,
    pi.pekerjaan_name AS pekerjaan_istri,
    ps.pendapatan_name AS pendapatan,
    pis.pendapatan_name AS pendapatan_istri,
    pt.pendidikan_name AS pendidikan,
    js.jurusan_smk_name AS jurusan_smk,
    bs.bidang_studi_name AS bidang_studi,
    ap.partai_name AS parpol,
    kpr.districts_name AS kecamatan_pr,
    dpr.villages_name AS desa_pr,
    jpr.jabatan_pr_name AS jabatan_pr,
    mpr.masa_khidmat_name AS masa_pr,
    kpac.districts_name AS kecamatan_pac,
    jpac.jabatan_pac_name AS jabatan_pac,
    mpac.masa_khidmat_name AS masa_pac,
    jpc.jabatan_pc_name AS jabatan_pc,
    mpc.masa_khidmat_name AS masa_pc
    
FROM 
    tb_anggota a
LEFT JOIN 
    tb_regencies t ON a.anggota_tempat_lahir = t.regencies_id
LEFT JOIN 
    tb_districts d ON a.anggota_domisili_kec = d.districts_id
LEFT JOIN 
    tb_villages v ON a.anggota_domisili_des = v.villages_id
LEFT JOIN 
    tb_rt rt ON a.anggota_rt = rt.rt_id
LEFT JOIN 
    tb_rw rw ON a.anggota_rw = rw.rw_id
LEFT JOIN 
    tb_golongan_darah g ON a.anggota_golongan_darah = g.golongan_darah_id
LEFT JOIN 
    tb_pernikahan p ON a.anggota_pernikahan = p.pernikahan_id
LEFT JOIN
    tb_tinggi_badan tb ON a.anggota_tinggi_badan = tb.tinggi_badan_id
LEFT JOIN
    tb_berat_badan bb ON a.anggota_berat_badan = bb.berat_badan_id
LEFT JOIN
    tb_pekerjaan pe ON a.anggota_pekerjaan = pe.pekerjaan_id
LEFT JOIN
    tb_pekerjaan pi ON a.anggota_pekerjaan_istri = pi.pekerjaan_id
LEFT JOIN
    tb_pendapatan ps ON a.anggota_pendapatan = ps.pendapatan_id
LEFT JOIN
    tb_pendapatan pis ON a.anggota_pendapatan_istri = pis.pendapatan_id
LEFT JOIN
    tb_pendidikan pt ON a.anggota_pendidikan = pt.pendidikan_id
LEFT JOIN
    tb_jurusan_smk js ON a.anggota_jurusan_smk = js.jurusan_smk_id
LEFT JOIN
    tb_bidang_studi bs ON a.anggota_bidang_studi = bs.bidang_studi_id
LEFT JOIN
    tb_partai ap ON a.anggota_parpol = ap.partai_id
LEFT JOIN
    tb_jabatan_pac jpac ON a.anggota_pac_jabatan = jpac.jabatan_pac_id
LEFT JOIN
    tb_masa_khidmat mpac ON a.anggota_pac_mk = mpac.masa_khidmat_id
LEFT JOIN
    tb_jabatan_pr jpr ON a.anggota_pr_jabatan = jpr.jabatan_pr_id
LEFT JOIN
    tb_masa_khidmat mpr ON a.anggota_pr_mk = mpr.masa_khidmat_id
LEFT JOIN
    tb_jabatan_pc jpc ON a.anggota_pc_jabatan = jpc.jabatan_pc_id
LEFT JOIN
    tb_masa_khidmat mpc ON a.anggota_pc_mk = mpc.masa_khidmat_id
LEFT JOIN
    tb_districts kpr ON a.anggota_pr_kec = kpr.districts_id
LEFT JOIN
    tb_villages dpr ON a.anggota_pr_des = dpr.villages_id
LEFT JOIN
    tb_districts kpac ON a.anggota_pac_kec = kpac.districts_id 
WHERE 
    a.anggota_id = ?";

// Prepare dan bind parameter
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

// Memeriksa apakah data ditemukan
if (!$data) {
    echo "Data tidak ditemukan.";
    exit();
}

// Nama desa
$desa_name = $data['desa'];

// Query untuk menghitung total pendaftar di desa yang sesuai
$query_total_pendaftar_desa = "
SELECT COUNT(*) AS total_pendaftar
FROM tb_anggota
WHERE anggota_domisili_des = (
SELECT villages_id FROM tb_villages WHERE villages_name = ?
)
";

// Eksekusi query
$stmt_total_pendaftar_desa = $conn->prepare($query_total_pendaftar_desa);
$stmt_total_pendaftar_desa->bind_param("s", $desa_name);
$stmt_total_pendaftar_desa->execute();
$total_pendaftar_desa = $stmt_total_pendaftar_desa->get_result()->fetch_assoc()['total_pendaftar'];

// Nama kecamatan
$kecamatan_name = $data['kecamatan'];

// Query untuk menghitung total pendaftar di kecamatan yang sesuai
$query_total_pendaftar_kecamatan = "
SELECT COUNT(*) AS total_pendaftar
FROM tb_anggota
WHERE anggota_domisili_kec = (
SELECT districts_id FROM tb_districts WHERE districts_name = ?
)
";

// Ekekusi query
$stmt_total_pendaftar_kecamatan = $conn->prepare($query_total_pendaftar_kecamatan);
$stmt_total_pendaftar_kecamatan->bind_param("s", $kecamatan_name);
$stmt_total_pendaftar_kecamatan->execute();
$total_pendaftar_kecamatan = $stmt_total_pendaftar_kecamatan->get_result()->fetch_assoc()['total_pendaftar'];

// Query untuk menghitung total pendaftar
$total_pendaftar = $conn->query("SELECT COUNT(*) AS total_pendaftar FROM tb_anggota")->fetch_assoc()['total_pendaftar'];

// Query untuk menghitung total admin kecamatan
$total_admin_kecamatan = $conn->query("SELECT COUNT(*) AS total FROM tb_users WHERE role = 'admin kecamatan'")->fetch_assoc()['total'];

// Query untuk menghitung total admin desa
$total_admin_desa = $conn->query("SELECT COUNT(*) AS total FROM tb_users WHERE role = 'admin desa'")->fetch_assoc()['total'];

// Query untuk menghitung total master
$total_master = $conn->query("SELECT COUNT(*) AS total FROM tb_users WHERE role = 'master'")->fetch_assoc()['total'];

// Query untuk menghitung total kecamatan
$total_kecamatan = $conn->query("SELECT COUNT(*) AS total FROM tb_districts")->fetch_assoc()['total'];

// Query untuk menghitung total desa
$total_desa = $conn->query("SELECT COUNT(*) AS total FROM tb_villages")->fetch_assoc()['total'];

// Query untuk mendapatkan data kecamatan
$kecamatans = $conn->query("SELECT d.districts_name AS kecamatan, COUNT(a.anggota_id) AS total_pendaftar
FROM tb_districts d
LEFT JOIN tb_anggota a ON a.anggota_domisili_kec = d.districts_id
GROUP BY d.districts_name")->fetch_all(MYSQLI_ASSOC);

// Query untuk mendapatkan data desa
$kecamatanDesaData = [];
$resultDesa = $conn->query("
SELECT d.districts_name AS kecamatan, v.villages_name AS desa, COUNT(a.anggota_id) AS total_pendaftar
FROM tb_districts d
LEFT JOIN tb_villages v ON v.districts_id = d.districts_id
LEFT JOIN tb_anggota a ON a.anggota_domisili_des = v.villages_id
GROUP BY d.districts_name, v.villages_name
ORDER BY d.districts_name, v.villages_name
");

while ($row = $resultDesa->fetch_assoc()) {
    $kecamatanDesaData[$row['kecamatan']][] = [
        'desa' => $row['desa'],
        'total_pendaftar' => $row['total_pendaftar']
    ];
}

// Fetch training data related to the current user
$anggota_id = $_SESSION['id'] ?? null;
$trainings = [];

if ($anggota_id) {
    // Query to fetch training data from tb_riwayat_diklat
    $query_trainings = "SELECT riwayat_diklat_item, riwayat_diklat_file FROM tb_riwayat_diklat WHERE anggota_id = ?";
    $stmt = $conn->prepare($query_trainings);
    $stmt->bind_param("i", $anggota_id);
    $stmt->execute();
    $trainings = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

// Define section-based mapping with folder paths
$sections = [
    'A. Pendidikan Kader' => [
        'items' => ['PKD', 'PKL', 'PKN'],
        'folder' => 'a.pendidikan_kader',
    ],
    'B. Latihan Instruktur' => [
        'items' => ['LI I', 'LI II', 'LI III'],
        'folder' => 'b.instruktur',
    ],
    'C. Dirosah' => [
        'items' => ['Dirosah Ula', 'Dirosah Wustho', 'Dirosah Ulya'],
        'folder' => 'c.dirosah',
    ],
    'D. Pendidikan & Latihan' => [
        'items' => ['Diklatsar', 'SUSBALAN', 'SUSBANPIM'],
        'folder' => 'd.pendidikan_latihan',
    ],
    'E. Kursus Kepelatihan' => [
        'items' => ['SUSPELAT I', 'SUSPELAT II', 'SUSPELAT III'],
        'folder' => 'e.kursus',
    ],
    'F. Pendidikan & Latihan Khusus' => [
        'items' => ['DIKLATSUS BAGANA', 'DIKLATSUS PROTOKOLER', 'DIKLATSUS BALAKAR', 'DIKLATSUS BALANTAS', 'DIKLATSUS BARITIM', 'DIKLATSUS DENSUS 99', 'DIKLATSUS PROVOST'],
        'folder' => 'f.pendidikan_latihan_khusus',
    ],
];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Ansor Kudus</title>

    <!-- Favicon -->
    <link rel="icon" href="../assets/ansor.png" type="image/x-icon">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../assets/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/adminlte/dist/css/adminlte.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.3.0/css/fixedColumns.dataTables.min.css">
    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <style>
        /* Pastikan tampilan Select2 sesuai dengan Bootstrap */
        .select2-container--default .select2-selection--single {
            height: calc(2.25rem + 2px);
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 1.5rem;
        }

        .required-label::after {
            content: "*";
            color: red;
            margin-left: 4px;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div style="background-color: #222d32" class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="../assets/logo.png" alt="AdminLTELogo" height="200" width="200">
        </div>

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
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <?php
        $current_page = basename($_SERVER['PHP_SELF']);
        ?>

        <!-- Sidebar Dinamis -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="dashboard.php" class="brand-link">
                <img src="../assets/ansor.png" alt="Admin Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Ansor Kudus</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../assets/photo.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">
                            <?php
                            // Memastikan nama user sesuai
                            if (isset($_SESSION['user'])) {
                                echo $_SESSION['user']['nama_lengkap'];
                            } else {
                                echo 'User';
                            }
                            ?>
                            <span class="d-block text-muted">
                                <?php
                                // Tampilkan role user jika ada sesi aktif
                                if (isset($_SESSION['user'])) {
                                    echo $_SESSION['user']['role'];
                                } else {
                                    echo 'Role: Guest';
                                }
                                ?>
                            </span>
                        </a>
                    </div>
                </div>

                <!-- Sidebar Menu Dinamis -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <?php if ($user_level == 'admin desa' || $user_level == 'admin kecamatan' || $user_level == 'master'): ?>
                            <!-- Dashboard -->
                            <li class="nav-item">
                                <a href="dashboard.php" class="nav-link <?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>">
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>

                            <!-- Form Pendaftaran -->
                            <li class="nav-item">
                                <a href="form.php" class="nav-link <?php echo ($current_page == 'form.php') ? 'active' : ''; ?>">
                                    <i class="nav-icon fas fa-user-plus"></i>
                                    <p>Form Pendaftaran</p>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if ($user_level == 'admin desa' || $user_level == 'admin kecamatan' || $user_level == 'master' || $user_level == 'user'): ?>
                            <!-- Data Anggota -->
                            <li class="nav-item">
                                <a href="data-ansor.php" class="nav-link <?php echo ($current_page == 'data-ansor.php') ? 'active' : ''; ?>">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Data Anggota</p>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if ($user_level == 'master'): ?>
                            <!-- Pengaturan -->
                            <li class="nav-item">
                                <a href="pengaturan.php" class="nav-link <?php echo ($current_page == 'pengaturan.php') ? 'active' : ''; ?>">
                                    <i class="nav-icon fas fa-user-cog"></i>
                                    <p>Manajemen Akun</p>
                                </a>
                            </li>
                        <?php endif; ?>

                        <!-- Data Pribadi -->
                        <li class="nav-item">
                            <a href="data-pribadi.php" class="nav-link <?php echo ($current_page == 'data-pribadi.php') ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Data Pribadi</p>
                            </a>
                        </li>

                        <!-- Logout -->
                        <li class="nav-item">
                            <a href="#" id="logout-link" class="nav-link">
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