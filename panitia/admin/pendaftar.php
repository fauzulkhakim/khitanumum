<?php
require 'header.php';
require '../config/config.php';

// SELECT Orders.OrderID, Customers.CustomerName, Orders.OrderDate
// FROM Orders
// INNER JOIN Customers ON Orders.CustomerID=Customers.CustomerIDs;

// $query = "SELECT 
//         pendaftar.*, 
//         tempat_lahir_regencies_id AS tempat_lahir,
//         domisili_regencies_id AS domisili
//     FROM 
//         pendaftar
//     LEFT JOIN 
//         regencies AS regencies_tempat_lahir ON pendaftar.tempat_lahir_regencies_id = regencies_tempat_lahir.id
//     LEFT JOIN 
//         regencies AS regencies_domisili ON pendaftar.domisili_regencies_id = regencies_domisili.id
// ";s

// echo "Query: $query<br>";

// $result = mysqli_query($conn, $query);

// // Cek apakah query berhasil
// if (!$result) {
//   die("Query gagal: " . mysqli_error($connection));
// }

// // Cek jumlah baris hasil query
// $num_rows = mysqli_num_rows($result);
// if ($num_rows == 0) {
//   die("Tidak ada hasil yang ditemukan.");
// }

// echo "Jumlah hasil: $num_rows<br>";

// $result = mysqli_query($conn, $query);
// $result = mysqli_fetch_assoc($result);
// var_dump($result);

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
        <tbody>
          <?php $no = 1;
          while ($row = $pendaftar->fetch_assoc()) { ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $row['id'] ?></td>
              <td><?= $row['is_admin'] == 1 ? 'Admin' : 'Umum' ?></td>
              <td><?= $row['status_pendaftaran'] === 1 ? 46 . sprintf('%04d', $row['id'])  : '' ?></td>
              <td><?= $row['nama_depan'] . ' ' . $row['nama_belakang'] ?></td>
              <td>Perlu Verifikasi</td>
              <td><?= $row['nik'] ?></td>
              <td><?= $row['mustahiq'] == 1 ? 'Ya' : 'Tidak' ?></td>
              <td><?= $row['relasi'] ?> </td>
              <td><?= $row['orang_tua_wali'] ?></td>
              <td></td>
              <td><?= $row['kabupaten_kota'] ?></td>
              <td class="text-center align-middle">
                <i class="fa-solid fa-circle-info"></i>
                <i class="fa-solid fa-pen"></i>
                <i class="fa-solid fa-trash"></i>
                <br>
                <i class="fa-solid fa-file"></i>
                <i class="fa-brands fa-square-whatsapp"></i>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>



<?php
require_once 'footer.php';
?>