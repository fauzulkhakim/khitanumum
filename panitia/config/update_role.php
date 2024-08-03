<?php
require 'config.php';

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id']) && isset($data['role'])) {
    $id = $data['id'];
    $role = $data['role'];

    $stmt = $conn->prepare("UPDATE users SET role = ? WHERE id = ?");
    $stmt->bind_param('si', $role, $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

    $stmt->close();
}
