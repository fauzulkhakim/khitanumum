<?php
require 'panitia/config/config.php';

// Asumsi kita mendapatkan otp dari query string
$otp = isset($_GET['otp']) ? $_GET['otp'] : '';

if (empty($otp)) {
    echo "<div class='alert alert-danger text-center'>OTP tidak ditemukan.</div>";
    exit();
}

// Query untuk mengambil data peserta berdasarkan otp dengan join ke tabel terkait
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
    exit();
}

// Cek apakah tidak diterima
if ($pendaftar['status_pendaftaran_id'] != 2) {
    echo "<div class='alert alert-danger text-center'>Data tidak ditemukan. Silakan cek kembali OTP Anda.</div>";
    exit();
}



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

// Dispaly Gambar
header('Content-Type: image/png');

// Otomatis Download
// header('Content-Description: File Transfer');
// header('Content-Disposition: attachment; filename="' . $no_peserta . '_' . $nama . '.jpg"');
// header('Content-Type: application/octet-stream');

// Format
$fontPathRegular = 'panitia/assets/font/Tinos-Regular.ttf';
$fontPathBold = 'panitia/assets/font/Tinos-Bold.ttf';
$fontSize = 28;
$image = imagecreatefrompng('panitia/assets/undangan.png');
$color = imagecolorallocate($image, 89, 89, 89);

imagettftext($image, $fontSize, 0, 1343, 396, $color, $fontPathRegular, $digit_awal);
imagettftext($image, 29, 0, 1382, 396, $color, $fontPathBold, $digit_akhir);

imagettftext($image, $fontSize, 0, 510, 641, $color, $fontPathRegular, $nama);
imagettftext($image, $fontSize, 0, 510, 683, $color, $fontPathRegular, $nik);
imagettftext($image, $fontSize, 0, 510, 723, $color, $fontPathRegular, $orang_tua);
imagettftext($image, $fontSize, 0, 510, 765, $color, $fontPathRegular, $alamat);

imagepng($image);
imagedestroy($image);
