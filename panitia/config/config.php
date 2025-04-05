<?php
// saat hosting jangan lupa periksa pesan whatsapp dan ganti url root status dan undangan di :
// - panitia/config/pendaftaran-tambah.php
// - panitia/config/resend_status.php
// - panitia/config/resend_undangan.php
// - panitia/config/update_status.php

date_default_timezone_set('Asia/Jakarta');

// Detail koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "khitanumum";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Include dates configuration
include 'dates_config.php';

function check_login()
{
  global $conn;

  session_start();

  // Cek apakah user sudah login dengan session
  if (isset($_SESSION['user'])) {
    return true;
  }

  // Cek apakah user sudah login dengan cookie
  if (isset($_COOKIE['user_login'])) {
    list($username, $password) = explode(':', base64_decode($_COOKIE['user_login']));
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
      $_SESSION['user'] = $user;
      return true;
    }
  }

  return false;
}

// Fungsi mencatat log pesan wa
function logWa($conn, $pendaftar_id, $jenis_pesan, $status, $pesan)
{
  $sql = "INSERT INTO log_wa (pendaftar_id, jenis_pesan, status, pesan, created_at) VALUES (?, ?, ?, ?, NOW())";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('isss', $pendaftar_id, $jenis_pesan, $status, $pesan);
  $stmt->execute();
}
