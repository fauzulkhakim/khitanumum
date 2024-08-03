<?php
session_start();
require 'config.php';

// Ambil data dari form
$username = $_POST['username'];
$password = $_POST['password'];

// Cek apakah username dan password benar
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verifikasi password
    if (password_verify($password, $user['password'])) {
        // Cek apakah memiliki akses
        if ($user['akses'] == 1) {
            // Set sesi
            $_SESSION['user'] = $user;

            // Redirect berdasarkan role
            switch ($user['role']) {
                case 'master':
                    header("Location: ../admin/dashboard.php");
                    break;
                case 'admin':
                    header("Location: ../admin/dashboard.php");
                    break;
                case 'foto':
                    header("Location: ../foto/index.php");
                    break;
                case 'user':
                    header("Location: ../admin/dashboard.php");
                    break;
                default:
                    $_SESSION['error'] = "Role tidak dikenali.";
                    header("Location: ../index.php");
                    break;
            }
            exit();
        } else {
            $_SESSION['error'] = "Anda tidak memiliki akses.";
        }
    } else {
        $_SESSION['error'] = "Password salah.";
    }
} else {
    $_SESSION['error'] = "Username tidak ditemukan.";
}

header("Location: ../index.php");
exit();
