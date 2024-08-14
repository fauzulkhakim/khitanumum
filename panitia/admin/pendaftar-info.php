<?php
require '../config/config.php';

if (!check_login()) {
    header("Location: ../index.php");
    exit();
}

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

require_once 'header.php';
?>

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
        background: #929A94;
    }

    h3 {
        color: white;
        font-weight: bolder;
    }

    h6 {
        color: #F8F4E1;
    }
</style>

<div class="row justify-content-center">
    <div class="col-ml text-center text-white mt-4">
        <h3>Halaman Info Pendaftar Khitan Umum</h3>
    </div>
</div>

<div class="container">
    <div class="row pt-2 justify-content-center">
        <div class="col-md-10">
            <div class="card mb-5">
                <div class="card-body">
                    <div class="row mb">
                        <div class="col">

                            <!-- Button kembali -->
                            <a href="pendaftar.php" class="back-button my-2"><i class="fa-solid fa-left-long"></i> Kembali</a>
                            <!-- Akhir Button kembali -->

                            <div class="card my-2">
                                <div class="card-header fw-bold">
                                    Data Identitas Calon Peserta
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 pb-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="nik" name="nik" value="<?= htmlspecialchars($pendaftaran['nik']); ?>" readonly>
                                                <label for="nik">NIK</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 pb-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="no_kk" name="no_kk" value="<?= htmlspecialchars($pendaftaran['no_kk']); ?>" readonly>
                                                <label for="no_kk">Nomor KK</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 pb-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= htmlspecialchars($pendaftaran['nama_lengkap']); ?>" readonly>
                                                <label for="nama_lengkap">Nama Lengkap</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 pb-4">
                                            <div class="form-floating">
                                                <select class="form-select" id="tempat_lahir" name="tempat_lahir" disabled>
                                                    <option value="" disabled>Pilih</option>
                                                    <?php
                                                    $regencies = mysqli_query($conn, "SELECT * FROM regencies");
                                                    while ($row = mysqli_fetch_assoc($regencies)) {
                                                        $selected = ($row['id_regencies'] == $pendaftaran['tempat_lahir_regencies_id']) ? 'selected' : '';
                                                        echo "<option value='{$row['id_regencies']}' $selected>{$row['name_regencies']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                                <label for="tempat_lahir">Tempat Lahir</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 pb-4">
                                            <div class="form-floating">
                                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= htmlspecialchars($pendaftaran['tanggal_lahir']); ?>" readonly>
                                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <p class="text-start">Alamat sesuai dokumen yang berlaku</p>
                                        <div class="col-md-4 pb-4">
                                            <div class="form-floating">
                                                <select class="form-select" id="provinsi" name="provinsi" disabled>
                                                    <option value="" disabled>Pilih</option>
                                                    <?php
                                                    $provinces = mysqli_query($conn, "SELECT * FROM provinces");
                                                    while ($row = mysqli_fetch_assoc($provinces)) {
                                                        $selected = ($row['id_provinces'] == $pendaftaran['domisili_provinces_id']) ? 'selected' : '';
                                                        echo "<option value='{$row['id_provinces']}' $selected>{$row['name_provinces']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                                <label for="provinsi">Provinsi</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 pb-4">
                                            <div class="form-floating">
                                                <select class="form-select" id="kabupaten_kota" name="kabupaten_kota" disabled>
                                                    <option value="" disabled>Pilih</option>
                                                    <?php
                                                    $regencies = mysqli_query($conn, "SELECT * FROM regencies WHERE id_provinces = " . $pendaftaran['domisili_provinces_id']);
                                                    while ($row = mysqli_fetch_assoc($regencies)) {
                                                        $selected = ($row['id_regencies'] == $pendaftaran['domisili_regencies_id']) ? 'selected' : '';
                                                        echo "<option value='{$row['id_regencies']}' $selected>{$row['name_regencies']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                                <label for="kabupaten_kota">Kabupaten/Kota</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 pb-4">
                                            <div class="form-floating">
                                                <select class="form-select" id="kecamatan" name="kecamatan" disabled>
                                                    <option value="" disabled>Pilih</option>
                                                    <?php
                                                    $districts = mysqli_query($conn, "SELECT * FROM districts WHERE id_regencies = " . $pendaftaran['domisili_regencies_id']);
                                                    while ($row = mysqli_fetch_assoc($districts)) {
                                                        $selected = ($row['id_districts'] == $pendaftaran['domisili_districts_id']) ? 'selected' : '';
                                                        echo "<option value='{$row['id_districts']}' $selected>{$row['name_districts']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                                <label for="kecamatan">Kecamatan</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 pb-4">
                                            <div class="form-floating">
                                                <select class="form-select" id="desa_kelurahan" name="desa_kelurahan" disabled>
                                                    <option value="" disabled>Pilih</option>
                                                    <?php
                                                    $villages = mysqli_query($conn, "SELECT * FROM villages WHERE id_districts = " . $pendaftaran['domisili_districts_id']);
                                                    while ($row = mysqli_fetch_assoc($villages)) {
                                                        $selected = ($row['id_villages'] == $pendaftaran['domisili_villages_id']) ? 'selected' : '';
                                                        echo "<option value='{$row['id_villages']}' $selected>{$row['name_villages']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                                <label for="desa_kelurahan">Desa/Kelurahan</label>
                                            </div>
                                        </div>
                                        <?php
                                        $rt = mysqli_query($conn, "SELECT * FROM rt_rw");
                                        ?>
                                        <div class="col-md-4 pb-4">
                                            <div class="form-floating">
                                                <select class="form-select" id="rt" name="rt" disabled>
                                                    <option value="" disabled>Pilih</option>
                                                    <?php while ($row = mysqli_fetch_array($rt)) { ?>
                                                        <option value="<?= $row['id_rt_rw'] ?>" <?= $pendaftaran['rt_rt_rw_id'] == $row['id_rt_rw'] ? 'selected' : ''; ?>><?= $row['nama_rt_rw'] ?></option>
                                                    <?php } ?>
                                                </select>
                                                <label for="rt">RT</label>
                                            </div>
                                        </div>
                                        <?php
                                        $rw = mysqli_query($conn, "SELECT * FROM rt_rw");
                                        ?>
                                        <div class="col-md-4 pb-4">
                                            <div class="form-floating">
                                                <select class="form-select" id="rw" name="rw" disabled>
                                                    <option value="" disabled>Pilih</option>
                                                    <?php while ($row = mysqli_fetch_array($rw)) { ?>
                                                        <option value="<?= $row['id_rt_rw'] ?>" <?= $pendaftaran['rw_rt_rw_id'] == $row['id_rt_rw'] ? 'selected' : ''; ?>><?= $row['nama_rt_rw'] ?></option>
                                                    <?php } ?>
                                                </select>
                                                <label for="rw">RW</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8 pb-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="alamat_lengkap" name="alamat_lengkap" value="<?= htmlspecialchars($pendaftaran['alamat_lengkap']); ?>" readonly>
                                                <label for="alamat_lengkap">Alamat Lengkap</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 pb-4">
                                            <div id="domisili" class="form-text">Apakah domisili calon peserta sesuai dengan alamat?</div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="domisili" id="domisili_ya" value="1" <?= $pendaftaran['domisili'] == 1 ? 'checked' : ''; ?> disabled>
                                                <label class="form-check-label" for="domisili_ya">Ya</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="domisili" id="domisili_tidak" value="0" <?= $pendaftaran['domisili'] == 0 ? 'checked' : ''; ?> disabled>
                                                <label class="form-check-label" for="domisili_tidak">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 pb-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="berat_badan" name="berat_badan" value="<?= htmlspecialchars($pendaftaran['berat_badan']); ?>" readonly>
                                                <label for="berat_badan">Berat Badan</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 pb-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="tinggi_badan" name="tinggi_badan" value="<?= htmlspecialchars($pendaftaran['tinggi_badan']); ?>" readonly>
                                                <label for="tinggi_badan">Tinggi Badan</label>
                                            </div>
                                        </div>
                                        <?php
                                        $ukuran_baju = mysqli_query($conn, "SELECT * FROM ukuran_baju");
                                        ?>
                                        <div class="col-md-4 pb-4">
                                            <div class="form-floating">
                                                <select class="form-select" id="ukuran_baju" name="ukuran_baju" disabled>
                                                    <option value="" disabled>Pilih</option>
                                                    <?php while ($row = mysqli_fetch_array($ukuran_baju)) { ?>
                                                        <option value="<?= $row['id_ukuran_baju'] ?>" <?= $pendaftaran['ukuran_baju_id'] == $row['id_ukuran_baju'] ? 'selected' : ''; ?>><?= $row['nama_ukuran_baju'] ?></option>
                                                    <?php } ?>
                                                </select>
                                                <label for="ukuran_baju">Ukuran Baju</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card my-2">
                                <div class="card-header fw-bold">
                                    Data Sekolah
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 pb-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" value="<?= htmlspecialchars($pendaftaran['nama_sekolah']); ?>" readonly>
                                                <label for="nama_sekolah">Nama Sekolah</label>
                                            </div>
                                        </div>
                                        <?php
                                        $kelas = mysqli_query($conn, "SELECT * FROM kelas");
                                        ?>
                                        <div class="col-md-4 pb-4">
                                            <div class="form-floating">
                                                <select class="form-select" id="kelas" name="kelas" disabled>
                                                    <option value="" disabled>Pilih</option>
                                                    <?php while ($row = mysqli_fetch_array($kelas)) { ?>
                                                        <option value="<?= $row['id_kelas'] ?>" <?= $pendaftaran['kelas_id'] == $row['id_kelas'] ? 'selected' : ''; ?>><?= $row['nama_kelas'] ?></option>
                                                    <?php } ?>
                                                </select>
                                                <label for="kelas">Kelas</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 pb-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="alamat_sekolah" name="alamat_sekolah" value="<?= htmlspecialchars($pendaftaran['alamat_sekolah']); ?>" readonly>
                                                <label for="alamat_sekolah">Alamat Sekolah</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card my-2">
                                <div class="card-header fw-bold">
                                    Data Pendaftar
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8 pb-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="orang_tua_wali" name="orang_tua_wali" value="<?= htmlspecialchars($pendaftaran['orang_tua_wali']); ?>" readonly>
                                                <label for="orang_tua_wali">Nama Orang Tua/Wali</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 pb-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= htmlspecialchars($pendaftaran['no_hp']); ?>" readonly>
                                                <label for="no_hp">Nomor Handphone</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 pb-4">
                                            <div id="mustahiq" class="form-text">Mustahiq</div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="mustahiq" id="mustahiq_ya" value="1" <?= $pendaftaran['mustahiq'] == 1 ? 'checked' : ''; ?> disabled>
                                                <label class="form-check-label" for="mustahiq_ya">Ya</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="mustahiq" id="mustahiq_tidak" value="0" <?= $pendaftaran['mustahiq'] == 0 ? 'checked' : ''; ?> disabled>
                                                <label class="form-check-label" for="mustahiq_tidak">Tidak</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 pb-4">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="relasi" name="relasi" value="<?= htmlspecialchars($pendaftaran['relasi']); ?>" readonly>
                                                <label for="relasi">Relasi</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 pb-4">
                                            <div class="form-floating">
                                                <select class="form-select" id="status_pendaftaran_id" name="status_pendaftaran_id" disabled>
                                                    <option value="" disabled>Pilih</option>
                                                    <?php
                                                    $status_pendaftaran = mysqli_query($conn, "SELECT * FROM status_pendaftaran");
                                                    while ($row = mysqli_fetch_array($status_pendaftaran)) {
                                                        $selected = ($row['id_status_pendaftaran'] == $pendaftaran['status_pendaftaran_id']) ? 'selected' : '';
                                                        echo "<option value='{$row['id_status_pendaftaran']}' $selected>{$row['nama_status_pendaftaran']}</option>";
                                                    }
                                                    ?>
                                                </select>
                                                <label for="status_pendaftaran_id">Status Pendaftaran</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>