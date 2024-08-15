<?php
require '../config/config.php';

if (!check_login()) {
    header("Location: ../index.php");
    exit();
}

// Pastikan name_created diambil dari sesi
if (isset($_SESSION['user']['nama_lengkap'])) {
    $logged_in_user = $_SESSION['user']['nama_lengkap'];
} else {
    $logged_in_user = 'Unknown';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $updated = $logged_in_user;
    $id = $_POST['id'];
    $nama_lengkap = strtoupper($_POST['nama_lengkap']);
    $nik = $_POST['nik'];
    $no_kk = $_POST['no_kk'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $provinsi = $_POST['provinsi'];
    $kabupaten_kota = $_POST['kabupaten_kota'];
    $kecamatan = $_POST['kecamatan'];
    $desa_kelurahan = $_POST['desa_kelurahan'];
    $rt = $_POST['rt'];
    $rw = $_POST['rw'];
    $alamat_lengkap = strtoupper($_POST['alamat_lengkap']);
    $domisili = $_POST['domisili'];
    $berat_badan = $_POST['berat_badan'];
    $tinggi_badan = $_POST['tinggi_badan'];
    $ukuran_baju = $_POST['ukuran_baju'];
    $nama_sekolah = strtoupper($_POST['nama_sekolah']);
    $kelas = $_POST['kelas'];
    $alamat_sekolah = strtoupper($_POST['alamat_sekolah']);
    $orang_tua_wali = strtoupper($_POST['orang_tua_wali']);
    $no_hp = $_POST['no_hp'];
    $mustahiq = $_POST['mustahiq'];
    $relasi = strtoupper($_POST['relasi']);
    $status_pendaftaran_id = $_POST['status_pendaftaran_id'];

    // Dokumen KIA/KK
    $dokumen_kia_kk = isset($_FILES['dokumen_kia_kk']) && $_FILES['dokumen_kia_kk']['error'] == 0 ? uploadImage($_FILES['dokumen_kia_kk'], $nik, 'kia_kk') : $pendaftaran['dokumen_kia_kk'];
    // Dokumen Sekolah
    $dokumen_sekolah = isset($_FILES['dokumen_sekolah']) && $_FILES['dokumen_sekolah']['error'] == 0 ? uploadImage($_FILES['dokumen_sekolah'], $nik, 'sekolah') : $pendaftaran['dokumen_sekolah'];
    // Dokumen Domisili
    $dokumen_domisili = isset($_FILES['dokumen_domisili']) && $_FILES['dokumen_domisili']['error'] == 0 ? uploadImage($_FILES['dokumen_domisili'], $nik, 'domisili') : $pendaftaran['dokumen_domisili'];
    // Dokumen Pendukung
    $dokumen_pendukung = isset($_FILES['dokumen_pendukung']) && $_FILES['dokumen_pendukung']['error'] == 0 ? uploadImage($_FILES['dokumen_pendukung'], $nik, 'pendukung') : $pendaftaran['dokumen_pendukung'];

    $sql = "UPDATE pendaftar SET
        nama_lengkap = '$nama_lengkap',
        updated = '$updated',
        nik = '$nik',
        no_kk = '$no_kk',
        tempat_lahir_regencies_id = '$tempat_lahir',
        tanggal_lahir = '$tanggal_lahir',
        domisili_provinces_id = '$provinsi',
        domisili_regencies_id = '$kabupaten_kota',
        domisili_districts_id = '$kecamatan',
        domisili_villages_id = '$desa_kelurahan',
        rt_rt_rw_id = '$rt',
        rw_rt_rw_id = '$rw',
        alamat_lengkap = '$alamat_lengkap',
        domisili = '$domisili',
        berat_badan = '$berat_badan',
        tinggi_badan = '$tinggi_badan',
        ukuran_baju_id = '$ukuran_baju',
        nama_sekolah = '$nama_sekolah',
        kelas_id = '$kelas',
        alamat_sekolah = '$alamat_sekolah',
        orang_tua_wali = '$orang_tua_wali',
        no_hp = '$no_hp',
        mustahiq = '$mustahiq',
        relasi = '$relasi',
        status_pendaftaran_id = '$status_pendaftaran_id',
        dokumen_kia_kk = '$dokumen_kia_kk',
        dokumen_sekolah = '$dokumen_sekolah',
        dokumen_domisili = '$dokumen_domisili',
        dokumen_pendukung = '$dokumen_pendukung'
        WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: pendaftar.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT
        p.*,
        tl.name_regencies,
        pr.name_provinces,
        r.name_regencies,
        d.name_districts,
        v.name_villages,
        sp.nama_status_pendaftaran,
        ub.nama_ukuran_baju
        FROM
        pendaftar p
        JOIN regencies tl ON p.domisili_regencies_id = tl.id_regencies
        JOIN provinces pr ON p.domisili_provinces_id = pr.id_provinces
        JOIN regencies r ON p.domisili_regencies_id = r.id_regencies
        JOIN districts d ON p.domisili_districts_id = d.id_districts
        JOIN villages v ON p.domisili_villages_id = v.id_villages
        JOIN status_pendaftaran sp ON p.status_pendaftaran_id = sp.id_status_pendaftaran
        JOIN ukuran_baju ub ON p.ukuran_baju_id = ub.id_ukuran_baju
        WHERE p.id = $id";
    $result = $conn->query($sql);
    $pendaftaran = $result->fetch_assoc();
}

function uploadImage($file, $nik, $dir)
{
    $file_name = $file['name'];
    $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
    $new_file_name = rand(000, 999) . '_' . $nik . '.' . $file_extension;
    $file_tmp = $file['tmp_name'];
    $targetDir = '../dokumen/' . $dir . '/';
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    $targetFile = $targetDir . $new_file_name;
    if (move_uploaded_file($file_tmp, $targetFile)) {
        return $new_file_name;
    } else {
        return null; // Handle error appropriately
    }
}

require_once 'header.php';
?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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

    /* Pastikan select2 memiliki tampilan yang konsisten dengan elemen Bootstrap lainnya */
    .select2-container--default .select2-selection--single {
        height: calc(3.5rem + 2px);
        /* Samakan dengan tinggi form-control */
        padding: 0.75rem 1rem;
        /* Samakan padding dengan form-control */
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        box-shadow: inset 0 0.075rem 0.1rem rgba(0, 0, 0, 0.075);
    }

    /* Untuk mengatur padding dalam elemen select2 agar teks berada di tengah */
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        padding-left: 0.75rem;
        /* Padding kiri */
        padding-right: 0.75rem;
        /* Padding kanan */
        padding-top: calc((3.5rem - 1.5rem) / 2);
        /* Padding atas, sesuaikan sesuai tinggi elemen */
        padding-bottom: calc((3.5rem - 1.5rem) / 2);
        /* Padding bawah, sesuaikan sesuai tinggi elemen */
        line-height: 1.5rem;
        /* Sesuaikan line-height agar seimbang */
        color: #495057;
        /* Warna teks */
    }


    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: calc(3.5rem + 2px);
        /* Samakan dengan tinggi select2 */
        top: 50%;
        transform: translateY(-50%);
        right: 10px;
    }
