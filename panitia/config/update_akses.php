<?php
require 'config.php';

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id']) && isset($data['akses'])) {
    $id = $data['id'];
    $akses = $data['akses'];

    $stmt = $conn->prepare("UPDATE users SET akses = ? WHERE id = ?");
    $stmt->bind_param('ii', $akses, $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
}
