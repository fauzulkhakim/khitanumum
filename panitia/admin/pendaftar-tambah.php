<?php
require_once '../assets/layouts/header.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="container-fluid">

    <!-- Awal Logo dan kop -->
    <div class="row mt-5">
      <div class="col-ml-4"></div>
      <div class="col-ml-1 text-center">
        <img src="../assets/images/icon_khitan_umum.png" height="100">
      </div>
      <div class="col-ml-5 mt-4 text-center">
        <h3>Pendaftaran Khitan Umum</h3>
        <h6>Pengajian Pitulasan Masjid Al-Aqsha Menara Kudus</h6>
        <h6>1447 H / 2025 TU</h6>
      </div>
      <div class="col-ml-2"></div>
    </div>
    <!-- Akhir Logo dan kop -->

    <!-- Awal Formulir Pendaftaran -->
    <form action="panitia/config/pendaftaran-tambah.php" method="POST" enctype="multipart/form-data" id="form-pendaftaran" class="needs-validation" novalidate>

      <!-- Awal Card Konten -->
      <div class="card card-outline card-primary mb-5">
        <div class="card-body">

          <!-- Awal Card Data -->
          <div class="row mb">
            <div class="col">
              <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-md-4">
                  <!-- Data Identitas Calon Peserta -->
                  <div class="card card-outline card-primary my-2">
                    <div class="card-header fw-bold">
                      Data Identitas Calon Peserta
                    </div>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-6 pb-4">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="nik" name="nik" pattern="[0-9]{16}" required>
                            <label for="nik">NIK</label>
                            <div id="nik" class="form-text">Dapat dilihat pada KIA/KK</div>
                            <div class="invalid-feedback">NIK harus diisi dengan 16 digit</div>
                          </div>
                        </div>
                        <div class="col-md-6 pb-4">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <div class="invalid-feedback">Nama Lengkap harus diisi</div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4 pb-4">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="no_kk" name="no_kk" pattern="[0-9]{16}" required>
                            <label for="no_kk">Nomor KK</label>
                            <div id="no_kk" class="form-text">Dapat dilihat pada KIA/KK</div>
                            <div class="invalid-feedback">Nomor KK harus diisi dengan 16 digit</div>
                          </div>
                        </div>
                        <div class="col-md-4 pb-4">
                          <div class="form-floating">
                            <select class="form-select" id="tempat_lahir" name="tempat_lahir" required>
                            </select>
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <div class="invalid-feedback">Tempat lahir harus diisi</div>
                          </div>
                        </div>
                        <div class="col-md-4 pb-4">
                          <div class="form-floating">
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <div id="tanggal_lahir" class="form-text">Rentang usia 7 - 15 tahun</div>
                            <div class="invalid-feedback">Tanggal lahir harus diisi dengan rentang tanggal yang tersedia</div>
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
                            <div class="invalid-feedback">Provinsi harus diisi</div>
                          </div>
                        </div>
                        <div class="col-md-4 pb-4">
                          <div class="form-floating">
                            <select class="form-select" id="kabupaten_kota" name="kabupaten_kota" onchange="fetchKecamatan()" required>
                            </select>
                            <label for="kabupaten_kota">Kabupaten/Kota</label>
                            <div class="invalid-feedback">Kabupaten/Kota harus diisi</div>
                          </div>
                        </div>
                        <div class="col-md-4 pb-4">
                          <div class="form-floating">
                            <select class="form-select" id="kecamatan" name="kecamatan" onchange="fetchDesa()" required>
                            </select>
                            <label for="kecamatan">Kecamatan</label>
                            <div class="invalid-feedback">Kecamatan harus diisi</div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4 pb-4">
                          <div class="form-floating">
                            <select class="form-select" id="desa_kelurahan" name="desa_kelurahan" required>
                            </select>
                            <label for="desa_kelurahan">Desa/Kelurahan</label>
                            <div class="invalid-feedback">Desa/Kelurahan harus diisi</div>
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
                            <div class="invalid-feedback">RT harus diisi</div>
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
                            <div class="invalid-feedback">RW harus diisi</div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-8 pb-4">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="alamat_lengkap" name="alamat_lengkap" required>
                            <label for="alamat_lengkap">Alamat Lengkap</label>
                            <div id="alamat_lengkap" class="form-text">Berisi jalan, gang, nomor rumah, dukuh atau lainnya</div>
                            <div class="invalid-feedback">Alamat harus diisi</div>
                          </div>
                        </div>
                        <div class="col-md-4 pb-4">
                          <div id="domisili" class="form-text">Apakah domisili calon peserta sesuai dengan alamat?</div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="domisili" id="domisili_ya" value="1" required>
                            <label class="form-check-label" for="domisili_ya">Ya</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="domisili" id="domisili_tidak" value="0" required>
                            <label class="form-check-label" for="domisili_tidak">Tidak</label>
                            <div class="invalid-feedback">Domisili harus diisi</div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-4 pb-4">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="berat_badan" name="berat_badan" pattern="\d{1,3}" required>
                            <label for="berat_badan">Berat Badan</label>
                            <div id="berat_badan" class="form-text">Dalam satuan kg</div>
                            <div class="invalid-feedback">Berat badan harus diisi dengan angka</div>
                          </div>
                        </div>
                        <div class="col-md-4 pb-4">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="tinggi_badan" name="tinggi_badan" pattern="\d{1,3}" required>
                            <label for="tinggi_badan">Tinggi Badan</label>
                            <div id="tinggi_badan" class="form-text">Dalam satuan cm</div>
                            <div class="invalid-feedback">Tinggi badan harus diisi dengan angka</div>
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
                            <div class="invalid-feedback">Ukuran baju harus diisi</div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Akhir Kolom Kiri -->

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
                          <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" required>
                          <div class="invalid-feedback">Nama sekolah harus diisi</div>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-md-6">
                          <label for="alamat_sekolah" class="form-label fw-bold">Alamat Sekolah</label>
                        </div>
                        <div class="col-md-6">
                          <textarea class="form-control" id="alamat_sekolah" name="alamat_sekolah" rows="2" required></textarea>
                          <div class="invalid-feedback">Alamat sekolah harus diisi</div>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-md-6">
                          <label for="kelas" class="form-label fw-bold">Kelas</label>
                        </div>
                        <div class="col-md-6">
                          <select class="form-select" id="kelas" name="kelas" required>
                            <option value="" disabled selected>Pilih</option>
                            <?php
                            $kelas = mysqli_query($conn, "SELECT * FROM kelas");
                            while ($row = $kelas->fetch_array()) {
                              echo "<option value='{$row['id_kelas']}'>{$row['nama_kelas']}</option>";
                            }
                            ?>
                          </select>
                          <div class="invalid-feedback">Kelas harus diisi</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Akhir Kolom Tengah -->

                <!-- Kolom Kanan -->
                <div class="col-md-4">
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
                          <input type="text" class="form-control" id="orang_tua_wali" name="orang_tua_wali" required>
                          <div class="invalid-feedback">Nama orang tua/wali harus diisi</div>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-md-6">
                          <label for="no_hp" class="form-label fw-bold">Nomor Handphone</label>
                        </div>
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="no_hp" name="no_hp" pattern="^\d{8,15}$" title="Nomor handphone harus terdiri dari 8 hingga 15 digit" required>
                          <div id="no_hp" class="form-text">Pastikan aktif WhatsApp untuk konfirmasi pendaftaran</div>
                          <div class="invalid-feedback">Nomor handphone harus diisi</div>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-md-6">
                          <label for="mustahiq" class="form-label fw-bold">Mustahiq</label>
                        </div>
                        <div class="col-md-6">
                          <select class="form-select" id="mustahiq" name="mustahiq" required>
                            <option value="" disabled selected>Pilih</option>
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                          </select>
                          <div class="invalid-feedback">Mustahiq harus diisi</div>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-md-6">
                          <label for="relasi" class="form-label fw-bold">Relasi</label>
                        </div>
                        <div class="col-md-6">
                          <input type="text" class="form-control" id="relasi" name="relasi" required>
                          <div class="invalid-feedback">Relasi harus diisi</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Akhir Kolom Kanan -->
              </div>
            </div>
          </div>
          <!-- Akhir Card Data -->

        </div>
      </div>
      <!-- Akhir Card Konten -->

    </form>
  </div>
