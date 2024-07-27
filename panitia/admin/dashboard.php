<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: index.php");
  exit();
}
require '../config/config.php';
require_once 'header.php';
?>

<div class="container mt-4">
  <div class="row justify-content-between">
    <div class="col-auto">
      <h3>Dashboard Pendaftar Khitan Umum</h3>
      <h6>Pengajian Pitulasan Masjid Al-Aqsha Menara Kudus</h6>
      <h6>1446 H / 2024 TU</h6>
    </div>
  </div>
</div>

<div class="container mt-5">
  <div class="row">
    <div class="col-md-10">
      <div class="table-responsive">
        <table class="table table-bordered table-responsive table-hover">
          <thead class="table-dark">
            <tr>
              <th>Daftar Oleh</th>
              <th>Daerah</th>
              <th>Pendaftar</th>
              <th>Diterima</th>
              <th>Ditolak</th>
              <th>Pending</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td rowspan="2" class="text-center align-middle">Umum</td>
              <td>Kudus</td>
              <td>10</td>
              <td>8</td>
              <td>1</td>
              <td>1</td>
            </tr>
            <tr>
              <td>Luar Kudus</td>
              <td>5</td>
              <td>4</td>
              <td>0</td>
              <td>1</td>
            </tr>
            <tr>
              <td rowspan="2" class="text-center align-middle">Admin</td>
              <td>Kudus</td>
              <td>12</td>
              <td>10</td>
              <td>1</td>
              <td>1</td>
            </tr>
            <tr>
              <td>Luar Kudus</td>
              <td>7</td>
              <td>5</td>
              <td>1</td>
              <td>1</td>
            </tr>
            <tr>
              <td colspan="2" class="text-center align-middle">Jumlah</td>
              <td>34</td>
              <td>27</td>
              <td>3</td>
              <td>4</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php
require_once 'footer.php';
?>