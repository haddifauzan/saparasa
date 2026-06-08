<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - SAPARASA</title>
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
                <a href="../index.php" class="tex-decoration-none" style="text-decoration: none;">
                    <span class="brand-title">SAPARASA</span>
                    <span class="brand-sub">Kuliner Saparua Bandung</span>
                </a>

                <h4 class="fw-bold mt-4 mb-1" style="font-family: 'Playfair Display', serif;">Selamat Datang Kembali</h4>
                <p class="text-muted small mb-4">Silahkan masuk menggunakan akun Anda</p>
            </div>

            <!-- FORM LOGIN -->
            <form action="#" method="POST">
                <div class="mb-3">
                    <label for="" class="form-label">Alamat Email</label>
                    <input type="email" class="form-control" placeholder="Masukkan alamat email" required>
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label for="password" class="form-label mb-0">Kata Sandi</label>
                        <a href="#" class="auth-link small fw-normal text-muted">Lupa Sandi?</a>
                    </div>
                    <input type="password" class="form-control" id="password" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn-auth-primary mb-3">Masuk</button>

                <div class="text-center mt-3">
                    <p class="small text-muted mb-0">Belum punya akun? <a href="register.php" class="auth-link">Daftar Sekarang</a></p>
                </div>
            </form>
        </div>
    </div>
    
    <!-- JavaScript -->
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>