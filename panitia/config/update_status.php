<?php
require 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pendaftarId = $_POST['id'];
    $statusId = $_POST['status'];
    $isAccepted = ($statusId == 2); // ID status 'Diterima' adalah 2
    $adminId = $_SESSION['user']['id']; // ID admin yang login

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
