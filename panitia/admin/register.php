<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Icon -->
    <link rel="icon" href="../assets/icon_khitan_umum.png" type="image/x-icon">

    <!-- boxicon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #4070f4;
        }

        .container {
            max-width: 370px;
            width: 100%;
        }

        .card {
            border-radius: 12px;
            background-color: #fff;
        }

        header {
            font-size: 22px;
            font-weight: 600;
            color: #333;
        }

        .form-label {
            font-weight: 500;
        }

        .input-group-text {
            cursor: pointer;
        }

        .invalid-feedback {
            display: none;
        }

        .is-invalid+.invalid-feedback {
            display: block;
        }

        .input-group .form-control {
            border-right: none;
        }

        .input-group .input-group-text {
            background-color: transparent;
            border-left: none;
        }
    </style>
</head>

<body>
    <div class="container mt-5 mb-5">
        <div class="card p-4">
            <header class="mb-4 text-center">Daftar</header>
            <?php if (isset($_SESSION['error'])) : ?>
                <div class="alert alert-danger"><?= $_SESSION['error']; ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
            <form action="../config/register.php" method="POST" class="needs-validation" novalidate>
                <!-- Nama Lengkap -->
                <div class="mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" placeholder="" required>
                    <div class="invalid-feedback">Nama lengkap harus diisi.</div>
                </div>
                <!-- Username -->
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="" minlength="4" required>
                    <div class="invalid-feedback">Username harus diisi minimal 4 karakter.</div>
                </div>
                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" id="password" name="password" class="form-control password" placeholder="" minlength="8" required>
                        <span class="input-group-text" onclick="togglePasswordVisibility('password', this)">
                            <i class="bx bx-hide"></i>
                        </span>
                        <div class="invalid-feedback">Password harus diisi minimal 8 karakter.</div>
                    </div>
                </div>
                <!-- Konfirmasi Password -->
                <div class="mb-3">
                    <label for="cPassword" class="form-label">Konfirmasi Password</label>
                    <div class="input-group">
                        <input type="password" id="cPassword" class="form-control cPassword" placeholder="" required>
                        <span class="input-group-text" onclick="togglePasswordVisibility('cPassword', this)">
                            <i class="bx bx-hide"></i>
                        </span>
                        <div class="invalid-feedback">Password tidak cocok.</div>
                    </div>
                </div>
                <!-- Nomor HP -->
                <div class="mb-3">
                    <label for="no_hp" class="form-label">Nomor HP</label>
                    <input type="tel" id="no_hp" name="no_hp" class="form-control" placeholder="" minlength="11" pattern="\d*" required>
                    <div class="invalid-feedback">Nomor HP harus diisi minimal 11 angka.</div>
                </div>
                <!-- Alamat -->
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" id="alamat" name="alamat" class="form-control" placeholder="" required>
                    <div class="invalid-feedback">Alamat harus diisi.</div>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Daftar</button>
                    <!-- Sudah punya akun? Login -->
                    <p class="text-center mt-3">Sudah punya akun? <a href="index.php">Login</a></p>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Validasi form
        (() => {
            'use strict'

            // Ambil semua form yang ingin diterapkan validasi Bootstrap
            const forms = document.querySelectorAll('.needs-validation')

            // Loop melalui mereka dan mencegah pengiriman
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })();

        // Fungsi untuk menampilkan/menyembunyikan password
        function togglePasswordVisibility(id, icon) {
            const input = document.getElementById(id);
            if (input.type === "password") {
                input.type = "text";
                icon.querySelector('i').classList.replace('bx-hide', 'bx-show');
            } else {
                input.type = "password";
                icon.querySelector('i').classList.replace('bx-show', 'bx-hide');
            }
        }

        // Validasi Konfirmasi Password
        document.querySelector("form").addEventListener("submit", function(e) {
            const password = document.getElementById("password").value;
            const cPassword = document.getElementById("cPassword").value;

            if (password !== cPassword) {
                e.preventDefault();
                document.getElementById("cPassword").classList.add("is-invalid");
            } else {
                document.getElementById("cPassword").classList.remove("is-invalid");
            }
        });
    </script>
</body>

</html>