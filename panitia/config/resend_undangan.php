<?php
header('Content-Type: application/json');
require 'config.php';

if ($conn->connect_error) {
  die(json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]));
}

$id = $_POST['id'];

// Query untuk mendapatkan data pendaftar
$sql = "SELECT * FROM pendaftar WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$result = mysqli_fetch_assoc($result);

if ($result) {
  $link = "https://khitanumum.menarakudus.id/undangan.php?otp=" . $result['otp'];
  $no_hp = $result['no_hp'];

  // Pesan yang akan dikirim
  $message = "🔄 *Kirim Ulang Undangan*\n\nDownload bukti daftar dan undangan melalui link berikut:\n\n$link\n\nJika ada kesalahan data atau membutuhkan informasi lebih lanjut, silakan hubungi:\n\n📞 wa.me/6285878537250 (Haidar)\n📞 wa.me/6281910287931 (Vian)\n\n*-= Khitan Umum 1446 H =-*";

  // Kirim pesan
  sendMessage($no_hp, $message);

  // Catat log pengiriman pesan
  $logQuery = "INSERT INTO log_wa (pendaftar_id, jenis_pesan, status, pesan, created_at) VALUES (?, ?, ?, ?, NOW())";
  $stmt = $conn->prepare($logQuery);
  $jenis_pesan = 'undangan';
  $status = 'kirim ulang undangan';
  $stmt->bind_param('isss', $id, $jenis_pesan, $status, $message);
  $stmt->execute();

  echo json_encode(["status" => "success", "message" => "Pesan terkirim"]);
} else {
  echo json_encode(["status" => "error", "message" => "Data pendaftar tidak ditemukan"]);
}

$conn->close();

function sendMessage($no_hp, $message)
{
  $api_key = 'z1UTH7UwXp2AHo8UNCtT';
  $url = 'https://api.fonnte.com/send';

  $data = [
    'target' => $no_hp,
    'message' => $message
  ];

  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
  curl_setopt($curl, CURLOPT_HTTPHEADER, [
    "Authorization: $api_key",
  ]);
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

  $response = curl_exec($curl);
  curl_close($curl);

  $result = json_decode($response, true);
  if ($result['status'] != "success") {
    throw new Exception("Gagal mengirim pesan: " . $result['message']);
  }
}
