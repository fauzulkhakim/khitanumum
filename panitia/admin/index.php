<?php
require_once 'header.php';
?>

<div class="row text-center justify-content-center">
  <div class="col-ml-4"></div>
  <div class="col-ml-1 text-center">
    <img src="../assets/icon_khitan_umum.png" height="100">
  </div>
  <div class="col-ml-5 text-center ml-3">
    <h3>Dashboard Pendaftar Khitan Umum</h3>
    <h5>Pengajian Pitulasan Masjid Al-Aqsha Menara Kudus</h5>
    <h5>1446 H / 2024 TU</h5>
  </div>
  <div class="col-ml-2"></div>
</div>

<div class="row mt-5 justify-content-center">
  <div class="col-md-2"></div>
  <div class="col-md-8">
    <table class="table table-responsive">
      <thead>
        <th>Daftar Oleh</th>
        <th>Daerah</th>
        <th>Pendaftar</th>
        <th>Diterima</th>
        <th>Ditolak</th>
        <th>Pending</th>
      </thead>
      <tbody>
        <tr>
          <td rowspan="2" class="text-center align-middle">Umum</td>
          <td>Kudus</td>
        </tr>
        <tr>
          <td>Luar Kudus</td>
        </tr>
        <tr>
          <td rowspan="2" class="text-center align-middle">Admin</td>
          <td>Kudus</td>
        </tr>
        <tr>
          <td>Luar Kudus</td>
        </tr>
        <tr>
          <td colspan="2" class="text-center align-middle">Jumlah</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-md-2"></div>
</div>


<?php
require_once 'footer.php';
?>