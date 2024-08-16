<?php
require 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pendaftarId = $_POST['id'];
    $statusId = $_POST['status'];
    $isAccepted = ($statusId == 2); // ID status 'Diterima' adalah 2
    $adminId = $_SESSION['user']['id']; // ID admin yang login

    // Kebutuhan kirim whatsapp
    $data_wa = mysqli_query($conn, "SELECT * FROM pendaftar WHERE id = $pendaftarId");
    $data_wa = mysqli_fetch_assoc($data_wa);
    $data_otp = $data_wa['otp'];
    $data_no_hp = $data_wa['no_hp'];

    // Mengambil nama lengkap admin
    $adminQuery = "SELECT nama_lengkap FROM users WHERE id = ?";
    $adminStmt = $conn->prepare($adminQuery);
    $adminStmt->bind_param('i', $adminId);
    $adminStmt->execute();
    $adminStmt->bind_result($namaLengkapAdmin);
    $adminStmt->fetch();
    $adminStmt->close();

    // Mulai transaksi
    $conn->begin_transaction();

    try {
        // Update status pendaftaran dan nama admin yang memperbarui
        $sql = "UPDATE pendaftar SET status_pendaftaran_id = ?, updated = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('isi', $statusId, $namaLengkapAdmin, $pendaftarId);
        $stmt->execute();

        // Jika status diubah menjadi 'Diterima', buat dan simpan nomor peserta
        if ($isAccepted) {
            // Ambil nomor peserta terbesar saat ini
            $maxQuery = "SELECT MAX(CAST(SUBSTRING(no_peserta, 3) AS UNSIGNED)) AS max_no FROM pendaftar";
            $maxResult = $conn->query($maxQuery);
            $maxRow = $maxResult->fetch_assoc();
            $maxNo = $maxRow['max_no'] ?? 0;

            // Buat nomor peserta baru dengan prefiks "46"
            $newNoPeserta = '46' . str_pad($maxNo + 1, 4, '0', STR_PAD_LEFT);

            // Simpan nomor peserta baru
            $sqlNoPeserta = "UPDATE pendaftar SET no_peserta = ? WHERE id = ?";
            $stmt = $conn->prepare($sqlNoPeserta);
            $stmt->bind_param('si', $newNoPeserta, $pendaftarId);
            $stmt->execute();

            // Kirim pesan WhatsApp
            $link = "https://khitanumum.menarakudus.id/undangan.php?otp=" . $data_otp; // Sesuaikan link dengan URL yang benar
            sendMessageDiterima($data_no_hp, $link);
        } elseif ($statusId == 3) {
            // Ditolak
            $link = "https://khitanumum.menarakudus.id/status.php?otp=" . $data_otp; // Sesuaikan link dengan URL yang benar
            sendMessageDitolak($data_no_hp, $link);
        } elseif ($statusId == 4) {
            // Pending
            $link = "https://khitanumum.menarakudus.id/status.php?otp=" . $data_otp; // Sesuaikan link dengan URL yang benar
            sendMessagePending($data_no_hp, $link);
        }

        // Commit transaksi
        $conn->commit();
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        // Jika ada error, rollback transaksi
        $conn->rollback();
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
}

function sendMessageDiterima($no_hp, $link)
{
    $api_key = 'wGd+U1ehDoCTphUxwciu';
    $url = 'https://api.fonnte.com/send';

    $message = "✅ Pendaftaran Diterima
------------------------------------------------------------

Download bukti daftar dan undangan melalui link dibawah ini:

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

function sendMessagePending($no_hp, $link)
{
    $api_key = 'wGd+U1ehDoCTphUxwciu';
    $url = 'https://api.fonnte.com/send';

    $message = "⌛︎ Pendaftaran dalam antrian
------------------------------------------------------------

Mohon tunggu sampai waktu pendaftaran selesai.
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

function sendMessageDitolak($no_hp, $link)
{
    $api_key = 'wGd+U1ehDoCTphUxwciu';
    $url = 'https://api.fonnte.com/send';

    $message = "❌ Pendaftaran Ditolak
------------------------------------------------------------

Mohon maaf calon peserta tidak dapat diterima.

$link

Informasi lebih lanjut silahkan hubungi WhatsApp dibawah ini:

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
