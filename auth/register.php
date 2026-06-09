<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - SAPARASA</title>
    <link rel="stylesheet" href="../assets/css/style-auth.css">
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
</head>
<body>
    <a href="../index.php" class="back-to-home">← Kembali ke Beranda</a>

    <div class="auth-bg-pattern"></div>

    <div class="container d-flex justify-content-center align-items-center py-5">
        <div class="auth-card">
            <div class="text-center">
                <a href="../index.php" style="text-decoration: none;">
                    <span class="brand-title">SAPARASA</span>
                    <span class="brand-sub">Kuliner Saparua Bandung</span>
                </a>
                <h4 class="fw-bold mt-4 mb-1" style="font-family: 'Playfair Display', serif;">Gabung Bersama Kami</h4>
                <p class="text-muted small mb-4">Daftarkan akun baru Anda untuk bergabung bersama kami</p>
            </div>

            <form action="#" method="POST">
                <div class="mb-3">
                    <label for="fullName" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="fullName" placeholder="Masukkan nama lengkap" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Alamat Email</label>
                    <input type="email" class="form-control" id="email" placeholder="nama@email.com" required>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Kata Sandi</label>
                        <div class="position-relative">
                            <input type="password" class="form-control pe-5" id="password" placeholder="••••••••" required>
                            <button type="button" class="btn password-toggle-btn" onclick="togglePassword('password', this)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="eye-icon">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="eye-off-icon d-none">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="confirmPassword" class="form-label">Konfirmasi Sandi</label>
                        <div class="position-relative">
                            <input type="password" class="form-control pe-5" id="confirmPassword" placeholder="••••••••" required>
                            <button type="button" class="btn password-toggle-btn" onclick="togglePassword('confirmPassword', this)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="eye-icon">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="eye-off-icon d-none">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>


                <button type="submit" class="btn-auth-primary mb-3">Daftar Akun</button>

                <div class="text-center mt-3">
                    <p class="small text-muted mb-0">Sudah memiliki akun? <a href="login.php" class="auth-link">Masuk Di Sini</a></p>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);
            const eyeIcon = button.querySelector('.eye-icon');
            const eyeOffIcon = button.querySelector('.eye-off-icon');
            
            if (input.type === 'password') {
                input.type = 'text';
                eyeIcon.classList.add('d-none');
                eyeOffIcon.classList.remove('d-none');
            } else {
                input.type = 'password';
                eyeIcon.classList.remove('d-none');
                eyeOffIcon.classList.add('d-none');
            }
        }
    </script>
</body>
</html>