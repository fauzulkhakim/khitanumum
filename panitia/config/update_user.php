<?php
require '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST['user_id'];
    $role = $_POST['role'] ?? null;
    $akses = $_POST['akses'] ?? null;

    if ($role !== null) {
        $sql = "UPDATE users SET role = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $role, $userId);
    } elseif ($akses !== null) {
        $sql = "UPDATE users SET akses = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $akses, $userId);
    }

    if ($stmt->execute()) {
        echo 1;
    } else {
        echo 0;
    }
    $stmt->close();
}
