<?php
require_once '../style/header.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard Master</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard.php">Master</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Total Pendaftar -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo $total_pendaftar; ?></h3>
                            <p>Total Pendaftar</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-android-contacts"></i>
                        </div>
                        <a href="#" class="small-box-footer">Info Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Total Admin Kecamatan -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3><?php echo $total_admin_kecamatan; ?></h3>
                            <p>Total Admin Kecamatan</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-map"></i>
                        </div>
                        <a href="#" class="small-box-footer">Info Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Total Admin Desa -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3><?php echo $total_admin_desa; ?></h3>
                            <p>Total Admin Desa</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-home"></i>
                        </div>
                        <a href="#" class="small-box-footer">Info Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Total Master -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-dark">
                        <div class="inner">
                            <h3><?php echo $total_master; ?></h3>
                            <p>Total Master</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="#" class="small-box-footer">Info Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Total Kecamatan -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $total_kecamatan; ?></h3>
                            <p>Total Kecamatan</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-map"></i>
                        </div>
                        <a href="#" class="small-box-footer">Info Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Total Desa -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $total_desa; ?></h3>
                            <p>Total Desa</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-location"></i>
                        </div>
                        <a href="#" class="small-box-footer">Info Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Tabel Data Kecamatan & Desa -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row my-3">
                        <div class="col-sm-6">
                            <h1>Data Kecamatan & Desa</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->

                <!-- TABEL PENDAFTAR KECAMATAN -->
                <div class="card">
                    <div class="card-header border-transparent">
                        <h3 class="card-title"><b>9 Kecamatan</b></h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#kecamatanCollapse" aria-expanded="false">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div id="kecamatanCollapse" class="collapse">
                        <div class="card-body p-0">
                            <div class="table-responsive table-bordered table-hover">
                                <table id="data-kecamatan" class="table m-3">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kecamatan</th>
                                            <th>Total Pendaftar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1; // Inisialisasi nomor
                                        foreach ($kecamatans as $kecamatan): ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo htmlspecialchars($kecamatan['kecamatan']); ?></td>
                                                <td><?php echo htmlspecialchars($kecamatan['total_pendaftar']); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- TABEL PENDAFTAR DESA -->
                <div class="card">
                    <div class="card-header border-transparent">
                        <h3 class="card-title"><b>123 Desa</b></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#desaCollapse" aria-expanded="false">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <!-- /.card-header -->
                    <div id="desaCollapse" class="collapse">
                        <div class="card-body p-0">
                            <div class="table-responsive table-bordered table-hover">
                                <table id="data-desa" class="table m-2">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kecamatan</th>
                                            <th>Desa / Kelurahan</th>
                                            <th>Total Pendaftar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1; // Inisialisasi nomor
                                        foreach ($kecamatanDesaData as $kecamatan => $desas): ?>
                                            <?php $rowspan = count($desas); ?>
                                            <tr>
                                                <td rowspan="<?php echo $rowspan; ?>"><?php echo $no++; ?></td>
                                                <td rowspan="<?php echo $rowspan; ?>"><?php echo htmlspecialchars($kecamatan); ?></td>
                                                <td>1. <?php echo htmlspecialchars($desas[0]['desa']); ?></td>
                                                <td><?php echo htmlspecialchars($desas[0]['total_pendaftar']); ?></td>
                                            </tr>
                                            <?php for ($i = 1; $i < $rowspan; $i++): ?>
                                                <tr>
                                                    <td><?php echo ($i + 1) . ". " . htmlspecialchars($desas[$i]['desa']); ?></td>
                                                    <td><?php echo htmlspecialchars($desas[$i]['total_pendaftar']); ?></td>
                                                </tr>
                                            <?php endfor; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.row -->
            </section>
        </div>
</div>

<?php
require_once '../style/footer.php';
?>