<?php
date_default_timezone_set('Asia/Jakarta');

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Khitan Umum YM3SK</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="icon" href="../assets/icon_khitan_umum.png" type="image/x-icon">

</head>

<body>
  <!-- Awal Kontainer -->
  <div class="container-fluid">
    <!-- Awal Logo dan kop -->
    <div class="row mt-3">
      <div class="col-ml-12 text-center">
        <h4>Pendaftaran Khitan Umum 1446 H / 2024 TU</h4>
        <h5>Jalur Panitia</h5>
      </div>
    </div>
    <!-- Akhir Logo dan kop -->

    <!-- Awal Konten -->
    <div class="row pt-2 justify-content-center">
      <div class="col-md-8">

        <!-- Awal Pendaftaran -->

        <form action="" method="" id="form-pendaftaran" class="needs-validation" novalidate>

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
                            <label for="nama_depan">Nama Depan</label>
                            <div class="valid-feedback"><small>Benar</small></div>
                            <div class="invalid-feedback"><small>Nama depan harus diisi</small></div>
                          </div>
                        </div>
                        <div class="col-md-4 pb-4">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="nama_belakang" name="nama_belakang" oninput="updateNamaLengkap()" required>
                            <label for="nama_belakang">Nama Belakang</label>
                            <div class="valid-feedback"><small>Benar</small></div>
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
                            <div class="valid-feedback"><small>Benar</small></div>
                            <div class="invalid-feedback"><small>NIK harus diisi dengan 16 digit</small></div>
                          </div>
                        </div>
                        <div class="col-md-4 pb-4">
                          <div class="form-floating">
                            <select class="form-select" id="tempat_lahir" name="tempat_lahir" required>
                            </select>
                            <label for="tempat_lahir">Tempat Lahir</label>
                          </div>
                        </div>
                        <div class="col-md-4 pb-4">
                          <div class="form-floating">
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                            <label for="tanggal_lahir">Tanggal Lahir</label>
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
                            <label for="provinsi">Provinsi</label>
                          </div>
                        </div>
                        <div class="col-md-4 pb-4">
                          <div class="form-floating">
                            <select class="form-select" id="kabupaten_kota" name="kabupaten_kota" onchange="fetchKecamatan()" required>
                            </select>
                            <label for="kabupaten_kota">Kabupaten/Kota</label>
                          </div>
                        </div>
                        <div class="col-md-4 pb-4">
                          <div class="form-floating">
                            <select class="form-select" id="kecamatan" name="kecamatan" onchange="fetchDesa()" required>
                            </select>
                            <label for="kecamatan">Kecamatan</label>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4 pb-4">
                          <div class="form-floating">
                            <select class="form-select" id="desa_kelurahan" name="desa_kelurahan" required>
                            </select>
                            <label for="desa_kelurahan">Desa/Kelurahan</label>
                          </div>
                        </div>
                        <div class="col-md-4 pb-4">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="rt" name="rt" pattern="\d{1,3}" required>
                            <label for="rt">RT</label>
                          </div>
                        </div>
                        <div class="col-md-4 pb-4">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="rw" name="rw" pattern="\d{1,3}" required>
                            <label for="rw">RW</label>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-8 pb-4">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="alamat_lengkap" name="alamat_lengkap" required>
                            <label for="alamat_lengkap">Alamat Lengkap</label>
                            <div id="alamat_lengkap" class="form-text">Berisi jalan, gang, nomor rumah, dukuh atau lainnya</div>
                          </div>
                        </div>
                        <div class="col-md-4 pb-4">
                          <div id="domisili" class="form-text">Apakah domisili calon peserta sesuai dengan alamat?</div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="domisili" id="domisili_ya" value="ya" updateDomisiliRequired() required>
                            <label class="form-check-label" for="domisili_ya">Ya</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="domisili" id="domisili_tidak" value="tidak" updateDomisiliRequired required>
                            <label class="form-check-label" for="domisili_tidak">Tidak</label>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4 pb-4">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="berat_badan" name="berat_badan" pattern="\d{1,3}" required>
                            <label for="berat_badan">Berat Badan</label>
                            <div id="berat_badan" class="form-text">Dalam satuan kg</div>
                          </div>
                        </div>
                        <div class="col-md-4 pb-4">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="tinggi_badan" name="tinggi_badan" pattern="\d{1,3}" required>
                            <label for="tinggi_badan">Tinggi Badan</label>
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
                            <label for="ukuran_baju">Ukuran Baju</label>
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
                          </div>
                        </div>
                        <div class="col-md-4 pb-4">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="kelas" name="kelas" pattern="\d{1,3}" required>
                            <label for="kelas">Kelas</label>
                            <div id="kelas" class="form-text">Contoh : 5 untuk kelas 5 SD, 8 untuk kelas 2 SMP</div>
                          </div>
                        </div>
                        <div class="col-md-4 pb-4">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="alamat_sekolah" name="alamat_sekolah" required>
                            <label for="alamat_sekolah">Alamat Sekolah</label>
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
                          </div>
                        </div>
                        <div class="col-md-4 pb-4">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="no_hp" name="no_hp" pattern="^\d{8,15}$" title="Nomor handphone harus terdiri dari 8 hingga 15 digit" required>
                            <label for="no_hp">Nomor Handphone</label>
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
                          <div id="dokumen_kia_kk" class="form-text">Dokumen KIA/KK</div>
                        </div>
                        <div class="col-md-8 pb-4 text-center">
                          <div id="preview_kia_kk"></div>
                        </div>
                      </div>
                      <!-- Sekolah -->
                      <div class="row">
                        <div class="col-md-4 pb-4">
                          <input class="form-control" type="file" id="dokumen_sekolah" required>
                          <div id="dokumen_sekolah" class="form-text">Dokumen Sekolah</div>
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
                        </div>
                        <div class="col-md-8 pb-4 text-center">
                          <div id="preview_domisili"></div>
                        </div>
                      </div>
                      <!-- Pendukung-->
                      <div class="row">
                        <div class="col-md-4 pb-4">
                          <input class="form-control" type="file" id="dokumen_pendukung">
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
                    <div class="col-md-8 py-2"></div>
                    <div class="col-md-4 text-center pt-2 pe-2">
                      <input type="submit" class="btn btn-success float-end mx-2" value="Daftar">
                      <a href="pendaftar.php" class="btn btn-primary float-end">Kembali</a>
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
      <!-- Akhir Pendaftaran -->

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

    // --------------------------------------------------------------------------------------------------------------------------------
    // Radio button domisili
    document.addEventListener('DOMContentLoaded', () => {
      const radioButtons = document.querySelectorAll('input[name="domisili"]');
      const dependentInput = document.getElementById('dokumen_domisili');
      const iconRequired = document.getElementById('dokumen_domisili_required');

      radioButtons.forEach(radio => {
        radio.addEventListener('change', () => {
          if (radio.checked && radio.value === 'ya') {
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