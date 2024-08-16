<?php
header('Content-Type: application/json');
require 'config.php';

// Periksa koneksi
if ($conn->connect_error) {
  die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
  exit();
}

$id = $_POST['id'];

// Contoh query ke database (opsional)
$sql = "SELECT * FROM pendaftar WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$result = mysqli_fetch_assoc($result);

// Cek hasil query
if (mysqli_num_rows(mysqli_query($conn, $sql)) > 0) {

  $link = "https://khitanumum.menarakudus.id/status.php?otp=" . $result['otp']; // Sesuaikan link dengan URL yang benar
  sendMessage($result['no_hp'], $link);

  echo json_encode(["status" => "success", "message" => "Pesan terkirim"]);
} else {
  echo json_encode(["status" => "error", "message" => "Pesan gagal dikirim"]);
}

// Tutup koneksi
$conn->close();

function sendMessage($no_hp, $link)
{
  $api_key = 'wGd+U1ehDoCTphUxwciu';
  $url = 'https://api.fonnte.com/send';

  $message = "🔄 Kirim ulang status pendaftaran
------------------------------------------------------------

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
