<?php
require 'config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Escape data input dari form
  $nama_lengkap = mysqli_escape_string($conn, strtoupper($_POST['nama_lengkap']));
  $nik = mysqli_real_escape_string($conn, $_POST['nik']);
  $no_kk = mysqli_real_escape_string($conn, $_POST['no_kk']);
  $tempat_lahir = mysqli_real_escape_string($conn, $_POST['tempat_lahir']);
  $tanggal_lahir = mysqli_real_escape_string($conn, $_POST['tanggal_lahir']);
  $provinsi = mysqli_real_escape_string($conn, $_POST['provinsi']);
  $kabupaten_kota = mysqli_real_escape_string($conn, $_POST['kabupaten_kota']);
  $kecamatan = mysqli_real_escape_string($conn, $_POST['kecamatan']);
  $desa_kelurahan = mysqli_real_escape_string($conn, $_POST['desa_kelurahan']);
  $rt = mysqli_real_escape_string($conn, $_POST['rt']);
  $rw = mysqli_real_escape_string($conn, $_POST['rw']);
  $alamat_lengkap = mysqli_real_escape_string($conn, strtoupper($_POST['alamat_lengkap']));
  $domisili = mysqli_real_escape_string($conn, $_POST['domisili']);
  $berat_badan = mysqli_real_escape_string($conn, $_POST['berat_badan']);
  $tinggi_badan = mysqli_real_escape_string($conn, $_POST['tinggi_badan']);
  $ukuran_baju = mysqli_real_escape_string($conn, $_POST['ukuran_baju']);
  $nama_sekolah = mysqli_real_escape_string($conn, strtoupper($_POST['nama_sekolah']));
  $kelas = mysqli_real_escape_string($conn, $_POST['kelas']);
  $alamat_sekolah = mysqli_real_escape_string($conn, strtoupper($_POST['alamat_sekolah']));
  $orang_tua_wali = mysqli_real_escape_string($conn, strtoupper($_POST['orang_tua_wali']));
  $no_hp = mysqli_real_escape_string($conn, $_POST['no_hp']);

  // cek apakah NIK sudah ada
  $cekNikQuery = "SELECT * FROM pendaftar WHERE nik = ?";
  $stmt = $conn->prepare($cekNikQuery);
  $stmt->bind_param("s", $nik);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    // Ambil nama lengkap dari hasil query
    $row = $result->fetch_assoc();
    $nama_terdaftar = $row['nama_lengkap'];

    // Tampilkan alert menggunakan JavaScript
    echo "<script>alert('NIK sudah terdaftar atas nama $nama_terdaftar. Silakan gunakan NIK yang berbeda.'); window.history.back();</script>";
    exit(); // Hentikan eksekusi skrip
  }

  // Upload dokumen
  $dokumen_kia_kk = uploadImage($_FILES['dokumen_kia_kk'], $nik, 'kia_kk');
  $dokumen_sekolah = uploadImage($_FILES['dokumen_sekolah'], $nik, 'sekolah');
  $dokumen_domisili = uploadImage($_FILES['dokumen_domisili'], $nik, 'domisili');
  $dokumen_pendukung = uploadImage($_FILES['dokumen_pendukung'], $nik, 'pendukung');

  // Generate OTP
  $otp = rand(100000, 999999);
  $waktu = time(); // Menyimpan waktu pembuatan OTP

  // Simpan data pendaftar bersama OTP

  $sql = "INSERT INTO `pendaftar` (
        `id`, `is_admin`, `nama_lengkap`, `nik`, `no_kk`, `no_peserta`, `otp`, `status_pendaftaran_id`, `mustahiq`, `relasi`, `orang_tua_wali`, `no_hp`, `tempat_lahir_regencies_id`, `tanggal_lahir`, `alamat_lengkap`, `domisili_provinces_id`, `domisili_regencies_id`, `domisili_districts_id`, `domisili_villages_id`, `rt_rt_rw_id`, `rw_rt_rw_id`, `domisili`, `berat_badan`, `tinggi_badan`, `ukuran_baju_id`, `nama_sekolah`, `kelas_id`, `alamat_sekolah`, `dokumen_kia_kk`, `dokumen_sekolah`, `dokumen_domisili`, `dokumen_pendukung`, `name_created`, `date_created`, `updated`, `name_updated`, `date_updated`
    ) VALUES (
        NULL, '0', '$nama_lengkap', '$nik', '$no_kk', NULL, '$otp', '1', '0', '$relasi', '$orang_tua_wali', '$no_hp', '$tempat_lahir', '$tanggal_lahir', '$alamat_lengkap', '$provinsi', '$kabupaten_kota', '$kecamatan', '$desa_kelurahan', '$rt', '$rw', '$domisili', '$berat_badan', '$tinggi_badan', '$ukuran_baju', '$nama_sekolah', '$kelas', '$alamat_sekolah', '$dokumen_kia_kk', '$dokumen_sekolah', '$dokumen_domisili', '$dokumen_pendukung','Umum', NOW(), NULL, NULL, NULL
    )";

  if (mysqli_query($conn, $sql)) {
    // Kirim pesan sukses pendaftaran ke WhatsApp
    $link = "https://khitanumum.menarakudus.id/status.php?otp=$otp"; // Sesuaikan link dengan URL yang benar
    sendSuccessMessage($no_hp, $link);

    // Redirect ke halaman status dengan parameter OTP
    header("Location: ../../status.php?otp=$otp");
    exit();
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  mysqli_close($conn);
}

function uploadImage($file, $nik, $dir)
{
  $file_name = $file['name'];
  $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

  $new_file_name = rand(000, 999) . '_' . $nik . '.' . $file_extension;
  $file_tmp = $file['tmp_name'];

  $targetDir = '../dokumen/' . $dir . '/';
  $targetFile = $targetDir . $new_file_name;

  if (move_uploaded_file($file_tmp, $targetFile)) {
    return $new_file_name;
  }
}

function sendSuccessMessage($no_hp, $link)
{
  $api_key = 'wGd+U1ehDoCTphUxwciu';
  $url = 'https://api.fonnte.com/send';

  $message = "✅ Pendaftaran Berhasil
------------------------------------------------------------

Silahkan tunggu proses verifikasi maksimal 2x24 jam. Jika lolos verifikasi akan dikirim undangan via WA.


Cek status calon peserta khitan secara berkala pada link dibawah ini:

$link


Jika ada kesalahan data anak dan membutuhkan informasi lebih lanjut silahkan hubungi WhatsApp dibawah ini:

wa.me/6285878537250 (Haidar)
wa.me/6281910287931 (Vian)

------------------------------------------------------------

-= Khitan Umum 1446 H =-";

  $data = [
    'target' => $no_hp, // Nomor tujuan dengan format internasional
    'message' => $message
  ];

  $curl = curl_init();

  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
  curl_setopt($curl, CURLOPT_HTTPHEADER, [
    "Authorization: $api_key", // Header otorisasi dengan API key
  ]);
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

  $response = curl_exec($curl);
  curl_close($curl);

  $result = json_decode($response, true);
  if ($result['status'] != "success") {
    echo "Gagal mengirim pesan sukses: " . $result['message'];
  }
}
