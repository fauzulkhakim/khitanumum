            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <!-- Page content goes here -->
                </div>
            </div>
            </div>
            <!-- Main Footer -->
            <footer class="main-footer">
                <!-- To the right -->
                <div class="float-right d-none d-sm-inline">
                    Versi 1.0
                </div>
                <!-- Default to the left -->
                <strong>Copyright &copy; 2024 Khitan Umum</strong>
            </footer>
            </div>
            <!-- ./wrapper -->

            <!-- REQUIRED SCRIPTS -->
            <!-- jQuery -->
            <script src="panitia/assets/adminlte/plugins/jquery/jquery.min.js"></script>
            <!-- select2 -->
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
            <!-- Bootstrap 4 -->
            <script src="panitia/assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
            <!-- AdminLTE App -->
            <script src="panitia/assets/adminlte/dist/js/adminlte.min.js"></script>
            <!-- SweetAlert2 -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>
            <!-- bs-custom-file-input -->
            <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
            <!-- icheck -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.css" integrity="sha512-J5tsMaZISEmI+Ly68nBDiQyNW6vzBoUlNHGsH8T3DzHTn2h9swZqiMeGm/4WMDxAphi5LMZMNA30LvxaEPiPkg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

            <!-- SCRIPT HALAMAN PENDAFTARAN -->
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
                document.addEventListener('DOMContentLoaded', () => {
                    // Data kabupaten untuk tempat lahir
                    fetchTempatLahir();
                    // Tampilkan tanggal sesuai
                    tanggalLahir();
                    // Data provinsi untuk alamat
                    fetchProvinces();
                });

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
                    fetch('panitia/config/tempat_lahir.php')
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
                    fetch('panitia/config/provinces.php')
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

                    fetch('panitia/config/regencies.php?id=' + provinsiId)
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

                    fetch('panitia/config/districts.php?id=' + kabupatenId)
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

                    fetch('panitia/config/villages.php?id=' + kecamatanId)
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
            <!-- SCRIPT HALAMAN PENDAFTARAN SELESAI -->
             
            </body>

            </html>