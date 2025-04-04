<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
require '../config/config.php';

$id = mysqli_real_escape_string($conn, $_GET['id']);
$deleted_by = $_SESSION['user']['nama_lengkap']; // Nama admin yang menghapus
$timestamp = date('Y-m-d H:i:s'); // Waktu saat ini

// Soft delete: update kolom deleted_by dan deleted_at
$sql = "UPDATE pendaftar SET deleted_by='$deleted_by', deleted_at='$timestamp' WHERE id='$id'";

if (mysqli_query($conn, $sql)) {
    $_SESSION['message'] = "Data telah dihapus (soft delete)";
    header("Location: ../admin/pendaftar.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
