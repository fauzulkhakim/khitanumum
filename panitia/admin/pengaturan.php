<?php
require '../config/config.php';
// session_start();

// if (isset($_SESSION['username']) && isset($_SESSION['id'])) {
//   // Pengguna sudah login
// } else {
//   // Pengguna belum login, alihkan ke halaman login
//   if (!isset($_SESSION['user'])) {
//     header("Location: index.php");
//     exit();
//   }
// }

// Membaca nilai saat ini untuk dibuka, ditutup, dan pelaksanaan
include '../config/dates_config.php';

// Menangani pengiriman formulir untuk memperbarui tanggal
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['pendaftaran'])) {
    if (isset($_POST['dibuka']) && isset($_POST['ditutup'])) {
      $dibuka = $_POST['dibuka'];
      $ditutup = $_POST['ditutup'];

      // Menulis tanggal baru ke file dates_config.php
      $config_content = "<?php\n";
      $config_content .= "\$dibuka = \"$dibuka\";\n";
      $config_content .= "\$ditutup = \"$ditutup\";\n";
      $config_content .= "\$pelaksanaan = \"$pelaksanaan\";\n"; // Pastikan ini tetap ada
      $config_content .= "?>";

      file_put_contents('../config/dates_config.php', $config_content);
      echo "<script>alert('Tanggal pendaftaran telah diperbarui');</script>";
      // Muat ulang untuk memuat tanggal baru
      header("Refresh:0");
    }
  } elseif (isset($_POST['pelaksanaan'])) {
    if (isset($_POST['pelaksanaan'])) {
      $pelaksanaan = $_POST['pelaksanaan'];

      // Menulis tanggal pelaksanaan baru ke file dates_config.php
      $config_content = "<?php\n";
      $config_content .= "\$dibuka = \"$dibuka\";\n"; // Pastikan ini tetap ada
      $config_content .= "\$ditutup = \"$ditutup\";\n"; // Pastikan ini tetap ada
      $config_content .= "\$pelaksanaan = \"$pelaksanaan\";\n";

      file_put_contents('../config/dates_config.php', $config_content);
      echo "<script>alert('Tanggal pelaksanaan telah diperbarui');</script>";
      // Muat ulang untuk memuat tanggal baru
      header("Refresh:0");
    }
  }
}

// Mengambil semua pengguna
$sql = "SELECT * FROM users";
$hasil = $conn->query($sql);

setlocale(LC_TIME, 'id_ID.UTF-8'); // Mengatur locale ke bahasa Indonesia

require_once 'header.php';
?>

<style>
  .date-range {
    background-color: black;
    color: white;
    padding: 5px;
    border-radius: 5px;
  }
</style>

<!-- Header -->
<div class="row justify-content-center bg-dark">
  <div class="col-ml text-center text-white my-2">
    <h3>Pengaturan Khitan Umum</h3>
    <h5>1446 H / 2024 TU</h5>
  </div>
</div>
<!-- Akhir Header -->

<div class="container">
  <div class="row justify-content-center my-4">
    <div class="col-12 col-md-4 mb-4 mb-md-0">
      <div class="card mx-auto" style="width: 75%;">
        <img src="../assets/avatar-3.jpg" class="card-img-top" alt="gambar pengguna">
        <div class="card-body text-center">
          <h5 class="card-title">
            <?php
            if (isset($_SESSION['user'])) {
              echo $_SESSION['user']['nama_lengkap'];
            }
            ?>
          </h5>
        </div>
      </div>
    </div>
  </div>

  <!-- Isi Halaman -->
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-md-6 mb-3">
        <!-- Card Tanggal Pendaftaran -->
        <div class="card" style="width: 100%;">
          <div class="card-body">
            <h5 class="card-title">Tanggal Pendaftaran</h5>
            <p class="date-range"><?= strftime('%d %B %Y', strtotime($dibuka)) . " - " . strftime('%d %B %Y', strtotime($ditutup)); ?></p>
            <form method="POST" id="formPendaftaran">
              <input type="hidden" name="pendaftaran" value="1">
              <div class="row">
                <div class="col-12 mb-3">
                  <label for="dibuka" class="form-label">Dibuka</label>
                  <input type="datetime-local" class="form-control" id="dibuka" name="dibuka" value="<?= date('Y-m-d\TH:i', strtotime($dibuka)); ?>" onchange="showButton('formPendaftaran')">
                </div>
                <div class="col-12 mb-3">
                  <label for="ditutup" class="form-label">Ditutup</label>
                  <input type="datetime-local" class="form-control" id="ditutup" name="ditutup" value="<?= date('Y-m-d\TH:i', strtotime($ditutup)); ?>" onchange="showButton('formPendaftaran')">
                </div>
              </div>
              <div class="mt-3 text-center d-none" id="buttonPendaftaran">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>
        </div>
        <!-- Akhir Card Tanggal Pendaftaran -->
      </div>

      <div class="col-12 col-md-6 mb-3">
        <!-- Card Tanggal Pelaksanaan -->
        <div class="card" style="width: 100%;">
          <div class="card-body">
            <h5 class="card-title">Tanggal Pelaksanaan</h5>
            <p class="date-range"><?= strftime('%d %B %Y', strtotime($pelaksanaan)); ?></p>
            <form method="POST" id="formPelaksanaan">
              <input type="hidden" name="pelaksanaan" value="1">
              <div class="row">
                <div class="col-12 mb-3">
                  <label for="pelaksanaan" class="form-label">Silahkan pilih tanggal</label>
                  <input type="datetime-local" class="form-control" id="pelaksanaan" name="pelaksanaan" value="<?= date('Y-m-d\TH:i', strtotime($pelaksanaan)); ?>" onchange="showButton('formPelaksanaan')">
                </div>
              </div>
              <div class="mt-3 text-center d-none" id="buttonPelaksanaan">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>
        </div>
        <!-- Akhir Card Tanggal Pelaksanaan -->
      </div>
    </div>

    <!-- Data Admin -->
    <div class="table-responsive mt-3 mb-5">
      <h2 class="text-center">Data Admin</h2>
      <table id="usersTable" class="table table-bordered table-hover table-striped">
        <thead class="table-dark">
          <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Username</th>
            <th>Role</th>
            <th>Akses</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          while ($user = $hasil->fetch_assoc()) : ?>
            <tr>
              <td><?= $no; ?></td>
              <td><?= $user['nama_lengkap']; ?></td>
              <td><?= $user['username']; ?></td>
              <td>
                <div class="form-check form-switch">
                  <input class="form-check-input admin-toggle" type="checkbox" role="switch" id="admin-<?= $user['id'] ?>" <?= $user['role'] == 'admin' ? 'checked' : '' ?> data-id="<?= $user['id'] ?>">
                </div>
              </td>
              <td>
                <div class="form-check form-switch">
                  <input class="form-check-input akses-toggle" type="checkbox" role="switch" id="akses-<?= $user['id'] ?>" <?= $user['akses'] ? 'checked' : '' ?> data-id="<?= $user['id'] ?>">
                </div>
              </td>
            </tr>
          <?php $no++;
          endwhile; ?>
        </tbody>
      </table>
    </div>
    <!-- Akhir Data Admin -->
  </div>

  <?php
  require_once 'footer.php';
  ?>