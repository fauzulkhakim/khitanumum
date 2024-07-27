<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: index.php");
  exit();
}
require '../config/config.php';
require_once 'header.php';
?>

<div class="row justify-content-center">
  <div class="col-ml text-center">
    <h5>Pendaftar Khitan Umum <br> 1446 H / 2024 TU</h5>
  </div>
</div>

<div class="container my-5">
  <div class="row mt-3 justify-content-center align-middle">
    <div class="col">
      <a href="pendaftar-tambah.php" class="btn btn-success my-4">Daftarkan</a>
      <div class="table-responsive">
        <table id="pendaftar" class="table table-striped table-bordered" style="width:100%">
          <thead class="table-dark">
            <tr>
              <th class="text-center align-middle">No</th>
              <th class="text-center align-middle">ID</th>
              <th class="text-center align-middle">Daftar</th>
              <th class="text-center align-middle">No Peserta</th>
              <th class="text-center align-middle">Nama Lengkap</th>
              <th class="text-center align-middle">Status</th>
              <th class="text-center align-middle">NIK</th>
              <th class="text-center align-middle">Mustahiq</th>
              <th class="text-center align-middle">Relasi</th>
              <th class="text-center align-middle">Orang Tua/Wali</th>
              <th class="text-center align-middle">Usia</th>
              <th class="text-center align-middle">Kabupaten/Kota</th>
              <th class="text-center align-middle">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT * FROM pendaftar";
            $result = $conn->query($sql);
            $no = 1;
            while ($pendaftaran = $result->fetch_assoc()) :
            ?>
              <tr>
                <td class="text-center align-middle"><?= $no; ?></td>
                <td class="text-center align-middle"><?= $pendaftaran['id']; ?></td>
                <td class="text-center align-middle"><?= $pendaftaran['is_admin']; ?></td>
                <td class="text-center align-middle"><?= $pendaftaran['id']; ?></td>
                <td class="text-center align-middle"><?= $pendaftaran['nama_depan'] . ' ' . $pendaftaran['nama_belakang']; ?></td>
                <td class="text-center align-middle"><?= $pendaftaran['status_pendaftaran_id']; ?></td>
                <td class="text-center align-middle"><?= $pendaftaran['nik']; ?></td>
                <td class="text-center align-middle"><?= $pendaftaran['mustahiq']; ?></td>
                <td class="text-center align-middle"><?= $pendaftaran['relasi']; ?></td>
                <td class="text-center align-middle"><?= $pendaftaran['orang_tua_wali']; ?></td>
                <?php
                $usia = date_diff(date_create($pendaftaran['tanggal_lahir']), date_create('now'))->format('%y');
                ?>
                <td class="text-center align-middle"><?= $usia; ?></td>
                <td class="text-center align-middle"><?= $pendaftaran['alamat_lengkap']; ?></td>
                <td class="text-center align-middle">
                  <!-- Aksi untuk mengedit atau menghapus data -->
                  <a href="pendaftar-edit.php?id=<?= $pendaftaran['id']; ?>" class="btn btn-warning">Edit</a>
                  <a href="pendaftar-delete.php?id=<?= $pendaftaran['id']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                </td>
              </tr>
            <?php
              $no++;
            endwhile;
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    $('#pendaftar').DataTable();
  });
</script>

<?php
require_once 'footer.php';
?>