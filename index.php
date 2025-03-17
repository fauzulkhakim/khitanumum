<?php
include 'layouts/header.php';
date_default_timezone_set('Asia/Jakarta');
require 'panitia/config/config.php';

// Cek apakah pendaftaran sudah ditutup
$current_time = date('Y-m-d H:i:s');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <div class="container-fluid">

    <!-- Awal Logo dan kop -->
    <div class="row mt-5">
      <div class="col-ml-4"></div>
      <div class="col-ml-1 text-center">
        <img src="panitia/assets/images/icon_khitan_umum.png" height="100">
      </div>
      <div class="col-ml-5 mt-4 text-center">
        <h3>Pendaftaran Khitan Umum</h3>
        <h6>Pengajian Pitulasan Masjid Al-Aqsha Menara Kudus</h6>
        <h6>1447 H / 2025 TU</h6>
      </div>
      <div class="col-ml-2"></div>
    </div>
    <!-- Akhir Logo dan kop -->

    <!-- Formulir Pendaftaran -->
    <?php if ($current_time >= $dibuka && $current_time <= $ditutup) { ?>
      <!-- Awal Petunjuk Pengisian -->
      <div class="row pt-2 justify-content-center">
        <div class="col-md-8">
          <div class="card mb-2">
            <div class="card-header fw-bold">
              Petunjuk Pengisian Formulir
            </div>
            <div class="card-body">
              <ul>
                <li>Anak Berusia 7-15 tahun pada 21 September 2024</li>
                <li>Berdomisili Kudus</li>
                <li>Menyiapkan Foto / Gambar KK atau KIA untuk diupload</li>
                <li>Pendaftaran ditutup ketika kuota terpenuhi</li>
                <li>Pastikan telah memeriksa ulang semua informasi sebelum mengirimkan formulir. Panitia tidak bertanggungjawab atas kesalahan pengisian data</li>
              </ul>
              <button id="btn-daftar" class="btn btn-success mt-3">Daftar</button>
            </div>
          </div>
          <!-- Akhir Petunjuk Pengisian -->

          <!-- Awal Formulir Pendaftaran -->
          <form action="panitia/config/pendaftaran-tambah.php" method="POST" enctype="multipart/form-data" id="form-pendaftaran" class="needs-validation" novalidate>

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
                              <input class="form-check-input" type="radio" name="domisili" id="domisili_ya" value="1" updateDomisiliRequired() required>
                              <label class="form-check-label" for="domisili_ya">Ya</label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="domisili" id="domisili_tidak" value="0" updateDomisiliRequired required>
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
                              <div class="invalid-feedback">Nama sekolah harus diisi</div>
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
                              <div class="invalid-feedback">Kelas harus diisi</div>
                            </div>
                          </div>
                          <div class="col-md-4 pb-4">
                            <div class="form-floating">
                              <input type="text" class="form-control" id="alamat_sekolah" name="alamat_sekolah" required>
                              <label for="alamat_sekolah">Alamat Sekolah</label>
                              <div class="invalid-feedback">Alamat sekolah harus diisi</div>
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
                              <div class="invalid-feedback">Nama orang tua/wali harus diisi</div>
                            </div>
                          </div>
                          <div class="col-md-4 pb-4">
                            <div class="form-floating">
                              <input type="text" class="form-control" id="no_hp" name="no_hp" pattern="^\d{8,15}$" title="Nomor handphone harus terdiri dari 8 hingga 15 digit" required>
                              <label for="no_hp">Nomor Handphone</label>
                              <div id="no_hp" class="form-text">Pastikan aktif WhatsApp untuk konfirmasi pendaftaran</div>
                              <div class="invalid-feedback">Nomor handphone harus diisi</div>
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
                            <div class="invalid-feedback">Dokumen KIA/KK harus diisi sesuai ketentuan</div>
                          </div>
                          <div class="col-md-8 pb-4 text-center">
                            <div id="preview_kia_kk"></div>
                          </div>
                        </div>
                        <!-- Sekolah -->
                        <div class="row">
                          <div class="col-md-4 pb-4">
                            <input class="form-control" type="file" id="dokumen_sekolah" name="dokumen_sekolah">
                            <div id="dokumen_sekolah" class="form-text">Dokumen Sekolah</div>
                            <div class="invalid-feedback">Dokumen sekolah harus diisi sesuai ketentuan</div>
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
                            <div class="invalid-feedback">Dokumen domisili harus diisi sesuai ketentuan</div>
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
        <?php } elseif ($current_time < $dibuka) { ?>
          <div class="rounded bg-danger text-white d-flex align-items-center justify-content-center" style="max-width: 300px; margin: 0 auto; height: 45px;">
            <h5 class="fw-bold mb-0">Pendaftaran belum dibuka</h5>
          </div>
        <?php } else { ?>
          <div class="rounded bg-danger text-white d-flex align-items-center justify-content-center" style="max-width: 300px; margin: 0 auto; height: 45px;">
            <h5 class="fw-bold mb-0">Pendaftaran ditutup</h5>
          </div>
        <?php } ?>
        </div>
      </div>
      <!-- Akhir Petunjuk Pengisian -->
  </div>
</div>
<!-- /.content-wrapper -->
<?php include 'layouts/footer.php'; ?>