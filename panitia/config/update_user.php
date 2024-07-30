<?php
require '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    if (isset($_POST['role'])) {
        $role = $_POST['role'];
        $sql = "UPDATE users SET role = '$role' WHERE id = $user_id";
        if ($conn->query($sql) === TRUE) {
            echo 1;
        } else {
            echo 0;
        }
    }

    if (isset($_POST['akses'])) {
        $akses = $_POST['akses'];
        $sql = "UPDATE users SET akses = $akses WHERE id = $user_id";
        if ($conn->query($sql) === TRUE) {
            echo 1;
        } else {
            echo 0;
        }
    }
}
