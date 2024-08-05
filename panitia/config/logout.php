<?php
session_start();
session_unset();
session_destroy();

// Hapus cookie
setcookie("user_login", "", time() - 3600, "/");

header("Location: ../index.php");
exit();
