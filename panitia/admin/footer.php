<?php
// Menentukan halaman aktif
$current_page = basename($_SERVER['PHP_SELF']);
$user_role = $_SESSION['user']['role'] ?? null;
?>

</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Main Footer -->
<footer class="main-footer">
  <div class="float-right d-none d-sm-inline">
    Anything you want
  </div>
  <strong>Copyright &copy; 2025 <a href="#">Your Company</a>.</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../assets/adminlte3/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../assets/adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../assets/adminlte3/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/adminlte3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../assets/adminlte3/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../assets/adminlte3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../assets/adminlte3/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../assets/adminlte3/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../assets/adminlte3/plugins/jszip/jszip.min.js"></script>
<script src="../assets/adminlte3/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../assets/adminlte3/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../assets/adminlte3/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../assets/adminlte3/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../assets/adminlte3/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Select2 -->
<script src="../assets/adminlte3/plugins/select2/js/select2.full.min.js"></script>
<!-- ChartJS -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- AdminLTE App -->
<script src="../assets/adminlte3/dist/js/adminlte.min.js"></script>

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
    $('#pendaftar').DataTable({
      "scrollX": true,
      "fixedColumns": {
        "leftColumns": 3 // Jumlah kolom yang ingin Anda bekukan dari sisi kiri
      },
      stateSave: true,
      stateSaveCallback: function(settings, data) {
        console.log('State is being saved:', data);
        localStorage.setItem('dataTableState', JSON.stringify(data));
      },
      stateLoadCallback: function(settings) {
        var state = localStorage.getItem('dataTableState');
        console.log('State is being loaded:', JSON.parse(state));
        return JSON.parse(state);
      }
    });

    $('#imageModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget);
      var images = button.data('images');
      var modal = $(this);
      var modalImages = modal.find('#modalImages');
      modalImages.empty();
      if (images.length > 0) {
        images.forEach(function(image) {
          if (image.file) {
            modalImages.append('<div class="col-md-6 mb-3"><label>' + image.label + '</label><a href="../dokumen/' + image.file + '" target="_blank"><img src="../dokumen/' + image.file + '" class="img-fluid rounded" onerror="this.onerror=null;this.src=\'../assets/image-not-found.png\';"></a></div>');
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

<!-- Resend Status-->
<script>
  $(document).ready(function() {
    $('.buttonStatus').click(function() {
      var id = $(this).data('id');

      $.ajax({
        url: '../config/resend_status.php',
        type: 'POST',
        data: {
          id: id
        },
        success: function(response) {
          alert(response.message);
        }
      });
    });
  });
</script>

<!-- Resend Undangan-->
<script>
  $(document).ready(function() {
    $('.buttonUndangan').click(function() {
      var id = $(this).data('id');

      $.ajax({
        url: '../config/resend_undangan.php',
        type: 'POST',
        data: {
          id: id
        },
        success: function(response) {
          alert(response.message);
        }
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