<?php
require_once '../assets/layouts/header.php';

// Pastikan variabel $conn terdefinisi
global $conn;

// Query untuk mendapatkan data pendaftar berdasarkan status dan lokasi
$query = "
SELECT
    p.is_admin,
    CASE
        WHEN p.domisili_regencies_id = 3319 THEN 'KUDUS'
        ELSE 'LUAR KUDUS'
    END AS lokasi,
    s.nama_status_pendaftaran AS status,
    p.tanggal_lahir,
    COUNT(p.id) AS jumlah,
    prov.name_provinces AS provinsi,
    r.name_regencies AS kabupaten,
    d.name_districts AS kecamatan,
    v.name_villages AS desa
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
    p.is_admin, lokasi, s.nama_status_pendaftaran, prov.name_provinces, r.name_regencies, d.name_districts, v.name_villages
ORDER BY
    p.is_admin, lokasi, s.nama_status_pendaftaran";

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
$total_belum = 0;

$summary_data = [
  'User' => [
    'KUDUS' => ['pendaftar' => 0, 'belum' => 0, 'diterima' => 0, 'ditolak' => 0, 'pending' => 0],
    'LUAR KUDUS' => ['pendaftar' => 0, 'belum' => 0, 'diterima' => 0, 'ditolak' => 0, 'pending' => 0]
  ],
  'Admin' => [
    'KUDUS' => ['pendaftar' => 0, 'belum' => 0, 'diterima' => 0, 'ditolak' => 0, 'pending' => 0],
    'LUAR KUDUS' => ['pendaftar' => 0, 'belum' => 0, 'diterima' => 0, 'ditolak' => 0, 'pending' => 0]
  ]
];

$age_data = []; // Inisialisasi dengan array kosong

foreach ($data as $row) {
  $admin_label = ($row['is_admin'] == 1) ? 'Admin' : 'User';
  $lokasi = $row['lokasi'];

  $summary_data[$admin_label][$lokasi]['pendaftar'] += $row['jumlah'];

  if ($row['status'] == 'Diterima') {
    $summary_data[$admin_label][$lokasi]['diterima'] += $row['jumlah'];
  } elseif ($row['status'] == 'Ditolak') {
    $summary_data[$admin_label][$lokasi]['ditolak'] += $row['jumlah'];
  } elseif ($row['status'] == 'Pending') {
    $summary_data[$admin_label][$lokasi]['pending'] += $row['jumlah'];
  } elseif ($row['status'] == 'Belum Verifikasi') {
    $summary_data[$admin_label][$lokasi]['belum'] += $row['jumlah'];
  }

  $total_pendaftar += $row['jumlah'];
  if ($row['status'] == 'Diterima') {
    $total_diterima += $row['jumlah'];
  } elseif ($row['status'] == 'Ditolak') {
    $total_ditolak += $row['jumlah'];
  } elseif ($row['status'] == 'Pending') {
    $total_pending += $row['jumlah'];
  } elseif ($row['status'] == 'Belum Verifikasi') {
    $total_belum += $row['jumlah']; // Track total "Belum Verifikasi"
  }

  // Calculate age
  $birthDate = new DateTime($row['tanggal_lahir']);
  $today = new DateTime('today');
  $age = $birthDate->diff($today)->y;

  if (!isset($age_data[$age])) {
    $age_data[$age] = 0;
  }
  $age_data[$age] += $row['jumlah'];
}

// Mengelompokkan data umur dan menghitung jumlah
ksort($age_data); // Sort age data by age

// Mengelompokkan data alamat dan menghitung jumlah
$address_data = [];
foreach ($data as $row) {
  $address_key = $row['provinsi'] . '|' . $row['kabupaten'] . '|' . $row['kecamatan'] . '|' . $row['desa'];
  if (!isset($address_data[$address_key])) {
    $address_data[$address_key] = [
      'provinsi' => $row['provinsi'],
      'kabupaten' => $row['kabupaten'],
      'kecamatan' => $row['kecamatan'],
      'desa' => $row['desa'],
      'jumlah' => 0
    ];
  }
  $address_data[$address_key]['jumlah'] += $row['jumlah'];
}