</style>

<div class="row justify-content-center">
    <div class="col-ml text-center text-white mt-4">
        <h3>Halaman Edit Pendaftar Khitan Umum</h3>
    </div>
</div>

<div class="container">
    <div class="row pt-2 justify-content-center">
        <div class="col-md-10">
            <form action="pendaftar-edit.php" method="POST" enctype="multipart/form-data" id="form-pendaftaran" class="needs-validation" novalidate>
                <input type="hidden" name="id" value="<?= $pendaftaran['id']; ?>">
                <!-- Awal Card Konten -->
                <div class="card mb-5">
                    <div class="card-body">
                        <!-- Awal Card Data -->
                        <div class="row mb">
                            <div class="col">
                                <!-- Button kembali -->
                                <a href="pendaftar.php" class="back-button my-2"><i class="fa-solid fa-left-long"></i> Kembali</a>
                                <!-- Akhir Button kembali -->

                                <!-- Awal Card Identitas -->
                                <div class="card my-2">
                                    <div class="card-header fw-bold">Data Identitas Calon Peserta</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 pb-4">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="nik" name="nik" value="<?= htmlspecialchars($pendaftaran['nik']); ?>" pattern="[0-9]{16}" required>
                                                    <label for="nik">NIK</label>
                                                    <div id="nik" class="form-text">Dapat dilihat pada KIA/KK</div>
                                                    <div class="invalid-feedback"><small>NIK harus diisi dengan 16 digit</small></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 pb-4">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="no_kk" name="no_kk" value="<?php echo htmlspecialchars($pendaftaran['no_kk']); ?>" required>
                                                    <label for="no_kk">Nomor KK</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4 pb-4">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="updated" name="updated" value="<?php echo htmlspecialchars($logged_in_user); ?>" readonly>
                                                    <label for="updated">Nama Admin</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 pb-4">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= htmlspecialchars($pendaftaran['nama_lengkap']); ?>" required>
                                                    <label for="nama_lengkap">Nama Lengkap</label>
                                                    <div class="invalid-feedback"><small>Nama Lengkap harus diisi</small></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 pb-4">
                                                <div class="form-floating">
                                                    <select class="form-select" id="tempat_lahir" name="tempat_lahir" required>
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
                                                    <div class="invalid-feedback"><small>Tempat lahir harus diisi</small></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 pb-4">
                                                <div class="form-floating">
                                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= htmlspecialchars($pendaftaran['tanggal_lahir']); ?>" required>
                                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                                    <div id="tanggal_lahir" class="form-text">Rentang usia 7 - 15 tahun</div>
                                                    <div class="invalid-feedback"><small>Tanggal lahir harus diisi dengan rentang tanggal yang tersedia</small></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <p class="text-start">Alamat sesuai dokumen yang berlaku</p>
                                            <div class="col-md-4 pb-4">
                                                <div class="form-floating">
                                                    <select class="form-select" id="provinsi" name="provinsi" onchange="fetchKabupaten()" required>
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
                                                    <div class="invalid-feedback"><small>Provinsi harus diisi</small></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 pb-4">
                                                <div class="form-floating">
                                                    <select class="form-select" id="kabupaten_kota" name="kabupaten_kota" onchange="fetchKecamatan()" required>
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
                                                    <div class="invalid-feedback"><small>Kabupaten/Kota harus diisi</small></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 pb-4">
                                                <div class="form-floating">
                                                    <select class="form-select" id="kecamatan" name="kecamatan" onchange="fetchDesa()" required>
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
                                                    <div class="invalid-feedback"><small>Kecamatan harus diisi</small></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 pb-4">
                                                <div class="form-floating">
                                                    <select class="form-select" id="desa_kelurahan" name="desa_kelurahan" required>
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
                                                    <div class="invalid-feedback"><small>Desa/Kelurahan harus diisi</small></div>
                                                </div>
                                            </div>
                                            <?php
                                            $rt = mysqli_query($conn, "SELECT * FROM rt_rw");
                                            ?>
                                            <div class="col-md-4 pb-4">
                                                <div class="form-floating">
                                                    <select class="form-select" id="rt" name="rt" required>
                                                        <option value="" disabled selected>Pilih</option>
                                                        <?php while ($row = mysqli_fetch_array($rt)) { ?>
                                                            <option value="<?= $row['id_rt_rw'] ?>" <?= $pendaftaran['rt_rt_rw_id'] == $row['id_rt_rw'] ? 'selected' : ''; ?>><?= $row['nama_rt_rw'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <label for="rt">RT</label>
                                                    <div class="invalid-feedback"><small>RT harus diisi</small></div>
                                                </div>
                                            </div>
                                            <?php
                                            $rw = mysqli_query($conn, "SELECT * FROM rt_rw");
                                            ?>
                                            <div class="col-md-4 pb-4">
                                                <div class="form-floating">
                                                    <select class="form-select" id="rw" name="rw" required>
                                                        <option value="" disabled selected>Pilih</option>
                                                        <?php while ($row = mysqli_fetch_array($rw)) { ?>
                                                            <option value="<?= $row['id_rt_rw'] ?>" <?= $pendaftaran['rw_rt_rw_id'] == $row['id_rt_rw'] ? 'selected' : ''; ?>><?= $row['nama_rt_rw'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <label for="rw">RW</label>
                                                    <div class="invalid-feedback"><small>RW harus diisi</small></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8 pb-4">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="alamat_lengkap" name="alamat_lengkap" value="<?= htmlspecialchars($pendaftaran['alamat_lengkap']); ?>" required>
                                                    <label for="alamat_lengkap">Alamat Lengkap</label>
                                                    <div id="alamat_lengkap" class="form-text">Berisi jalan, gang, nomor rumah, dukuh atau lainnya</div>
                                                    <div class="invalid-feedback"><small>Alamat harus diisi</small></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 pb-4">
                                                <div id="domisili" class="form-text">Apakah domisili calon peserta sesuai dengan alamat?</div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="domisili" id="domisili_ya" value="1" <?= $pendaftaran['domisili'] == 1 ? 'checked' : ''; ?> required>
                                                    <label class="form-check-label" for="domisili_ya">Ya</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="domisili" id="domisili_tidak" value="0" <?= $pendaftaran['domisili'] == 0 ? 'checked' : ''; ?> required>
                                                    <label class="form-check-label" for="domisili_tidak">Tidak</label>
                                                    <div class="invalid-feedback"><small>Domisili harus diisi</small></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 pb-4">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="berat_badan" name="berat_badan" value="<?= htmlspecialchars($pendaftaran['berat_badan']); ?>" pattern="\d{1,3}" required>
                                                    <label for="berat_badan">Berat Badan</label>
                                                    <div id="berat_badan" class="form-text">Dalam satuan kg</div>
                                                    <div class="invalid-feedback"><small>Berat badan harus diisi dengan angka</small></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 pb-4">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="tinggi_badan" name="tinggi_badan" value="<?= htmlspecialchars($pendaftaran['tinggi_badan']); ?>" pattern="\d{1,3}" required>
                                                    <label for="tinggi_badan">Tinggi Badan</label>
                                                    <div id="tinggi_badan" class="form-text">Dalam satuan cm</div>
                                                    <div class="invalid-feedback"><small>Tinggi badan harus diisi dengan angka</small></div>
                                                </div>
                                            </div>
                                            <?php
                                            $ukuran_baju = mysqli_query($conn, "SELECT * FROM ukuran_baju");
                                            ?>
                                            <div class="col-md-4 pb-4">
                                                <div class="form-floating">
                                                    <select class="form-select" id="ukuran_baju" name="ukuran_baju" required>
                                                        <option value="" disabled selected>Pilih</option>
                                                        <?php while ($row = mysqli_fetch_array($ukuran_baju)) { ?>
                                                            <option value="<?= $row['id_ukuran_baju'] ?>" <?= $pendaftaran['ukuran_baju_id'] == $row['id_ukuran_baju'] ? 'selected' : ''; ?>><?= $row['nama_ukuran_baju'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <label for="ukuran_baju">Ukuran Baju</label>
                                                    <div class="invalid-feedback"><small>Ukuran baju harus diisi</small></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Akhir Card Identitas -->

                                <!-- Awal Card Sekolah -->
                                <div class="card my-2">
                                    <div class="card-header fw-bold">Data Sekolah</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 pb-4">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" value="<?= htmlspecialchars($pendaftaran['nama_sekolah']); ?>" required>
                                                    <label for="nama_sekolah">Nama Sekolah</label>
                                                    <div class="invalid-feedback"><small>Nama sekolah harus diisi</small></div>
                                                </div>
                                            </div>
                                            <?php
                                            $kelas = mysqli_query($conn, "SELECT * FROM kelas");
                                            ?>
                                            <div class="col-md-4 pb-4">
                                                <div class="form-floating">
                                                    <select class="form-select" id="kelas" name="kelas" required>
                                                        <option value="" disabled selected>Pilih</option>
                                                        <?php while ($row = mysqli_fetch_array($kelas)) { ?>
                                                            <option value="<?= $row['id_kelas'] ?>" <?= $pendaftaran['kelas_id'] == $row['id_kelas'] ? 'selected' : ''; ?>><?= $row['nama_kelas'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <label for="kelas">Kelas</label>
                                                    <div class="invalid-feedback"><small>Kelas harus diisi</small></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 pb-4">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="alamat_sekolah" name="alamat_sekolah" value="<?= htmlspecialchars($pendaftaran['alamat_sekolah']); ?>" required>
                                                    <label for="alamat_sekolah">Alamat Sekolah</label>
                                                    <div class="invalid-feedback"><small>Alamat sekolah harus diisi</small></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Akhir Card Sekolah -->

                                <!-- Awal Card Pendaftar -->
                                <div class="card my-2">
                                    <div class="card-header fw-bold">Data Pendaftar</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8 pb-4">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="orang_tua_wali" name="orang_tua_wali" value="<?= htmlspecialchars($pendaftaran['orang_tua_wali']); ?>" required>
                                                    <label for="orang_tua_wali">Nama Orang Tua/Wali</label>
                                                    <div class="invalid-feedback"><small>Nama orang tua/wali harus diisi</small></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 pb-4">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="no_hp" name="no_hp" pattern="^\d{8,15}$" title="Nomor handphone harus terdiri dari 8 hingga 15 digit" value="<?= htmlspecialchars($pendaftaran['no_hp']); ?>" required>
                                                    <label for="no_hp">Nomor Handphone</label>
                                                    <div id="no_hp" class="form-text">Pastikan aktif WhatsApp untuk konfirmasi pendaftaran</div>
                                                    <div class="invalid-feedback"><small>Nomor handphone harus diisi</small></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 pb-4">
                                                <div id="mustahiq" class="form-text">Mustahiq</div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="mustahiq" id="mustahiq_ya" value="1" <?= $pendaftaran['mustahiq'] == 1 ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="mustahiq_ya">Ya</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="mustahiq" id="mustahiq_tidak" value="0" <?= $pendaftaran['mustahiq'] == 0 ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="mustahiq_tidak">Tidak</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4 pb-4">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="relasi" name="relasi" value="<?= htmlspecialchars($pendaftaran['relasi']); ?>">
                                                    <label for="relasi">Relasi</label>
                                                    <div class="invalid-feedback"><small>Relasi harus diisi</small></div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 pb-4">
                                                <div class="form-floating">
                                                    <select class="form-select" id="status_pendaftaran_id" name="status_pendaftaran_id" required>
                                                        <option value="" disabled selected>Pilih</option>
                                                        <?php
                                                        $status_pendaftaran = mysqli_query($conn, "SELECT * FROM status_pendaftaran");
                                                        while ($row = mysqli_fetch_array($status_pendaftaran)) {
                                                            $selected = ($row['id_status_pendaftaran'] == $pendaftaran['status_pendaftaran_id']) ? 'selected' : '';
                                                            echo "<option value='{$row['id_status_pendaftaran']}' $selected>{$row['nama_status_pendaftaran']}</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    <label for="status_pendaftaran_id">Status Pendaftaran</label>
                                                    <div class="invalid-feedback"><small>Status pendaftaran harus diisi</small></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Akhir Card Pendaftar -->

                                <!-- Awal Card Dokumen -->
                                <div class="card my-2">
                                    <div class="card-header fw-bold">Upload Dokumen</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md pb-3">
                                                <p class="text-start">Perhatian! Dokumen harus jelas dan dapat dibaca untuk kebutuhan verifikasi. File harus berupa gambar dalam format jpg/jpeg.</p>
                                            </div>
                                        </div>
                                        <!-- KIA / KK -->
                                        <div class="row">
                                            <div class="col-md-4 pb-4">
                                                <input class="form-control" type="file" id="dokumen_kia_kk" name="dokumen_kia_kk">
                                                <div id="dokumen_kia_kk" class="form-text">Dokumen KIA/KK</div>
                                            </div>
                                            <div class="col-md-8 pb-4 text-center">
                                                <div id="preview_kia_kk">
                                                    <?php if (!empty($pendaftaran['dokumen_kia_kk'])) : ?>
                                                        <img src="../dokumen/kia_kk/<?= htmlspecialchars($pendaftaran['dokumen_kia_kk']); ?>" alt="Dokumen KIA/KK" class="rounded img-fluid" style="width: 30%;">
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Sekolah -->
                                        <div class="row">
                                            <div class="col-md-4 pb-4">
                                                <input class="form-control" type="file" id="dokumen_sekolah" name="dokumen_sekolah">
                                                <div id="dokumen_sekolah" class="form-text">Dokumen Sekolah</div>
                                            </div>
                                            <div class="col-md-8 pb-4 text-center">
                                                <div id="preview_sekolah">
                                                    <?php if (!empty($pendaftaran['dokumen_sekolah'])) : ?>
                                                        <img src="../dokumen/sekolah/<?= htmlspecialchars($pendaftaran['dokumen_sekolah']); ?>" alt="Dokumen Sekolah" class="rounded img-fluid" style="width: 30%;">
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Domisili -->
                                        <div class="row">
                                            <div class="col-md-4 pb-4">
                                                <input class="form-control" type="file" id="dokumen_domisili" name="dokumen_domisili">
                                                <div id="dokumen_domisili" class="form-text">Dokumen Domisili</div>
                                            </div>
                                            <div class="col-md-8 pb-4 text-center">
                                                <div id="preview_domisili">
                                                    <?php if (!empty($pendaftaran['dokumen_domisili'])) : ?>
                                                        <img src="../dokumen/domisili/<?= htmlspecialchars($pendaftaran['dokumen_domisili']); ?>" alt="Dokumen Domisili" class="rounded img-fluid" style="width: 30%;">
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Pendukung-->
                                        <div class="row">
                                            <div class="col-md-4 pb-4">
                                                <input class="form-control" type="file" id="dokumen_pendukung" name="dokumen_pendukung">
                                                <div id="dokumen_pendukung" class="form-text">Dokumen Pendukung</div>
                                            </div>
                                            <div class="col-md-8 pb-4 text-center">
                                                <div id="preview_pendukung">
                                                    <?php if (!empty($pendaftaran['dokumen_pendukung'])) : ?>
                                                        <img src="../dokumen/pendukung/<?= htmlspecialchars($pendaftaran['dokumen_pendukung']); ?>" alt="Dokumen Pendukung" class="rounded img-fluid" style="width: 30%;">
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Akhir Card Dokumen -->

                                <!-- Submit -->
                                <div class="row">
                                    <div class="col-md-10 py-2">
                                    </div>
                                    <div class="col-md-2 text-center pt-2 pe-2">
                                        <input type="submit" class="btn btn-success" value="Simpan" id="btnSubmit">
                                    </div>
                                </div>
                                <!-- Akhir Submit -->
                            </div>
                        </div>
                        <!-- Akhir Card Data -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- implementasi select2js -->
<script>
    $(document).ready(function() {
        // Inisialisasi Select2 pada dropdown tempat lahir, provinsi, kabupaten, kecamatan, desa
        $('#tempat_lahir').select2({
            minimumResultsForSearch: 10, // Tampilkan search box hanya jika options lebih dari 10
            width: '100%' // Pastikan lebar 100% untuk menyesuaikan dengan form-control
        });

        $('#provinsi').select2({
            minimumResultsForSearch: 10,
            width: '100%'
        });

        $('#kabupaten_kota').select2({
            minimumResultsForSearch: 10,
            width: '100%'
        });

        $('#kecamatan').select2({
            minimumResultsForSearch: 10,
            width: '100%'
        });

        $('#desa_kelurahan').select2({
            minimumResultsForSearch: 10,
            width: '100%'
        });
        $('#yourDropdownId').select2({
            minimumResultsForSearch: 10,
            width: '100%',
            multiple: true
        });
    });
</script>

<script>
    // Menyiapkan data ketika halaman dibuka
    document.addEventListener('DOMContentLoaded', () => {
        // Data kabupaten untuk tempat lahir
        fetchTempatLahir();
    });

    // Tempat Lahir => Kabupaten fetch API
    function fetchTempatLahir() {
        fetch('../config/tempat_lahir.php')
            .then(response => response.json())
            .then(data => {
                const kabupatenSelect = document.getElementById('tempat_lahir');
                kabupatenSelect.innerHTML = '<option value="" disabled selected>Pilih</option>'; // Reset options

                data.data.forEach(kabupaten => {
                    const option = document.createElement('option');
                    option.value = kabupaten.id_regencies;
                    option.textContent = kabupaten.name_regencies;
                    if (kabupaten.id_regencies == "<?= $pendaftaran['tempat_lahir_regencies_id']; ?>") {
                        option.selected = true;
                    }
                    kabupatenSelect.appendChild(option);
                });
            })
    }

    // Validasi form
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>

<script>
    //---------------------------------------------------------------------------------------------------------------------------------
    // Menghubungkan nama depan dan nama belakang
    function updateNamaLengkap() {
        var nama_depan = document.getElementById('nama_depan').value;
        var nama_belakang = document.getElementById('nama_belakang').value;
        document.getElementById('nama_lengkap').value = nama_depan + ' ' + nama_belakang;
    }


    // --------------------------------------------------------------------------------------------------------------------------------
    // Tanggal lahir => Rentang usia 7 - 15 tahun
    // function tanggalLahir() {
    //     const dateInput = document.getElementById('tanggal_lahir');
    //     const today = new Date('2023-10-07');

    //     // Rentang umur yang diizinkan (misalnya, 18 hingga 60 tahun)
    //     const minAge = 7;
    //     const maxAge = 15;

    //     // Menghitung tanggal minimum dan maksimum
    //     const minDate = new Date(today.getFullYear() - maxAge, today.getMonth(), today.getDate());
    //     const maxDate = new Date(today.getFullYear() - minAge, today.getMonth(), today.getDate());

    //     // Mengatur atribut min dan max pada input date
    //     dateInput.setAttribute('min', minDate.toISOString().split('T')[0]);
    //     dateInput.setAttribute('max', maxDate.toISOString().split('T')[0]);

    //     // Mencegah pengetikan manual pada input date
    //     dateInput.addEventListener('keydown', function(event) {
    //         event.preventDefault();
    //     });

    // }

    // --------------------------------------------------------------------------------------------------------------------------------
    // Alamat => Provinsi, Kabupaten, Kecamatan dan Desa fetch API
    function fetchProvinces() {
        fetch('../config/provinces.php')
            .then(response => response.json())
            .then(data => {
                const provinsiSelect = document.getElementById('provinsi');
                provinsiSelect.innerHTML = '<option value="" disabled selected>Pilih</option>'; // Reset options

                // Mengakses elemen 'data' dari JSON response
                data.data.forEach(provinsi => {
                    const option = document.createElement('option');
                    option.value = provinsi.id_provinces;
                    option.textContent = provinsi.name_provinces;
                    provinsiSelect.appendChild(option);
                });
            })
    }


    function fetchKabupaten() {
        const provinsiId = document.getElementById('provinsi').value;
        if (!provinsiId) return;

        fetch('../config/regencies.php?id=' + provinsiId)
            .then(response => response.json())
            .then(data => {

                const kabupatenSelect = document.getElementById('kabupaten_kota');
                kabupatenSelect.innerHTML = '<option value="" disabled selected>Pilih</option>'; // Reset options

                data.data.forEach(kabupaten => {
                    const option = document.createElement('option');
                    option.value = kabupaten.id_regencies;
                    option.textContent = kabupaten.name_regencies;
                    kabupatenSelect.appendChild(option);
                });
            })
    }

    function fetchKecamatan() {
        const kabupatenId = document.getElementById('kabupaten_kota').value;
        if (!kabupatenId) return;

        fetch('../config/districts.php?id=' + kabupatenId)
            .then(response => response.json())
            .then(data => {

                const kecamatanSelect = document.getElementById('kecamatan');
                kecamatanSelect.innerHTML = '<option value="" disabled selected>Pilih</option>'; // Reset options

                data.data.forEach(kecamatan => {
                    const option = document.createElement('option');
                    option.value = kecamatan.id_districts;
                    option.textContent = kecamatan.name_districts;
                    kecamatanSelect.appendChild(option);
                });
            })
    }

    function fetchDesa() {
        const kecamatanId = document.getElementById('kecamatan').value;
        if (!kecamatanId) return;

        fetch('../config/villages.php?id=' + kecamatanId)
            .then(response => response.json())
            .then(data => {

                const desaSelect = document.getElementById('desa_kelurahan');
                desaSelect.innerHTML = '<option value="" disabled selected>Pilih</option>'; // Reset options

                data.data.forEach(desa => {
                    const option = document.createElement('option');
                    option.value = desa.id_villages;
                    option.textContent = desa.name_villages;
                    desaSelect.appendChild(option);
                });
            })
    }

    // --------------------------------------------------------------------------------------------------------------------------------
    // Radio button domisili
    document.addEventListener('DOMContentLoaded', () => {
        const radioButtons = document.querySelectorAll('input[name="domisili"]');
        const dependentInput = document.getElementById('dokumen_domisili');
        const iconRequired = document.getElementById('dokumen_domisili_required');

        radioButtons.forEach(radio => {
            radio.addEventListener('change', () => {
                if (radio.checked && radio.value === 0) {
                    dependentInput.required = true;
                    iconRequired.show(true)
                } else {
                    dependentInput.required = false;
                    iconRequired.show(false)
                }
            });
        });
    });


    // --------------------------------------------------------------------------------------------------------------------------------
    // Preview foto
    // KIA / KK
    document.getElementById('dokumen_kia_kk').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const previewContainer = document.getElementById('preview_kia_kk');

        // Clear previous preview
        previewContainer.innerHTML = '';

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('rounded', 'img-fluid'); // Add class for styling
                img.style.width = '30%'; // Set width or adjust as needed
                previewContainer.appendChild(img);
            };

            reader.readAsDataURL(file);
        } else {
            document.getElementById('dokumen_kia_kk').value = '';
            alert('Please select a valid image file.');
        }
    });

    // Sekolah
    document.getElementById('dokumen_sekolah').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const previewContainer = document.getElementById('preview_sekolah');

        // Clear previous preview
        previewContainer.innerHTML = '';

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('rounded', 'img-fluid'); // Add class for styling
                img.style.width = '30%'; // Set width or adjust as needed
                previewContainer.appendChild(img);
            };

            reader.readAsDataURL(file);
        } else {
            document.getElementById('dokumen_sekolah').value = '';
            alert('Please select a valid image file.');
        }
    });

    // Domisili
    document.getElementById('dokumen_domisili').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const previewContainer = document.getElementById('preview_domisili');

        // Clear previous preview
        previewContainer.innerHTML = '';

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('rounded', 'img-fluid'); // Add class for styling
                img.style.width = '30%'; // Set width or adjust as needed
                previewContainer.appendChild(img);
            };

            reader.readAsDataURL(file);
        } else {
            document.getElementById('dokumen_domisili').value = '';
            alert('Please select a valid image file.');
        }
    });

    // Pendukung
    document.getElementById('dokumen_pendukung').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const previewContainer = document.getElementById('preview_pendukung');

        // Clear previous preview
        previewContainer.innerHTML = '';

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('rounded', 'img-fluid'); // Add class for styling
                img.style.width = '30%'; // Set width or adjust as needed
                previewContainer.appendChild(img);
            };

            reader.readAsDataURL(file);
        } else {
            document.getElementById('dokumen_pendukung').value = '';
            alert('Please select a valid image file.');
        }
    });

    // --------------------------------------------------------------------------------------------------------------------------------
    // Validasi form
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>

</body>

</html>