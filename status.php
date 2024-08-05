<?php
require 'panitia/config/config.php';

// Asumsi kita mendapatkan otp dari query string
$otp = isset($_GET['otp']) ? $_GET['otp'] : '';

if (empty($otp)) {
    echo "<div class='alert alert-danger text-center'>OTP tidak ditemukan. Silakan login kembali.</div>";
    exit();
}

// Query untuk mengambil data peserta berdasarkan otp dengan join ke tabel terkait
$query = "
SELECT
    p.*,
    r.nama_rt_rw AS rt_rw,
    rw.nama_rt_rw AS rw_rw,
    v.name_villages AS desa_kelurahan,
    d.name_districts AS kecamatan,
    reg.name_regencies AS kabupaten_kota,
    prov.name_provinces AS provinsi
FROM
    pendaftar p
LEFT JOIN
    rt_rw r ON p.rt_rt_rw_id = r.id_rt_rw
LEFT JOIN
    rt_rw rw ON p.rw_rt_rw_id = rw.id_rt_rw
LEFT JOIN
    villages v ON p.domisili_villages_id = v.id_villages
LEFT JOIN
    districts d ON p.domisili_districts_id = d.id_districts
LEFT JOIN
    regencies reg ON p.domisili_regencies_id = reg.id_regencies
LEFT JOIN
    provinces prov ON p.domisili_provinces_id = prov.id_provinces
WHERE
    p.otp = '$otp'
";
$result = mysqli_query($conn, $query);
$pendaftar = mysqli_fetch_assoc($result);

if (!$pendaftar) {
    echo "<div class='alert alert-danger text-center'>Data tidak ditemukan. Silakan cek kembali OTP Anda.</div>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pendaftaran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
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
                <span>RT/RW:
                    <?php echo isset($pendaftar['rt_rw']) && isset($pendaftar['rw_rw']) ? htmlspecialchars($pendaftar['rt_rw']) . ' / ' . htmlspecialchars($pendaftar['rw_rw']) : '-'; ?>
                </span>
                <span>Kel/Desa:
                    <?php echo isset($pendaftar['desa_kelurahan']) ? htmlspecialchars($pendaftar['desa_kelurahan']) : '-'; ?>
                </span>
                <span>Kecamatan:
                    <?php echo isset($pendaftar['kecamatan']) ? htmlspecialchars($pendaftar['kecamatan']) : '-'; ?>
                </span>
                <span>Kabupaten/Kota:
                    <?php echo isset($pendaftar['kabupaten_kota']) ? htmlspecialchars($pendaftar['kabupaten_kota']) : '-'; ?>
                </span>
            </div>
            <!-- Status Pendaftaran -->
            <div class="info-section">
                <span>Status Pendaftaran:</span>
                <?php
                if ($pendaftar['status_pendaftaran_id'] == 1) {
                    echo '🟠Belum Verifikasi';
                } elseif ($pendaftar['status_pendaftaran_id'] == 2) {
                    echo '✅Diterima';
                    // Tampilkan tombol download dan QR code jika diterima
                    echo '<div class="text-center mt-3">
                            <a href="javascript:void(0)" id="download-pdf" class="btn btn-success">Download PDF</a>
                            <a href="javascript:void(0)" id="show-qrcode" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#qrcodeModal">QR Code</a>
                        </div>';
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
                <p>Faza: <a href="https://wa.me/6287760123112" target="_blank">087760123112</a></p>
                <p>Ari: <a href="https://wa.me/6281212121992" target="_blank">081212121992</a></p>
            </div>

        </div>
        <div class="card-footer">
            <small><?php echo date('d/m/Y H:i:s', strtotime($pendaftar['date_created'])); ?></small>
        </div>
    </div>

    <!-- Modal QR Code -->
    <div class="modal fade" id="qrcodeModal" tabindex="-1" aria-labelledby="qrcodeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="qrcodeModalLabel">QR Code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <canvas id="qrcode"></canvas>
                    <p class="mt-3">ID Pendaftar: <span id="id-pendaftar"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>

    <script>
        document.getElementById('download-pdf').addEventListener('click', function() {
            const element = document.querySelector('.card'); // Pilih elemen yang ingin di-download sebagai PDF

            html2canvas(element, {
                scale: 3 // Menambah skala untuk kualitas lebih baik
            }).then((canvas) => {
                const imgData = canvas.toDataURL('image/png');
                const pdf = new jspdf.jsPDF({
                    orientation: 'portrait',
                    unit: 'px', // Unit piksel
                    format: [canvas.width, canvas.height] // Sesuaikan ukuran PDF dengan kanvas
                });
                pdf.addImage(imgData, 'PNG', 0, 0, canvas.width, canvas.height);
                pdf.save("status_pendaftaran.pdf");
            });
        });

        document.getElementById('show-qrcode').addEventListener('click', function() {
            const idPendaftar = "<?php echo $pendaftar['id']; ?>"; // Ambil ID Pendaftar

            // Generate QR Code
            var qr = new QRious({
                element: document.getElementById('qrcode'),
                value: idPendaftar,
                size: 200
            });

            // Set ID Pendaftar
            document.getElementById('id-pendaftar').textContent = idPendaftar;
        });
    </script>
</body>

</html>