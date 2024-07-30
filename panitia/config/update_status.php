<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pendaftarId = $_POST['id'];
    $statusId = $_POST['status'];

    $sql = "UPDATE pendaftar SET status_pendaftaran_id = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $statusId, $pendaftarId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
}
