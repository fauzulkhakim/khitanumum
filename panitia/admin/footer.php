<?php
// Menentukan halaman aktif
$current_page = basename($_SERVER['PHP_SELF']);
$user_role = $_SESSION['user']['role'] ?? null;
?>

</div>
</div>
</div>

<nav class="navbar navbar-expand navbar-light navbar-bottom">
  <div class="container-fluid">
    <ul class="navbar-nav mx-auto">
      <!-- Home -->
      <li class="nav-item">
        <a class="nav-link <?= ($current_page == 'dashboard.php') ? 'active' : ''; ?>" href="dashboard.php">
          <i class="fas fa-home text-center d-block"></i>
          <span>Home</span>
        </a>
      </li>

      <!-- Pendaftar (Hanya untuk master dan admin) -->
      <?php if (in_array($user_role, ['master', 'admin'])) : ?>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'pendaftar.php') ? 'active' : ''; ?>" href="pendaftar.php">
            <i class="fas fa-users text-center d-block"></i>
            <span>Pendaftar</span>
          </a>
        </li>
      <?php endif; ?>

      <!-- Pengaturan (Hanya untuk master) -->
      <?php if ($user_role == 'master') : ?>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == 'pengaturan.php') ? 'active' : ''; ?>" href="pengaturan.php">
            <i class="fas fa-cogs text-center d-block"></i>
            <span>Setting</span>
          </a>
        </li>
      <?php endif; ?>

      <!-- Logout (Tampil untuk semua role) -->
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

<!-- Tambahan untuk modal -->
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

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
  $(document).ready(function() {
    $('#pendaftar').DataTable();

    $('#imageModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget);
      var images = button.data('images');
      var modal = $(this);
      var modalImages = modal.find('#modalImages');
      modalImages.empty();
      if (images.length > 0) {
        images.forEach(function(image) {
          if (image.file) {
            modalImages.append('<div class="col-md-6 mb-3"><label>' + image.label + '</label><img src="../dokumen/' + image.file + '" class="img-fluid rounded" onerror="this.onerror=null;this.src=\'../assets/image-not-found.png\';"></div>');
          }
        });
      } else {
        modalImages.append('<p>Tidak ada gambar tersedia.</p>');
      }
    });

    $('#infoModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget);
      var info = button.data('info');
      var modal = $(this);
      var modalInfoContent = modal.find('#modalInfoContent');
      modalInfoContent.empty();
      for (var key in info) {
        if (info.hasOwnProperty(key)) {
          modalInfoContent.append('<p><strong>' + key + ':</strong> ' + info[key] + '</p>');
        }
      }
    });
  });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.status-dropdown').forEach(function(dropdown) {
      dropdown.addEventListener('change', function() {
        const pendaftarId = this.getAttribute('data-id');
        const statusId = this.value;

        fetch('../config/update_status.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `id=${pendaftarId}&status=${statusId}`
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              alert('Status berhasil diubah');
              location.reload();
            } else {
              alert('Gagal mengubah status: ' + data.error);
            }
          })
          .catch(error => console.error('Error:', error));
      });
    });
  });
</script>

<!-- Akhir Halaman Pendaftar -->

<!-- Halaman Pengaturan -->
<script>
  function showButton(formId) {
    document.getElementById('button' + formId.charAt(4).toUpperCase() + formId.slice(5)).classList.remove('d-none');
  }
</script>

<script>
  $(document).ready(function() {
    $('#usersTable').DataTable({
      info: false,
      ordering: false,
      paging: false
    });
  });
</script>

<script>
  document.querySelectorAll('.role-dropdown').forEach(item => {
    item.addEventListener('change', event => {
      const userId = event.target.getAttribute('data-id');
      const newRole = event.target.value;

      fetch('../config/update_role.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            id: userId,
            role: newRole
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            alert('Role berhasil diperbarui');
            location.reload(); // Reload the page
          } else {
            alert('Kesalahan saat memperbarui role: ' + data.error);
          }
        })
        .catch(error => console.error('Error:', error));
    });
  });
</script>

<script>
  document.querySelectorAll('.akses-toggle').forEach(item => {
    item.addEventListener('change', event => {
      const userId = event.target.getAttribute('data-id');
      const newAkses = event.target.checked ? 1 : 0;

      fetch('../config/update_akses.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            id: userId,
            akses: newAkses
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            alert('Hak akses berhasil diperbarui');
            location.reload(); // Reload the page
          } else {
            alert('Gagal memperbarui hak akses: ' + data.error);
          }
        })
        .catch(error => console.error('Error:', error));
    });
  });
</script>
<!-- Akhir Halaman Pengaturan -->

</body>

</html>