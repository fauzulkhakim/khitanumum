<?php include 'layouts/header.php'; ?>

<div class="content-wrapper">
    <div class="content-header text-center">
        <div class="container-fluid">
            <div class="row mb-2 justify-content-center">
                <div class="col-sm-6">
                    <h1 class="m-auto">Status Pendaftaran</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">

            <!-- Card Input OTP -->
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card card-outline card-primary mt-2" id="otpCard">
                        <div class="card-header">
                            <h3 class="card-title">Input OTP</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-toggle="collapse" data-target="#otpCollapse" aria-expanded="false">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div id="otpCollapse" class="collapse show">
                            <div class="card-body">
                                <form action="status.php" method="GET">
                                    <div class="form-group">
                                        <label for="otp">OTP:</label>
                                        <input type="text" class="form-control" id="otp" name="otp" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-3">Cek Status</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            if (isset($_GET['otp'])) {
                require 'panitia/config/config.php';

                $otp = $_GET['otp'];

                $query = "
                SELECT
                    p.*,
                    r.nama_rt_rw AS rt_rw,
                    rw.nama_rt_rw AS rw_rw,
                    v.name_villages AS desa_kelurahan,
                    d.name_districts AS kecamatan,
                    reg.name_regencies AS kabupaten_kota,
                    prov.name_provinces AS provinsi
                FROM
                    pendaftar p
                LEFT JOIN
                    rt_rw r ON p.rt_rt_rw_id = r.id_rt_rw
                LEFT JOIN
                    rt_rw rw ON p.rw_rt_rw_id = rw.id_rt_rw
                LEFT JOIN
                    villages v ON p.domisili_villages_id = v.id_villages
                LEFT JOIN
                    districts d ON p.domisili_districts_id = d.id_districts
                LEFT JOIN
                    regencies reg ON p.domisili_regencies_id = reg.id_regencies
                LEFT JOIN
                    provinces prov ON p.domisili_provinces_id = prov.id_provinces
                WHERE
                    p.otp = '$otp'
                ";
                $result = mysqli_query($conn, $query);
                $pendaftar = mysqli_fetch_assoc($result);

                if (!$pendaftar) {
                    echo "<div class='alert alert-danger text-center'>Data tidak ditemukan. Silakan cek kembali OTP Anda.</div>";
                } else {
                    $status = '';
                    $qr = '';
                    if ($pendaftar['status_pendaftaran_id'] == 1) {
                        $status = '🟠 &nbsp; Belum Verifikasi';
                    } elseif ($pendaftar['status_pendaftaran_id'] == 2) {
                        $status = '✅ &nbsp; Diterima';
                        $qr = 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . $pendaftar['no_peserta'];
                    } elseif ($pendaftar['status_pendaftaran_id'] == 3) {
                        $status = '❌ &nbsp; Ditolak';
                    } elseif ($pendaftar['status_pendaftaran_id'] == 4) {
                        $status = '⌛︎ &nbsp; Pending';
                    }
            ?>

                    <!-- Card Status Pendaftaran -->
                    <div class="row justify-content-center mt-4">
                        <div class="col-md-8">
                            <div class="card card-outline card-primary">
                                <div class="card-header text-left">
                                    <div class="d-flex align-items-center">
                                        <img src="panitia/assets/images/icon_khitan_umum.png" alt="logo" width="50" class="me-3">
                                        <h4 class="card-title mb-0">Status Pendaftaran Khitan Umum 1447H</h4>
                                    </div>
                                </div>

                                <!-- CARD STATUS PENDAFTARAN -->
                                <div class="card-body">
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <table class="table table-borderless">
                                                <!-- status pendaftaran -->
                                                <tr>
                                                    <td>Status Pendaftaran</td>
                                                    <td>:</td>
                                                    <td><?php echo $status; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>No. Peserta</td>
                                                    <td>:</td>
                                                    <td><?php echo htmlspecialchars($pendaftar['no_peserta']); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Nama</td>
                                                    <td>:</td>
                                                    <td><?php echo htmlspecialchars($pendaftar['nama_lengkap']); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>NIK</td>
                                                    <td>:</td>
                                                    <td><?php echo htmlspecialchars($pendaftar['nik']); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Orang Tua</td>
                                                    <td>:</td>
                                                    <td><?php echo htmlspecialchars($pendaftar['orang_tua_wali']); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Alamat</td>
                                                    <td>:</td>
                                                    <td><?php echo htmlspecialchars($pendaftar['desa_kelurahan']) . ' ' . htmlspecialchars($pendaftar['rt_rw']) . '/' . htmlspecialchars($pendaftar['rw_rw']); ?></td>
                                                </tr>
                                                <tr>
                                                    <?php
                                                    $kab_kota = $pendaftar['kabupaten_kota'];
                                                    if (stripos($kab_kota, 'Kabupaten') === 0) {
                                                        $kab_kota = trim(substr($kab_kota, strlen('Kabupaten')));
                                                    }
                                                    ?>
                                                    <td></td>
                                                    <td></td>
                                                    <td><?php echo htmlspecialchars($pendaftar['kecamatan']) . ' ' . htmlspecialchars($kab_kota); ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Waktu</td>
                                                    <td>:</td>
                                                    <td><?php echo date('d/m/Y H:i:s', strtotime($pendaftar['updated_at'])); ?></td>
                                                </tr>
                                                <tr>
                                                    <?php if ($pendaftar['status_pendaftaran_id'] == 2) { ?>
                                                        <td>Scan QRCode</td>
                                                        <td>:</td>
                                                        <td><img src="<?php echo $qr; ?>" alt="qr" width="80px" class="img-fluid"></td>
                                                    <?php } ?>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                    <?php if ($pendaftar['status_pendaftaran_id'] == 1) { ?>
                                        <p class="mt-4 text-center">Pendaftaran berhasil. <br> Proses verifikasi 2 X 24 jam.</p>
                                    <?php } elseif ($pendaftar['status_pendaftaran_id'] == 2) { ?>
                                        <p class="mt-4 text-center">Pendaftaran diterima. <br> Undangan Pemeriksaan Kesehatan akan segera dikirimkan via WhatsApp.</p>
                                        <div class="contact-info text-center mt-2">
                                            <p>Info lebih lanjut, hubungi:</p>
                                            <p>Haidar : <a href="https://wa.me/6285878537250" target="_blank">085878537250</a></p>
                                            <p>Vian : <a href="https://wa.me/6281910287931" target="_blank">081910287931</a></p>
                                        </div>
                                    <?php } elseif ($pendaftar['status_pendaftaran_id'] == 3) { ?>
                                        <p class="mt-4 text-center">Pendaftaran ditolak.</p>
                                    <?php } else { ?>
                                        <p class="mt-4 text-center">Pendaftaran dalam antrian.</p>
                                        <div class="contact-info text-center mt-2">
                                            <p>Info lebih lanjut, hubungi:</p>
                                            <p>Haidar : <a href="https://wa.me/6285878537250" target="_blank">085878537250</a></p>
                                            <p>Vian : <a href="https://wa.me/6281910287931" target="_blank">081910287931</a></p>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="card-footer text-center">
                                    <small><?php echo date('d/m/Y H:i:s'); ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>

<?php if (isset($_GET['otp']) && $pendaftar) { ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var otpCollapse = document.getElementById('otpCollapse');
            otpCollapse.classList.remove('show');
        });
    </script>
<?php } ?>

<?php include 'layouts/footer.php'; ?>