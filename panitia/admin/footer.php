<?php
// Menentukan halaman aktif
$current_page = basename($_SERVER['PHP_SELF']);
?>

</div>
</div>
</div>

<nav class="navbar navbar-expand navbar-light navbar-bottom">
  <div class="container-fluid">
    <ul class="navbar-nav mx-auto">
      <!-- home -->
      <li class="nav-item">
        <a class="nav-link <?= ($current_page == 'dashboard.php') ? 'active' : ''; ?>" href="dashboard.php">
          <i class="fas fa-home text-center d-block"></i>
          <span>Home</span>
        </a>
      </li>
      <!-- pendaftar -->
      <li class="nav-item">
        <a class="nav-link <?= ($current_page == 'pendaftar.php') ? 'active' : ''; ?>" href="pendaftar.php">
          <i class="fas fa-users text-center d-block"></i>
          <span>Pendaftar</span>
        </a>
      </li>
      <!-- setting -->
      <li class="nav-item">
        <a class="nav-link <?= ($current_page == 'pengaturan.php') ? 'active' : ''; ?>" href="pengaturan.php">
          <i class="fas fa-cogs text-center d-block"></i>
          <span>Setting</span>
        </a>
      </li>
      <!-- logout -->
      <li class="nav-item">
        <a class="nav-link" href="../config/logout.php" id="logout-link" onclick="return confirm('Apakah Anda yakin ingin keluar?')">
          <i class="fas fa-sign-out-alt text-center d-block"></i>
          <span>Logout</span>
        </a>
      </li>
    </ul>
  </div>
</nav>

<!-- jQuery Library -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.1.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.2/js/dataTables.bootstrap5.js"></script>
<!-- Font Awesome JS -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<!-- Halaman Dashboard -->
<script>
  $('#usia').DataTable({
    "info": false,
    "searching": false,
    "paging": false
  });
</script>

<script>
  $('#alamat').DataTable({
    "info": false,
    "searching": true,
    "paging": false
  });
</script>
<!-- Akhir Halaman Dashboard -->

<!-- Halaman Pendaftar -->
<script>
  new DataTable('#pendaftar');
</script>
<!-- Akhir Halaman Pendaftar -->

<!-- Halaman Pengaturan -->
<script>
  $(document).ready(function() {
    $('#usersTable').DataTable({
      info: false,
      ordering: false,
      paging: false
    });
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
<!-- Akhir Halaman Pengaturan -->

</body>

</html>