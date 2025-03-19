<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>

    <!-- Favicon -->
    <link rel="icon" href="assets/images/icon_khitan_umum.png" type="image/x-icon">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/adminlte/plugins/fontawesome-free/css/all.min.css">

    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="assets/adminlte/dist/css/adminlte.min.css?v=3.2.0">

    <!-- Font IBM Plex Sans -->
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'IBM Plex Sans', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: #f5f6fa;
            font-size: 14px;
            font-weight: 400;
        }

        .form-control {
            font-size: 14px !important;
        }

        .content-wrapper {
            flex: 1;
        }

        h3 {
            color: #2D3C28;
            font-weight: bolder;
            font-size: 1.75rem;
        }

        h4 {
            color: #2D3C28;
            font-size: 1.5rem;
        }

        h5 {
            color: #2D3C28;
            font-size: 1.25rem;
        }

        h6 {
            color: #2D3C28;
            font-size: 1rem;
        }

        .card-outline.card-primary {
            border-color: #2D3C28;
        }

        .btn-primary {
            background-color: #2D3C28;
            border-color: #2D3C28;
        }

        .btn-primary:hover {
            background-color: #1e2a1b;
            border-color: #1e2a1b;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h2"><b>Login</b></a>
            </div>
            <div class="card-body">
                <h6 class="login-box-msg">Masukkan username & password</h6>

                <!-- Alert untuk pesan sukses/error -->
                <?php
                if (isset($_GET['message'])) {
                    echo "<div class='alert alert-success'>" . htmlspecialchars($_GET['message']) . "</div>";
                }

                if (isset($_GET['error'])) {
                    echo "<div class='alert alert-danger'>" . htmlspecialchars($_GET['error']) . "</div>";
                }
                ?>

                <!-- Tampilkan pesan sukses atau error -->
                <?php if (isset($_SESSION['error'])) : ?>
                    <div class="alert alert-danger"><?= $_SESSION['error']; ?></div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <form action="config/login.php" method="POST" class="needs-validation" novalidate>
                    <!-- Username -->
                    <div class="input-group mb-3">
                        <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan username" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <div class="invalid-feedback">Masukkan username.</div>
                    </div>

                    <!-- Password -->
                    <div class="input-group mb-3">
                        <input type="password" id="password" name="password" class="form-control password" placeholder="Masukkan password" required>
                        <div class="input-group-append">
                            <div class="input-group-text" onclick="togglePasswordVisibility('password', this)">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <div class="invalid-feedback">Password harus diisi minimal 8 karakter.</div>
                    </div>

                    <!-- Checkbox Remember Me -->
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="rememberMe" name="rememberMe">
                                <label for="rememberMe">Ingat Saya</label>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                    </div>
                </form>

                <!-- <p class="mb-0 text-center">Belum punya akun?
                    <a href="register.php" class="text-center">Daftar</a>
                </p> -->
            </div>
        </div>
    </div>

    <script src="assets/adminlte/plugins/jquery/jquery.min.js"></script>
    <script src="assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/adminlte/dist/js/adminlte.min.js?v=3.2.0"></script>

    <script>
        // Validasi form
        (() => {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')
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
                icon.querySelector('span').classList.replace('fa-lock', 'fa-unlock');
            } else {
                input.type = "password";
                icon.querySelector('span').classList.replace('fa-unlock', 'fa-lock');
            }
        }
    </script>
</body>

</html>