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
                                                        <input type="date" class="form-control" id="tanggal_lahir" value="<?= htmlspecialchars($pendaftaran['tanggal_lahir']); ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="alamat_lengkap" class="form-label fw-bold">Alamat Lengkap</label>
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
                                                        <input type="text" class="form-control" id="relasi" value="<?= htmlspecialchars($pendaftaran['relasi']); ?>" readonly>
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
                                    <div class="col-md-4">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<?php
require_once '../assets/layouts/footer.php';
?>