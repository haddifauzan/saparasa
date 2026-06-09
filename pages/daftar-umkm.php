<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Seluruh UMKM - SAPARASA</title>
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/daftar-umkm-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

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
                    <a href="daftar-umkm.php" class="nav-link-custom active" style="background: var(--sapa-green-light); color: var(--sapa-green);">Daftar UMKM</a>
                    <a href="index.php#tentang" class="nav-link-custom">Tentang</a>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="../auth/login.php" class="nav-link-custom d-none d-md-block">Masuk</a>
                    <a href="../auth/register.php" class="btn-nav-cta">Daftar</a>
                </div>
            </div>
        </div>
    </nav>

    <header class="catalog-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <p class="text-success fw-semibold mb-2" style="font-size: 0.85rem; letter-spacing: 1px; text-transform: uppercase;">Eksplorasi Jajanan</p>
                    <h1 class="catalog-title">Seluruh UMKM Kuliner</h1>
                    <p class="text-muted mb-0">Menampilkan semua mitra pelaku usaha kuliner hasil pemetaan di kawasan Saparua Kota Bandung.</p>
                </div>
                
                <div class="col-md-5 mt-4 mt-md-0">
                    <form action="daftar-umkm.php" method="GET">
                        <div class="input-group p-2 bg-white rounded-pill border" style="border-color: #EAE5DC !important; box-shadow: 0 4px 20px rgba(0,0,0,0.01);">
                            <input type="text" name="keyword" class="form-control border-0 px-3 bg-transparent" placeholder="Cari kuliner Saparua..." style="box-shadow: none; font-size: 0.9rem;">
                            <button class="btn text-white rounded-pill px-4" type="submit" style="background-color: var(--sapa-green); font-size: 0.9rem; font-weight: 500;">
                                Cari
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="filter-container">
                <a href="daftar-umkm.php" class="btn-filter active">Semua Jajanan</a>
                <a href="daftar-umkm.php?kategori=makanan" class="btn-filter">Makanan</a>
                <a href="daftar-umkm.php?kategori=minuman" class="btn-filter">Minuman</a>
                <a href="daftar-umkm.php?kategori=cemilan" class="btn-filter">Cemilan</a>
            </div>
        </div>
    </header>

    <section class="catalog-section">
        <div class="container">
            <div class="row g-4">
                
                <div class="col-lg-4 col-md-6">
                    <div class="umkm-card" onclick="window.location.href='detail-umkm.php?id=1'">
                        <div class="umkm-card-img">
                            <span class="badge-category">Makanan & Minuman</span>
                            <img src="../assets/img/DimsumSmoothies.jpg" alt="Dimsum Smoothies">
                        </div>
                        <div class="umkm-card-body">
                            <h3 class="umkm-name">Dimsum Smoothies</h3>
                            <p class="umkm-clock">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                15.30 - 23.00 WIB
                            </p>
                            <div class="umkm-rating">
                                <span style="color: #d97706; font-weight: 700;">★ 4.8</span>
                                <span class="text-muted">(24 Ulasan)</span>
                            </div>
                            <a href="detail-umkm.php?id=1" class="btn-detail">Lihat Detail Warung</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="umkm-card" onclick="window.location.href='detail-umkm.php?id=2'">
                        <div class="umkm-card-img">
                            <span class="badge-category">Makanan</span>
                            <img src="../assets/img/BatagorRonsep.jpg" alt="Batagor Ronsep">
                        </div>
                        <div class="umkm-card-body">
                            <h3 class="umkm-name">Batagor Ronsep</h3>
                            <p class="umkm-clock">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                08.30 - 18.00 WIB
                            </p>
                            <div class="umkm-rating">
                                <span style="color: #d97706; font-weight: 700;">★ 4.7</span>
                                <span class="text-muted">(18 Ulasan)</span>
                            </div>
                            <a href="detail-umkm.php?id=2" class="btn-detail">Lihat Detail Warung</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="umkm-card" onclick="window.location.href='detail-umkm.php?id=3'">
                        <div class="umkm-card-img">
                            <span class="badge-category">Cemilan</span>
                            <img src="../assets/img/CimolBojotAA.jpg" alt="Cimol Bojot AA">
                        </div>
                        <div class="umkm-card-body">
                            <h3 class="umkm-name">Cimol Bojot AA</h3>
                            <p class="umkm-clock">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                14.00 - 23.00 WIB
                            </p>
                            <div class="umkm-rating">
                                <span style="color: #d97706; font-weight: 700;">★ 4.5</span>
                                <span class="text-muted">(32 Ulasan)</span>
                            </div>
                            <a href="detail-umkm.php?id=3" class="btn-detail">Lihat Detail Warung</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="umkm-card" onclick="window.location.href='detail-umkm.php?id=4'">
                        <div class="umkm-card-img">
                            <span class="badge-category">Minuman</span>
                            <img src="../assets/img/SegarSehat.jpg" alt="Segar Sehat">
                        </div>
                        <div class="umkm-card-body">
                            <h3 class="umkm-name">Segar Sehat</h3>
                            <p class="umkm-clock">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                11.00 - 23.00 WIB
                            </p>
                            <div class="umkm-rating">
                                <span style="color: #d97706; font-weight: 700;">★ 4.6</span>
                                <span class="text-muted">(14 Ulasan)</span>
                            </div>
                            <a href="detail-umkm.php?id=4" class="btn-detail">Lihat Detail Warung</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="umkm-card" onclick="window.location.href='detail-umkm.php?id=5'">
                        <div class="umkm-card-img">
                            <span class="badge-category">Minuman</span>
                            <img src="../assets/img/BorneoCoffee.jpg" alt="Borneo Coffee">
                        </div>
                        <div class="umkm-card-body">
                            <h3 class="umkm-name">Borneo Coffee</h3>
                            <p class="umkm-clock">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                11.00 - 23.00 WIB
                            </p>
                            <div class="umkm-rating">
                                <span style="color: #d97706; font-weight: 700;">★ 4.9</span>
                                <span class="text-muted">(41 Ulasan)</span>
                            </div>
                            <a href="detail-umkm.php?id=5" class="btn-detail">Lihat Detail Warung</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="umkm-card" onclick="window.location.href='detail-umkm.php?id=6'">
                        <div class="umkm-card-img">
                            <span class="badge-category">Minuman</span>
                            <img src="../assets/img/BadmanCoffee.jpg" alt="Badman Coffee">
                        </div>
                        <div class="umkm-card-body">
                            <h3 class="umkm-name">Badman Coffee</h3>
                            <p class="umkm-clock">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                16.00 - 00.00 WIB
                            </p>
                            <div class="umkm-rating">
                                <span style="color: #d97706; font-weight: 700;">★ 4.4</span>
                                <span class="text-muted">(9 Ulasan)</span>
                            </div>
                            <a href="detail-umkm.php?id=6" class="btn-detail">Lihat Detail Warung</a>
                        </div>
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
                    <a href="#umkm" class="footer-link">Daftar UMKM</a>
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