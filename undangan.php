<?php
require 'panitia/config/config.php';

if (isset($_GET['otp']) && isset($_GET['download'])) {
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

    if ($pendaftar) {
        $no_peserta = $pendaftar['no_peserta'];
        $digit_awal = substr($no_peserta, 0, 2);
        $digit_akhir = substr($no_peserta, -4);

        $nama = $pendaftar['nama_lengkap'];
        $nik = $pendaftar['nik'];
        $orang_tua = $pendaftar['orang_tua_wali'];
        if (stripos($pendaftar['kabupaten_kota'], 'Kabupaten') === 0) {
            $kab_kota = trim(substr($pendaftar['kabupaten_kota'], strlen('Kabupaten')));
        }
        $alamat = $pendaftar['desa_kelurahan'] . ' ' . $pendaftar['rt_rw'] . '/' . $pendaftar['rw_rw'] . ' ' . $pendaftar['kecamatan'] . ' ' . $kab_kota;

        // Display Gambar
        header('Content-Type: image/png');

        // Format
        $fontPathRegular = 'panitia/assets/font/Tinos-Regular.ttf';
        $fontPathBold = 'panitia/assets/font/Tinos-Bold.ttf';
        $fontSize = 28;
        $image = imagecreatefrompng('panitia/assets/images/undangan.png');
        $color = imagecolorallocate($image, 89, 89, 89);

        imagettftext($image, $fontSize, 0, 1343, 396, $color, $fontPathRegular, $digit_awal);
        imagettftext($image, 29, 0, 1382, 396, $color, $fontPathBold, $digit_akhir);

        imagettftext($image, $fontSize, 0, 510, 641, $color, $fontPathRegular, $nama);
        imagettftext($image, $fontSize, 0, 510, 683, $color, $fontPathRegular, $nik);
        imagettftext($image, $fontSize, 0, 510, 723, $color, $fontPathRegular, $orang_tua);
        imagettftext($image, $fontSize, 0, 510, 765, $color, $fontPathRegular, $alamat);

        imagepng($image);
        imagedestroy($image);
        exit();
    }
}

include 'layouts/header.php';
?>

<div class="content-wrapper">
    <div class="content-header text-center">
        <div class="container-fluid">
            <div class="row mb-2 justify-content-center">
                <div class="col-sm-6">
                    <h1 class="m-auto">Undangan</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Input OTP</h3>
                        </div>
                        <div class="card-body">
                            <form action="undangan.php" method="GET">
                                <div class="form-group">
                                    <label for="otp">OTP:</label>
                                    <input type="text" class="form-control" id="otp" name="otp" required>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Cek Undangan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            if (isset($_GET['otp']) && !isset($_GET['download'])) {
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
            ?>
                    <div class="row justify-content-center mt-4">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header text-left">
                                    <div class="d-flex align-items-center">
                                        <img src="panitia/assets/images/icon_khitan_umum.png" alt="logo" width="50" class="me-3">
                                        <h4 class="card-title mb-0">Undangan Peserta Khitan Umum 1447H</h4>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-borderless">
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
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12 text-center">
                                            <a href="undangan.php?otp=<?php echo $otp; ?>&download=true" class="btn btn-success" target="_blank">Preview</a>
                                        </div>
                                    </div>
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

<?php include 'layouts/footer.php'; ?>