<?php
require 'panitia/config/config.php';

$error_message = '';

// Fungsi untuk mengirim OTP baru
function sendNewOTP($conn, $nik)
{
    $new_otp = rand(100000, 999999);
    $waktu = time();

    // Update OTP baru ke database
    $update_query = "UPDATE pendaftar SET otp = '$new_otp', date_created = NOW() WHERE nik = '$nik'";
    if (mysqli_query($conn, $update_query)) {
        // Dapatkan nomor telepon pengguna
        $result = mysqli_query($conn, "SELECT no_hp FROM pendaftar WHERE nik = '$nik'");
        $row = mysqli_fetch_assoc($result);
        $no_hp = $row['no_hp'];

        // Kirim OTP baru via WhatsApp
        sendOTPWhatsApp($no_hp, $new_otp);
        return "<div class='alert alert-success text-center'>OTP baru telah dikirim. Silakan cek WhatsApp Anda.</div>";
    } else {
        return "<div class='alert alert-danger text-center'>Gagal mengirim OTP baru. Silakan coba lagi nanti.</div>";
    }
}

// Fungsi untuk mengirim OTP via WhatsApp
function sendOTPWhatsApp($no_hp, $otp)
{
    $api_key = 'isWg7e+RSvxmVDncTvbw'; // Ganti dengan API key Anda
    $url = 'https://api.fonnte.com/send';

    $data = [
        'target' => $no_hp, // Nomor tujuan dengan format internasional
        'message' => "Kode OTP Anda adalah: $otp"
    ];

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        "Authorization: $api_key", // Header otorisasi dengan API key
    ]);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

    $response = curl_exec($curl);
    curl_close($curl);

    $result = json_decode($response, true);
    if ($result['status'] != "success") {
        return "Gagal mengirim OTP: " . $result['message'];
    }
    return "OTP baru telah dikirim.";
}

// Fungsi untuk mengirim pesan sukses pendaftaran via WhatsApp
function sendSuccessMessage($no_hp, $link)
{
    $api_key = 'isWg7e+RSvxmVDncTvbw'; // Ganti dengan API key Anda
    $url = 'https://api.fonnte.com/send';

    $message = "✅ Pendaftaran Berhasil
------------------------------------------------------------

Untuk melihat informasi status pendaftaran, silahkan buka link dibawah ini: 
$link

Informasi lebih lanjut akan diberikan melalui nomor whatsapp ini.

------------------------------------------------------------

-= KhitanUmum 1446H =-";

    $data = [
        'target' => $no_hp, // Nomor tujuan dengan format internasional
        'message' => $message
    ];

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        "Authorization: $api_key", // Header otorisasi dengan API key
    ]);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

    $response = curl_exec($curl);
    curl_close($curl);

    $result = json_decode($response, true);
    if ($result['status'] != "success") {
        return "Gagal mengirim pesan sukses: " . $result['message'];
    }
    return "Pesan sukses telah dikirim.";
}

// Cek jika pengguna meminta OTP baru
if (isset($_GET['request_new_otp']) && $_GET['request_new_otp'] == 'true') {
    $nik = mysqli_real_escape_string($conn, $_GET['nik']);
    $error_message = sendNewOTP($conn, $nik);
}

// Proses verifikasi OTP
if (isset($_POST['submit-login'])) {
    $otp = mysqli_real_escape_string($conn, $_POST['otp']);
    $nik = mysqli_real_escape_string($conn, $_POST['nik']);

    // Cek OTP di database
    $q = mysqli_query($conn, "SELECT * FROM pendaftar WHERE nik = '$nik' AND otp = '$otp'");
    $row = mysqli_num_rows($q);
    $r = mysqli_fetch_array($q);
    if ($row) {
        if (time() - strtotime($r['date_created']) <= 300) { // Validasi OTP dalam 5 menit
            // Update status verifikasi di database
            $update_query = "UPDATE pendaftar SET is_verified = 1 WHERE nik = '$nik'";
            mysqli_query($conn, $update_query);

            // Kirim pesan sukses
            $link = "http://localhost/khitanumum/status.php?nik=$nik"; // Sesuaikan link dengan URL yang benar
            sendSuccessMessage($r['no_hp'], $link);

            // Redirect ke halaman status
            header("Location: status.php?nik=$nik");
            exit();
        } else {
            $error_message = "<div class='alert alert-warning text-center'>OTP kedaluwarsa. Silakan minta OTP baru. <a href='otp.php?nik=$nik&request_new_otp=true'>Kirim OTP baru</a></div>";
        }
    } else {
        $error_message = "<div class='alert alert-danger text-center'>OTP salah. Silakan coba lagi.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP</title>
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
            background: #3C5B6F;
        }

        .otp-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 400px;
            margin: 0 20px;
        }

        .alert a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="otp-container">
        <h1 class="text-center mb-4">Verifikasi OTP</h1>
        <?php echo $error_message; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="otp">Kode OTP :</label>
                <input placeholder="Masukkan 6 digit" name="otp" type="text" id="otp" required class="form-control" maxlength="6" />
            </div>
            <input type="hidden" name="nik" value="<?php echo htmlspecialchars($_GET['nik']); ?>">
            <button type="submit" class="btn btn-success btn-block mt-3" name="submit-login">Verifikasi</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>