<?php
require '../config/config.php';
session_start();

if (isset($_SESSION['username']) && isset($_SESSION['id'])) {
  // User is logged in
} else {
  // User is not logged in, redirect to login page
if (!isset($_SESSION['user'])) {
  header("Location: index.php");
  exit();
}
}

// Read the current values for dibuka and ditutup
include '../config/dates_config.php';

// Handle form submission to update dates
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $dibuka = $_POST['dibuka'];
  $ditutup = $_POST['ditutup'];

  // Write the new dates to the dates_config.php file
  $config_content = "<?php\n";
  $config_content .= "\$dibuka = \"$dibuka\";\n";
  $config_content .= "\$ditutup = \"$ditutup\";\n";
  $config_content .= "?>";

  file_put_contents('../config/dates_config.php', $config_content);
  echo "<script>alert('Tanggal pendaftaran telah diperbarui');</script>";
  // Refresh to load the new dates
  header("Refresh:0");
}

// Fetch all users
$sql = "SELECT * FROM users";
$hasil = $conn->query($sql);

require_once 'header.php';
?>

<!-- Header -->
<div class="row justify-content-center bg-dark">
  <div class="col-ml text-center text-white my-3">
    <h3>Pengaturan Khitan Umum</h3>
    <h5>1446 H / 2024 TU</h5>
  </div>
</div>
<!-- Akhir Header -->

<!-- Isi Halaman -->
<div class="container mt-5">
  <div class="row justify-content-center mb-5">
    <div class="col-12 col-md-4 mb-4 mb-md-0">
      <div class="card" style="width: 75%;">
        <img src="../assets/avatar-3.jpg" class="card-img-top" alt="user image">
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

    <div class="col-12 col-md-6">
      <div class="card" style="width: 100%;">
        <div class="card-body">
          <h5 class="card-title">Tanggal Pendaftaran</h5>
          <form method="POST">
            <div class="row">
              <div class="col-12 mb-3">
                <label for="dibuka" class="form-label">Dibuka</label>
                <input type="datetime-local" class="form-control" id="dibuka" name="dibuka" value="<?= date('Y-m-d\TH:i', strtotime($dibuka)); ?>">
              </div>
              <div class="col-12 mb-3">
                <label for="ditutup" class="form-label">Ditutup</label>
                <input type="datetime-local" class="form-control" id="ditutup" name="ditutup" value="<?= date('Y-m-d\TH:i', strtotime($ditutup)); ?>">
              </div>
            </div>
            <div class="mt-3 text-center">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="table-responsive mb-5">
    <h3 class="text-center">Data Admin</h3>
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
</div>

<?php
require_once 'footer.php';
?>