<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>

    <!-- Favicon -->
    <link rel="icon" href="assets/icon_khitan_umum.png" type="image/x-icon">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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
            background: #3C5B6F;
        }

        .container {
            max-width: 370px;
            width: 100%;
        }

        .card {
            border-radius: 8px;
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
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="card p-4">
            <header class="mb-4 text-center">Login</header>
            <?php if (isset($_SESSION['error'])) : ?>
                <div class="alert alert-danger"><?= $_SESSION['error']; ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
            <form action="config/login.php" method="POST" class="needs-validation" novalidate>

                <!-- Username -->
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan username" required>
                    <div class="invalid-feedback">Masukkan username.</div>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" id="password" name="password" class="form-control password" placeholder="Masukkan password" minlength="8" required>
                        <span class="input-group-text" onclick="togglePasswordVisibility('password', this)">
                            <i class="bx bx-hide"></i>
                        </span>
                        <div class="invalid-feedback">Password harus diisi minimal 8 karakter.</div>
                    </div>
                </div>

                <!-- Checkbox Remember Me -->
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
                    <label class="form-check-label" for="rememberMe">Ingat Saya</label>
                </div>

                <!-- Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Login</button>
                    <!-- Belum punya akun? Daftar -->
                    <p class="text-center mt-3">Belum punya akun? <a href="register.php">Daftar</a></p>
                </div>
            </form>
        </div>
    </div>

    <script>
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
    </script>
</body>

</html>