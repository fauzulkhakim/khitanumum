<?php
require '../config/config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pendaftaran</title>

    <link rel="icon" href="../assets/icon_khitan_umum.png" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            color: #333;
        }

        .card {
            max-width: 700px;
            width: 100%;
            margin: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 10px;
        }

        .card-header {
            background: #3C5B6F;
            color: #fff;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 15px 20px;
        }

        .card-title {
            font-weight: 600;
            font-size: 22px;
            margin: 0;
        }

        .card-body {
            padding: 25px 30px;
        }

        .info-section {
            margin: 15px 0;
            line-height: 1.6;
        }

        .info-section span {
            font-weight: 500;
            display: block;
            margin-bottom: 5px;
            color: #3C5B6F;
        }

        .contact-info {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        .contact-info img {
            max-width: 100%;
            max-height: 100%;
            display: block;
            margin: auto;
        }

        .card-footer {
            padding: 10px 30px;
            background: #f1f1f1;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            text-align: right;
            font-size: 14px;
        }

        .back-button {
            background-color: #3C5B6F;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            border-radius: 5px;
        }

        .back-button:hover {
            background-color: #2B4D6A;
            color: #F8F4E1;
        }

        @media (max-width: 576px) {
            .card-body {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-header text-center">
            <h5 class="card-title">Halaman Foto</h5>
            <p class="mb-0">Khitan Umum 1446 H</p>
        </div>
        <div class="card-body">
            <div class="info-section">
                <h5>Template:</h5>
                <div class="contact-info">
                    <!-- gunakan unsplash -->
                    <img src="../assets/avatar.jfif" alt="Avatar Anak dari Unsplash">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="../index.php" class="back-button">Kembali</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho3lo1AsFwP5SlSH6n6HK1+Pe/m6k/GCI0eFyzxNczepGbVkq8xgoe/A4+gQxgAa" crossorigin="anonymous"></script>
</body>

</html>