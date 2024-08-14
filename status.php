<?php
require 'panitia/config/config.php';

// Asumsi kita mendapatkan otp dari query string
$otp = isset($_GET['otp']) ? $_GET['otp'] : '';

if (empty($otp)) {
    echo "<div class='alert alert-danger text-center'>OTP tidak ditemukan.</div>";
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
            background: #929A94;
            color: #333;
        }

        .card {
            max-width: 400px;
            min-width: 350px;
            margin: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
            border-radius: 10px;
        }

        .card-header {
            background: #f1f1f1;
            color: #2D3C28;
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
            <div class="row justify-content-center">
                <div class="col-3 text-end align-self-center">
                    <img src="panitia/assets/icon_khitan_umum.png" alt="logo" width="50">
                </div>
                <div class="col-9 text-start">
                    <h5 class="card-title">Status Pendaftaran</h5>
                    <p class="mb-0">Khitan Umum 1446 H</p>
                </div>
            </div>
        </div>
        <?php
        $status = '';
        $qr = '';
        if ($pendaftar['status_pendaftaran_id'] == 1) {
            $status = '🟠 &nbsp; Belum Verifikasi';
        } elseif ($pendaftar['status_pendaftaran_id'] == 2) {
            $status = '✅ &nbsp; Diterima';
            $qr = 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . $pendaftar['no_peserta'];
            // $qr = 'https://barcode.tec-it.com/barcode.ashx?data=' . $pendaftar['no_peserta'];
        } elseif ($pendaftar['status_pendaftaran_id'] == 3) {
            $status = '❌ &nbsp; Ditolak';
        } elseif ($pendaftar['status_pendaftaran_id'] == 4) {
            $status = '⌛︎ &nbsp; Pending';
        }
        ?>

        <div class="card-body">
            <div class="row" style="padding-right: 10%;">
                <table>
                    <tr>
                        <td style="color: #3C5B6F; font-weight: 600; font-size: 18px" class="text-center">Status Pendaftaran : </td>
                        <?php if ($pendaftar['status_pendaftaran_id'] == 2) { ?>
                            <td rowspan="2" class="text-end"><img src="<?php echo $qr; ?>" alt="qr" width="80px"></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td style="color: #3C5B6F; font-weight: 600; font-size: 24px" class="text-center"><?php echo $status; ?></td>
                    </tr>
                    <?php if ($pendaftar['status_pendaftaran_id'] == 2) { ?>
                        <tr>
                            <td></td>
                            <td style="padding-right: 4%; padding-top: 5px" class="text-end"><?php echo $pendaftar['no_peserta']; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="row mt-3" style="padding-left: 5%;">
                <table>
                    <thead>
                        <th style="width: 22%;"></th>
                        <th style="width: 3%;"></th>
                        <th style="width: 75%;"></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($pendaftar['nama_lengkap']); ?></td>
                        </tr>
                        <tr>
                            <td>NIK</td>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($pendaftar['nik']); ?></td>
                        </tr>
                        <tr>
                            <td>Orang Tua</td>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($pendaftar['orang_tua_wali']); ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td><?php echo htmlspecialchars($pendaftar['desa_kelurahan']) . ' ' . htmlspecialchars($pendaftar['rt_rw']) . '/' . htmlspecialchars($pendaftar['rw_rw']); ?></td>
                        </tr>
                        <tr>
                            <!-- Buang Kabupaten -->
                            <?php
                            $kab_kota = $pendaftar['kabupaten_kota'];
                            if (stripos($kab_kota, 'Kabupaten') === 0) {
                                $kab_kota = trim(substr($kab_kota, strlen('Kabupaten')));
                            }
                            ?>
                            <td></td>
                            <td></td>
                            <td><?php echo htmlspecialchars($pendaftar['kecamatan']) . ' ' . htmlspecialchars($kab_kota); ?></td>
                        </tr>
                        <tr>
                            <td>Waktu</td>
                            <td>:</td>
                            <td><?php echo date('d/m/Y H:i:s', strtotime($pendaftar['date_created'])); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <?php if ($pendaftar['status_pendaftaran_id'] == 1) { ?>
                <!-- Belum Verifikasi -->
                <p class="mt-4 text-center">Pendaftaran berhasil. <br> Proses verifikasi 2 X 24 jam.</p>
            <?php } elseif ($pendaftar['status_pendaftaran_id'] == 2) { ?>
                <!-- Diterima -->
                <p class="mt-4 text-center">Pendaftaran diterima. <br> Undangan Pemeriksaan Kesehatan akan segera dikirimkan via WhatsApp.</p>
                <div class="contact-info text-center mt-2">
                    <p>Info lebih lanjut, hubungi:</p>
                    <p>Haidar : <a href="https://wa.me/6285878537250" target="_blank">085878537250</a></p>
                    <p>Vian : <a href="https://wa.me/6281910287931" target="_blank">081910287931</a></p>
                </div>
            <?php } elseif ($pendaftar['status_pendaftaran_id'] == 3) { ?>
                <!-- Ditolak -->
                <p class="mt-4 text-center">Pendaftaran ditolak.</p>
            <?php } else { ?>
                <!-- Pending -->
                <p class="mt-4 text-center">Pendaftaran dalam antrian.</p>
                <div class="contact-info text-center mt-2">
                    <p>Info lebih lanjut, hubungi:</p>
                    <p>Haidar : <a href="https://wa.me/6285878537250" target="_blank">085878537250</a></p>
                    <p>Vian : <a href="https://wa.me/6281910287931" target="_blank">081910287931</a></p>
                </div>
            <?php } ?>

        </div>
        <div class="card-footer">
            <small><?php echo date('d/m/Y H:i:s'); ?></small>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>

</body>

</html>