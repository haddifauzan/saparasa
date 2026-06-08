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
                        <input type="password" class="form-control" id="password" placeholder="••••••••" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="confirmPassword" class="form-label">Konfirmasi Sandi</label>
                        <input type="password" class="form-control" id="confirmPassword" placeholder="••••••••" required>
                    </div>
                </div>


                <button type="submit" class="btn-auth-primary mb-3">Daftar Akun</button>

                <div class="text-center mt-3">
                    <p class="small text-muted mb-0">Sudah memiliki akun? <a href="login.php" class="auth-link">Masuk Di Sini</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>