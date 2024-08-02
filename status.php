<?php
require 'panitia/config/config.php';

// Asumsi kita mendapatkan NIK atau ID pengguna dari sesi atau query string
$nik = isset($_GET['nik']) ? $_GET['nik'] : '';

if (empty($nik)) {
    echo "<div class='alert alert-danger text-center'>NIK tidak ditemukan. Silakan login kembali.</div>";
    exit();
}

// Query untuk mengambil data peserta berdasarkan NIK
$query = "SELECT * FROM pendaftar WHERE nik = '$nik'";
$result = mysqli_query($conn, $query);
$pendaftar = mysqli_fetch_assoc($result);

if (!$pendaftar) {
    echo "<div class='alert alert-danger text-center'>Data tidak ditemukan. Silakan cek kembali NIK Anda.</div>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pendaftaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="panitia/assets/icon_khitan_umum.png" type="image/x-icon">
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
            max-width: 500px;
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

        .contact-info p {
            margin-bottom: 0;
        }

        .card-footer {
            padding: 10px 30px;
            background: #f1f1f1;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            text-align: right;
            font-size: 14px;
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
            <h5 class="card-title">Bukti Pendaftaran</h5>
            <p class="mb-0">Khitan Umum 1446 H</p>
        </div>
        <div class="card-body">
            <div class="info-section">
                <span>Nomor KIA / NIK:</span>
                <?php echo htmlspecialchars($pendaftar['nik']); ?>
            </div>
            <div class="info-section">
                <span>Nama Peserta:</span>
                <?php echo htmlspecialchars($pendaftar['nama_depan'] . ' ' . $pendaftar['nama_belakang']); ?>
            </div>
            <div class="info-section">
                <span>Nama Orang Tua/Wali:</span>
                <?php echo htmlspecialchars($pendaftar['orang_tua_wali']); ?>
            </div>
            <div class="info-section">
                <span>Alamat:</span>
                <?php echo htmlspecialchars($pendaftar['alamat_lengkap']); ?>
            </div>
            <!-- Status Pendaftaran -->
            <div class="info-section">
                <span>Status Pendaftaran:</span>
                <?php
                if ($pendaftar['status_pendaftaran_id'] == 1) {
                    echo '🟠Belum Verifikasi';
                } elseif ($pendaftar['status_pendaftaran_id'] == 2) {
                    echo '✅Diterima';
                } elseif ($pendaftar['status_pendaftaran_id'] == 3) {
                    echo '❌Ditolak';
                } elseif ($pendaftar['status_pendaftaran_id'] == 4) {
                    echo '🟡Pending';
                }
                ?>
            </div>
            <p class="mt-4 text-center">UNDANGAN Pemeriksaan Kesehatan akan dikirimkan lewat WA setelah Verifikasi Administratif.</p>
            <div class="contact-info text-center mt-3">
                <p>Info lebih lanjut, hubungi:</p>
                <p>Faza: 0877-6012-3112</p>
                <p>Ari: 0812-1212-1992</p>
            </div>
        </div>
        <div class="card-footer">
            <small><?php echo date('d/m/Y H:i:s', strtotime($pendaftar['date_created'])); ?></small>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho3lo1AsFwP5SlSH6n6HK1+Pe/m6k/GCI0eFyzxNczepGbVkq8xgoe/A4+gQxgAa" crossorigin="anonymous"></script>
</body>

</html>