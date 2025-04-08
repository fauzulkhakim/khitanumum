<?php
require_once '../assets/layouts/header.php';
$id = $_GET['id'];
$sql = "SELECT
    p.*,
    pr.name_provinces,
    r.name_regencies,
    d.name_districts,
    v.name_villages,
    sp.nama_status_pendaftaran,
    ub.nama_ukuran_baju
FROM
    pendaftar p
JOIN provinces pr ON p.domisili_provinces_id = pr.id_provinces
JOIN regencies r ON p.domisili_regencies_id = r.id_regencies
JOIN districts d ON p.domisili_districts_id = d.id_districts
JOIN villages v ON p.domisili_villages_id = v.id_villages
JOIN status_pendaftaran sp ON p.status_pendaftaran_id = sp.id_status_pendaftaran
JOIN ukuran_baju ub ON p.ukuran_baju_id = ub.id_ukuran_baju
WHERE
    p.id = $id";
$result = $conn->query($sql);
$pendaftaran = $result->fetch_assoc();
?>

<div class="row justify-content-center">
    <div class="col-ml text-center text-white mt-4">
        <h3>Halaman Info Pendaftar Khitan Umum</h3>
    </div>
</div>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row pt-2 justify-content-center">
            <div class="col-md-10">
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="row mb">
                            <div class="col">

                                <!-- Button kembali -->
                                <a href="pendaftar.php" class="back-button my-2"><i class="fa-solid fa-left-long"></i> Kembali</a>
                                <!-- Akhir Button kembali -->

                                <div class="row">

                                    <!-- Kolom Kiri -->
                                    <div class="col-md-4">

                                        <!-- Status Pendaftar -->
                                        <div class="card my-2">
                                            <div class="card-header fw-bold">Status Pendaftaran</div>
                                            <div class="card-body">
                                                <form action="../config/update_status.php" method="POST">
                                                    <input type="hidden" name="id" value="<?= $pendaftaran['id']; ?>">
                                                    <div class="form-group">
                                                        <label for="status_pendaftaran">Update Status</label>
                                                        <select class="form-select" name="status" id="status_pendaftaran">
                                                            <?php
                                                            $statusQuery = "SELECT * FROM status_pendaftaran";
                                                            $statusResult = $conn->query($statusQuery);
                                                            while ($status = $statusResult->fetch_assoc()) {
                                                                $selected = $status['id_status_pendaftaran'] == $pendaftaran['status_pendaftaran_id'] ? 'selected' : '';
                                                                echo "<option value='{$status['id_status_pendaftaran']}' {$selected}>{$status['nama_status_pendaftaran']}</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="btn btn-secondary mt-2">Simpan</button>
                                                </form>
                                            </div>
                                        </div>

                                        <!-- Data Identitas Calon Peserta -->
                                        <div class="card my-2">
                                            <div class="card-header fw-bold">
                                                Data Identitas Calon Peserta
                                            </div>
                                            <div class="card-body">
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="nik" class="form-label fw-bold">NIK</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" id="nik" value="<?= htmlspecialchars($pendaftaran['nik']); ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="no_kk" class="form-label fw-bold">Nomor KK</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" id="no_kk" value="<?= htmlspecialchars($pendaftaran['no_kk']); ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="nama_lengkap" class="form-label fw-bold">Nama Lengkap</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" id="nama_lengkap" value="<?= htmlspecialchars($pendaftaran['nama_lengkap']); ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="tempat_lahir" class="form-label fw-bold">Tempat Lahir</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" id="tempat_lahir" value="<?= htmlspecialchars($pendaftaran['name_regencies']); ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="tanggal_lahir" class="form-label fw-bold">Tanggal Lahir</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" id="tanggal_lahir" value="<?= htmlspecialchars(date('d F Y', strtotime($pendaftaran['tanggal_lahir']))); ?>" readonly>
                                                    </div>
                                                </div>
                                                <!-- Alamat -->
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="alamat_lengkap" class="form-label fw-bold">Alamat</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <textarea class="form-control" id="alamat_lengkap" rows="2" readonly><?= htmlspecialchars($pendaftaran['name_regencies'] . ', ' . $pendaftaran['name_districts'] . ', ' . $pendaftaran['name_villages'] . ', RT ' . $pendaftaran['rt_rt_rw_id'] . '/RW ' . $pendaftaran['rw_rt_rw_id']); ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="alamat_lengkap" class="form-label fw-bold">Detail Alamat</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <textarea class="form-control" id="alamat_lengkap" rows="2" readonly><?= htmlspecialchars($pendaftaran['alamat_lengkap']); ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="domisili" class="form-label fw-bold">Domisili</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" id="domisili" value="<?= $pendaftaran['domisili'] == 1 ? 'Sesuai' : 'Tidak Sesuai'; ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Kolom Tengah -->
                                    <div class="col-md-4">

                                        <!-- WhatsApp -->
                                        <div class="card my-2">
                                            <div class="card-header fw-bold">WhatsApp</div>
                                            <div class="card-body">
                                                <?php
                                                $no_hp = $pendaftaran['no_hp'];
                                                if (substr($no_hp, 0, 1) === '0') {
                                                    $no_hp = '+62' . substr($no_hp, 1);
                                                }
                                                ?>
                                                <a href="https://wa.me/<?= $no_hp; ?>" class="btn btn-sm btn-success m-1" target="_blank" title="Kirim Pesan WhatsApp" onclick="return confirm('Apakah Anda yakin ingin mengirim pesan WhatsApp ke nomor ini?')">
                                                    <i class="fab fa-whatsapp"></i> WhatsApp
                                                </a>
                                                <button data-id="<?= $pendaftaran['id']; ?>" class="btn btn-sm btn-secondary m-1 buttonStatus" title="Kirim ulang status pendaftaran" onclick="return">
                                                    <i class="fa-solid fa-square-poll-horizontal"></i> Kirim Ulang Status
                                                </button>
                                                <?php if ($pendaftaran['status_pendaftaran_id'] == 2) : ?>
                                                    <button data-id="<?= $pendaftaran['id']; ?>" class="btn btn-sm btn-secondary m-1 buttonUndangan" title="Kirim ulang undangan" onclick="return">
                                                        <i class="fa-solid fa-file-arrow-down"></i> Kirim Ulang Undangan
                                                    </button>
                                                <?php endif; ?>
                                                <button class="btn btn-sm btn-secondary m-1" data-bs-toggle="modal" data-bs-target="#logModal" title="Lihat Log">
                                                    <i class="fa-solid fa-clock-rotate-left"></i> Log Pesan
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Modal for Log -->
                                        <div class="modal fade" id="logModal" tabindex="-1" aria-labelledby="logModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="logModalLabel">Log WhatsApp</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="table-responsive">
                                                            <table id="modal" class="table table-hover table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="align-middle">No</th>
                                                                        <th class="align-middle">Tanggal</th>
                                                                        <th class="align-middle">Waktu</th>
                                                                        <th class="align-middle">Pesan Terkirim ✅</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $logQuery = "SELECT * FROM log_wa WHERE pendaftar_id = {$pendaftaran['id']} ORDER BY created_at DESC";
                                                                    $logResult = $conn->query($logQuery);
                                                                    $no = 1;
                                                                    while ($log = $logResult->fetch_assoc()) {
                                                                        echo "<tr>
                                        <td>{$no}</td>
                                        <td>" . date('d-m-Y', strtotime($log['created_at'])) . "</td>
                                        <td>" . date('H:i:s', strtotime($log['created_at'])) . "</td>
                                        <td>{$log['pesan']}</td>
                                      </tr>";
                                                                        $no++;
                                                                    }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Data Sekolah -->
                                        <div class="card my-2">
                                            <div class="card-header fw-bold">
                                                Data Sekolah
                                            </div>
                                            <div class="card-body">
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="nama_sekolah" class="form-label fw-bold">Nama Sekolah</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" id="nama_sekolah" value="<?= htmlspecialchars($pendaftaran['nama_sekolah']); ?>" readonly>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="alamat_sekolah" class="form-label fw-bold">Alamat Sekolah</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <textarea class="form-control" id="alamat_sekolah" rows="2" readonly><?= htmlspecialchars($pendaftaran['alamat_sekolah']); ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="kelas" class="form-label fw-bold">Kelas</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" id="kelas" value="<?php
                                                                                                                    $kelas = mysqli_query($conn, "SELECT * FROM kelas");
                                                                                                                    while ($row = mysqli_fetch_array($kelas)) {
                                                                                                                        if ($pendaftaran['kelas_id'] == $row['id_kelas']) {
                                                                                                                            echo htmlspecialchars($row['nama_kelas']);
                                                                                                                            break;
                                                                                                                        }
                                                                                                                    }
                                                                                                                    ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Data Pendaftar -->
                                        <div class="card my-2">
                                            <div class="card-header fw-bold">
                                                Data Pendaftar
                                            </div>
                                            <div class="card-body">
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="orang_tua_wali" class="form-label fw-bold">Nama Orang Tua/Wali</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" id="orang_tua_wali" value="<?= htmlspecialchars($pendaftaran['orang_tua_wali']); ?>" readonly>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="no_hp" class="form-label fw-bold">Nomor Handphone</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" id="no_hp" value="<?= htmlspecialchars($pendaftaran['no_hp']); ?>" readonly>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="mustahiq" class="form-label fw-bold">Mustahiq</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" id="mustahiq" value="<?= $pendaftaran['mustahiq'] == 1 ? 'Ya' : 'Tidak'; ?>" readonly>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="relasi" class="form-label fw-bold">Relasi</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" id="relasi" value="<?= !empty($pendaftaran['relasi']) ? htmlspecialchars($pendaftaran['relasi']) : '-'; ?>" readonly>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="status_pendaftaran_id" class="form-label fw-bold">Status Pendaftaran</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" id="status_pendaftaran_id" value="<?php
                                                                                                                                    $status_pendaftaran = mysqli_query($conn, "SELECT * FROM status_pendaftaran");
                                                                                                                                    while ($row = mysqli_fetch_array($status_pendaftaran)) {
                                                                                                                                        if ($pendaftaran['status_pendaftaran_id'] == $row['id_status_pendaftaran']) {
                                                                                                                                            echo htmlspecialchars($row['nama_status_pendaftaran']);
                                                                                                                                            break;
                                                                                                                                        }
                                                                                                                                    }
                                                                                                                                    ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Kolom Kanan -->
                                    <div class="col-md-4">
                                        <!-- Data Dokumen -->
                                        <div class="card my-2">
                                            <div class="card-header fw-bold">Dokumen</div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md pb-3">
                                                        <p class="text-start">Dokumen harus jelas dan dapat dibaca untuk kebutuhan verifikasi. File berupa gambar dalam format jpg/jpeg.</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 pb-4">
                                                        <div id="dokumen_kia_kk" class="form-text">Dokumen KIA/KK</div>
                                                    </div>
                                                    <div class="col-md-8 pb-4 text-center">
                                                        <div id="preview_kia_kk">
                                                            <?php if (!empty($pendaftaran['dokumen_kia_kk'])) : ?>
                                                                <img src="../dokumen/kia_kk/<?= htmlspecialchars($pendaftaran['dokumen_kia_kk']); ?>" alt="Dokumen KIA/KK" class="rounded img-fluid" style="width: 30%;">
                                                            <?php else : ?>
                                                                <p>Dokumen KIA/KK tidak tersedia.</p>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 pb-4">
                                                        <div id="dokumen_sekolah" class="form-text">Dokumen Sekolah</div>
                                                    </div>
                                                    <div class="col-md-8 pb-4 text-center">
                                                        <div id="preview_sekolah">
                                                            <?php if (!empty($pendaftaran['dokumen_sekolah'])) : ?>
                                                                <img src="../dokumen/sekolah/<?= htmlspecialchars($pendaftaran['dokumen_sekolah']); ?>" alt="Dokumen Sekolah" class="rounded img-fluid" style="width: 30%;">
                                                            <?php else : ?>
                                                                <p>Dokumen Sekolah tidak tersedia.</p>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 pb-4">
                                                        <div id="dokumen_domisili" class="form-text">Dokumen Domisili</div>
                                                    </div>
                                                    <div class="col-md-8 pb-4 text-center">
                                                        <div id="preview_domisili">
                                                            <?php if (!empty($pendaftaran['dokumen_domisili'])) : ?>
                                                                <img src="../dokumen/domisili/<?= htmlspecialchars($pendaftaran['dokumen_domisili']); ?>" alt="Dokumen Domisili" class="rounded img-fluid" style="width: 30%;">
                                                            <?php else : ?>
                                                                <p>Dokumen Domisili tidak tersedia.</p>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 pb-4">
                                                        <div id="dokumen_pendukung" class="form-text">Dokumen Pendukung</div>
                                                    </div>
                                                    <div class="col-md-8 pb-4 text-center">
                                                        <div id="preview_pendukung">
                                                            <?php if (!empty($pendaftaran['dokumen_pendukung'])) : ?>
                                                                <img src="../dokumen/pendukung/<?= htmlspecialchars($pendaftaran['dokumen_pendukung']); ?>" alt="Dokumen Pendukung" class="rounded img-fluid" style="width: 30%;">
                                                            <?php else : ?>
                                                                <p>Dokumen Pendukung tidak tersedia.</p>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once '../assets/layouts/footer.php';
?>

<!-- script untuk menampilkan modal -->