?>
<div class="row justify-content-center">
  <div class="col-ml text-center mt-4 mb-4">
    <h3>Dashboard</h3>
    <h6>Pengajian Pitulasan Masjid Al-Aqsha Menara Kudus</h6>
    <h6>1447 H / 2025 TU</h6>
  </div>
</div>


  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="row justify-content-center align-middle">
        <div class="col-md-11">
          <div class="row">
            <div class="col-md-6">
              <!-- Kalkulasi Pendaftar -->
              <div class="card mb-5">
                <div class="card-header">
                  <h5>Kalkulasi Pendaftar</h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                      <thead class="table-dark">
                        <tr>
                          <th class="text-center align-middle">Daftar Oleh</th>
                          <th class="text-center align-middle">Daerah</th>
                          <th class="text-center align-middle">Pendaftar</th>
                          <th class="text-center align-middle">Belum Verifikasi</th>
                          <th class="text-center align-middle">Diterima</th>
                          <th class="text-center align-middle">Ditolak</th>
                          <th class="text-center align-middle">Pending</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($summary_data as $admin_label => $locations) : ?>
                          <tr>
                            <td rowspan="2" class="text-center align-middle"><?= $admin_label ?></td>
                            <td>KUDUS</td>
                            <td><?= $locations['KUDUS']['pendaftar'] ?></td>
                            <td><?= $locations['KUDUS']['belum'] ?></td>
                            <td><?= $locations['KUDUS']['diterima'] ?></td>
                            <td><?= $locations['KUDUS']['ditolak'] ?></td>
                            <td><?= $locations['KUDUS']['pending'] ?></td>
                          </tr>
                          <tr>
                            <td>LUAR KUDUS</td>
                            <td><?= $locations['LUAR KUDUS']['pendaftar'] ?></td>
                            <td><?= $locations['LUAR KUDUS']['belum'] ?></td>
                            <td><?= $locations['LUAR KUDUS']['diterima'] ?></td>
                            <td><?= $locations['LUAR KUDUS']['ditolak'] ?></td>
                            <td><?= $locations['LUAR KUDUS']['pending'] ?></td>
                          </tr>
                        <?php endforeach; ?>
                        <tr>
                          <td colspan="2" class="text-center align-middle">Jumlah</td>
                          <td><?= $total_pendaftar; ?></td>
                          <td><?= $total_belum; ?></td>
                          <td><?= $total_diterima; ?></td>
                          <td><?= $total_ditolak; ?></td>
                          <td><?= $total_pending; ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- Akhir Kalkulasi Pendaftar -->

              <!-- Usia Pendaftar -->
              <div class="card mb-5">
                <div class="card-header">
                  <h5>Usia Pendaftar</h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="usia" class="table table-bordered table-hover">
                      <thead class="table-dark">
                        <tr>
                          <th>Usia</th>
                          <th>Jumlah</th>
                          <th>Persentase</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($age_data as $age => $jumlah) :
                          $percentage = ($jumlah / $total_pendaftar) * 100;
                        ?>
                          <tr>
                            <td><?= $age ?> tahun</td>
                            <td><?= $jumlah ?></td>
                            <td><?= number_format($percentage, 2) ?>%</td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- Akhir Usia Pendaftar -->
            </div>

            <div class="col-md-6">
              <!-- Alamat Pendaftar -->
              <div class="card">
                <div class="card-header">
                  <h5>Alamat Pendaftar</h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="alamat" class="table table-bordered table-hover">
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
                        <?php foreach ($address_data as $address) : ?>
                          <tr>
                            <td><?= $address['provinsi'] ?></td>
                            <td><?= $address['kabupaten'] ?></td>
                            <td><?= $address['kecamatan'] ?></td>
                            <td><?= $address['desa'] ?></td>
                            <td><?= $address['jumlah'] ?></td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- Akhir Alamat Pendaftar -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
require_once '../assets/layouts/footer.php';
?>