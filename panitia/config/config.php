<?php
// Detail koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "khitanumum";

// Membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Cek koneksi
if (!$conn) {
  die(mysqli_connect_error());
}
