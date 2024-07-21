<?php
date_default_timezone_set('Asia/Jakarta');
$dibuka = "2024-07-18 00:00:00";
$ditutup = "2024-07-24 23:59:59";

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Khitan Umum YM3SK</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="icon" href="admin/assets/icon_khitan_umum.png" type="image/x-icon">

  <style>
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
        <img src="admin/assets/icon_khitan_umum.png" height="100">
      </div>
      <div class="col-ml-5 text-center">
        <h3>Pendaftaran Khitan Umum</h3>
        <h5>Pengajian Pitulasan Masjid Al-Aqsha Menara Kudus</h5>
        <h5>1446 H / 2024 TU</h5>
      </div>
      <div class="col-ml-2"></div>
    </div>
    <!-- Akhir Logo dan kop -->

    <!-- Awal Konten -->
    <div class="row pt-2 justify-content-center">
      <div class="col-md-8">

        <!-- Pengkondisian waktu pendaftaran -->
        <!-- <?php if (date('Y-m-d H:i:s') >= $dibuka && date('Y-m-d H:i:s') <= $ditutup) { ?> --!>

          <!-- Awal Pendaftaran dibuka -->

        <form action="" method="">

          <!-- Awal Card Konten -->
          <div class="card">
            <div class="card-body">

              <!-- Awal Card Data -->
              <div class="row">
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
                            <label for="nama_depan">Nama Depan <span class="text-danger">*</span></label>
                          </div>
                        </div>
                        <div class="col-md-4 pb-4">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="nama_belakang" name="nama_belakang" oninput="updateNamaLengkap()" required>
                            <label for="nama_belakang">Nama Belakang <span class="text-danger">*</span></label>
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
                            <label for="nik">NIK <span class="text-danger">*</span></label>
                            <div id="nik" class="form-text">Dapat dilihat pada KIA/KK (16 digit)</div>
                          </div>
                        </div>
                        <div class="col-md-4 pb-4">
                          <div class="form-floating">
                            <select class="form-select" id="tempat_lahir" name="tempat_lahir" required>
                            </select>
                            <label for="tempat_lahir">Tempat Lahir <span class="text-danger">*</span></label>
                          </div>
                        </div>
                        <div class="col-md-4 pb-4">
                          <div class="form-floating">
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                            <label for="tanggal_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                            <div id="tanggal_lahir" class="form-text">Rentang usia 7 - 15 tahun</div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <p class="text-start">Alamat sesuai dokumen yang berlaku</p>
                        <div class="col-md-4 pb-4">
                          <div class="form-floating">
                            <select class="form-select" id="provinsi" name="provinsi" onchange="fetchKabupaten()" required>
                            </select>
                            <label for="provinsi">Provinsi <span class="text-danger">*</span></label>
                          </div>
                        </div>
                        <div class="col-md-4 pb-4">
                          <div class="form-floating">
                            <select class="form-select" id="kabupaten_kota" name="kabupaten_kota" onchange="fetchKecamatan()" required>
                            </select>
                            <label for="kabupaten_kota">Kabupaten/Kota <span class="text-danger">*</span></label>
                          </div>
                        </div>
                        <div class="col-md-4 pb-4">
                          <div class="form-floating">
                            <select class="form-select" id="kecamatan" name="kecamatan" onchange="fetchDesa()" required>
                            </select>
                            <label for="kecamatan">Kecamatan <span class="text-danger">*</span></label>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4 pb-4">
                          <div class="form-floating">
                            <select class="form-select" id="desa_kelurahan" name="desa_kelurahan" required>
                            </select>
                            <label for="desa_kelurahan">Desa/Kelurahan <span class="text-danger">*</span></label>
                          </div>
                        </div>
                        <div class="col-md-4 pb-4">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="rt" name="rt" pattern="\d{1,3}" required>
                            <label for="rt">RT <span class="text-danger">*</span></label>
                          </div>
                        </div>
                        <div class="col-md-4 pb-4">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="rw" name="rw" pattern="\d{1,3}" required>
                            <label for="rw">RW <span class="text-danger">*</span></label>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-8 pb-4">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="alamat_lengkap" name="alamat_lengkap" required>
                            <label for="alamat_lengkap">Alamat Lengkap <span class="text-danger">*</span></label>
                            <div id="alamat_lengkap" class="form-text">Berisi jalan, gang, nomor rumah, dukuh atau lainnya</div>
                          </div>
                        </div>
                        <div class="col-md-4 pb-4">
                          <div id="domisili" class="form-text">Apakah domisili calon peserta sesuai dengan alamat? <span class="text-danger">*</span></div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="domisili" id="domisili_ya" value="ya" required>
                            <label class="form-check-label" for="domisili_ya">Ya</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="domisili" id="domisili_tidak" value="tidak" required>
                            <label class="form-check-label" for="domisili_tidak">Tidak</label>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4 pb-4">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="berat_badan" name="berat_badan" pattern="\d{1,3}" required>
                            <label for="berat_badan">Berat Badan <span class="text-danger">*</span></label>
                            <div id="berat_badan" class="form-text">Dalam satuan kg</div>
                          </div>
                        </div>
                        <div class="col-md-4 pb-4">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="tinggi_badan" name="tinggi_badan" pattern="\d{1,3}" required>
                            <label for="tinggi_badan">Tinggi Badan <span class="text-danger">*</span></label>
                            <div id="tinggi_badan" class="form-text">Dalam satuan cm</div>
                          </div>
                        </div>
                        <div class="col-md-4 pb-4">
                          <div class="form-floating">
                            <select class="form-select" id="ukuran_baju" name="ukuran_baju" required>
                              <option value="" disabled selected>Pilih</option>
                              <option value="S">S</option>
                              <option value="M">M</option>
                              <option value="L">L</option>
                              <option value="XL">XL</option>
                            </select>
                            <label for="ukuran_baju">Ukuran Baju <span class="text-danger">*</span></label>
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
                            <label for="nama_sekolah">Nama Sekolah <span class="text-danger">*</span></label>
                          </div>
                        </div>
                        <div class="col-md-4 pb-4">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="kelas" name="kelas" pattern="\d{1,3}" required>
                            <label for="kelas">Kelas <span class="text-danger">*</span></label>
                            <div id="kelas" class="form-text">Contoh : 5 untuk kelas 5 SD, 8 untuk kelas 2 SMP</div>
                          </div>
                        </div>
                        <div class="col-md-4 pb-4">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="alamat_sekolah" name="alamat_sekolah" required>
                            <label for="alamat_sekolah">Alamat Sekolah <span class="text-danger">*</span></label>
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
                            <label for="orang_tua_wali">Nama Orang Tua/Wali <span class="text-danger">*</span></label>
                          </div>
                        </div>
                        <div class="col-md-4 pb-4">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="no_hp" name="no_hp" required pattern="[0-9]{15}">
                            <label for="no_hp">Nomor Handphone <span class="text-danger">*</span></label>
                            <div id="no_hp" class="form-text">Pastikan aktif WhatsApp untuk konfirmasi pendaftaran</div>
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
                          <input class="form-control" type="file" id="dokumen_kia_kk" required>
                          <div id="dokumen_kia_kk" class="form-text">Dokumen KIA/KK <span class="text-danger">*</span></div>
                        </div>
                        <div class="col-md-8 pb-4 text-center">
                          <img src="dokumen/kia_kk/kia.jpeg" class="rounded img-fluid" width="50%">
                        </div>
                      </div>
                      <!-- Sekolah -->
                      <div class="row">
                        <div class="col-md-4 pb-4">
                          <input class="form-control" type="file" id="dokumen_sekolah" required>
                          <div id="dokumen_sekolah" class="form-text">Dokumen Sekolah <span class="text-danger">*</span></div>
                        </div>
                        <div class="col-md-8 pb-4 text-center">
                          <img src="dokumen/sekolah/sekolah.jpeg" class="rounded img-fluid" width="50%">
                        </div>
                      </div>
                      <!-- Domisili -->
                      <div class="row">
                        <div class="col-md-4 pb-4">
                          <input class="form-control" type="file" id="dokumen_domisili">
                          <div id="dokumen_domisili" class="form-text">Dokumen Domisili <span class="text-danger">*</span></div>
                        </div>
                        <div class="col-md-8 pb-4 text-center">
                          <img src="dokumen/domisili/domisili.jpg" class="rounded img-fluid" width="50%">
                        </div>
                      </div>
                      <!-- Pendukung-->
                      <div class="row">
                        <div class="col-md-4 pb-4">
                          <input class="form-control" type="file" id="dokumen_pendukung">
                          <div id="dokumen_pendukung" class="form-text">Dokumen Pendukung</div>
                        </div>
                        <div class="col-md-8 pb-4 text-center">
                          <img src="dokumen/pendukung/pas_foto.jpeg" class="rounded img-fluid" width="50%">
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
                      <input type="submit" class="btn btn-success" value="Daftar">
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
      <!-- <h5 class="text-danger">Pendaftaran ditutup</h5> --!>
    <?php } ?>
    <!-- Akhir Pendaftaran ditutup -->
    </div>
    <!-- Akhir Konten -->

  </div>
  <!-- Akhir Kontainer -->




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
      fetch('https://alamat.thecloudalert.com/api/kabkota/get/')
        .then(response => response.json())
        .then(data => {

          const kabupatenSelect = document.getElementById('tempat_lahir');
          kabupatenSelect.innerHTML = '<option value="" disabled selected>Pilih</option>'; // Reset options

          data.result.forEach(kabupaten => {
            const option = document.createElement('option');
            option.value = kabupaten.id;
            option.textContent = kabupaten.text;
            kabupatenSelect.appendChild(option);
          });
        })
    }

    // --------------------------------------------------------------------------------------------------------------------------------
    // Tanggal lahir => Rentang usia 7 - 15 tahun
    function tanggalLahir() {
      const dateInput = document.getElementById('tanggal_lahir');
      const today = new Date('2023-10-07');

      // Rentang umur yang diizinkan (misalnya, 18 hingga 60 tahun)
      const minAge = 7;
      const maxAge = 15;

      // Menghitung tanggal minimum dan maksimum
      const minDate = new Date(today.getFullYear() - maxAge, today.getMonth(), today.getDate());
      const maxDate = new Date(today.getFullYear() - minAge, today.getMonth(), today.getDate());

      // Mengatur atribut min dan max pada input date
      dateInput.setAttribute('min', minDate.toISOString().split('T')[0]);
      dateInput.setAttribute('max', maxDate.toISOString().split('T')[0]);

      // Mencegah pengetikan manual pada input date
      dateInput.addEventListener('keydown', function(event) {
        event.preventDefault();
      });

    }

    // --------------------------------------------------------------------------------------------------------------------------------
    // Alamat => Provinsi, Kabupaten, Kecamatan dan Desa fetch API
    function fetchProvinces() {
      fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
        .then(response => response.json())
        .then(data => {

          const provinsiSelect = document.getElementById('provinsi');
          provinsiSelect.innerHTML = '<option value="" disabled selected>Pilih</option>'; // Reset options

          data.forEach(provinsi => {
            const option = document.createElement('option');
            option.value = provinsi.id;
            option.textContent = provinsi.name;
            provinsiSelect.appendChild(option);
          });
        })
    }

    function fetchKabupaten() {
      const provinsiId = document.getElementById('provinsi').value;
      if (!provinsiId) return;

      fetch('https://www.emsifa.com/api-wilayah-indonesia/api/regencies/' + provinsiId + '.json')
        .then(response => response.json())
        .then(data => {

          const kabupatenSelect = document.getElementById('kabupaten_kota');
          kabupatenSelect.innerHTML = '<option value="" disabled selected>Pilih</option>'; // Reset options

          data.forEach(kabupaten => {
            const option = document.createElement('option');
            option.value = kabupaten.id;
            option.textContent = kabupaten.name;
            kabupatenSelect.appendChild(option);
          });
        })
    }

    function fetchKecamatan() {
      const kabupatenId = document.getElementById('kabupaten_kota').value;
      if (!kabupatenId) return;

      fetch('https://www.emsifa.com/api-wilayah-indonesia/api/districts/' + kabupatenId + '.json')
        .then(response => response.json())
        .then(data => {

          const kecamatanSelect = document.getElementById('kecamatan');
          kecamatanSelect.innerHTML = '<option value="" disabled selected>Pilih</option>'; // Reset options

          data.forEach(kecamatan => {
            const option = document.createElement('option');
            option.value = kecamatan.id;
            option.textContent = kecamatan.name;
            kecamatanSelect.appendChild(option);
          });
        })
    }

    function fetchDesa() {
      const kecamatanId = document.getElementById('kecamatan').value;
      if (!kecamatanId) return;

      fetch('https://www.emsifa.com/api-wilayah-indonesia/api/villages/' + kecamatanId + '.json')
        .then(response => response.json())
        .then(data => {

          const desaSelect = document.getElementById('desa_kelurahan');
          desaSelect.innerHTML = '<option value="" disabled selected>Pilih</option>'; // Reset options

          data.forEach(desa => {
            const option = document.createElement('option');
            option.value = desa.id;
            option.textContent = desa.name;
            desaSelect.appendChild(option);
          });
        })
    }
  </script>

</body>

</html>