</div>
<!-- Akhir Petunjuk Pengisian -->
</div>
</div>

<script>
  // Implementasi select2js
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
  });
</script>

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
  // Tanggal lahir => Rentang usia 7 - 15 tahun
  function tanggalLahir() {
    const dateInput = document.getElementById('tanggal_lahir');
    const today = new Date('2024-09-21');

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
  // Tombol radio domisili
  document.addEventListener('DOMContentLoaded', () => {
    const radioButtons = document.querySelectorAll('input[name="domisili"]');
    const dokumenDomisili = document.getElementById('dokumen_domisili');
    const previewDomisili = document.getElementById('preview_domisili');
    const formTextDomisili = document.querySelector('#dokumen_domisili').nextElementSibling;

    // Fungsi untuk memperbarui visibilitas dan atribut required dari bidang dokumen domisili
    function perbaruiBidangDomisili() {
      if (document.getElementById('domisili_ya').checked) {
        // Sembunyikan dan nonaktifkan bidang ketika "Ya" dipilih
        dokumenDomisili.required = false;
        dokumenDomisili.style.display = 'none';
        previewDomisili.style.display = 'none';
        formTextDomisili.style.display = 'none';
      } else if (document.getElementById('domisili_tidak').checked) {
        // Tampilkan dan aktifkan bidang ketika "Tidak" dipilih
        dokumenDomisili.required = true;
        dokumenDomisili.style.display = 'block';
        previewDomisili.style.display = 'block';
        formTextDomisili.style.display = 'block';
      }
    }

    // Inisialisasi visibilitas bidang berdasarkan tombol radio yang dipilih
    perbaruiBidangDomisili();

    // Tambahkan event listener ke tombol radio untuk memperbarui bidang secara dinamis
    radioButtons.forEach(radio => {
      radio.addEventListener('change', perbaruiBidangDomisili);
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

<?php
require_once '../assets/layouts/footer.php';
?>