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
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/3.3.0/js/dataTables.fixedColumns.min.js"></script>

<!-- DataTables Buttons -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

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
      },
      dom: 'Bfrtip',
      buttons: [
        "copy",
        "csv",
        {
          extend: 'excel',
          title: 'Data Pendaftar'
        },
        {
          extend: 'pdf',
          title: 'Data Pendaftar'
        },
        {
          extend: 'print',
          title: 'Data Pendaftar',
          customize: function(win) {
            $(win.document.body).find('h1').remove();
            $(win.document.body).find('table').addClass('table table-bordered table-striped');
            $(win.document.body).css('font-size', '12pt');
          }
        }
      ],
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

<script>
  $(document).ready(function() {
    // Resend Status
    $('.buttonStatus').click(function(e) {
      e.preventDefault(); // Mencegah aksi default tombol
      const id = $(this).data('id');
      const confirmAction = confirm('Apakah Anda yakin ingin mengirim ulang status pendaftaran?');
      if (!confirmAction) {
        return; // Jika konfirmasi dibatalkan, hentikan eksekusi
      }

      $.post('../config/resend_status.php', {
        id: id
      }, function(response) {
        if (response.status === 'success') {
          alert(response.message);
        } else {
          alert(response.message);
        }
      }, 'json');
    });

    // Resend Undangan
    $('.buttonUndangan').click(function(e) {
      e.preventDefault(); // Mencegah aksi default tombol
      const id = $(this).data('id');
      const confirmAction = confirm('Apakah Anda yakin ingin mengirim ulang undangan?');
      if (!confirmAction) {
        return; // Jika konfirmasi dibatalkan, hentikan eksekusi
      }

      $.post('../config/resend_undangan.php', {
        id: id
      }, function(response) {
        if (response.status === 'success') {
          alert(response.message);
        } else {
          alert(response.message);
        }
      }, 'json');
    });
  });
</script>
<!-- Akhir Halaman Pendaftar -->

<!-- Awal Halaman Pendaftar Tambah -->

<script>
  document.getElementById('btn-daftar').addEventListener('click', function() {
    // Tampilkan form pendaftaran
    document.getElementById('form-pendaftaran').style.display = 'block';

    // Hilangkan tombol daftar
    document.getElementById('btn-daftar').style.display = 'none';

    // Scroll ke form pendaftaran
    document.getElementById('form-pendaftaran').scrollIntoView({
      behavior: 'smooth'
    });
  });

  // Implementasi select2js
  $(document).ready(function() {
    // Inisialisasi Select2 pada dropdown tempat lahir, provinsi, kabupaten, kecamatan, desa
    $('#tempat_lahir').select2({
      minimumResultsForSearch: 10, // Tampilkan search box hanya jika options lebih dari 10
      width: '100%' // Pastikan lebar 100% untuk menyesuaikan dengan form-control
    });

    $('#provinsi').select2({
      minimumResultsForSearch: 10,
      width: '100%'
    });

    $('#kabupaten_kota').select2({
      minimumResultsForSearch: 10,
      width: '100%'
    });

    $('#kecamatan').select2({
      minimumResultsForSearch: 10,
      width: '100%'
    });

    $('#desa_kelurahan').select2({
      minimumResultsForSearch: 10,
      width: '100%'
    });
  });
</script>

