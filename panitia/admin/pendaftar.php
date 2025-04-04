<?php

require_once '../assets/layouts/header.php';
?>

<div class="row justify-content-center">
  <div class="col-ml text-center mt-3">
    <h3>Pendaftar Khitan Umum</h3>
    <h5>1446 H / 2024 TU</h5>
  </div>
</div>

<!-- tambahkan agar saat sidebar dibuka, halaman responsif mengikuti, tidak tertutup -->
<div class="content-wrapper">
  <div class="container-fluid">
    <div class="row pt-2 justify-content-center">
      <div class="col-md-10">
        <!-- bungkus ke dalam card -->
        <div class="card mb-5">
          <div class="card-body">
            <div class="row mb">
              <div class="col">
                <a href="pendaftar-tambah.php" class="btn btn-success mb-4">+ Daftarkan</a>

                <div class="mb-3">
                  <table id="pendaftar" class="table table-bordered table-hover table-responsive" style="width:100%">
                    <thead class="table-dark">
                      <tr>
                        <th class="text-center align-middle">No</th>
                        <th class="text-center align-middle">Nomor Peserta</th>
                        <th class="text-center align-middle">Nama</th>
                        <th class="text-center align-middle">NIK</th>
                        <th class="text-center align-middle">No KK</th>
                        <th class="text-center align-middle">No HP</th>
                        <th class="text-center align-middle">Kab/Kota</th>
                        <th class="text-center align-middle">Relasi</th>
                        <th class="text-center align-middle">Diubah oleh</th>
                        <th class="text-center align-middle" style="min-width: 150px">Status Pendaftaran</th>
                        <th class="text-center align-middle" style="min-width: 150px">Document & Resend</th>
                        <th class="text-center align-middle" style="min-width: 100px">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sql = "SELECT p.*, r.name_regencies, s.nama_status_pendaftaran
        FROM pendaftar p
        LEFT JOIN regencies r ON p.domisili_regencies_id = r.id_regencies
        LEFT JOIN status_pendaftaran s ON p.status_pendaftaran_id = s.id_status_pendaftaran
        WHERE p.deleted_at IS NULL";

                      $result = $conn->query($sql);
                      $no = 1;
                      $nicks = []; // Array untuk menyimpan NIK, No KK, dan No HP untuk cek duplikat

                      while ($pendaftaran = $result->fetch_assoc()) :
                        // Tentukan kelas warna berdasarkan status pendaftaran
                        $statusClass = '';
                        if ($pendaftaran['status_pendaftaran_id'] == 2) {
                          $statusClass = 'table-success'; // Hijau untuk "Diterima"
                        } elseif ($pendaftaran['status_pendaftaran_id'] == 4) {
                          $statusClass = 'table-warning'; // Kuning untuk "Pending"
                        } elseif ($pendaftaran['status_pendaftaran_id'] == 3) {
                          $statusClass = 'table-danger'; // Merah untuk "Ditolak"
                        }

                        // Cek duplikasi NIK, No KK, No HP
                        $highlight_nik = in_array($pendaftaran['nik'], $nicks) ? 'table-danger' : '';
                        $highlight_kk = in_array($pendaftaran['no_kk'], $nicks) ? 'table-danger' : '';
                        $highlight_hp = in_array($pendaftaran['no_hp'], $nicks) ? 'table-danger' : '';

                        // Simpan NIK, No KK, No HP dalam array untuk perbandingan berikutnya
                        $nicks[] = $pendaftaran['nik'];
                        $nicks[] = $pendaftaran['no_kk'];
                        $nicks[] = $pendaftaran['no_hp'];
                      ?>
                        <tr>
                          <td class="text-center align-middle"><?= $no; ?></td>
                          <td class="text-center align-middle"><?= $pendaftaran['no_peserta']; ?></td>
                          <td class="align-middle"><?= $pendaftaran['nama_lengkap']; ?></td>
                          <td class="text-center align-middle <?= $highlight_nik; ?>"><?= $pendaftaran['nik']; ?></td>
                          <td class="text-center align-middle <?= $highlight_kk; ?>"><?= $pendaftaran['no_kk']; ?></td>
                          <td class="text-center align-middle <?= $highlight_hp; ?>"><?= $pendaftaran['no_hp']; ?></td>
                          <td class="align-middle"><?= trim(str_ireplace('Kabupaten', '', $pendaftaran['name_regencies'])); ?></td>
                          <td class="align-middle"><?= $pendaftaran['relasi']; ?></td>
                          <td class="align-middle"><?= $pendaftaran['updated_by']; ?></td>
                          <td class="text-center align-middle <?= $statusClass; ?>">
                            <select class="form-select status-dropdown" data-id="<?= $pendaftaran['id']; ?>" style="width: 180px;" <?= ($pendaftaran['status_pendaftaran_id'] == 2) ? 'disabled' : ''; ?>>
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
                          <?php
                          $no_hp = $pendaftaran['no_hp'];
                          if (substr($no_hp, 0, 1) === '0') {
                            $no_hp = '+62' . substr($no_hp, 1);
                          }
                          ?>
                          <td class="text-center align-middle">
                            <button class="btn btn-sm btn-secondary m-1" data-toggle="modal" data-target="#imageModal" data-images='<?= json_encode([
                                                                                                                                      ["label" => "Dokumen KIA/KK", "file" => "kia_kk/" . $pendaftaran["dokumen_kia_kk"]],
                                                                                                                                      ["label" => "Dokumen Sekolah", "file" => "sekolah/" . $pendaftaran["dokumen_sekolah"]],
                                                                                                                                      ["label" => "Dokumen Domisili", "file" => "domisili/" . $pendaftaran["dokumen_domisili"]],
                                                                                                                                      ["label" => "Dokumen Pendukung", "file" => "pendukung/" . $pendaftaran["dokumen_pendukung"]]
                                                                                                                                    ]); ?>' title="Lihat dokumen">
                              <i class="fa-solid fa-file"></i>
                            </button>
                            <a href="https://wa.me/<?= $no_hp; ?>" class="btn btn-sm btn-success m-1" target="_blank" title="Kirim Pesan WhatsApp" onclick="return confirm('Apakah Anda yakin ingin mengirim pesan WhatsApp ke nomor ini?')">
                              <i class="fab fa-whatsapp"></i>
                            </a>
                            <button data-id="<?= $pendaftaran['id']; ?>" class="btn btn-sm btn-secondary m-1 buttonStatus" title="Kirim ulang status pendaftaran" onclick="return confirm('Apakah Anda yakin ingin mengirim ulang status pendaftaran?')">
                              <i class="fa-solid fa-square-poll-horizontal"></i>
                            </button>
                            <?php if ($pendaftaran['status_pendaftaran_id'] == 2) : ?>
                              <button data-id="<?= $pendaftaran['id']; ?>" class="btn btn-sm btn-secondary m-1 buttonUndangan" title="Kirim ulang undangan" onclick="return confirm('Apakah Anda yakin ingin mengirim ulang undangan?')">
                                <i class="fa-solid fa-file-arrow-down"></i>
                              </button>
                            <?php endif; ?>
                          </td>
                          <td class="text-center align-middle">
                            <a href="pendaftar-info.php?id=<?= $pendaftaran['id']; ?>" class="btn btn-sm btn-primary m-1" title="Detail data">
                              <i class="fas fa-info"></i>
                            </a>
                            <a href="pendaftar-edit.php?id=<?= $pendaftaran['id']; ?>" class="btn btn-sm btn-warning m-1" title="Edit data">
                              <i class="fas fa-edit"></i>
                            </a>
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
        </div>
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

<?php
require_once '../assets/layouts/footer.php';
?>