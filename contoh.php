<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Pendaftaran</title>

    <!-- Favicon -->
    <link rel="icon" href="assets/logo.png" type="image/x-icon">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="assets/adminlte/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/adminlte/dist/css/adminlte.min.css">
    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- icheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css" integrity="sha512-8vq2g5nHE062j3xor4XxPeZiPjmRDh6wlufQlfC6pdQ/9urJkU07NM0tEREeymP++NczacJ/Q59ul+/K2eYvcg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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


<body class="hold-transition sidebar-mini">
    <?php
    include 'config/config.php';
    include 'config/data.php';
    ?>

    <div class="wrapper">

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
                <img src="assets/ansor.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Ansor Kudus</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Form Pendaftaran -->
                        <li class="nav-item">
                            <a href="index.php" class="nav-link active">
                                <i class="nav-icon fas fa-file-signature"></i>
                                <p>Form Pendaftaran</p>
                            </a>
                        </li>

                        <!-- Login -->
                        <li class="nav-item">
                            <a href="login.php" class="nav-link">
                                <i class="nav-icon fas fa-sign-in-alt "></i>
                                <p>Login</p>
                            </a>
                        </li>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- /.sidebar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Form Pendaftaran</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <!-- Form with step-by-step collapsible cards -->
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <form id="formPendaftaran" action="config/pendaftaran.php" method="POST" enctype="multipart/form-data" novalidate>

                                <!-- Step 1: Data Anggota -->
                                <div class="card card-outline card-primary mt-4">
                                    <div class="card-header" data-toggle="collapse" data-target="#dataAnggota">
                                        <h5>1. Data Anggota</h5>
                                    </div>
                                    <div id="dataAnggota" class="collapse show">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label class="required-label" for="fotoDiri">Foto Diri</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="fotoDiri" id="fotoDiri" accept="image/*" required>
                                                        <label class="custom-file-label" for="fotoDiri">Pilih file</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">Harap pilih file foto diri.</div>
                                            </div>
                                            <div class="form-group">
                                                <label class="required-label" for="fotoKTP">Upload Foto KTP</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="fotoKTP" id="fotoKTP" accept="image/*" required>
                                                        <label class="custom-file-label" for="fotoKTP">Pilih file</label>
                                                    </div>
                                                </div>
                                                <div class="invalid-feedback">Harap pilih file foto KTP.</div>
                                            </div>
                                            <div class="form-group">
                                                <label class="required-label" for="email">Alamat Email</label>
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Alamat Email" required>
                                                <div class="invalid-feedback">Harap masukkan email yang valid.</div>
                                            </div>
                                            <div class="form-group">
                                                <label class="required-label" for="nama">Nama Lengkap</label>
                                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama Lengkap" required>
                                                <div class="invalid-feedback">Harap masukkan Nama Lengkap.</div>
                                            </div>
                                            <div class="form-group">
                                                <label class="required-label" for="nik">No. KTP / NIK</label>
                                                <input type="text" class="form-control" name="nik" id="nik" placeholder="Masukkan No. KTP / NIK" required>
                                                <div class="invalid-feedback">Harap masukkan No. KTP / NIK.</div>
                                            </div>
                                            <div class="form-group">
                                                <label class="required-label">Tempat Lahir</label>
                                                <select name="tempat_lahir" class="form-control select2" required>
                                                    <option value="" disabled selected>Pilih Tempat Lahir</option>
                                                    <?php foreach ($kabupaten as $item) { ?>
                                                        <option value="<?= $item['regencies_id'] ?>"><?= $item['regencies_name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="invalid-feedback">Harap masukkan Tempat Lahir.</div>
                                            </div>
                                            <div class="form-group">
                                                <label class="required-label" for="tanggal_lahir">Tanggal Lahir</label>
                                                <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" required>
                                                <div class="invalid-feedback">Harap masukkan Tanggal Lahir.</div>
                                            </div>
                                            <div class="form-group">
                                                <label class="required-label">Golongan Darah</label>
                                                <select class="form-control select2" name="golongan_darah" required>
                                                    <option value="" disabled selected>Pilih Golongan Darah</option>
                                                    <?php foreach ($gol_darah as $item) { ?>
                                                        <option value="<?= $item['golongan_darah_id'] ?>"><?= $item['golongan_darah_name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="invalid-feedback">Harap pilih Golongan Darah.</div>
                                            </div>
                                            <div class="form-group">
                                                <label class="required-label">Tinggi Badan (cm)</label>
                                                <select name="tinggi_badan" class="form-control select2" required>
                                                    <option value="" disabled selected>Pilih Tinggi Badan</option>
                                                    <?php foreach ($tb as $item) { ?>
                                                        <option value="<?= $item['tinggi_badan_id'] ?>"><?= $item['tinggi_badan_name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="invalid-feedback">Harap pilih Tinggi Badan.</div>
                                            </div>
                                            <div class="form-group">
                                                <label class="required-label">Berat Badan (kg)</label>
                                                <select name="berat_badan" class="form-control select2" required>
                                                    <option value="" disabled selected>Pilih Berat Badan</option>
                                                    <?php foreach ($bb as $item) { ?>
                                                        <option value="<?= $item['berat_badan_id'] ?>"><?= $item['berat_badan_name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="invalid-feedback">Harap pilih Berat Badan.</div>
                                            </div>
                                            <div class="form-group">
                                                <label class="required-label" for="ayah">Nama Ayah Kandung</label>
                                                <input type="text" class="form-control" name="ayah" id="ayah" placeholder="Masukkan Nama Ayah Kandung" required>
                                                <div class="invalid-feedback">Harap masukkan Nama Ayah Kandung.</div>
                                            </div>

                                            <div class="form-group">
                                                <label class="required-label" for="ibu">Nama Ibu Kandung</label>
                                                <input type="text" class="form-control" name="ibu" id="ibu" placeholder="Masukkan Nama Ibu Kandung" required>
                                                <div class="invalid-feedback">Harap masukkan Nama Ibu Kandung.</div>
                                            </div>

                                            <!-- Status Pernikahan -->
                                            <div class="form-group">
                                                <label class="required-label">Status Pernikahan</label>
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    <label class="btn btn-outline-primary">
                                                        <input type="radio" name="status_pernikahan" value="1" required onclick="toggleMarriageFields()"> Belum Menikah
                                                    </label>
                                                    <label class="btn btn-outline-primary">
                                                        <input type="radio" name="status_pernikahan" value="2" required onclick="toggleMarriageFields()"> Sudah Menikah
                                                    </label>
                                                    <label class="btn btn-outline-primary">
                                                        <input type="radio" name="status_pernikahan" value="3" required onclick="toggleMarriageFields()"> Cerai (Mati/Hidup)
                                                    </label>
                                                </div>
                                                <div class="invalid-feedback">Harap pilih Status Pernikahan.</div>
                                            </div>

                                            <!-- Wrapper for Marriage Details -->
                                            <div id="marriageDetails" style="display: none;">
                                                <!-- Nama Istri -->
                                                <div class="form-group">
                                                    <label id="nama_istriLabel" for="nama_istri">Nama Istri</label>
                                                    <input type="text" class="form-control" name="nama_istri" id="nama_istri" placeholder="Masukkan Nama Istri">
                                                    <div class="invalid-feedback">Harap masukkan Nama Istri.</div>
                                                </div>

                                                <!-- Jumlah Anak Laki-laki -->
                                                <div class="form-group">
                                                    <label id="anak_lakiLabel" for="anak_laki">Jumlah Anak Laki-laki</label>
                                                    <input type="number" class="form-control" name="anak_laki" id="anak_laki" placeholder="Masukkan Jumlah Anak Laki-laki">
                                                    <div class="invalid-feedback">Harap masukkan Jumlah Anak Laki-laki.</div>
                                                </div>

                                                <!-- Jumlah Anak Perempuan -->
                                                <div class="form-group">
                                                    <label id="anak_perempuanLabel" for="anak_perempuan">Jumlah Anak Perempuan</label>
                                                    <input type="number" class="form-control" name="anak_perempuan" id="anak_perempuan" placeholder="Masukkan Jumlah Anak Perempuan">
                                                    <div class="invalid-feedback">Harap masukkan Jumlah Anak Perempuan.</div>
                                                </div>
                                            </div>

                                            <!-- NPWP -->
                                            <div class="form-group">
                                                <label class="required-label">Kepemilikan NPWP</label>
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    <label class="btn btn-outline-primary">
                                                        <input type="radio" name="npwp" value="1" required onclick="toggleUploadSection('npwp', true)"> Sudah Memiliki
                                                    </label>
                                                    <label class="btn btn-outline-secondary">
                                                        <input type="radio" name="npwp" value="0" required checked onclick="toggleUploadSection('npwp', false)"> Belum Memiliki
                                                    </label>
                                                </div>
                                                <br>

                                                <!-- NPWP Upload -->
                                                <div id="npwpUpload" class="upload-section" style="display: none;">
                                                    <label class="required-label" for="npwpFile">Upload Foto NPWP</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="npwpFile" name="npwpFile" accept="image/*">
                                                        <label class="custom-file-label" for="npwpFile">Pilih file</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- BPJS -->
                                            <div class="form-group">
                                                <label class="required-label">BPJS Kesehatan</label>
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    <label class="btn btn-outline-primary">
                                                        <input type="radio" name="bpjs" value="1" required onclick="toggleUploadSection('bpjs', true)"> Sudah Memiliki
                                                    </label>
                                                    <label class="btn btn-outline-secondary">
                                                        <input type="radio" name="bpjs" value="0" required checked onclick="toggleUploadSection('bpjs', false)"> Belum Memiliki
                                                    </label>
                                                </div>
                                                <br>

                                                <!-- BPJS Upload -->
                                                <div id="bpjsUpload" class="upload-section" style="display: none;">
                                                    <label class="required-label" for="bpjsFile">Upload Foto BPJS</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="bpjsFile" name="bpjsFile" accept="image/*">
                                                        <label class="custom-file-label" for="bpjsFile">Pilih file</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="button" class="btn btn-primary" onclick="nextStep('dataAnggota', 'dataAlamat')">Lanjut</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 2: Alamat dan Media Sosial -->
                                <div class="card card-outline card-primary mt-4">
                                    <div class="card-header" data-toggle="collapse" data-target="#dataAlamat">
                                        <h5>2. Alamat dan Media Sosial</h5>
                                    </div>
                                    <div id="dataAlamat" class="collapse">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label class="required-label">Kecamatan</label>
                                                <select class="form-control" id="kecamatan" name="kecamatan" required>
                                                    <option value="">Pilih Kecamatan</option>
                                                </select>
                                                <div class="invalid-feedback">Harap pilih Kecamatan.</div>
                                            </div>

                                            <div class="form-group">
                                                <label class="required-label">Desa</label>
                                                <select class="form-control" id="desa" name="desa" required>
                                                    <option value="">Pilih Desa</option>
                                                </select>
                                                <div class="invalid-feedback">Harap pilih Desa.</div>
                                            </div>

                                            <div class="form-group">
                                                <label class="required-label" for="rt">RT</label>
                                                <select class="form-control select2" id="rt" name="rt" required>
                                                    <option value="" disabled selected>Pilih RT</option>
                                                    <?php foreach ($rt as $item) { ?>
                                                        <option value="<?= $item['rt_id'] ?>">
                                                            <?= $item['rt_name'] ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                                <div class="invalid-feedback">Harap pilih RT.</div>
                                            </div>

                                            <div class="form-group">
                                                <label class="required-label" for="rw">RW</label>
                                                <select class="form-control select2" id="rw" name="rw" required>
                                                    <option value="" disabled selected>Pilih RW</option>
                                                    <?php foreach ($rw as $item) { ?>
                                                        <option value="<?= $item['rw_id'] ?>">
                                                            <?= $item['rw_name'] ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                                <div class="invalid-feedback">Harap pilih RW.</div>
                                            </div>

                                            <div class="form-group">
                                                <label class="required-label" for="no_telp">No. Telp / WA</label>
                                                <input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="Masukkan No. Telp / WA" required>
                                                <div class="invalid-feedback">Nomor telepon ini sudah terdaftar. Gunakan nomor lain.</div>
                                            </div>

                                            <div class="form-group">
                                                <label class="required-label">Akun Facebook</label>
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    <label class="btn btn-outline-primary">
                                                        <input type="radio" name="facebook" value="1" required> Punya
                                                    </label>
                                                    <label class="btn btn-outline-secondary active">
                                                        <input type="radio" name="facebook" value="0" required checked> Tidak
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="required-label">Akun Instagram</label>
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    <label class="btn btn-outline-primary">
                                                        <input type="radio" name="instagram" value="1" required> Punya
                                                    </label>
                                                    <label class="btn btn-outline-secondary active">
                                                        <input type="radio" name="instagram" value="0" required checked> Tidak
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="required-label">Akun TikTok</label>
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    <label class="btn btn-outline-primary">
                                                        <input type="radio" name="tiktok" value="1" required> Punya
                                                    </label>
                                                    <label class="btn btn-outline-secondary active">
                                                        <input type="radio" name="tiktok" value="0" required checked> Tidak
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="required-label">Akun YouTube</label>
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    <label class="btn btn-outline-primary">
                                                        <input type="radio" name="youtube" value="1" required> Punya
                                                    </label>
                                                    <label class="btn btn-outline-secondary active">
                                                        <input type="radio" name="youtube" value="0" required checked> Tidak
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="required-label">Akun Twitter</label>
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    <label class="btn btn-outline-primary">
                                                        <input type="radio" name="twitter" value="1" required> Punya
                                                    </label>
                                                    <label class="btn btn-outline-secondary active">
                                                        <input type="radio" name="twitter" value="0" required checked> Tidak
                                                    </label>
                                                </div>
                                            </div>

                                            <button type="button" class="btn btn-secondary" onclick="prevStep('dataAlamat', 'dataAnggota')">Kembali</button>
                                            <button type="button" class="btn btn-primary" onclick="nextStep('dataAlamat', 'dataPekerjaan')">Lanjut</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 3: Pekerjaan -->
                                <div class="card card-outline card-primary mt-4">
                                    <div class="card-header" data-toggle="collapse" data-target="#dataPekerjaan">
                                        <h5>3. Data Pekerjaan</h5>
                                    </div>
                                    <div id="dataPekerjaan" class="collapse">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label class="required-label" for="jenisPekerjaan">Jenis Pekerjaan</label>
                                                <select class="form-control select2" id="jenisPekerjaan" name="jenisPekerjaan" required>
                                                    <option value="" disabled selected>Pilih Jenis Pekerjaan</option>
                                                    <?php foreach ($pekerjaan as $job) { ?>
                                                        <option value="<?= $job['pekerjaan_id'] ?>">
                                                            <?= $job['pekerjaan_name'] ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                                <div class="invalid-feedback">Harap pilih Jenis Pekerjaan.</div>
                                            </div>

                                            <!-- Fields tambahan yang akan disembunyikan jika tidak bekerja -->
                                            <div id="jobFields" style="display: none;">
                                                <div class="form-group">
                                                    <label id="pendapatanSuamiLabel">Pendapatan Perbulan</label>
                                                    <select name="pendapatanSuami" class="form-control select2" id="pendapatanSuami">
                                                        <option value="" disabled selected>Pilih Pendapatan</option>
                                                        <?php foreach ($pendapatan as $item) { ?>
                                                            <option value="<?= $item['pendapatan_id'] ?>">
                                                                <?= $item['pendapatan_name'] ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                    <div class="invalid-feedback">Harap pilih Pendapatan.</div>
                                                </div>
                                                <div class="form-group">
                                                    <label id="sistemKerjaLabel">Sistem Kerja</label>
                                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                        <label class="btn btn-outline-primary">
                                                            <input type="radio" name="sistemKerja" id="sistemKerja" value="0" autocomplete="off"> Non Shift
                                                        </label>
                                                        <label class="btn btn-outline-primary">
                                                            <input type="radio" name="sistemKerja" id="sistemKerja" value="1" autocomplete="off"> Shift
                                                        </label>
                                                    </div>
                                                    <div class="invalid-feedback">Harap pilih Sistem Kerja.</div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="namaInstansi" id="namaInstansiLabel">Nama Instansi / Tempat Bekerja</label>
                                                    <input type="text" class="form-control" id="namaInstansi" name="namaInstansi" placeholder="Masukkan Nama Instansi">
                                                    <div class="invalid-feedback">Harap isi Nama Instansi.</div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="alamatInstansi" id="alamatInstansiLabel">Alamat Instansi / Tempat Bekerja</label>
                                                    <input type="text" class="form-control" id="alamatInstansi" name="alamatInstansi" placeholder="Masukkan Alamat Instansi">
                                                </div>
                                                <div class="invalid-feedback">Harap isi Alamat Instansi.</div>
                                            </div>

                                            <div id="pekerjaanIstriFields" style="display: none;">
                                                <div class="form-group">
                                                    <label id="pekerjaanIstriLabel" for="jenisPekerjaanIstri">Jenis Pekerjaan Istri</label>
                                                    <select class="form-control select2" id="pekerjaanIstri" name="jenisPekerjaanIstri">
                                                        <option value="" disabled selected>Pilih Jenis Pekerjaan</option>
                                                        <?php foreach ($pekerjaan as $job) { ?>
                                                            <option value="<?= $job['pekerjaan_id'] ?>">
                                                                <?= $job['pekerjaan_name'] ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                    <div class="invalid-feedback">Harap pilih Jenis Pekerjaan.</div>
                                                </div>
                                            </div>

                                            <div id="pendapatanIstriFields" style="display: none;">
                                                <div class="form-group">
                                                    <label for="pendapatanIstri" id="pendapatanIstriLabel">Pendapatan Perbulan Istri</label>
                                                    <select name="pendapatanIstri" class="form-control select2" id="pendapatanIstri">
                                                        <option value="" disabled selected>Pilih Pendapatan</option>
                                                        <?php foreach ($pendapatan as $item) { ?>
                                                            <option value="<?= $item['pendapatan_id'] ?>">
                                                                <?= $item['pendapatan_name'] ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                    <div class="invalid-feedback">Harap pilih Pendapatan.</div>
                                                </div>
                                            </div>

                                            <button type="button" class="btn btn-secondary" onclick="prevStep('dataPekerjaan', 'dataAlamat')">Kembali</button>
                                            <button type="button" class="btn btn-primary" onclick="nextStep('dataPekerjaan', 'dataPendidikan')">Lanjut</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 4: Riwayat Pendidikan dan Organisasi -->
                                <div class="card card-outline card-primary mt-4">
                                    <div class="card-header" data-toggle="collapse" data-target="#dataPendidikan">
                                        <h5>4. Riwayat Pendidikan dan Organisasi</h5>
                                    </div>
                                    <div id="dataPendidikan" class="collapse">
                                        <div class="card-body">
                                            <!-- Pendidikan Terakhir -->
                                            <div class="form-group">
                                                <label class="required-label" for="pendidikanTerakhir">Pendidikan Terakhir</label>
                                                <select class="form-control select2" id="pendidikanTerakhir" name="pendidikanTerakhir" required>
                                                    <option value="" disabled selected>Pilih Pendidikan Terakhir</option>
                                                    <?php foreach ($pendidikan as $edu) { ?>
                                                        <option value="<?= $edu['pendidikan_id'] ?>">
                                                            <?= $edu['pendidikan_name'] ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                                <div class="invalid-feedback">Harap pilih Pendidikan Terakhir.</div>
                                            </div>

                                            <!-- Jurusan SMK -->
                                            <div id="jurusanSmkField" style="display: none;">
                                                <div class="form-group">
                                                    <label id="jurusanSmkLabel">Jurusan SMK</label>
                                                    <select name="jurusanSmk" class="form-control select2" id="jurusanSmk">
                                                        <option value="" disabled selected>Pilih Jurusan</option>
                                                        <?php foreach ($smk as $item) { ?>
                                                            <option value="<?= $item['jurusan_smk_id'] ?>">
                                                                <?= $item['jurusan_smk_name'] ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                    <div class="invalid-feedback">Harap pilih Jurusan SMK.</div>
                                                </div>
                                            </div>

                                            <!-- Bidang Studi -->
                                            <div id="bidangStudiField" style="display: none;">
                                                <div class="form-group">
                                                    <label id="bidangStudiLabel">Bidang Studi</label>
                                                    <select name="bidangStudi" class="form-control select2" id="bidangStudi">
                                                        <option value="" disabled selected>Pilih Bidang Studi</option>
                                                        <?php foreach ($studi as $item) { ?>
                                                            <option value="<?= $item['bidang_studi_id'] ?>">
                                                                <?= $item['bidang_studi_name'] ?>
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                    <div class="invalid-feedback">Harap pilih Bidang Studi.</div>
                                                </div>
                                            </div>

                                            <!-- Nama Lembaga Pendidikan -->
                                            <div class="form-group">
                                                <label class="required-label" for="lembagaPendidikan">Nama Lembaga Pendidikan Terakhir</label>
                                                <input type="text" class="form-control" id="lembagaPendidikan" name="lembagaPendidikan" placeholder="Masukkan Nama Lembaga" required>
                                                <div class="invalid-feedback">Harap masukkan Nama Lembaga Pendidikan Terakhir.</div>
                                            </div>

                                            <!-- Nama Pesantren -->
                                            <div class="form-group">
                                                <label for="namaPesantren">Nama Pesantren</label>
                                                <input type="text" class="form-control" name="namaPesantren" id="namaPesantren" placeholder="Masukkan Nama Pesantren">
                                            </div>

                                            <!-- Nama Madrasah Diniyah -->
                                            <div class="form-group">
                                                <label for="madrasahDiniyah">Nama Madrasah Diniyah</label>
                                                <input type="text" class="form-control" name="madrasahDiniyah" id="madrasahDiniyah" placeholder="Masukkan Nama Madrasah">
                                            </div>
                                            <br>

                                            <!-- Riwayat Organisasi -->
                                            <h6><b>Riwayat Organisasi</b></h6>

                                            <div class="form-group">
                                                <label class="required-label">IPNU</label>
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    <label class="btn btn-outline-primary">
                                                        <input type="radio" name="ipnu" value="1" required> Pernah
                                                    </label>
                                                    <label class="btn btn-outline-primary">
                                                        <input type="radio" name="ipnu" value="0" required> Tidak Pernah
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="required-label">PMII</label>
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    <label class="btn btn-outline-primary">
                                                        <input type="radio" name="pmii" value="1" required> Pernah
                                                    </label>
                                                    <label class="btn btn-outline-primary">
                                                        <input type="radio" name="pmii" value="0" required> Tidak Pernah
                                                    </label>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="required-label">DEMA / BEM</label>
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    <label class="btn btn-outline-primary">
                                                        <input type="radio" name="dema" value="1" required> Pernah
                                                    </label>
                                                    <label class="btn btn-outline-primary">
                                                        <input type="radio" name="dema" value="0" required> Tidak Pernah
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="organisasiLainnya">Organisasi Lainnya</label>
                                                <input type="text" class="form-control" id="organisasiLainnya" name="organisasiLainnya" placeholder="Masukkan Nama Organisasi">
                                            </div>

                                            <div class="form-group">
                                                <label class="required-label" for="afiliasiPartai">Afiliasi Partai Politik Saat Ini</label>
                                                <select name="afiliasiPartai" id="afiliasiPartai" class="form-control select2" required>
                                                    <!-- ambil data dari tb_partai -->
                                                    <option value="" disabled selected>Pilih Partai</option>
                                                    <?php foreach ($partai as $item) { ?>
                                                        <option value="<?= $item['partai_id'] ?>">
                                                            <?= $item['partai_name'] ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                                <div class="invalid-feedback">Harap pilih Afiliasi Partai Politik Saat Ini.</div>
                                            </div>

                                            <button type="button" class="btn btn-secondary" onclick="prevStep('dataPendidikan', 'dataPekerjaan')">Kembali</button>
                                            <button type="button" class="btn btn-primary" onclick="nextStep('dataPendidikan', 'dataKepengurusan')">Lanjut</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 5: Riwayat Kepengurusan di Ansor -->
                                <div class="card card-outline card-primary mt-4">
                                    <div class="card-header" data-toggle="collapse" data-target="#dataKepengurusan">
                                        <h5>5. Riwayat Kepengurusan di Ansor</h5>
                                    </div>
                                    <div id="dataKepengurusan" class="collapse">
                                        <div class="card-body">
                                            <!-- Tingkat Pimpinan Ranting -->
                                            <h6>A. Tingkat Pimpinan Ranting</h6>
                                            <div class="form-group">
                                                <label for="namaKecamatanRanting">Kecamatan</label>
                                                <select class="form-control" id="namaKecamatanRanting" name="namaKecamatanRanting">
                                                    <option value="">Pilih Kecamatan</option>
                                                </select>
                                                <div class="invalid-feedback">Harap pilih Kecamatan.</div>
                                            </div>
                                            <div class="form-group">
                                                <label for="namaDesaRanting">Desa</label>
                                                <select class="form-control" id="namaDesaRanting" name="namaDesaRanting">
                                                    <option value="">Pilih Desa</option>
                                                </select>
                                                <div class="invalid-feedback">Harap pilih Desa.</div>
                                            </div>
                                            <div class="form-group">
                                                <label for="jabatanRanting">Jabatan Tertinggi di Ranting</label>
                                                <select name="jabatanRanting" class="form-control select2">
                                                    <option value="" disabled selected>Pilih Jabatan</option>
                                                    <?php foreach ($pr as $item) { ?>
                                                        <option value="<?= $item['jabatan_pr_id'] ?>">
                                                            <?= $item['jabatan_pr_name'] ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="masaRanting">Masa Khidmat di Ranting</label>
                                                <select name="masaRanting" class="form-control select2">
                                                    <option value="" disabled selected>Pilih Masa</option>
                                                    <?php foreach ($masa_khidmat as $item) { ?>
                                                        <option value="<?= $item['masa_khidmat_id'] ?>">
                                                            <?= $item['masa_khidmat_name'] ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <br>

                                            <!-- Tingkat Pimpinan Anak Cabang -->
                                            <h6>B. Tingkat Pimpinan Anak Cabang (PAC)</h6>
                                            <div class="form-group">
                                                <label for="kecamatanPAC">Kecamatan (PAC)</label>
                                                <select id="kecamatanPAC" name="kecamatanPAC" class="form-control select2">
                                                    <option value="" disabled selected>Pilih Kecamatan</option>
                                                    <?php foreach ($kecamatan as $item) { ?>
                                                        <option value="<?= $item['districts_id'] ?>">
                                                            <?= $item['districts_name'] ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="jabatanPAC">Jabatan Tertinggi di PAC</label>
                                                <select name="jabatanPAC" class="form-control select2">
                                                    <option value="" disabled selected>Pilih Jabatan</option>
                                                    <?php foreach ($pac as $item) { ?>
                                                        <option value="<?= $item['jabatan_pac_id'] ?>">
                                                            <?= $item['jabatan_pac_name'] ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="masaPAC">Masa Khidmat di PAC</label>
                                                <select name="masaPAC" class="form-control select2">
                                                    <option value="" disabled selected>Pilih Masa</option>
                                                    <?php foreach ($masa_khidmat as $item) { ?>
                                                        <option value="<?= $item['masa_khidmat_id'] ?>">
                                                            <?= $item['masa_khidmat_name'] ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <br>

                                            <!-- Tingkat Pimpinan Cabang -->
                                            <h6>C. Tingkat Pimpinan Cabang (PC)</h6>
                                            <div class="form-group">
                                                <label for="jabatanPC">Jabatan Tertinggi di PC</label>
                                                <select name="jabatanPC" class="form-control select2">
                                                    <option value="" disabled selected>Pilih Jabatan</option>
                                                    <?php foreach ($pc as $item) { ?>
                                                        <option value="<?= $item['jabatan_pc_id'] ?>">
                                                            <?= $item['jabatan_pc_name'] ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="masaPC">Masa Khidmat di PC</label>
                                                <select name="masaPC" class="form-control select2">
                                                    <option value="" disabled selected>Pilih Masa</option>
                                                    <?php foreach ($masa_khidmat as $item) { ?>
                                                        <option value="<?= $item['masa_khidmat_id'] ?>">
                                                            <?= $item['masa_khidmat_name'] ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <button type="button" class="btn btn-secondary" onclick="prevStep('dataKepengurusan', 'dataPendidikan')">Kembali</button>
                                            <button type="button" class="btn btn-primary" onclick="nextStep('dataKepengurusan', 'dataPelatihanKaderisasi')">Lanjut</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 6: Riwayat Pelatihan Kaderisasi -->
                                <div class="card card-outline card-primary mt-4">
                                    <div class="card-header" data-toggle="collapse" data-target="#dataPelatihanKaderisasi">
                                        <h5>6. Riwayat Pelatihan Kaderisasi</h5>
                                    </div>
                                    <div id="dataPelatihanKaderisasi" class="collapse">
                                        <div class="card-body">

                                            <div class="row align-items-center">
                                                <!-- A. Pendidikan Kader -->
                                                <div class="col-md-6">
                                                    <h6>A. Pendidikan Kader</h6>
                                                    <div class="form-group">
                                                        <div class="icheck-primary d-block">
                                                            <input type="checkbox" id="pkd" name="pendidikanKader[]" value="PKD">
                                                            <label for="pkd">PKD</label>
                                                        </div>
                                                        <div class="icheck-primary d-block">
                                                            <input type="checkbox" id="pkl" name="pendidikanKader[]" value="PKL">
                                                            <label for="pkl">PKL</label>
                                                        </div>
                                                        <div class="icheck-primary d-block">
                                                            <input type="checkbox" id="pkn" name="pendidikanKader[]" value="PKN">
                                                            <label for="pkn">PKN</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Upload Sertifikat -->
                                                <div class="col-md-6">
                                                    <div id="pkdUpload" class="upload-section pendidikanKader" style="display: none;">
                                                        <div class="form-group">
                                                            <label>Upload Sertifikat PKD</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="pkdCertificate" name="pkdCertificate" accept="image/*,application/pdf">
                                                                    <label class="custom-file-label" for="pkdCertificate">Pilih file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div id="pklUpload" class="upload-section pendidikanKader" style="display: none;">
                                                        <div class="form-group">
                                                            <label>Upload Sertifikat PKL</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="pklCertificate" name="pklCertificate" accept="image/*,application/pdf">
                                                                    <label class="custom-file-label" for="pklCertificate">Pilih file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div id="pknUpload" class="upload-section pendidikanKader" style="display: none;">
                                                        <div class="form-group">
                                                            <label>Upload Sertifikat PKN</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="pknCertificate" name="pknCertificate" accept="image/*,application/pdf">
                                                                    <label class="custom-file-label" for="pknCertificate">Pilih file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>

                                            <div class="row" id="latihanInstrukturSection" style="display: none;">
                                                <!-- B. Latihan Instruktur -->
                                                <div class="col-md-6">
                                                    <h6>B. Latihan Instruktur</h6>
                                                    <div class="form-group">
                                                        <div class="icheck-primary d-block">
                                                            <input type="checkbox" id="li1" name="instruktur[]" value="LI I" onchange="toggleUploadInstruktur()">
                                                            <label for="li1">LI I</label>
                                                        </div>
                                                        <div class="icheck-primary d-block">
                                                            <input type="checkbox" id="li2" name="instruktur[]" value="LI II" onchange="toggleUploadInstruktur()">
                                                            <label for="li2">LI II</label>
                                                        </div>
                                                        <div class="icheck-primary d-block">
                                                            <input type="checkbox" id="li3" name="instruktur[]" value="LI III" onchange="toggleUploadInstruktur()">
                                                            <label for="li3">LI III</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Upload Sertifikat untuk Latihan Instruktur -->
                                                <div class="col-md-6">
                                                    <div id="li1Upload" class="upload-section instruktur" style="display: none;">
                                                        <div class="form-group">
                                                            <label>Upload Sertifikat LI I</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="li1Certificate" name="li1Certificate" accept="image/*,application/pdf">
                                                                    <label class="custom-file-label" for="li1Certificate">Pilih file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div id="li2Upload" class="upload-section instruktur" style="display: none;">
                                                        <div class="form-group">
                                                            <label>Upload Sertifikat LI II</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="li2Certificate" name="li2Certificate" accept="image/*,application/pdf">
                                                                    <label class="custom-file-label" for="li2Certificate">Pilih file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div id="li3Upload" class="upload-section instruktur" style="display: none;">
                                                        <div class="form-group">
                                                            <label>Upload Sertifikat LI III</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="li3Certificate" name="li3Certificate" accept="image/*,application/pdf">
                                                                    <label class="custom-file-label" for="li3Certificate">Pilih file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>

                                            <div class="row" id="dirosahPendidikanLatihanSection" style="display: none;">
                                                <!-- C. Dirosah -->
                                                <div class="col-md-6">
                                                    <h6>C. Dirosah</h6>
                                                    <div class="form-group">
                                                        <div class="icheck-primary d-block">
                                                            <input type="checkbox" id="dirosahUla" name="dirosah[]" value="Dirosah Ula" onchange="toggleUploadDirosah()">
                                                            <label for="dirosahUla">Dirosah Ula</label>
                                                        </div>
                                                        <div class="icheck-primary d-block">
                                                            <input type="checkbox" id="dirosahWustho" name="dirosah[]" value="Dirosah Wustho" onchange="toggleUploadDirosah()">
                                                            <label for="dirosahWustho">Dirosah Wustho</label>
                                                        </div>
                                                        <div class="icheck-primary d-block">
                                                            <input type="checkbox" id="dirosahUlya" name="dirosah[]" value="Dirosah Ulya" onchange="toggleUploadDirosah()">
                                                            <label for="dirosahUlya">Dirosah Ulya</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Upload Sertifikat untuk Dirosah -->
                                                <div class="col-md-6">
                                                    <div id="dirosahUlaUpload" class="upload-section dirosah" style="display: none;">
                                                        <div class="form-group">
                                                            <label>Upload Sertifikat Dirosah Ula</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="dirosahUlaCertificate" name="dirosahulaCertificate" accept="image/*,application/pdf">
                                                                    <label class="custom-file-label" for="dirosahUlaCertificate">Pilih file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div id="dirosahWusthoUpload" class="upload-section dirosah" style="display: none;">
                                                        <div class="form-group">
                                                            <label>Upload Sertifikat Dirosah Wustho</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="dirosahWusthoCertificate" name="dirosahwusthoCertificate" accept="image/*,application/pdf">
                                                                    <label class="custom-file-label" for="dirosahWusthoCertificate">Pilih file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div id="dirosahUlyaUpload" class="upload-section dirosah" style="display: none;">
                                                        <div class="form-group">
                                                            <label>Upload Sertifikat Dirosah Ulya</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="dirosahUlyaCertificate" name="dirosahulyaCertificate" accept="image/*,application/pdf">
                                                                    <label class="custom-file-label" for="dirosahUlyaCertificate">Pilih file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>

                                            <div class="row" id="diklatsarPendidikanLatihanSection" style="display: none;">
                                                <!-- D. Pendidikan & Latihan -->
                                                <div class="col-md-6">
                                                    <h6>D. Pendidikan & Latihan</h6>
                                                    <div class="form-group">
                                                        <div class="icheck-primary d-block">
                                                            <input type="checkbox" id="diklatsar" name="pendidikanLatihan[]" value="Diklatsar" onchange="toggleUploadLatihan()">
                                                            <label for="diklatsar">Diklatsar</label>
                                                        </div>
                                                        <div class="icheck-primary d-block">
                                                            <input type="checkbox" id="susbalan" name="pendidikanLatihan[]" value="SUSBALAN" onchange="toggleUploadLatihan()">
                                                            <label for="susbalan">SUSBALAN</label>
                                                        </div>
                                                        <div class="icheck-primary d-block">
                                                            <input type="checkbox" id="susbanpim" name="pendidikanLatihan[]" value="SUSBANPIM" onchange="toggleUploadLatihan()">
                                                            <label for="susbanpim">SUSBANPIM</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Upload Sertifikat untuk Pendidikan & Latihan -->
                                                <div class="col-md-6">
                                                    <div id="diklatsarUpload" class="upload-section pendidikanLatihan" style="display: none;">
                                                        <div class="form-group">
                                                            <label>Upload Sertifikat Diklatsar</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="diklatsarCertificate" name="diklatsarCertificate" accept="image/*,application/pdf">
                                                                    <label class="custom-file-label" for="diklatsarCertificate">Pilih file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div id="susbalanUpload" class="upload-section pendidikanLatihan" style="display: none;">
                                                        <div class="form-group">
                                                            <label>Upload Sertifikat SUSBALAN</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="susbalanCertificate" name="susbalanCertificate" accept="image/*,application/pdf">
                                                                    <label class="custom-file-label" for="susbalanCertificate">Pilih file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div id="susbanpimUpload" class="upload-section pendidikanLatihan" style="display: none;">
                                                        <div class="form-group">
                                                            <label>Upload Sertifikat SUSBANPIM</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="susbanpimCertificate" name="susbanpimCertificate" accept="image/*,application/pdf">
                                                                    <label class="custom-file-label" for="susbanpimCertificate">Pilih file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>

                                            <div class="row" id="kursusKepelatihanSection" style="display: none;">
                                                <!-- E. Kursus Kepelatihan -->
                                                <div class="col-md-6">
                                                    <h6>E. Kursus Kepelatihan</h6>
                                                    <div class="form-group">
                                                        <div class="icheck-primary d-block">
                                                            <input type="checkbox" id="suspelat1" name="kursus[]" value="SUSPELAT I" onchange="toggleUploadKursus()">
                                                            <label for="suspelat1">SUSPELAT I</label>
                                                        </div>
                                                        <div class="icheck-primary d-block">
                                                            <input type="checkbox" id="suspelat2" name="kursus[]" value="SUSPELAT II" onchange="toggleUploadKursus()">
                                                            <label for="suspelat2">SUSPELAT II</label>
                                                        </div>
                                                        <div class="icheck-primary d-block">
                                                            <input type="checkbox" id="suspelat3" name="kursus[]" value="SUSPELAT III" onchange="toggleUploadKursus()">
                                                            <label for="suspelat3">SUSPELAT III</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Upload Sertifikat untuk Kursus Kepelatihan -->
                                                <div class="col-md-6">
                                                    <div id="suspelat1Upload" class="upload-section kursus" style="display: none;">
                                                        <div class="form-group">
                                                            <label>Upload Sertifikat SUSPELAT I</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="suspelat1Certificate" name="suspelat1Certificate" accept="image/*,application/pdf">
                                                                    <label class="custom-file-label" for="suspelat1Certificate">Pilih file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div id="suspelat2Upload" class="upload-section kursus" style="display: none;">
                                                        <div class="form-group">
                                                            <label>Upload Sertifikat SUSPELAT II</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="suspelat2Certificate" name="suspelat2Certificate" accept="image/*,application/pdf">
                                                                    <label class="custom-file-label" for="suspelat2Certificate">Pilih file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div id="suspelat3Upload" class="upload-section kursus" style="display: none;">
                                                        <div class="form-group">
                                                            <label>Upload Sertifikat SUSPELAT III</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="suspelat3Certificate" name="suspelat3Certificate" accept="image/*,application/pdf">
                                                                    <label class="custom-file-label" for="suspelat3Certificate">Pilih file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>

                                            <div class="row" id="pendidikanLatihanKhususSection" style="display: none;">
                                                <!-- F. Pendidikan & Latihan Khusus -->
                                                <div class="col-md-6">
                                                    <h6>F. Pendidikan & Latihan Khusus</h6>
                                                    <div class="form-group">
                                                        <div class="icheck-primary d-block">
                                                            <input type="checkbox" id="diklatsusBagana" name="latihanKhusus[]" value="DIKLATSUS BAGANA" onchange="toggleUpload('latihanKhusus')">
                                                            <label for="diklatsusBagana">DIKLATSUS BAGANA</label>
                                                        </div>
                                                        <div class="icheck-primary d-block">
                                                            <input type="checkbox" id="diklatsusProtokoler" name="latihanKhusus[]" value="DIKLATSUS PROTOKOLER" onchange="toggleUpload('latihanKhusus')">
                                                            <label for="diklatsusProtokoler">DIKLATSUS PROTOKOLER</label>
                                                        </div>
                                                        <div class="icheck-primary d-block">
                                                            <input type="checkbox" id="diklatsusBalakar" name="latihanKhusus[]" value="DIKLATSUS BALAKAR" onchange="toggleUpload('latihanKhusus')">
                                                            <label for="diklatsusBalakar">DIKLATSUS BALAKAR</label>
                                                        </div>
                                                        <div class="icheck-primary d-block">
                                                            <input type="checkbox" id="diklatsusBalantas" name="latihanKhusus[]" value="DIKLATSUS BALANTAS" onchange="toggleUpload('latihanKhusus')">
                                                            <label for="diklatsusBalantas">DIKLATSUS BALANTAS</label>
                                                        </div>
                                                        <div class="icheck-primary d-block">
                                                            <input type="checkbox" id="diklatsusBaritim" name="latihanKhusus[]" value="DIKLATSUS BARITIM" onchange="toggleUpload('latihanKhusus')">
                                                            <label for="diklatsusBaritim">DIKLATSUS BARITIM</label>
                                                        </div>
                                                        <div class="icheck-primary d-block">
                                                            <input type="checkbox" id="diklatsusDensus99" name="latihanKhusus[]" value="DIKLATSUS DENSUS 99" onchange="toggleUpload('latihanKhusus')">
                                                            <label for="diklatsusDensus99">DIKLATSUS DENSUS 99</label>
                                                        </div>
                                                        <div class="icheck-primary d-block">
                                                            <input type="checkbox" id="diklatsusProvost" name="latihanKhusus[]" value="DIKLATSUS PROVOST" onchange="toggleUpload('latihanKhusus')">
                                                            <label for="diklatsusProvost">DIKLATSUS PROVOST</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Upload Sertifikat untuk Pendidikan & Latihan Khusus -->
                                                <div class="col-md-6">
                                                    <!-- Upload Section for DIKLATSUS BAGANA -->
                                                    <div id="diklatsusBaganaUpload" class="upload-section latihanKhusus" style="display: none;">
                                                        <div class="form-group">
                                                            <label>Upload Sertifikat DIKLATSUS BAGANA</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="diklatsusBaganaCertificate" name="diklatsusbaganaCertificate" accept="image/*,application/pdf">
                                                                    <label class="custom-file-label" for="diklatsusBaganaCertificate">Pilih file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Upload Section for DIKLATSUS PROTOKOLER -->
                                                    <div id="diklatsusProtokolerUpload" class="upload-section latihanKhusus" style="display: none;">
                                                        <div class="form-group">
                                                            <label>Upload Sertifikat DIKLATSUS PROTOKOLER</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="diklatsusProtokolerCertificate" name="diklatsusprotokolerCertificate" accept="image/*,application/pdf">
                                                                    <label class="custom-file-label" for="diklatsusProtokolerCertificate">Pilih file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Upload Section for DIKLATSUS BALAKAR -->
                                                    <div id="diklatsusBalakarUpload" class="upload-section latihanKhusus" style="display: none;">
                                                        <div class="form-group">
                                                            <label>Upload Sertifikat DIKLATSUS BALAKAR</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="diklatsusBalakarCertificate" name="diklatsusbalakarCertificate" accept="image/*,application/pdf">
                                                                    <label class="custom-file-label" for="diklatsusBalakarCertificate">Pilih file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Upload Section for DIKLATSUS BALANTAS -->
                                                    <div id="diklatsusBalantasUpload" class="upload-section latihanKhusus" style="display: none;">
                                                        <div class="form-group">
                                                            <label>Upload Sertifikat DIKLATSUS BALANTAS</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="diklatsusBalantasCertificate" name="diklatsusbalantasCertificate" accept="image/*,application/pdf">
                                                                    <label class="custom-file-label" for="diklatsusBalantasCertificate">Pilih file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Upload Section for DIKLATSUS BARITIM -->
                                                    <div id="diklatsusBaritimUpload" class="upload-section latihanKhusus" style="display: none;">
                                                        <div class="form-group">
                                                            <label>Upload Sertifikat DIKLATSUS BARITIM</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="diklatsusBaritimCertificate" name="diklatsusbaritimCertificate" accept="image/*,application/pdf">
                                                                    <label class="custom-file-label" for="diklatsusBaritimCertificate">Pilih file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Upload Section for DIKLATSUS DENSUS 99 -->
                                                    <div id="diklatsusDensus99Upload" class="upload-section latihanKhusus" style="display: none;">
                                                        <div class="form-group">
                                                            <label>Upload Sertifikat DIKLATSUS DENSUS 99</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="diklatsusDensus99Certificate" name="diklatsusdensus99Certificate" accept="image/*,application/pdf">
                                                                    <label class="custom-file-label" for="diklatsusDensus99Certificate">Pilih file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Upload Section for DIKLATSUS PROVOST -->
                                                    <div id="diklatsusProvostUpload" class="upload-section latihanKhusus" style="display: none;">
                                                        <div class="form-group">
                                                            <label>Upload Sertifikat DIKLATSUS PROVOST</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="diklatsusProvostCertificate" name="diklatsusprovostCertificate" accept="image/*,application/pdf">
                                                                    <label class="custom-file-label" for="diklatsusProvostCertificate">Pilih file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>

                                            <button type="button" class="btn btn-secondary" onclick="prevStep('dataPelatihanKaderisasi', 'dataKepengurusan')">Kembali</button>
                                            <button type="submit" class="btn btn-success">Selesai</button>
                                        </div>
                                    </div>
                                </div>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>

    </div>
    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            Versi 1.0
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2024 Ansor Kudus</strong>
    </footer>
    </div>
    <!-- ./wrapper -->

    <!--  REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="assets/adminlte/plugins/jquery/jquery.min.js"></script>
    <!-- select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/adminlte/dist/js/adminlte.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
    <!-- icheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.css" integrity="sha512-J5tsMaZISEmI+Ly68nBDiQyNW6vzBoUlNHGsH8T3DzHTn2h9swZqiMeGm/4WMDxAphi5LMZMNA30LvxaEPiPkg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script>
        function nextStep(current, next) {
            $('#' + current).collapse('hide');
            $('#' + next).collapse('show');
            document.getElementById(next).scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        function prevStep(current, prev) {
            $('#' + current).collapse('hide');
            $('#' + prev).collapse('show');
        }

        // Upload NPWP & BPJS
        function toggleUploadSection(field, show) {
            const uploadSection = document.getElementById(field + 'Upload');
            const fileInput = document.getElementById(field + 'File');

            // Tampilkan atau sembunyikan bagian upload
            uploadSection.style.display = show ? 'block' : 'none';

            // Tambahkan atau hapus atribut required berdasarkan pilihan
            if (show) {
                fileInput.setAttribute('required', 'required');
            } else {
                fileInput.removeAttribute('required');
            }
        }

        // FIeld Data Anggota & Pekerjaan Istri
        function toggleMarriageFields() {
            const marriageDetails = document.getElementById('marriageDetails');
            const nama_istri = document.getElementById('nama_istri');
            const anak_laki = document.getElementById('anak_laki');
            const anak_perempuan = document.getElementById('anak_perempuan');
            const nama_istriLabel = document.getElementById('nama_istriLabel');
            const anak_lakiLabel = document.getElementById('anak_lakiLabel');
            const anak_perempuanLabel = document.getElementById('anak_perempuanLabel');

            const pekerjaanIstriFields = document.getElementById('pekerjaanIstriFields');
            const pekerjaanIstri = document.getElementById('pekerjaanIstri');
            const pendapatanIstri = document.getElementById('pendapatanIstri');
            const pekerjaanIstriLabel = document.getElementById('pekerjaanIstriLabel');
            const pendapatanIstriLabel = document.getElementById('pendapatanIstriLabel');

            const selectedStatusPernikahan = document.querySelector('input[name="status_pernikahan"]:checked').value;

            document.getElementById('pekerjaanIstri').onchange = function() {
                if (this.value !== '21') {
                    pendapatanIstriFields.style.display = 'block';
                    pendapatanIstri.required = true;
                    pendapatanIstriLabel.classList.add('required-label');
                } else {
                    pendapatanIstriFields.style.display = 'none';
                    pendapatanIstri.required = false;
                    pendapatanIstriLabel.classList.remove('required-label');
                }
            }

            // Show fields and mark as required if "Menikah" is selected
            if (selectedStatusPernikahan === '2') {
                marriageDetails.style.display = 'block';
                pekerjaanIstriFields.style.display = 'block';
                nama_istri.required = true;
                anak_laki.required = true;
                anak_perempuan.required = true;
                pekerjaanIstri.required = true;

                // Add red asterisk to labels
                nama_istriLabel.classList.add('required-label');
                anak_lakiLabel.classList.add('required-label');
                anak_perempuanLabel.classList.add('required-label');
                pekerjaanIstriLabel.classList.add('required-label');
            } else {
                // Hide fields and remove required attribute
                marriageDetails.style.display = 'none';
                pekerjaanIstriFields.style.display = 'none';
                nama_istri.required = false;
                anak_laki.required = false;
                anak_perempuan.required = false;
                pekerjaanIstri.required = false;
                pendapatanIstri.required = false;

                // Remove red asterisk from labels
                nama_istriLabel.classList.remove('required-label');
                anak_lakiLabel.classList.remove('required-label');
                anak_perempuanLabel.classList.remove('required-label');
                pekerjaanIstriLabel.classList.remove('required-label');
                pendapatanIstriLabel.classList.remove('required-label');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            toggleMarriageFields(); // Panggil saat DOM sudah siap
        });

        // Field Alamat
        document.addEventListener('DOMContentLoaded', function() {
            // Fetch data kecamatan saat halaman dimuat
            fetch('config/districts.php')
                .then(response => response.json())
                .then(data => {
                    const kecamatanSelect = document.getElementById('kecamatan');
                    kecamatanSelect.innerHTML = '<option value="" disabled selected>Pilih Kecamatan</option>';

                    if (data.status === "success") {
                        data.data.forEach(district => {
                            const option = document.createElement('option');
                            option.value = district.districts_id;
                            option.textContent = district.districts_name;
                            kecamatanSelect.appendChild(option);
                        });
                    } else {
                        alert('Tidak ada data kecamatan ditemukan.');
                    }
                })
                .catch(error => console.error('Error:', error));

            // Fetch data desa saat kecamatan berubah
            document.getElementById('kecamatan').addEventListener('change', function() {
                const districtsId = this.value;
                const desaSelect = document.getElementById('desa');

                if (!districtsId) {
                    desaSelect.innerHTML = '<option value="" disabled selected>Pilih Desa</option>';
                    return;
                }

                // Fetch desa berdasarkan kecamatan yang dipilih
                fetch(`config/villages.php?districts_id=${districtsId}`)
                    .then(response => response.json())
                    .then(data => {
                        desaSelect.innerHTML = '<option value="" disabled selected>Pilih Desa</option>';

                        if (data.status === "success") {
                            data.data.forEach(village => {
                                const option = document.createElement('option');
                                option.value = village.villages_id;
                                option.textContent = village.villages_name;
                                desaSelect.appendChild(option);
                            });
                        } else {
                            alert('Tidak ada data desa ditemukan.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });


        // Field Kepengurusan Ranting
        document.addEventListener('DOMContentLoaded', function() {
            // Fetch data kecamatan saat halaman dimuat
            fetch('config/districts.php')
                .then(response => response.json())
                .then(data => {
                    const kecamatanSelect = document.getElementById('namaKecamatanRanting');
                    kecamatanSelect.innerHTML = '<option value="" disabled selected>Pilih Kecamatan</option>';

                    if (data.status === "success") {
                        data.data.forEach(district => {
                            const option = document.createElement('option');
                            option.value = district.districts_id;
                            option.textContent = district.districts_name;
                            kecamatanSelect.appendChild(option);
                        });
                    } else {
                        alert('Tidak ada data kecamatan ditemukan.');
                    }
                })
                .catch(error => console.error('Error:', error));

            // Fetch data desa saat kecamatan berubah
            document.getElementById('namaKecamatanRanting').addEventListener('change', function() {
                const districtsId = this.value;
                const desaSelect = document.getElementById('namaDesaRanting');

                if (!districtsId) {
                    desaSelect.innerHTML = '<option value="" disabled selected>Pilih Desa</option>';
                    return;
                }

                // Fetch desa berdasarkan kecamatan yang dipilih
                fetch(`config/villages.php?districts_id=${districtsId}`)
                    .then(response => response.json())
                    .then(data => {
                        desaSelect.innerHTML = '<option value="" disabled selected>Pilih Desa</option>';

                        if (data.status === "success") {
                            data.data.forEach(village => {
                                const option = document.createElement('option');
                                option.value = village.villages_id;
                                option.textContent = village.villages_name;
                                desaSelect.appendChild(option);
                            });
                        } else {
                            alert('Tidak ada data desa ditemukan.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });

        // Field Pekerjaan Suami
        document.getElementById('jenisPekerjaan').onchange = function() {
            const jobFields = document.getElementById('jobFields');
            const pendapatanLabel = document.getElementById('pendapatanSuamiLabel');
            const sistemKerjaLabel = document.getElementById('sistemKerjaLabel');
            const namaInstansiLabel = document.getElementById('namaInstansiLabel');
            const alamatInstansiLabel = document.getElementById('alamatInstansiLabel');

            const pendapatan = document.getElementById('pendapatanSuami');
            const sistemKerja = document.getElementById('sistemKerja');
            const namaInstansi = document.getElementById('namaInstansi');
            const alamatInstansi = document.getElementById('alamatInstansi');

            if (this.value !== '21') {
                jobFields.style.display = 'block';
                pendapatanLabel.classList.add('required-label');
                sistemKerjaLabel.classList.add('required-label');
                namaInstansiLabel.classList.add('required-label');
                alamatInstansiLabel.classList.add('required-label');
                pendapatan.required = true;
                sistemKerja.required = true;
                namaInstansi.required = true;
                alamatInstansi.required = true;
            } else {
                jobFields.style.display = 'none';
                pendapatanLabel.classList.remove('required-label');
                sistemKerjaLabel.classList.remove('required-label');
                namaInstansiLabel.classList.remove('required-label');
                alamatInstansiLabel.classList.remove('required-label');
                pendapatan.required = false;
                sistemKerja.required = false;
                namaInstansi.required = false;
                alamatInstansi.required = false;
            }
        };

        // Field Pendidikan Terakhir
        document.getElementById('pendidikanTerakhir').onchange = function() {
            const jurusanSmkField = document.getElementById('jurusanSmkField');
            const bidangStudiField = document.getElementById('bidangStudiField');

            const jurusanSmkLabel = document.getElementById('jurusanSmkLabel');
            const bidangStudiLabel = document.getElementById('bidangStudiLabel');

            const jurusanSmk = document.getElementById('jurusanSmk');
            const bidangStudi = document.getElementById('bidangStudi');

            if (this.value === '4') {
                jurusanSmkField.style.display = 'block';
                bidangStudiField.style.display = 'none';
                jurusanSmkLabel.classList.add('required-label');
                bidangStudiLabel.classList.remove('required-label');
                jurusanSmk.required = true;
                bidangStudi.required = false;
            } else if (this.value === '5' || this.value === '6' || this.value === '7') {
                jurusanSmkField.style.display = 'none';
                bidangStudiField.style.display = 'block';
                jurusanSmkLabel.classList.remove('required-label');
                bidangStudiLabel.classList.add('required-label');
                jurusanSmk.required = false;
                bidangStudi.required = true;
            } else {
                jurusanSmkField.style.display = 'none';
                bidangStudiField.style.display = 'none';
                jurusanSmkLabel.classList.remove('required-label');
                bidangStudiLabel.classList.remove('required-label');
                jurusanSmk.required = false;
                bidangStudi.required = false;
            }
        };

        // Field Pelatihan Kaderisasi
        // Fungsi untuk menampilkan atau menyembunyikan bagian upload untuk setiap kelompok checkbox
        function toggleUpload(sectionName) {
            const checkboxes = document.querySelectorAll(`input[name="${sectionName}[]"]`);

            checkboxes.forEach(checkbox => {
                const uploadSection = document.getElementById(checkbox.id + 'Upload');
                if (checkbox.checked) {
                    uploadSection.style.display = 'block'; // Tampilkan bagian upload jika checkbox dicentang
                } else {
                    uploadSection.style.display = 'none'; // Sembunyikan bagian upload jika checkbox tidak dicentang
                }
            });
        }

        // Fungsi untuk menampilkan atau menyembunyikan bagian tertentu berdasarkan checkbox utama yang dipilih
        function toggleSections() {
            // Ambil elemen checkbox utama untuk kontrol tampilan
            const pkd = document.getElementById('pkd');
            const pkl = document.getElementById('pkl');
            const susbalan = document.getElementById('susbalan');
            const diklatsar = document.getElementById('diklatsar');

            // Tampilkan atau sembunyikan bagian tertentu berdasarkan status checkbox utama
            document.getElementById('dirosahPendidikanLatihanSection').style.display = pkd.checked ? 'block' : 'none';
            document.getElementById('diklatsarPendidikanLatihanSection').style.display = pkd.checked ? 'block' : 'none';
            document.getElementById('latihanInstrukturSection').style.display = pkl.checked ? 'block' : 'none';
            document.getElementById('kursusKepelatihanSection').style.display = susbalan.checked ? 'block' : 'none';
            document.getElementById('pendidikanLatihanKhususSection').style.display = diklatsar.checked ? 'block' : 'none';
        }

        // Tambahkan fungsi ini ke bagian JavaScript
        function toggleUploadInstruktur() {
            // Toggle untuk setiap checkbox Latihan Instruktur
            ['li1', 'li2', 'li3'].forEach(id => {
                const checkbox = document.getElementById(id);
                const uploadDiv = document.getElementById(id + 'Upload');
                const fileInput = document.getElementById(id + 'Certificate');

                if (checkbox && uploadDiv && fileInput) {
                    uploadDiv.style.display = checkbox.checked ? 'block' : 'none';
                    if (checkbox.checked) {
                        fileInput.setAttribute('required', 'required');
                    } else {
                        fileInput.removeAttribute('required');
                    }
                }
            });
        }

        // Fungsi untuk menampilkan atau menyembunyikan upload section berdasarkan checkbox SUSPELAT
        function toggleUploadKursus() {
            // Daftar ID checkbox untuk Kursus Kepelatihan
            ['suspelat1', 'suspelat2', 'suspelat3'].forEach(id => {
                const checkbox = document.getElementById(id);
                const uploadDiv = document.getElementById(id + 'Upload');
                const fileInput = document.getElementById(id + 'Certificate');

                if (checkbox && uploadDiv && fileInput) {
                    // Tampilkan atau sembunyikan div upload berdasarkan status checkbox
                    uploadDiv.style.display = checkbox.checked ? 'block' : 'none';
                    if (checkbox.checked) {
                        fileInput.setAttribute('required', 'required'); // Tambahkan atribut required
                    } else {
                        fileInput.removeAttribute('required'); // Hapus atribut required
                    }
                }
            });
        }

        // Panggil fungsi saat halaman dimuat untuk mengatur status awal
        window.onload = toggleUploadKursus;


        // Event listener untuk checkbox pendidikan kader
        document.querySelectorAll('input[name="pendidikanKader[]"]').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const uploadId = this.id + 'Upload';
                const uploadDiv = document.getElementById(uploadId);
                const fileInput = uploadDiv.querySelector('input[type="file"]');

                if (this.checked) {
                    uploadDiv.style.display = 'block';
                    fileInput.setAttribute('required', 'required');
                } else {
                    uploadDiv.style.display = 'none';
                    fileInput.removeAttribute('required');
                }
            });
        });

        // Fungsi untuk inisialisasi toggle pada setiap bagian checkbox
        function initializeToggleForSection(sectionName) {
            // Panggil toggleUpload untuk setup awal setiap bagian
            toggleUpload(sectionName);

            // Tambahkan event listener pada checkbox untuk memicu toggleUpload saat status berubah
            document.querySelectorAll(`input[name="${sectionName}[]"]`).forEach(checkbox => {
                checkbox.addEventListener('change', () => toggleUpload(sectionName));
            });
        }

        // Saat halaman dimuat, inisialisasi semua toggle dan setup tampilan sesuai kondisi
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi setiap bagian pelatihan sesuai kelompoknya
            initializeToggleForSection('pendidikanKader'); // A. Pendidikan Kader
            initializeToggleForSection('instruktur'); // B. Latihan Instruktur
            initializeToggleForSection('dirosah'); // C. Dirosah
            initializeToggleForSection('pendidikanLatihan'); // D. Pendidikan & Latihan
            initializeToggleForSection('kursus'); // E. Kursus Kepelatihan
            initializeToggleForSection('latihanKhusus'); // F. Pendidikan & Latihan Khusus

            // Panggil toggleSections untuk menampilkan atau menyembunyikan bagian bersyarat berdasarkan pilihan awal
            toggleSections();

            // Tambahkan event listener pada checkbox utama untuk kontrol bagian bersyarat
            document.getElementById('pkd').addEventListener('change', toggleSections);
            document.getElementById('pkl').addEventListener('change', toggleSections);
            document.getElementById('susbalan').addEventListener('change', toggleSections);
            document.getElementById('diklatsar').addEventListener('change', toggleSections);

            // Inisialisasi tampilan input file untuk menyesuaikan tampilan custom
            bsCustomFileInput.init();
        });

        // Validasi duplikat nomor wa
        $(document).ready(function() {
            $('#no_telp').on('blur', function() {
                var noTelp = $(this).val();

                // Lakukan pengecekan hanya jika input tidak kosong
                if (noTelp !== '') {
                    $.ajax({
                        url: 'config/check_phone.php', // Endpoint untuk pengecekan
                        method: 'POST',
                        data: {
                            no_telp: noTelp
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.exists) {
                                // Jika nomor telepon sudah terdaftar
                                Swal.fire({
                                    title: 'Ganti Nomor Hp Anda!',
                                    text: 'Nomor Hp yang anda masukkan sudah terdaftar. Gunakan nomor lain.',
                                    icon: 'warning',
                                    confirmButtonText: 'OK'
                                });

                                // Tambahkan kelas invalid-feedback
                                $('#no_telp').addClass('is-invalid');
                            } else {
                                // Nomor telepon valid, hilangkan pesan error
                                $('#no_telp').removeClass('is-invalid');
                            }
                        },
                        error: function() {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Gagal memeriksa nomor telepon. Coba lagi.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                }
            });
        });

        // Validasi form
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const formSuccess = urlParams.get('form_success');

            if (formSuccess) {
                Swal.fire({
                    title: 'Form Berhasil Dikirim',
                    text: 'Terima kasih telah mengisi form pendaftaran',
                    icon: 'success',
                    confirmButtonText: 'OK',
                }).then(() => {
                    // Hapus parameter dari URL setelah popup ditutup
                    window.history.replaceState({}, document.title, window.location.pathname);
                });
            }

            const forms = document.querySelectorAll('form');

            forms.forEach((form) => {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault(); // Hentikan submit jika ada kesalahan
                        event.stopPropagation();

                        // Tambahkan kelas Bootstrap untuk menunjukkan error
                        form.classList.add('was-validated');

                        // Scroll ke elemen pertama yang invalid
                        const firstInvalidField = form.querySelector(':invalid');
                        if (firstInvalidField) {
                            firstInvalidField.focus();
                            firstInvalidField.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });
                        }

                        // Tampilkan SweetAlert jika ada error
                        Swal.fire({
                            title: 'Data belum lengkap!',
                            text: 'Pastikan semua data telah terisi dengan benar!',
                            icon: 'warning',
                            confirmButtonText: 'OK',
                        });

                    } else {
                        // Jika validasi lolos, jalankan submit form dan SweetAlert konfirmasi
                        event.preventDefault(); // Mencegah submit asli
                        Swal.fire({
                            title: 'Submit Formulir?',
                            text: 'Pastikan semua data yang anda masukkan benar',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Tidak',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit(); // Kirim form setelah konfirmasi
                            }
                        });
                    }
                }, false);
            });
        });
    </script>

    <!-- select2 -->
    <script>
        $(document).ready(function() {
            // Inisialisasi Select2 pada semua elemen dengan kelas 'select2'
            $('.select2').select2({
                // placeholder: "Pilih",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
</body>

</html>