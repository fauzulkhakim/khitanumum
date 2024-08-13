<?php
require 'config.php';
session_start();

function generateParticipantNumber() {
    $timestamp = time();
    $randomNumber = rand(1000, 9999);
    return $randomNumber;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pendaftarId = $_POST['id'];
    $statusId = $_POST['status'];
    $isAccepted = ($statusId == 2);  // ID status 'Diterima' adalah 2
    $adminId = $_SESSION['user']['id'];  // ID admin yang login

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
            $noPeserta = generateParticipantNumber();
            $sqlNoPeserta = "UPDATE pendaftar SET no_peserta = ? WHERE id = ?";
            $stmt = $conn->prepare($sqlNoPeserta);
            $stmt->bind_param('si', $noPeserta, $pendaftarId);
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