<script>
  //---------------------------------------------------------------------------------------------------------------------------------
  // Menyiapkan data ketika halaman dibuka
  // document.addEventListener('DOMContentLoaded', () => {
  //   // Data kabupaten untuk tempat lahir
  //   fetchTempatLahir();
  //   // Tampilkan tanggal sesuai
  //   tanggalLahir();
  //   // Data provinsi untuk alamat
  //   fetchProvinces();
  // });

  //---------------------------------------------------------------------------------------------------------------------------------
  // Menghubungkan nama depan dan nama belakang
  function updateNamaLengkap() {
    var nama_depan = document.getElementById('nama_depan').value;
    var nama_belakang = document.getElementById('nama_belakang').value;
    document.getElementById('nama_lengkap').value = nama_depan + ' ' + nama_belakang;
  }

  // ---------------------------------------------------------------------------------------------------------------------------------
  // Tempat Lahir => Kabupaten fetch API
  function fetchTempatLahir() {
    fetch('../config/tempat_lahir.php')
      .then(response => response.json())
      .then(data => {

        const kabupatenSelect = document.getElementById('tempat_lahir');
        kabupatenSelect.innerHTML = '<option value="" disabled selected>Pilih</option>'; // Reset options

        data.data.forEach(kabupaten => {
          const option = document.createElement('option');
          option.value = kabupaten.id_regencies;
          option.textContent = kabupaten.name_regencies;
          kabupatenSelect.appendChild(option);
        });
      })
  }


  // --------------------------------------------------------------------------------------------------------------------------------
  // Tanggal lahir => Rentang usia 7 - 15 tahun
  function tanggalLahir() {
    const dateInput = document.getElementById('tanggal_lahir');
    const today = new Date('2024-09-21');

    // Rentang umur yang diizinkan (misalnya, 18 hingga 60 tahun)
    const minAge = 7;
    const maxAge = 15;

    // Menghitung tanggal minimum dan maksimum
    const minDate = new Date(today.getFullYear() - maxAge, today.getMonth(), today.getDate());
    const maxDate = new Date(today.getFullYear() - minAge, today.getMonth(), today.getDate());

    // Mengatur atribut min dan max pada input date
    dateInput.setAttribute('min', minDate.toISOString().split('T')[0]);
    dateInput.setAttribute('max', maxDate.toISOString().split('T')[0]);

    // Mencegah pengetikan manual pada input date
    dateInput.addEventListener('keydown', function(event) {
      event.preventDefault();
    });

  }

  // --------------------------------------------------------------------------------------------------------------------------------
  // Alamat => Provinsi, Kabupaten, Kecamatan dan Desa fetch API
  function fetchProvinces() {
    fetch('../config/provinces.php')
      .then(response => response.json())
      .then(data => {
        const provinsiSelect = document.getElementById('provinsi');
        provinsiSelect.innerHTML = '<option value="" disabled selected>Pilih</option>'; // Reset options

        // Mengakses elemen 'data' dari JSON response
        data.data.forEach(provinsi => {
          const option = document.createElement('option');
          option.value = provinsi.id_provinces;
          option.textContent = provinsi.name_provinces;
          provinsiSelect.appendChild(option);
        });
      })
  }


  function fetchKabupaten() {
    const provinsiId = document.getElementById('provinsi').value;
    if (!provinsiId) return;

    fetch('../config/regencies.php?id=' + provinsiId)
      .then(response => response.json())
      .then(data => {

        const kabupatenSelect = document.getElementById('kabupaten_kota');
        kabupatenSelect.innerHTML = '<option value="" disabled selected>Pilih</option>'; // Reset options

        data.data.forEach(kabupaten => {
          const option = document.createElement('option');
          option.value = kabupaten.id_regencies;
          option.textContent = kabupaten.name_regencies;
          kabupatenSelect.appendChild(option);
        });
      })
  }

  function fetchKecamatan() {
    const kabupatenId = document.getElementById('kabupaten_kota').value;
    if (!kabupatenId) return;

    fetch('../config/districts.php?id=' + kabupatenId)
      .then(response => response.json())
      .then(data => {

        const kecamatanSelect = document.getElementById('kecamatan');
        kecamatanSelect.innerHTML = '<option value="" disabled selected>Pilih</option>'; // Reset options

        data.data.forEach(kecamatan => {
          const option = document.createElement('option');
          option.value = kecamatan.id_districts;
          option.textContent = kecamatan.name_districts;
          kecamatanSelect.appendChild(option);
        });
      })
  }

  function fetchDesa() {
    const kecamatanId = document.getElementById('kecamatan').value;
    if (!kecamatanId) return;

    fetch('../config/villages.php?id=' + kecamatanId)
      .then(response => response.json())
      .then(data => {

        const desaSelect = document.getElementById('desa_kelurahan');
        desaSelect.innerHTML = '<option value="" disabled selected>Pilih</option>'; // Reset options

        data.data.forEach(desa => {
          const option = document.createElement('option');
          option.value = desa.id_villages;
          option.textContent = desa.name_villages;
          desaSelect.appendChild(option);
        });
      })
  }

  // --------------------------------------------------------------------------------------------------------------------------------
  // Tombol radio domisili
  document.addEventListener('DOMContentLoaded', () => {
    const radioButtons = document.querySelectorAll('input[name="domisili"]');
    const dokumenDomisili = document.getElementById('dokumen_domisili');
    const previewDomisili = document.getElementById('preview_domisili');
    const formTextDomisili = document.querySelector('#dokumen_domisili').nextElementSibling;

    // Fungsi untuk memperbarui visibilitas dan atribut required dari bidang dokumen domisili
    function perbaruiBidangDomisili() {
      if (document.getElementById('domisili_ya').checked) {
        // Sembunyikan dan nonaktifkan bidang ketika "Ya" dipilih
        dokumenDomisili.required = false;
        dokumenDomisili.style.display = 'none';
        previewDomisili.style.display = 'none';
        formTextDomisili.style.display = 'none';
      } else if (document.getElementById('domisili_tidak').checked) {
        // Tampilkan dan aktifkan bidang ketika "Tidak" dipilih
        dokumenDomisili.required = true;
        dokumenDomisili.style.display = 'block';
        previewDomisili.style.display = 'block';
        formTextDomisili.style.display = 'block';
      }
    }

    // Inisialisasi visibilitas bidang berdasarkan tombol radio yang dipilih
    perbaruiBidangDomisili();

    // Tambahkan event listener ke tombol radio untuk memperbarui bidang secara dinamis
    radioButtons.forEach(radio => {
      radio.addEventListener('change', perbaruiBidangDomisili);
    });
  });


  // --------------------------------------------------------------------------------------------------------------------------------
  // Preview foto
  // KIA / KK
  document.getElementById('dokumen_kia_kk').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const previewContainer = document.getElementById('preview_kia_kk');

    // Clear previous preview
    previewContainer.innerHTML = '';

    if (file && file.type.startsWith('image/')) {
      const reader = new FileReader();

      reader.onload = function(e) {
        const img = document.createElement('img');
        img.src = e.target.result;
        img.classList.add('rounded', 'img-fluid'); // Add class for styling
        img.style.width = '30%'; // Set width or adjust as needed
        previewContainer.appendChild(img);
      };

      reader.readAsDataURL(file);
    } else {
      document.getElementById('dokumen_kia_kk').value = '';
      alert('Please select a valid image file.');
    }
  });

  // Sekolah
  document.getElementById('dokumen_sekolah').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const previewContainer = document.getElementById('preview_sekolah');

    // Clear previous preview
    previewContainer.innerHTML = '';

    if (file && file.type.startsWith('image/')) {
      const reader = new FileReader();

      reader.onload = function(e) {
        const img = document.createElement('img');
        img.src = e.target.result;
        img.classList.add('rounded', 'img-fluid'); // Add class for styling
        img.style.width = '30%'; // Set width or adjust as needed
        previewContainer.appendChild(img);
      };

      reader.readAsDataURL(file);
    } else {
      document.getElementById('dokumen_sekolah').value = '';
      alert('Please select a valid image file.');
    }
  });

  // Domisili
  document.getElementById('dokumen_domisili').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const previewContainer = document.getElementById('preview_domisili');

    // Clear previous preview
    previewContainer.innerHTML = '';

    if (file && file.type.startsWith('image/')) {
      const reader = new FileReader();

      reader.onload = function(e) {
        const img = document.createElement('img');
        img.src = e.target.result;
        img.classList.add('rounded', 'img-fluid'); // Add class for styling
        img.style.width = '30%'; // Set width or adjust as needed
        previewContainer.appendChild(img);
      };

      reader.readAsDataURL(file);
    } else {
      document.getElementById('dokumen_domisili').value = '';
      alert('Please select a valid image file.');
    }
  });

  // Pendukung
  document.getElementById('dokumen_pendukung').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const previewContainer = document.getElementById('preview_pendukung');

    // Clear previous preview
    previewContainer.innerHTML = '';

    if (file && file.type.startsWith('image/')) {
      const reader = new FileReader();

      reader.onload = function(e) {
        const img = document.createElement('img');
        img.src = e.target.result;
        img.classList.add('rounded', 'img-fluid'); // Add class for styling
        img.style.width = '30%'; // Set width or adjust as needed
        previewContainer.appendChild(img);
      };

      reader.readAsDataURL(file);
    } else {
      document.getElementById('dokumen_pendukung').value = '';
      alert('Please select a valid image file.');
    }
  });

  // --------------------------------------------------------------------------------------------------------------------------------
  // Validasi form
  (() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
  })()
</script>
<!-- Akhir Halaman Pendaftar Tambah -->

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