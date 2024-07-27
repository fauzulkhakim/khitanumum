<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: index.php");
  exit();
}
require '../config/config.php';

// Fetch all users
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

require_once 'header.php';
?>

<div class="row justify-content-center">
  <div class="col-ml text-center ml-3">
    <h5>Pengaturan Khitan Umum 1446 H / 2024 TU</h5>
  </div>
</div>

<div class="container my-5">
  <div class="table-responsive mt-5">
    <table id="usersTable" class="table table-bordered table-hover table-striped">
      <thead class="table-dark">
        <tr>
          <th>No</th>
          <th>Nama Lengkap</th>
          <th>Username</th>
          <th>Role</th>
          <th>Akses</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        while ($user = $result->fetch_assoc()) : ?>
          <tr>
            <td><?= $no; ?></td>
            <td><?= $user['nama_lengkap']; ?></td>
            <td><?= $user['username']; ?></td>
            <td>
              <div class="form-check form-switch">
                <input class="form-check-input admin-toggle" type="checkbox" role="switch" id="admin-<?= $user['id'] ?>" <?= $user['role'] == 'admin' ? 'checked' : '' ?> data-id="<?= $user['id'] ?>">
              </div>
            </td>
            <td>
              <div class="form-check form-switch">
                <input class="form-check-input akses-toggle" type="checkbox" role="switch" id="akses-<?= $user['id'] ?>" <?= $user['akses'] ? 'checked' : '' ?> data-id="<?= $user['id'] ?>">
              </div>
            </td>
          </tr>
        <?php $no++;
        endwhile; ?>
      </tbody>
    </table>
  </div>
</div>
</div>

<script>
  $(document).ready(function() {
    $('#usersTable').DataTable();

    $('.admin-toggle').on('change', function() {
      var userId = $(this).data('id');
      var role = $(this).is(':checked') ? 'admin' : 'user';
      updateRole(userId, role);
    });

    $('.akses-toggle').on('change', function() {
      var userId = $(this).data('id');
      var akses = $(this).is(':checked') ? 1 : 0;
      updateAkses(userId, akses);
    });
  });

  function updateRole(id, role) {
    $.ajax({
      type: 'POST',
      url: '../config/update_user.php',
      data: {
        user_id: id,
        role: role
      },
      success: function(response) {
        if (response == 1) {
          alert('Role telah diupdate');
        } else {
          alert('Terjadi kesalahan saat mengupdate role');
        }
      }
    });
  }

  function updateAkses(id, akses) {
    $.ajax({
      type: 'POST',
      url: '../config/update_user.php',
      data: {
        user_id: id,
        akses: akses
      },
      success: function(response) {
        if (response == 1) {
          alert('Akses telah diupdate');
        } else {
          alert('Terjadi kesalahan saat mengupdate akses');
        }
      }
    });
  }
</script>

<?php
require_once 'footer.php';
?>