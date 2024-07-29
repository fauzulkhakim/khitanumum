<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
require '../config/config.php';

$id = mysqli_real_escape_string($conn, $_GET['id']);
$sql = "DELETE FROM pendaftar WHERE id='$id'";
if (mysqli_query($conn, $sql)) {
    $_SESSION['message'] = "Data telah terhapus";
    header("Location: ../admin/pendaftar.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
