<?php
require 'config.php';
session_start();

var_dump($_SESSION['user']['nama_lengkap']);
exit();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $pendaftarId = intval($_POST['id']);
    $statusId = intval($_POST['status']);
    $updated_by = isset($_SESSION['user']['nama_lengkap']) ? $_SESSION['user']['nama_lengkap'] : null; // Nama admin yang login
    $timestamp = date('Y-m-d H:i:s'); // Waktu saat ini

    // Validasi apakah admin sudah login
    if (!$updated_by) {
        echo json_encode(['success' => false, 'error' => 'Admin tidak terdeteksi. Pastikan Anda sudah login.']);
        exit();
    }

    // Ambil data pendaftar untuk kebutuhan WhatsApp
    $query = "SELECT otp, no_hp FROM pendaftar WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $pendaftarId);
    $stmt->execute();
    $result = $stmt->get_result();
    $data_wa = $result->fetch_assoc();

    if (!$data_wa) {
        echo json_encode(['success' => false, 'error' => 'Data pendaftar tidak ditemukan.']);
        exit();
    }

    $otp = $data_wa['otp'];
    $no_hp = $data_wa['no_hp'];

    // Mulai transaksi
    $conn->begin_transaction();

    try {
        // Update status pendaftaran, updated_by, dan updated_at
        $sql = "UPDATE pendaftar SET status_pendaftaran_id = ?, updated_by = ?, updated_at = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('issi', $statusId, $updated_by, $timestamp, $pendaftarId);

        if (!$stmt->execute()) {
            throw new Exception($stmt->error);
        }

        // Kirim pesan WhatsApp berdasarkan status
        $link = "https://khitanumum.menarakudus.id/status.php?otp=$otp"; // Link default
        if ($statusId == 2) { // Diterima
            $link = "https://khitanumum.menarakudus.id/undangan.php?otp=$otp";
            sendMessage($no_hp, "✅ Pendaftaran Diterima\n\nDownload bukti daftar dan undangan melalui link berikut:\n\n$link\n\nJika ada kesalahan data atau membutuhkan informasi lebih lanjut, silakan hubungi:\n\nwa.me/6285878537250 (Haidar)\nwa.me/6281910287931 (Vian)\n\n-= Khitan Umum 1446 H =-");
        } elseif ($statusId == 3) { // Ditolak
            sendMessage($no_hp, "❌ Pendaftaran Ditolak\n\nMohon maaf calon peserta tidak dapat diterima.\n\nCek status melalui link berikut:\n\n$link\n\nInformasi lebih lanjut silakan hubungi:\n\nwa.me/6285878537250 (Haidar)\nwa.me/6281910287931 (Vian)\n\n-= Khitan Umum 1446 H =-");
        } elseif ($statusId == 4) { // Pending
            sendMessage($no_hp, "⌛︎ Pendaftaran dalam antrian\n\nMohon tunggu sampai waktu pendaftaran selesai.\n\nCek status melalui link berikut:\n\n$link\n\nJika ada kesalahan data atau membutuhkan informasi lebih lanjut, silakan hubungi:\n\nwa.me/6285878537250 (Haidar)\nwa.me/6281910287931 (Vian)\n\n-= Khitan Umum 1446 H =-");
        }

        // Commit transaksi
        $conn->commit();
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        // Rollback transaksi jika terjadi error
        $conn->rollback();
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}

/**
 * Fungsi untuk mengirim pesan WhatsApp
 */
function sendMessage($no_hp, $message)
{
    $api_key = 'z1UTH7UwXp2AHo8UNCtT';
    $url = 'https://api.fonnte.com/send';

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
        throw new Exception("Gagal mengirim pesan WhatsApp: " . $result['message']);
    }
}
