<?php
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['id'])) {
  // User is logged in
} else {
  // User is not logged in, redirect to login page
  if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
  }
}
require '../config/config.php';
require_once 'header.php';

// Query untuk mendapatkan data pendaftar berdasarkan status dan lokasi
$query = "
SELECT 
    p.is_admin,
    prov.name_provinces AS provinsi,
    r.name_regencies AS kabupaten,
    d.name_districts AS kecamatan,
    v.name_villages AS desa,
    s.nama_status_pendaftaran AS status,
    p.tanggal_lahir,
    COUNT(p.id) AS jumlah
FROM 
    pendaftar p
LEFT JOIN 
    provinces prov ON p.domisili_provinces_id = prov.id_provinces
LEFT JOIN 
    regencies r ON p.domisili_regencies_id = r.id_regencies
LEFT JOIN 
    districts d ON p.domisili_districts_id = d.id_districts
LEFT JOIN 
    villages v ON p.domisili_villages_id = v.id_villages
LEFT JOIN 
    status_pendaftaran s ON p.status_pendaftaran_id = s.id_status_pendaftaran
GROUP BY 
    p.is_admin, prov.name_provinces, r.name_regencies, d.name_districts, v.name_villages, s.nama_status_pendaftaran, p.tanggal_lahir
ORDER BY 
    prov.name_provinces, r.name_regencies, d.name_districts, v.name_villages, s.nama_status_pendaftaran, p.tanggal_lahir";

$result = $conn->query($query);
$data = [];

while ($row = $result->fetch_assoc()) {
  $data[] = $row;
}

// Menghitung total pendaftar berdasarkan kategori
$total_pendaftar = 0;
$total_diterima = 0;
$total_ditolak = 0;
$total_pending = 0;

$age_data = [];

foreach ($data as $row) {
  if ($row['status'] == 'Diterima') {
    $total_diterima += $row['jumlah'];
  } elseif ($row['status'] == 'Ditolak') {
    $total_ditolak += $row['jumlah'];
  } elseif ($row['status'] == 'Pending') {
    $total_pending += $row['jumlah'];
  }
  $total_pendaftar += $row['jumlah'];

  // Calculate age
  $birthDate = new DateTime($row['tanggal_lahir']);
  $today = new DateTime('today');
  $age = $birthDate->diff($today)->y;

  if (!isset($age_data[$age])) {
    $age_data[$age] = 0;
  }
  $age_data[$age] += $row['jumlah'];
}

ksort($age_data); // Sort age data by age
?>

<div class="row justify-content-center bg-dark">
  <div class="col-ml text-center text-white my-3">
    <h3>Dashboard Khitan Umum</h3>
    <h6>Pengajian Pitulasan Masjid Al-Aqsha Menara Kudus</h6>
    <h6>1446 H / 2024 TU</h6>
  </div>
</div>

<div class="container mt-5 mb-5">
  <div class="row justify-content-center align-middle">
    <div class="col-md-10">

    <!-- Kalkulasi Pendaftar -->
      <div class="table-responsive mb-5">
        <h3>Kalkulasi Pendaftar</h3>
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
            <?php
            $current_admin = '';
            foreach ($data as $row) {
              if ($current_admin !== $row['is_admin']) {
                if ($current_admin !== '') {
                  echo '<tr><td colspan="2" class="text-center align-middle">Total</td>';
                  echo "<td>{$total_pendaftar}</td><td>{$total_diterima}</td><td>{$total_ditolak}</td><td>{$total_pending}</td></tr>";
                }
                $current_admin = $row['is_admin'];
                $admin_label = $current_admin ? 'Admin' : 'User';
                echo "<tr><td rowspan='2' class='text-center align-middle'>{$admin_label}</td>";
              }
              echo "<td>{$row['kabupaten']}</td>";
              echo "<td>{$row['jumlah']}</td>";
              echo "<td>" . ($row['status'] == 'Diterima' ? $row['jumlah'] : '') . "</td>";
              echo "<td>" . ($row['status'] == 'Ditolak' ? $row['jumlah'] : '') . "</td>";
              echo "<td>" . ($row['status'] == 'Pending' ? $row['jumlah'] : '') . "</td>";
              echo "</tr>";
            }
            ?>
            <tr>
              <td colspan="2" class="text-center align-middle">Jumlah</td>
              <td><?= $total_pendaftar; ?></td>
              <td><?= $total_diterima; ?></td>
              <td><?= $total_ditolak; ?></td>
              <td><?= $total_pending; ?></td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- Akhir Kalkulasi Pendaftar -->

      <!-- Usia Pendaftar -->
      <div class="table-responsive mb-5">
        <h3>Usia Pendaftar</h3>
        <table id="usia" class="table table-bordered table-responsive table-hover">
          <thead class="table-dark">
            <tr>
              <th>Usia</th>
              <th>Jumlah</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($age_data as $age => $jumlah) {
              echo "<tr>";
              echo "<td>{$age}</td>";
              echo "<td>{$jumlah}</td>";
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
      <!-- Akhir Usia Pendaftar -->

      <!-- Alamat Pendaftar -->
      <div class="table-responsive">
        <h3>Alamat Pendaftar</h3>
        <table id="alamat" class="table table-bordered table-responsive table-hover">
          <thead class="table-dark">
            <tr>
              <th>Provinsi</th>
              <th>Kabupaten/Kota</th>
              <th>Kecamatan</th>
              <th>Desa/Kelurahan</th>
              <th>Jumlah</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($data as $row) {
              echo "<tr>";
              echo "<td>{$row['provinsi']}</td>";
              echo "<td>{$row['kabupaten']}</td>";
              echo "<td>{$row['kecamatan']}</td>";
              echo "<td>{$row['desa']}</td>";
              echo "<td>{$row['jumlah']}</td>";
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
      <!-- Akhir Alamat Pendaftar -->

    </div>
  </div>
</div>

<?php
require_once 'footer.php';
?>