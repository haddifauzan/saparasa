<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - SAPARASA</title>
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/tentang-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

    <style>
        
    </style>
</head>
<body>

    <nav class="navbar-custom">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between gap-3">
                <a href="index.php" class="text-decoration-none">
                    <span class="name">SAPARASA</span>
                    <span class="sub">Kuliner Saparua Bandung</span>
                </a>
                <div class="d-none d-md-flex align-items-center gap-1">
                    <a href="../index.php#home" class="nav-link-custom">Beranda</a>
                    <a href="daftar-umkm.php" class="nav-link-custom">Daftar UMKM</a>
                    <a href="tentang.php" class="nav-link-custom active" style="background: var(--sapa-green-light); color: var(--sapa-green);">Tentang</a>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="../auth/login.php" class="nav-link-custom d-none d-md-block">Masuk</a>
                    <a href="../auth/register.php" class="btn-nav-cta">Daftar</a>
                </div>
            </div>
        </div>
    </nav>

    <header class="about-header">
        <div class="container">
            <p class="text-success fw-semibold mb-2" style="font-size: 0.85rem; letter-spacing: 1px; text-transform: uppercase;">Mengenal Platform</p>
            <h1 class="about-title">Tentang SAPARASA</h1>
            <div class="divider-green-center"></div>
            <p class="text-muted mx-auto mb-0" style="max-width: 700px; line-height: 1.7; font-size: 0.95rem;">
                SAPARASA merupakan website sistem informasi UMKM berbasis PHP Native dan MySQL yang digunakan untuk menampilkan informasi UMKM di kawasan Saparua Bandung.
            </p>
        </div>
    </header>

    <section class="platform-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 22s1-1 1-4l14-14a3 3 0 0 1 4 4L7 22H2z"></path></svg>
                        </div>
                        <h3 class="feature-title">Eksplorasi UMKM</h3>
                        <p class="text-muted mb-0" style="font-size: 0.88rem; line-height: 1.6;">
                            Memudahkan masyarakat dan wisatawan kuliner untuk menemukan data profil operasional, jam buka-tutup, dan menu unggulan pedagang lokal secara transparan.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                        </div>
                        <h3 class="feature-title">Ulasan Agregat</h3>
                        <p class="text-muted mb-0" style="font-size: 0.88rem; line-height: 1.6;">
                            Didukung fitur penilaian umpan balik (rating & review) yang langsung terintegrasi dengan basis data relasional untuk menjaga reliabilitas kualitas kuliner.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="2.18" ry="2.18"></rect><line x1="7" y1="2" x2="7" y2="22"></line><line x1="17" y1="2" x2="17" y2="22"></line><line x1="2" y1="12" x2="22" y2="12"></line></svg>
                        </div>
                        <h3 class="feature-title">Teknologi Terintegrasi</h3>
                        <p class="text-muted mb-0" style="font-size: 0.88rem; line-height: 1.6;">
                            Dibangun menggunakan arsitektur bersih PHP Native, Bootstrap 5, serta optimalisasi basis data relasional MySQL melalui implementasi *Stored Procedure* dan *Views*.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="team-section">
        <div class="container">
            <div class="text-center">
                <p class="text-success fw-semibold mb-2" style="font-size: 0.85rem; letter-spacing: 1px; text-transform: uppercase;">Tim Pengembang</p>
                <h2 style="font-family: 'Playfair Display', serif; font-size: 2.25rem; font-weight: 800;" class="mb-2">Balik Layar SAPARASA</h2>
                <p class="section-subtext">Halaman ini dikembangkan sebagai pemenuhan Tugas Besar mata kuliah Sistem Manajemen Basis Data (SMBD) oleh Kelompok 3 Kelas C2.</p>
            </div>

            <div class="row g-4 justify-content-center">
                <div class="col-xl-3 col-md-6">
                    <div class="team-card">
                        <h4 class="member-name">Afit Fajar</h4>
                        <p class="member-role">NIM. 2501826</p>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="team-card">
                        <h4 class="member-name">Haddi Fauzan N.</h4>
                        <p class="member-role">NIM. 2507609</p>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="team-card">
                        <h4 class="member-name">M. Zidan Mirza F.</h4>
                        <p class="member-role">NIM. 2507692</p>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="team-card">
                        <h4 class="member-name">Kang Farrel</h4>
                        <p class="member-role">NIM. 2507xxx</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4">
                    <div class="footer-brand">SAPARASA</div>
                    <p class="footer-desc">Platform informasi UMKM kuliner kawasan Saparua Bandung. Temukan, nikmati, dan dukung UMKM Lokal.</p>
                </div>
                <div class="col-6 col-lg-2">
                    <div class="footer-heading">Menu</div>
                    <a href="daftar-umkm.php" class="footer-link">Daftar UMKM</a>
                </div>
                <div class="col-6 col-lg-2">
                    <div class="footer-heading">Akun</div>
                    <a href="../auth/login.php" class="footer-link">Masuk</a>
                    <a href="../auth/register.php" class="footer-link">Daftar</a>
                </div>
                <div class="col-lg-4">
                    <div class="footer-heading">Tentang</div>
                    <p style="font-size:0.82rem; line-height:1.7; color:rgba(255,255,255,0.5);">SAPARASA merupakan website sistem informasi UMKM berbasis PHP Native dan MySQL yang digunakan untuk menampilkan informasi UMKM di kawasan Saparua Bandung.</p>
                </div>
            </div>
            <hr class="footer-divider">
            <p class="footer-copy text-center mb-0">© 2026 SAPARASA · Sistem Informasi UMKM Saparua Bandung</p>
        </div>
    </footer>

    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>