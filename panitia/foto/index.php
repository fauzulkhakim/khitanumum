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

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: 500;
            color: #3C5B6F;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Ambil Foto Peserta</h2>
        </div>
        <div class="card-body">
            <form id="participantForm">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="id_number">Nomor ID</label>
                    <input type="text" id="id_number" name="id_number" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="barcode">Barcode</label>
                    <input type="text" id="barcode" name="barcode" class="form-control" required>
                </div>
                <div id="camera">
                    <video id="video" width="300" height="300" autoplay></video>
                    <button type="button" id="capture" class="btn btn-primary mt-3">Ambil Foto</button>
                </div>
                <div id="output">
                    <canvas id="photoCanvas"></canvas>
                </div>
            </form>
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

        // Fungsi untuk menangkap gambar dan menggabungkannya dengan template
        captureButton.addEventListener('click', () => {
            const twibbon = new Image();
            twibbon.src = '../assets/avatar.jfif'; // Path ke template

            twibbon.onload = () => {
                // Mengatur ukuran kanvas sesuai dengan ukuran template
                canvas.width = twibbon.width;
                canvas.height = twibbon.height;

                // Menggambar template terlebih dahulu
                context.drawImage(twibbon, 0, 0, canvas.width, canvas.height);

                // Gambar dari video (kamera), disesuaikan dengan posisi lingkaran pada template
                const centerX = canvas.width / 2;
                const centerY = canvas.height / 2 - 17;
                const radius = 45; // Sesuaikan dengan radius lingkaran putih pada template

                context.beginPath();
                context.arc(centerX, centerY, radius, 0, 2 * Math.PI);
                context.closePath();
                context.clip();

                // Menyesuaikan gambar video agar pas di dalam lingkaran
                const videoWidth = video.videoWidth;
                const videoHeight = video.videoHeight;

                // Kalkulasi skala untuk menyesuaikan video di dalam lingkaran
                const scale = Math.max((radius * 2) / videoWidth, (radius * 2) / videoHeight);
                const scaledWidth = videoWidth * scale;
                const scaledHeight = videoHeight * scale;

                // Menggambar gambar video di lingkaran
                context.drawImage(video, centerX - scaledWidth / 2, centerY - scaledHeight / 2, scaledWidth, scaledHeight);

                // Menambahkan teks untuk Nama, Nomor ID, dan Barcode
                const name = document.getElementById('name').value;
                const idNumber = document.getElementById('id_number').value;
                const barcode = document.getElementById('barcode').value;

                context.font = 'bold 16px Poppins';
                context.fillStyle = '#000';
                context.textAlign = 'center';

                // Menyesuaikan posisi teks
                context.fillText(name, canvas.width / 2, canvas.height - 120); // Atur posisi Y sesuai dengan kebutuhan
                context.fillText(idNumber, canvas.width / 2, canvas.height - 100); // Atur posisi Y sesuai dengan kebutuhan
                context.fillText(barcode, canvas.width / 2, canvas.height - 80); // Atur posisi Y sesuai dengan kebutuhan

                // Mengunduh gambar
                const dataURL = canvas.toDataURL('image/png');
                const link = document.createElement('a');
                link.href = dataURL;
                link.download = 'twibbon.png';
                link.click();

                // Test
                console.log("Name: ", name);
                console.log("ID Number: ", idNumber);
                console.log("Barcode: ", barcode);

            };
        });
    </script>
</body>

</html>