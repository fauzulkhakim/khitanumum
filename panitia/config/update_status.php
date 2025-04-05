<?php
require 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $pendaftarId = intval($_POST['id']);
    $statusId = intval($_POST['status']);
    $updated = isset($_SESSION['user']['nama_lengkap']) ? $_SESSION['user']['nama_lengkap'] : null;
    $timestamp = date('Y-m-d H:i:s'); // Waktu saat ini

    // Validasi apakah admin sudah login
    if (!$updated) {
        echo "<script>
            alert('Admin tidak terdeteksi. Pastikan Anda sudah login.');
            window.location.href = '../admin/pendaftar-info.php?id=$pendaftarId';
        </script>";
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
        echo "<script>
            alert('Data pendaftar tidak ditemukan.');
            window.location.href = '../admin/pendaftar-info.php?id=$pendaftarId';
        </script>";
        exit();
    }

    $otp = $data_wa['otp'];
    $no_hp = $data_wa['no_hp'];

    // Mulai transaksi
    $conn->begin_transaction();

    try {
        // Update status pendaftaran, updated, dan updated_at
        $sql = "UPDATE pendaftar SET status_pendaftaran_id = ?, updated = ?, updated_at = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('issi', $statusId, $updated, $timestamp, $pendaftarId);

        if (!$stmt->execute()) {
            throw new Exception($stmt->error);
        }

        // Kirim pesan WhatsApp berdasarkan status
        $link = "https://khitanumum.menarakudus.id/status.php?otp=$otp"; // Link default
        if ($statusId == 2) { // Diterima
            $link = "https://khitanumum.menarakudus.id/undangan.php?otp=$otp";
            $pesan = "✅ *Pendaftaran Diterima*\n\nSelamat! Pendaftaran Anda telah diterima.\n\nSilakan download bukti daftar dan undangan melalui link berikut:\n$link\n\nJika ada kesalahan data atau membutuhkan informasi lebih lanjut, silakan hubungi:\n\n📞 wa.me/6285878537250 (Haidar)\n📞 wa.me/6281910287931 (Vian)\n\n*-= Khitan Umum 1447 H =-*";
            sendMessage($no_hp, $pesan);
            logWa($conn, $pendaftarId, 'status', "diterima", $pesan);
        } elseif ($statusId == 3) { // Ditolak
            $pesan = "❌ *Pendaftaran Ditolak*\n\nMohon maaf, calon peserta tidak dapat diterima.\n\nCek status pendaftaran Anda melalui link berikut:\n$link\n\nUntuk informasi lebih lanjut, silakan hubungi:\n\n📞 wa.me/6285878537250 (Haidar)\n📞 wa.me/6281910287931 (Vian)\n\n*-= Khitan Umum 1447 H =-*";
            sendMessage($no_hp, $pesan);
            logWa($conn, $pendaftarId, 'status', "ditolak", $pesan);
        } elseif ($statusId == 4) { // Pending
            $pesan = "⌛︎ *Pendaftaran Dalam Antrian*\n\nPendaftaran Anda sedang dalam antrian. Mohon tunggu sampai waktu pendaftaran selesai.\n\nCek status pendaftaran Anda melalui link berikut:\n$link\n\nJika ada kesalahan data atau membutuhkan informasi lebih lanjut, silakan hubungi:\n\n📞 wa.me/6285878537250 (Haidar)\n📞 wa.me/6281910287931 (Vian)\n\n*-= Khitan Umum 1447 H =-*";
            sendMessage($no_hp, $pesan);
            logWa($conn, $pendaftarId, 'status', "pending", $pesan);
        }

        // Commit transaksi
        $conn->commit();
        echo "<script>
            alert('Status pendaftaran berhasil diperbarui.');
            window.location.href = '../admin/pendaftar-info.php?id=$pendaftarId';
        </script>";
        exit();
    } catch (Exception $e) {
        // Rollback transaksi jika terjadi error
        $conn->rollback();
        echo "<script>
            alert('Terjadi kesalahan: {$e->getMessage()}');
            window.location.href = '../admin/pendaftar-info.php?id=$pendaftarId';
        </script>";
        exit();
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
