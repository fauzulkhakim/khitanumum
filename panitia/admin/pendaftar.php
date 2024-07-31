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
  <div class="col-ml text-center text-white my-2">
    <h3>Pendaftar Khitan Umum</h3>
    <h5>1446 H / 2024 TU</h5>
  </div>
</div>

<div class="container">
  <div class="row justify-content-center align-middle">
    <div class="col">
      <a href="pendaftar-tambah.php" class="btn btn-success my-4">+ Daftarkan</a>
      <div class="table-responsive mb-5">
        <table id="pendaftar" class="table table-striped table-bordered table-hover table-responsive" style="width:100%">
          <thead class="table-dark">
            <tr>
              <th class="text-center align-middle">No</th>
              <th class="text-center align-middle">Daftar</th>
              <th class="text-center align-middle">Peserta</th>
              <th class="text-center align-middle">Nama</th>
              <th class="text-center align-middle">Status</th>
              <th class="text-center align-middle">NIK</th>
              <th class="text-center align-middle">Mustahiq</th>
              <th class="text-center align-middle">Relasi</th>
              <th class="text-center align-middle">Ortu/Wali</th>
              <th class="text-center align-middle">Usia</th>
              <th class="text-center align-middle">Kab/Kota</th>
              <th class="text-center align-middle">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT p.*, r.name_regencies, s.nama_status_pendaftaran
                                FROM pendaftar p
                                LEFT JOIN regencies r ON p.domisili_regencies_id = r.id_regencies
                                LEFT JOIN status_pendaftaran s ON p.status_pendaftaran_id = s.id_status_pendaftaran";

            $result = $conn->query($sql);
            $no = 1;
            while ($pendaftaran = $result->fetch_assoc()) :
              $usia = date_diff(date_create($pendaftaran['tanggal_lahir']), date_create('now'))->format('%y');
            ?>
              <tr>
                <td class="text-center align-middle"><?= $no; ?></td>
                <td class="text-center align-middle"><?= $pendaftaran['is_admin'] == 1 ? 'Admin' : 'Umum'; ?></td>
                <td class="text-center align-middle"><?= $pendaftaran['status_pendaftaran_id'] == 2 ? 46 . sprintf('%04d', $pendaftaran['id']) : '' ?></td>
                <td class="align-middle"><?= $pendaftaran['nama_depan'] . ' ' . $pendaftaran['nama_belakang']; ?></td>
                <td class="text-center align-middle">
                  <select class="form-select status-dropdown" data-id="<?= $pendaftaran['id']; ?>">
                    <?php
                    $statusQuery = "SELECT * FROM status_pendaftaran";
                    $statusResult = $conn->query($statusQuery);
                    while ($status = $statusResult->fetch_assoc()) {
                      $selected = $status['id_status_pendaftaran'] == $pendaftaran['status_pendaftaran_id'] ? 'selected' : '';
                      echo "<option value='{$status['id_status_pendaftaran']}' {$selected}>{$status['nama_status_pendaftaran']}</option>";
                    }
                    ?>
                  </select>
                </td>
                <td class="text-center align-middle"><?= $pendaftaran['nik']; ?></td>
                <td class="text-center align-middle"><?= $pendaftaran['mustahiq'] === 1 ? 'Ya' : 'Tidak'; ?></td>
                <td class="align-middle"><?= $pendaftaran['relasi']; ?></td>
                <td class="align-middle"><?= $pendaftaran['orang_tua_wali']; ?></td>
                <td class="text-center align-middle"><?= $usia; ?></td>
                <td class="align-middle"><?= trim(str_ireplace('Kabupaten', '', $pendaftaran['name_regencies'])) ?></td>
                <td class="text-center align-middle d-flex">
                  <?php
                  // Mengubah nomor HP yang diawali dengan '0' menjadi '+62'
                  $no_hp = $pendaftaran['no_hp'];
                  if (substr($no_hp, 0, 1) === '0') {
                    $no_hp = '+62' . substr($no_hp, 1);
                  }
                  ?>
                  <!-- Dokumen -->
                  <button class="btn btn-sm btn-secondary m-1" data-toggle="modal" data-target="#imageModal" data-images='<?= json_encode([
                                                                                                                            ["label" => "Dokumen KIA/KK", "file" => "kia_kk/" . $pendaftaran["dokumen_kia_kk"]],
                                                                                                                            ["label" => "Dokumen Sekolah", "file" => "sekolah/" . $pendaftaran["dokumen_sekolah"]],
                                                                                                                            ["label" => "Dokumen Domisili", "file" => "domisili/" . $pendaftaran["dokumen_domisili"]],
                                                                                                                            ["label" => "Dokumen Pendukung", "file" => "pendukung/" . $pendaftaran["dokumen_pendukung"]]
                                                                                                                          ]); ?>'>
                    <i class="fa-solid fa-file"></i>
                  </button>
                  <!-- Whatsapp -->
                  <a href="https://wa.me/<?= $no_hp; ?>" class="btn btn-sm btn-success m-1" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                  </a>
                  <!-- Detail -->
                  <a href="pendaftar-info.php?id=<?= $pendaftaran['id']; ?>" class="btn btn-sm btn-primary m-1">
                    <i class="fas fa-info"></i>
                    </button>
                    <!-- Edit -->
                    <a href="pendaftar-edit.php?id=<?= $pendaftaran['id']; ?>" class="btn btn-sm btn-warning m-1">
                      <i class="fas fa-edit"></i>
                    </a>
                    <!-- Hapus -->
                    <a href="../config/pendaftar-delete.php?id=<?= $pendaftaran['id']; ?>" class="btn btn-sm btn-danger m-1" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                      <i class="fas fa-trash"></i>
                    </a>
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

<!-- Modal Gambar -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imageModalLabel">Gambar Dokumen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row" id="modalImages">
          <!-- Gambar akan dimuat di sini oleh JavaScript -->
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Informasi -->
<!-- <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="infoModalLabel">Informasi Pendaftar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="modalInfoContent">
          <!-- Informasi akan dimuat di sini oleh JavaScript -->
        </div>
      </div>
    </div>
  </div>
</div> -->

<?php
require_once 'footer.php';
?>