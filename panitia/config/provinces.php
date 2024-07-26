<?php
header('Content-Type: application/json'); // Set header untuk mengembalikan JSON
require 'config.php';

// Periksa koneksi
if ($conn->connect_error) {
  die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
  exit();
}

// Contoh query ke database (opsional)
$sql = "SELECT * FROM provinces ORDER BY name_provinces ASC";
$result = mysqli_query($conn, $sql);

// Cek hasil query
if ($result->num_rows > 0) {
  // Ambil data dari hasil query
  $data = $result->fetch_all(MYSQLI_ASSOC);
  echo json_encode(["status" => "success", "data" => $data]);
} else {
  echo json_encode(["status" => "error", "message" => "No records found"]);
}

// Tutup koneksi
$conn->close();
