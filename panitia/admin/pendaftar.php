<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: index.php");
  exit();
}
require '../config/config.php';
require_once 'header.php';
?>

<div class="row justify-content-center bg-dark">
  <div class="col-ml text-center text-white my-3">
    <h3>Pendaftar Khitan Umum</h3>
    <h5>1446 H / 2024 TU</h5>
  </div>
</div>

<div class="container my-3 mb-5">
  <div class="row mt-3 justify-content-center align-middle">
    <div class="col">
      <a href="pendaftar-tambah.php" class="btn btn-success my-4">+ Daftarkan</a>
      <h3>Data Pendaftar</h3>
      <div class="table-responsive">
        <table id="pendaftar" class="table table-striped table-bordered table-hover" style="width:100%">
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
              <th class="text-center align-middle">WA</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT p.*, r.name_regencies
                                FROM pendaftar p
                                LEFT JOIN regencies r ON p.domisili_regencies_id = r.id_regencies";
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
                <td class="text-center align-middle"><?= $pendaftaran['name_regencies']; ?></td>
                <td class="text-center align-middle">
                  <a href="pendaftar-edit.php?id=<?= $pendaftaran['id']; ?>" class="btn btn-warning action-icon"><i class="fas fa-edit"></i></a>
                  <a href="../config/pendaftar-delete.php?id=<?= $pendaftaran['id']; ?>" class="btn btn-danger action-icon" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                </td>
                <td class="text-center align-middle">
                  <?php
                  // Mengubah nomor HP yang diawali dengan '0' menjadi '+62'
                  $no_hp = $pendaftaran['no_hp'];
                  if (substr($no_hp, 0, 1) === '0') {
                    $no_hp = '+62' . substr($no_hp, 1);
                  }
                  ?>
                  <a href="https://wa.me/<?= $no_hp; ?>" class="btn btn-success" target="_blank"><i class="fab fa-whatsapp"></i></a>
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

<?php
require_once 'footer.php';
?>