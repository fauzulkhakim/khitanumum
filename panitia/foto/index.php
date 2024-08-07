<?php
require '../config/config.php';

if (!check_login()) {
    header("Location: ../index.php");
    exit();
}

// Cek role
if ($_SESSION['user']['role'] !== 'master' && $_SESSION['user']['role'] !== 'foto') {
    header("Location: ../index.php"); // atau halaman lain yang sesuai
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Foto</title>

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

        #camera {
            width: 100%;
            max-width: 300px;
            margin: 0 auto;
        }

        #output {
            width: 100%;
            max-width: 300px;
            margin: 20px auto;
            position: relative;
        }

        #output canvas {
            width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Ambil Foto Peserta</h2>
        </div>
        <div class="card-body">
            <div id="camera">
                <video id="video" width="300" height="300" autoplay></video>
                <button id="capture" class="btn btn-primary mt-3">Ambil Foto</button>
            </div>
            <div id="output">
                <canvas id="photoCanvas"></canvas>
            </div>
        </div>
    </div>

    <script>
        const video = document.getElementById('video');
        const captureButton = document.getElementById('capture');
        const canvas = document.getElementById('photoCanvas');
        const context = canvas.getContext('2d');

        // Mengakses kamera
        navigator.mediaDevices.getUserMedia({
                video: true
            })
            .then((stream) => {
                video.srcObject = stream;
            })
            .catch((err) => {
                console.error('Gagal mengakses kamera: ', err);
            });

        // Fungsi untuk menangkap gambar dan menggabungkannya dengan twibbon
        captureButton.addEventListener('click', () => {
            const twibbon = new Image();
            twibbon.src = '../assets/avatar.jfif'; // Path ke twibbon

            twibbon.onload = () => {
                // Mengatur ukuran kanvas sesuai dengan ukuran twibbon
                canvas.width = twibbon.width;
                canvas.height = twibbon.height;

                // Menggambar twibbon terlebih dahulu
                context.drawImage(twibbon, 0, 0, canvas.width, canvas.height);

                // Gambar dari video (kamera), disesuaikan dengan posisi lingkaran pada twibbon
                const centerX = canvas.width / 2;
                const centerY = canvas.height / 2 - 17;
                const radius = 45; // Adjust this according to the actual radius of the white circle in the twibbon

                context.beginPath();
                context.arc(centerX, centerY, radius, 0, 2 * Math.PI);
                context.closePath();
                context.clip();

                // Menyesuaikan gambar video agar pas di dalam lingkaran
                const videoWidth = video.videoWidth;
                const videoHeight = video.videoHeight;

                // Calculate scale to fit the video within the circle
                const scale = Math.max((radius * 2) / videoWidth, (radius * 2) / videoHeight);
                const scaledWidth = videoWidth * scale;
                const scaledHeight = videoHeight * scale;

                // Draw the video image centered inside the circle
                context.drawImage(video, centerX - scaledWidth / 2, centerY - scaledHeight / 2, scaledWidth, scaledHeight);
            };
        });
    </script>
</body>

</html>