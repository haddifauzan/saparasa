<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAPARASA</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar-custom">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between gap-3">
                <a href="#" class="text-decoration-none">
                    <span class="name">SAPARASA</span>
                    <span class="sub">Kuliner Saparua Bandung</span>
                </a>
                <div class="d-none d-md-flex align-items-center gap-1">
                    <a href="#umkm" class="nav-link-custom">Daftar UMKM</a>
                    <a href="#tentang" class="nav-link-custom">Tentang</a>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="#" class="nav-link-custom d-none d-md-block">Masuk</a>
                    <a href="#" class="btn-nav-cta">Daftar</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero-section">
        <div class="hero-pattern"></div>
        <div class="container">
            <div class="row align-items-center gy-5">
                <div class="col-lg-6">
                    <h1 class="hero-title">
                        Jelajahi <em>Kuliner</em><br>Terbaik Saparua
                    </h1>
                    <p class="hero-desc">
                        Temukan berbagai UMKM kuliner pilihan di kawasan Saparua Bandung. Dari warung tradisional hingga kafe modern, semua ada di sini.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#umkm" class="btn-hero-primary">Jelajahi UMKM</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- DETAIL UMKM -->
    <section class="umkm-section" id="umkm">
        <div class="container">
            <div class="row align-items-end mb-5">
                <div class="col-md-7">
                    <p class="section-label">Daftar UMKM</p>
                    <div class="divider-green"></div>
                    <h2 class="section-title">UMKM Pilihan<br>di Saparua Bandung</h2>
                </div>
                <div class="col-md-5 text-md-end mt-3 mt-md-0">
                    <a href="#" style="font-size: 0.88rem; font-weight:600; color:var(--sapa-green); text-decoration:none;">Lihat Semua UMKM →</a>
                </div>
            </div>

            <!-- UMKM CARDS -->
            <div class="row g-4">
                <!-- UMKM 1 -->
                <div class="col-lg-4 col-md-6">
                    <div class="umkm-card" onclick="document.getElementById('detail').scrollIntoView({behavior:'smooth'})">
                        <div class="umkm-card-img">
                            <img src="assets/img/DimsumSmoothies.jpg" alt="">
                        </div>
                        <div class="umkm-card-body">
                            <h3 class="umkm-name">Dimsum Smoothies</h3>
                            <p class="umkm-clock">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                15.30 - 23.00 WIB
                            </p>
                            <div class="umkm-detail">
                                <a href="#detail" class="btn-detail">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- UMKM 2 -->
                <div class="col-lg-4 col-md-6">
                    <div class="umkm-card" onclick="document.getElementById('detail').scrollIntoView({behavior:'smooth'})">
                        <div class="umkm-card-img">
                            <img src="assets/img/BatagorRonsep.jpg" alt="">
                        </div>
                        <div class="umkm-card-body">
                            <h3 class="umkm-name">Batagor Ronsep</h3>
                            <p class="umkm-clock">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                08.30 - 18.00 WIB
                            </p>
                            <div class="umkm-detail">
                                <a href="#detail" class="btn-detail">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- UMKM 3 -->
                <div class="col-lg-4 col-md-6">
                    <div class="umkm-card" onclick="document.getElementById('detail').scrollIntoView({behavior:'smooth'})">
                        <div class="umkm-card-img">
                            <img src="assets/img/CimolBojotAA.jpg" alt="">
                        </div>
                        <div class="umkm-card-body">
                            <h3 class="umkm-name">Cimol Bojot AA</h3>
                            <p class="umkm-clock">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                14.00 - 23.00 WIB
                            </p>
                            <div class="umkm-detail">
                                <a href="#detail" class="btn-detail">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- UMKM 4 -->
                <div class="col-lg-4 col-md-6">
                    <div class="umkm-card" onclick="document.getElementById('detail').scrollIntoView({behavior:'smooth'})">
                        <div class="umkm-card-img">
                            <img src="assets/img/SegarSehat.jpg" alt="">
                        </div>
                        <div class="umkm-card-body">
                            <h3 class="umkm-name">Segar Sehat</h3>
                            <p class="umkm-clock">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                11.00 - 23.00 WIB
                            </p>
                            <div class="umkm-detail">
                                <a href="#detail" class="btn-detail">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- UMKM 5 -->
                <div class="col-lg-4 col-md-6">
                    <div class="umkm-card" onclick="document.getElementById('detail').scrollIntoView({behavior:'smooth'})">
                        <div class="umkm-card-img">
                            <img src="assets/img/BorneoCoffee.jpg" alt="">
                        </div>
                        <div class="umkm-card-body">
                            <h3 class="umkm-name">Borneo Coffee</h3>
                            <p class="umkm-clock">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                11.00 - 23.00 WIB
                            </p>
                            <div class="umkm-detail">
                                <a href="#detail" class="btn-detail">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- UMKM 6 -->
                <div class="col-lg-4 col-md-6">
                    <div class="umkm-card" onclick="document.getElementById('detail').scrollIntoView({behavior:'smooth'})">
                        <div class="umkm-card-img">
                            <img src="assets/img/BadmanCoffee.jpg" alt="">
                        </div>
                        <div class="umkm-card-body">
                            <h3 class="umkm-name">Badman Coffee</h3>
                            <p class="umkm-clock">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                16.00 - 00.00 WIB
                            </p>
                            <div class="umkm-detail">
                                <a href="#detail" class="btn-detail">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4">
                    <div class="footer-brand">SAPARASA</div>
                    <p class="footer-desc">Platform informasi UMKM kuliner kawasan Saparua Bandung. Temukan, nikmati, dan dukung UMKM Lokal.</p>
                </div>
                <div class="col-6 col-lg-2">
                    <div class="footer-heading">Menu</div>
                    <a href="#umkm" class="footer-link">Daftar UMKM</a>
                </div>
                <div class="col-6 col-lg-2">
                    <div class="footer-heading">Akun</div>
                    <a href="#" class="footer-link">Masuk</a>
                    <a href="#" class="footer-link">Daftar</a>
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

    <!-- JavaScript -->
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>