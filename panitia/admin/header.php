<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Khitan Umum YM3SK</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.2/css/dataTables.bootstrap5.css">

  <link rel="icon" href="../assets/icon_khitan_umum.png" type="image/x-icon">
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap");

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
      min-height: 100vh;
      display: flex;
      justify-content: center;
      flex-direction: column;
    }

    .container-fluid {
      flex: 1;
    }

    .navbar-bottom {
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      background-color: #f8f9fa;
      border-top: 1px solid #ddd;
      padding: 10px;
      margin-top: 100px;
    }

    .navbar-bottom .nav-item .nav-link {
      color: #000;
    }

    .navbar-bottom .nav-item .nav-link:hover {
      color: #007bff;
    }

    .navbar-bottom .nav-item .nav-link i {
      display: block;
      font-size: 18px;
    }

    .navbar-bottom .nav-link.active i {
      color: #007bff;
    }

    .action-icon {
      padding: 9px;
      /* Sesuaikan padding sesuai kebutuhan */
      margin: 2px;
      /* Menambahkan jarak antar ikon */
    }

    .action-icon i {
      font-size: 13px;
      /* Mengatur ukuran ikon */
    }
  </style>
</head>

<body>

  <div class="container-fluid">
    <div class="row">
      <div class="col-12 mb-5">