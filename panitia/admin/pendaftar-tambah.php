<?php
date_default_timezone_set('Asia/Jakarta');
require '../config/config.php';
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Khitan Umum YM3SK</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="icon" href="../assets/icon_khitan_umum.png" type="image/x-icon">

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
      background: #3C5B6F;
    }

    /* buat h3 - h5 menjadi warna white */
    h3 {
      color: white;
      font-weight: bolder;
    }

    h6 {
      color: #F8F4E1;
    }

    /* Menghilangkan kursor teks untuk input date */
    input[type="date"] {
      caret-color: transparent;
      /* Menyembunyikan kursor */
    }
  </style>

</head>

<body>
  <!-- Awal Kontainer -->
  <div class="container-fluid">
    <!-- Awal Logo dan kop -->
    <div class="row mt-5">
      <div class="col-ml-4"></div>
      <div class="col-ml-1 text-center">
        <img src="../assets/icon_khitan_umum.png" height="100">
      </div>
      <div class="col-ml-5 mt-4 text-center">
        <h3>Pendaftaran Khitan Umum</h3>
        <h6>Pengajian Pitulasan Masjid Al-Aqsha Menara Kudus</h6>
        <h6>1446 H / 2024 TU</h6>
      </div>
      <div class="col-ml-2"></div>
    </div>
    <!-- Akhir Logo dan kop -->

    <!-- Awal Konten -->
    <div class="row pt-2 justify-content-center">
      <div class="col-md-8">

        <!-- Pengkondisian waktu pendaftaran -->
        <?php if (date('Y-m-d H:i:s') >= $dibuka && date('Y-m-d H:i:s') <= $ditutup) { ?>

          <!-- Awal Pendaftaran dibuka -->

          <form action="../config/pendaftaran-tambah.php" method="POST" enctype="multipart/form-data" id="form-pendaftaran" class="needs-validation" novalidate>

            <!-- Awal Card Konten -->
            <div class="card mb-5">
              <div class="card-body">

                <!-- Awal Card Data -->
                <div class="row mb">
                  <div class="col">

                    <!-- Awal Card Identitas -->
                    <div class="card my-2">
                      <div class="card-header fw-bold">
                        Data Identitas Calon Peserta
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-4 pb-4">
                            <div class="form-floating">
                              <input type="text" class="form-control" id="nama_depan" name="nama_depan" oninput="updateNamaLengkap()" required>
                              <label for="nama_depan">Nama Depan</label>
                              <div class="invalid-feedback"><small>Nama depan harus diisi</small></div>
                            </div>
                          </div>
                          <div class="col-md-4 pb-4">
                            <div class="form-floating">
                              <input type="text" class="form-control" id="nama_belakang" name="nama_belakang" oninput="updateNamaLengkap()" required>
                              <label for="nama_belakang">Nama Belakang</label>
                              <div class="invalid-feedback"><small>Nama belakang harus diisi</small></div>
                            </div>
                          </div>
                          <div class="col-md-4 pb-4">
                            <div class="form-floating">
                              <input class="form-control" type="text" name="nama_lengkap" id="nama_lengkap" value="" disabled readonly>
                              <label for="nama_lengkap">Nama Lengkap</label>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4 pb-4">
                            <div class="form-floating">
                              <input type="text" class="form-control" id="nik" name="nik" pattern="[0-9]{16}" required>
                              <label for="nik">NIK</label>
                              <div id="nik" class="form-text">Dapat dilihat pada KIA/KK</div>
                              <div class="invalid-feedback"><small>NIK harus diisi dengan 16 digit</small></div>
                            </div>
                          </div>
                          <div class="col-md-4 pb-4">
                            <div class="form-floating">
                              <select class="form-select" id="tempat_lahir" name="tempat_lahir" required>
                              </select>
                              <label for="tempat_lahir">Tempat Lahir</label>
                              <div class="invalid-feedback"><small>Tempat lahir harus diisi</small></div>
                            </div>
                          </div>
                          <div class="col-md-4 pb-4">
                            <div class="form-floating">
                              <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
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
                              </select>
                              <label for="provinsi">Provinsi</label>
                              <div class="invalid-feedback"><small>Provinsi harus diisi</small></div>
                            </div>
                          </div>
                          <div class="col-md-4 pb-4">
                            <div class="form-floating">
                              <select class="form-select" id="kabupaten_kota" name="kabupaten_kota" onchange="fetchKecamatan()" required>
                              </select>
                              <label for="kabupaten_kota">Kabupaten/Kota</label>
                              <div class="invalid-feedback"><small>Kabupaten/Kota harus diisi</small></div>
                            </div>
                          </div>
                          <div class="col-md-4 pb-4">
                            <div class="form-floating">
                              <select class="form-select" id="kecamatan" name="kecamatan" onchange="fetchDesa()" required>
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
                                  <option value="<?= $row['id_rt_rw'] ?>"><?= $row['nama_rt_rw'] ?></option>
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
                                  <option value="<?= $row['id_rt_rw'] ?>"><?= $row['nama_rt_rw'] ?></option>
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
                              <input type="text" class="form-control" id="alamat_lengkap" name="alamat_lengkap" required>
                              <label for="alamat_lengkap">Alamat Lengkap</label>
                              <div id="alamat_lengkap" class="form-text">Berisi jalan, gang, nomor rumah, dukuh atau lainnya</div>
                              <div class="invalid-feedback"><small>Alamat harus diisi</small></div>
                            </div>
                          </div>
                          <div class="col-md-4 pb-4">
                            <div id="domisili" class="form-text">Apakah domisili calon peserta sesuai dengan alamat?</div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="domisili" id="domisili_ya" value="1" updateDomisiliRequired() required>
                              <label class="form-check-label" for="domisili_ya">Ya</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="domisili" id="domisili_tidak" value="0" updateDomisiliRequired required>
                              <label class="form-check-label" for="domisili_tidak">Tidak</label>
                              <div class="invalid-feedback"><small>Domisili harus diisi</small></div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4 pb-4">
                            <div class="form-floating">
                              <input type="text" class="form-control" id="berat_badan" name="berat_badan" pattern="\d{1,3}" required>
                              <label for="berat_badan">Berat Badan</label>
                              <div id="berat_badan" class="form-text">Dalam satuan kg</div>
                              <div class="invalid-feedback"><small>Berat badan harus diisi dengan angka</small></div>
                            </div>
                          </div>
                          <div class="col-md-4 pb-4">
                            <div class="form-floating">
                              <input type="text" class="form-control" id="tinggi_badan" name="tinggi_badan" pattern="\d{1,3}" required>
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
                                  <option value="<?= $row['id_ukuran_baju'] ?>"><?= $row['nama_ukuran_baju'] ?></option>
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
                      <div class="card-header fw-bold">
                        Data Sekolah
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-4 pb-4">
                            <div class="form-floating">
                              <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" required>
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
                                  <option value="<?= $row['id_kelas'] ?>"><?= $row['nama_kelas'] ?></option>
                                <?php } ?>
                              </select>
                              <label for="kelas">Kelas</label>
                              <div class="invalid-feedback"><small>Kelas harus diisi</small></div>
                            </div>
                          </div>
                          <div class="col-md-4 pb-4">
                            <div class="form-floating">
                              <input type="text" class="form-control" id="alamat_sekolah" name="alamat_sekolah" required>
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
                      <div class="card-header fw-bold">
                        Data Pendaftar
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-8 pb-4">
                            <div class="form-floating">
                              <input type="text" class="form-control" id="orang_tua_wali" name="orang_tua_wali" required>
                              <label for="orang_tua_wali">Nama Orang Tua/Wali</label>
                              <div class="invalid-feedback"><small>Nama orang tua/wali harus diisi</small></div>
                            </div>
                          </div>
                          <div class="col-md-4 pb-4">
                            <div class="form-floating">
                              <input type="text" class="form-control" id="no_hp" name="no_hp" pattern="^\d{8,15}$" title="Nomor handphone harus terdiri dari 8 hingga 15 digit" required>
                              <label for="no_hp">Nomor Handphone</label>
                              <div id="no_hp" class="form-text">Pastikan aktif WhatsApp untuk konfirmasi pendaftaran</div>
                              <div class="invalid-feedback"><small>Nomor handphone harus diisi</small></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Akhir Card Pendaftar -->

                    <!-- Awal Card Dokumen -->
                    <div class="card my-2">
                      <div class="card-header fw-bold">
                        Upload Dokumen
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md pb-3">
                            <p class="text-start">Perhatian !<br>Dokumen harus jelas dan dapat dibaca untuk kebutuhan verifikasi. File harus berupa gambar dalam format jpg/jpeg.</p>
                          </div>
                        </div>
                        <!-- KIA / KK -->
                        <div class="row">
                          <div class="col-md-4 pb-4">
                            <input class="form-control" type="file" id="dokumen_kia_kk" name="dokumen_kia_kk" required>
                            <div id="dokumen_kia_kk" class="form-text">Dokumen KIA/KK</div>
                            <div class="invalid-feedback"><small>Dokumen KIA/KK harus diisi sesuai ketentuan</small></div>
                          </div>
                          <div class="col-md-8 pb-4 text-center">
                            <div id="preview_kia_kk"></div>
                          </div>
                        </div>
                        <!-- Sekolah -->
                        <div class="row">
                          <div class="col-md-4 pb-4">
                            <input class="form-control" type="file" id="dokumen_sekolah" name="dokumen_sekolah" required>
                            <div id="dokumen_sekolah" class="form-text">Dokumen Sekolah</div>
                            <div class="invalid-feedback"><small>Dokumen sekolah harus diisi sesuai ketentuan</small></div>
                          </div>
                          <div class="col-md-8 pb-4 text-center">
                            <div id="preview_sekolah"></div>
                          </div>
                        </div>
                        <!-- Domisili -->
                        <div class="row">
                          <div class="col-md-4 pb-4">
                            <input class="form-control" type="file" id="dokumen_domisili" name="dokumen_domisili" required>
                            <div id="dokumen_domisili" class="form-text">Dokumen Domisili</div>
                            <div class="invalid-feedback"><small>Dokumen domisili harus diisi sesuai ketentuan</small></div>
                          </div>
                          <div class="col-md-8 pb-4 text-center">
                            <div id="preview_domisili"></div>
                          </div>
                        </div>
                        <!-- Pendukung-->
                        <div class="row">
                          <div class="col-md-4 pb-4">
                            <input class="form-control" type="file" id="dokumen_pendukung" name="dokumen_pendukung">
                            <div id="dokumen_pendukung" class="form-text">Dokumen Pendukung</div>
                          </div>
                          <div class="col-md-8 pb-4 text-center">
                            <div id="preview_pendukung"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Submit -->
                    <div class="row">
                      <div class="col-md-10 py-2">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="setuju" required>
                          <label class="form-check-label" for="setuju">
                            <p class="justify-content-start">
                              Dengan mendaftar, pengguna menyetujui dan memahami bahwa data yang diterima akan digunakan untuk keperluan administrasi dan dibagikan dengan pihak ketiga yang terlibat dalam acara, sesuai dengan kebijakan privasi dan ketentuan yang telah ditetapkan.
                            </p>
                          </label>
                        </div>
                      </div>
                      <div class="col-md-2 text-center pt-2 pe-2">
                        <input type="submit" class="btn btn-success" value="Daftar" id="btnSubmit">
                      </div>
                    </div>
                    <!-- Akhir Card Dokumen -->

                  </div>
                </div>
                <!-- Akhir Card Data -->

              </div>
            </div>
            <!-- Akhir Card Konten -->

          </form>
      </div>
      <!-- Akhir Pendaftaran dibuka -->

      <!-- Awal Pendaftaran ditutup -->
    <?php } else { ?>
      <div class="rounded bg-danger text-white d-flex align-items-center justify-content-center" style="max-width: 300px; margin: 0 auto; height: 45px;">
        <h5 class="fw-bold mb-0">Pendaftaran ditutup</h5>
      </div>
    <?php } ?>
    <!-- Akhir Pendaftaran ditutup -->
    </div>
    <!-- Akhir Konten -->

  </div>
  <!-- Akhir Kontainer -->

  <!-- Modal -->
  <div class="modal fade" id="btnSubmit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  <script>
    //---------------------------------------------------------------------------------------------------------------------------------
    // Menyiapkan data ketika halaman dibuka
    document.addEventListener('DOMContentLoaded', () => {
      // Data kabupaten untuk tempat lahir
      fetchTempatLahir();
      // Tampilkan tanggal sesuai
      tanggalLahir();
      // Data provinsi untuk alamat
      fetchProvinces();
    });

    //---------------------------------------------------------------------------------------------------------------------------------
    // Menghubungkan nama depan dan nama belakang
    function updateNamaLengkap() {
      var nama_depan = document.getElementById('nama_depan').value;
      var nama_belakang = document.getElementById('nama_belakang').value;
      document.getElementById('nama_lengkap').value = nama_depan + ' ' + nama_belakang;
    }

    // ---------------------------------------------------------------------------------------------------------------------------------
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
            kabupatenSelect.appendChild(option);
          });
        })
    }

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