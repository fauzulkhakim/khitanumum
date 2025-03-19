<?php
require_once '../assets/layouts/header.php';
global $conn;

// Ambil data enum dari kolom role
$query = "SHOW COLUMNS FROM users LIKE 'role'";
$result = $conn->query($query);
$row = $result->fetch_assoc();
preg_match("/^enum\(\'(.*)\'\)$/", $row['Type'], $matches);
$enum_values = explode("','", $matches[1]);

// Menangani pengiriman formulir untuk memperbarui tanggal
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['pendaftaran'])) {
    if (isset($_POST['dibuka']) && isset($_POST['ditutup'])) {
      $dibuka = date('Y-m-d H:i:s', strtotime($_POST['dibuka']));
      $ditutup = date('Y-m-d H:i:s', strtotime($_POST['ditutup']));

      // Menulis tanggal baru ke file dates_config.php
      $config_content = "<?php\n";
      $config_content .= "\$dibuka = \"$dibuka\";\n";
      $config_content .= "\$ditutup = \"$ditutup\";\n";
      $config_content .= "\$pelaksanaan = \"$pelaksanaan\";\n"; // Pastikan ini tetap ada
      $config_content .= "?>";

      file_put_contents('../config/dates_config.php', $config_content);
      echo "<script>alert('Tanggal pendaftaran telah diperbarui');</script>";
      // Muat ulang untuk memuat tanggal baru
      header("Location: " . $_SERVER['PHP_SELF']);
      exit();
    }
  } elseif (isset($_POST['pelaksanaan'])) {
    if (isset($_POST['pelaksanaan'])) {
      $pelaksanaan = date('Y-m-d H:i:s', strtotime($_POST['pelaksanaan']));

      // Menulis tanggal pelaksanaan baru ke file dates_config.php
      $config_content = "<?php\n";
      $config_content .= "\$dibuka = \"$dibuka\";\n"; // Pastikan ini tetap ada
      $config_content .= "\$ditutup = \"$ditutup\";\n"; // Pastikan ini tetap ada
      $config_content .= "\$pelaksanaan = \"$pelaksanaan\";\n";

      file_put_contents('../config/dates_config.php', $config_content);
      echo "<script>alert('Tanggal pelaksanaan telah diperbarui');</script>";
      // Muat ulang untuk memuat tanggal baru
      header("Location: " . $_SERVER['PHP_SELF']);
      exit();
    }
  }
}

// Mengambil semua pengguna
$sql = "SELECT * FROM users";
$hasil = $conn->query($sql);

setlocale(LC_TIME, 'id_ID.UTF-8'); // Mengatur locale ke bahasa Indonesia
?>

<!-- Header -->
<div class="row justify-content-center">
  <div class="col-ml text-center my-3">
    <h3>Pengaturan</h3>
    <h5>Khitan Umum 1447 H / 2025 TU</h5>
  </div>
</div>
<!-- Akhir Header -->

<div class="container">
  <!-- Isi Halaman -->
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-md-6 mb-3">
        <!-- Card Tanggal Pendaftaran -->
        <div class="card" style="width: 100%;">
          <div class="card-body">
            <p class="card-title">Tanggal Pendaftaran</p><br><br>
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
            <p class="card-title">Tanggal Pelaksanaan</p><br><br>
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
                <select name="role" class="form-select role-dropdown" data-id="<?= $user['id'] ?>">
                  <?php foreach ($enum_values as $value) : ?>
                    <option value="<?= $value ?>" <?= $user['role'] == $value ? 'selected' : '' ?>><?= ucfirst($value) ?></option>
                  <?php endforeach; ?>
                </select>
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
  require_once '../assets/layouts/footer.php';
  ?>