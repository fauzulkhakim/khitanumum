<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  require 'config.php';

  $nama_depan = mysqli_real_escape_string($conn, $_POST['nama_depan']);
  $nama_belakang = mysqli_real_escape_string($conn, $_POST['nama_belakang']);
  $nik = mysqli_escape_string($conn, $_POST['nik']);
  $tempat_lahir = mysqli_escape_string($conn, $_POST['tempat_lahir']);
  $tanggal_lahir = mysqli_escape_string($conn, $_POST['tanggal_lahir']);
  $provinsi = mysqli_escape_string($conn, $_POST['provinsi']);
  $kabupaten_kota = mysqli_escape_string($conn, $_POST['kabupaten_kota']);
  $kecamatan = mysqli_escape_string($conn, $_POST['kecamatan']);
  $desa_kelurahan = mysqli_escape_string($conn, $_POST['desa_kelurahan']);
  $rt = mysqli_escape_string($conn, $_POST['rt']);
  $rw = mysqli_escape_string($conn, $_POST['rw']);
  $alamat_lengkap = mysqli_escape_string($conn, $_POST['alamat_lengkap']);
  $domisili = mysqli_escape_string($conn, $_POST['domisili']);
  $berat_badan = mysqli_escape_string($conn, $_POST['berat_badan']);
  $tinggi_badan = mysqli_escape_string($conn, $_POST['tinggi_badan']);
  $ukuran_baju = mysqli_escape_string($conn, $_POST['ukuran_baju']);
  $nama_sekolah = mysqli_escape_string($conn, $_POST['nama_sekolah']);
  $kelas = mysqli_escape_string($conn, $_POST['kelas']);
  $alamat_sekolah = mysqli_escape_string($conn, $_POST['alamat_sekolah']);
  $orang_tua_wali = mysqli_escape_string($conn, $_POST['orang_tua_wali']);
  $no_hp = mysqli_escape_string($conn, $_POST['no_hp']);
  $relasi = mysqli_escape_string($conn, $_POST['relasi']);
  $mustahiq = mysqli_escape_string($conn, $_POST['mustahiq']);

  $dokumen_kia_kk = uploadImage($_FILES['dokumen_kia_kk'], $nik, 'kia_kk');
  $dokumen_sekolah = uploadImage($_FILES['dokumen_sekolah'], $nik, 'sekolah');
  $dokumen_domisili = uploadImage($_FILES['dokumen_domisili'], $nik, 'domisili');
  $dokumen_pendukung = uploadImage($_FILES['dokumen_pendukung'], $nik, 'pendukung');

  $otp = mt_rand(100000, 999999);

  $sql = "INSERT INTO `pendaftar` (
    `id`, `is_admin`, `nama_depan`, `nama_belakang`, `nik`, `otp`, `status_pendaftaran_id`, `mustahiq`, `relasi`, `orang_tua_wali`, `no_hp`, `tempat_lahir_regencies_id`, `tanggal_lahir`, `alamat_lengkap`, `domisili_provinces_id`, `domisili_regencies_id`, `domisili_districts_id`, `domisili_villages_id`, `rt_rt_rw_id`, `rw_rt_rw_id`, `domisili`, `berat_badan`, `tinggi_badan`, `ukuran_baju_id`, `nama_sekolah`, `kelas_id`, `alamat_sekolah`, `dokumen_kia_kk`, `dokumen_sekolah`, `dokumen_domisili`, `dokumen_pendukung`, `name_created`, `date_created`, `name_updated`, `date_updated`
    ) VALUES (
    NULL, '1', '$nama_depan', '$nama_belakang', '$nik', '$otp', '1', '$mustahiq',  '$relasi', '$orang_tua_wali', '$no_hp', '$tempat_lahir', '$tanggal_lahir', '$alamat_lengkap', '$provinsi', '$kabupaten_kota', '$kecamatan', '$desa_kelurahan', '$rt', '$rw', '$domisili', '$berat_badan', '$tinggi_badan', '$ukuran_baju', '$nama_sekolah', '$kelas', '$alamat_sekolah', '$dokumen_kia_kk', '$dokumen_sekolah', '$dokumen_domisili', '$dokumen_pendukung','1', NOW(), NULL, NULL
    )";

  if (mysqli_query($conn, $sql)) {
    echo "<script>
    alert('Data berhasil ditambahkan');
    window.location.href = '../admin/pendaftar.php';
  </script>";
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
