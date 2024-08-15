<?php
session_start();
require 'config.php'; // Pastikan file ini menghubungkan ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama_lengkap = $_POST['nama_lengkap'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password untuk keamanan
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];

    // SQL untuk memasukkan data ke tabel users
    $sql = "INSERT INTO users (nama_lengkap, username, password, no_hp, alamat, akses, role) VALUES (?, ?, ?, ?, ?, 0, 'user')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nama_lengkap, $username, $password, $no_hp, $alamat);

    try {
        // Cek apakah eksekusi berhasil
        if ($stmt->execute()) {
            // Jika berhasil, arahkan ke index.php dengan pesan sukses
            header("Location: ../index.php?message=" . urlencode("Pendaftaran berhasil! Hubungi admin untuk persetujuan akses."));
        } else {
            // Jika gagal karena alasan lain, simpan pesan error ke session
            throw new Exception("Pendaftaran gagal! Silakan coba lagi.");
        }
    } catch (mysqli_sql_exception $e) {
        // Jika terjadi duplikat entry (username sudah ada)
        if ($e->getCode() == 1062) {
            $error_message = "Username sudah digunakan. Silakan pilih username lain.";
        } else {
            $error_message = "Terjadi kesalahan: " . $e->getMessage();
        }
        header("Location: ../index.php?error=" . urlencode($error_message));
    }

    // Tutup statement
    $stmt->close();
    exit(); // Hentikan eksekusi skrip lebih lanjut
}
