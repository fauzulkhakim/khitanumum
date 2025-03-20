</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Main Footer -->
<footer class="main-footer mt-auto">
  <!-- To the right -->
  <div class="float-right d-none d-sm-inline">
    Versi 1.0
  </div>
  <!-- Default to the left -->
  <strong>Copyright &copy; 2025 Khitan Umum</strong>
</footer>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../assets/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../assets/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.3.0/js/dataTables.fixedColumns.min.js"></script>
<script src="https://cdn.datatables.net/2.1.2/js/dataTables.bootstrap5.js"></script>
<!-- DataTables Responsive JS -->
<script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
<!-- select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/adminlte/dist/js/adminlte.js"></script>
<!-- JsBarcode -->
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
<!-- bs-custom-file-input -->
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
<!-- icheck -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.css" integrity="sha512-J5tsMaZISEmI+Ly68nBDiQyNW6vzBoUlNHGsH8T3DzHTn2h9swZqiMeGm/4WMDxAphi5LMZMNA30LvxaEPiPkg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
<!-- Preview Dokumen -->
<script>
  $(document).ready(function() {
    $('#pendaftar').DataTable({
      responsive: true,
      autoWidth: false,
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
</script>

<!-- Update Status -->
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