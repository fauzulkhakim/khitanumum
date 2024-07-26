<?php
require 'header.php';
require '../config/config.php';
?>

<div class="row justify-content-center">
  <div class="col-ml text-center ml-3">
    <h5>Pendaftar Khitan Umum <br> 1446 H / 2024 TU</h5>
  </div>
</div>

<div class="container">
  <div class="row mt-3 justify-content-center align-middle">
    <div class="col">
      <a href="pendaftar-tambah.php" class="btn btn-success my-3 float-end">Daftarkan</a>
      <table id="pendaftar" class="table table-striped table-bordered table-responsive" style="width:100%">
        <thead>
          <th class="text-center align-middle">No</th>
          <th class="text-center align-middle">ID</th>
          <th class="text-center align-middle">Daftar</i></th>
          <th class="text-center align-middle">No Peserta</th>
          <th class="text-center align-middle">Nama Lengkap</th>
          <th class="text-center align-middle">Status</th>
          <th class="text-center align-middle">NIK</th>
          <th class="text-center align-middle">Mustahiq</th>
          <th class="text-center align-middle">Relasi</th>
          <th class="text-center align-middle">Orang Tua/Wali</th>
          <th class="text-center align-middle">Usia</th>
          <th class="text-center align-middle">Kabupaten/Kota</th>
          <th class="text-center align-middle">Aksi</th>
        </thead>
        <!-- <tbody>
        </tbody> -->
      </table>
    </div>
  </div>
</div>



<?php
require_once 'footer.php';
?>