<?php
session_start();
require '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_lengkap = $_POST['nama_lengkap'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];

    $sql = "INSERT INTO users (nama_lengkap, username, password, no_hp, alamat, akses, role) VALUES (?, ?, ?, ?, ?, 0, 'user')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nama_lengkap, $username, $password, $no_hp, $alamat);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Registration successful!";
        header("Location: ../admin/index.php");
    } else {
        $_SESSION['error'] = "Registration failed!";
    }
    $stmt->close();
}
?>