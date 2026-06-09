<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail UMKM - SAPARASA</title>
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --sapa-green: #1d6a4a;
            --sapa-green-light: #e8f5ef;
            --sapa-amber: #d97706;
            --sapa-amber-light: #fef3c7;
            --sapa-cream: #fdfbf7;
            --sapa-dark: #1c1917;
            --sapa-muted: #6b7280;
            --sapa-border: #EAE5DC;
        }

        body {
            font-family: "Inter", sans-serif;
            background-color: var(--sapa-cream);
            color: var(--sapa-dark);
            margin: 0;
        }

        /* NAVBAR */
        .navbar-custom {
            background: rgba(253,251,247,0.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #E5E0D8;
            padding: 0.75rem 0;
            position: sticky; top: 0; z-index: 999;
        }

        .name {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            color: var(--sapa-green);
            letter-spacing: -0.5px;
            font-weight: 700;
        }

        .sub {
            font-size: 0.6rem;
            color: var(--sapa-muted);
            letter-spacing: 2px;
            text-transform: uppercase;
            display: block;
            margin-top: -4px;
        }

        .nav-link-custom {
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--sapa-dark);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: background 0.2s;
            text-decoration: none;
        }

        .nav-link-custom:hover {
            background: var(--sapa-green-light);
            color: var(--sapa-green);
        }

        .btn-nav-cta {
            background: var(--sapa-green);
            color: #fff;
            font-size: 0.85rem;
            font-weight: 600;
            padding: 0.5rem 1.25rem;
            border-radius: 100px;
            border: none;
            text-decoration: none;
        }

        /* DETAIL HERO HEADER */
        .detail-hero {
            background: #fff;
            border-bottom: 1px solid var(--sapa-border);
            padding: 3.5rem 0;
        }

        .umkm-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--sapa-dark);
            margin-bottom: 0.5rem;
        }

        .badge-status {
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.35rem 0.75rem;
            border-radius: 6px;
            letter-spacing: 0.5px;
        }

        .badge-halal {
            background-color: #dcfce7;
            color: #166534;
        }

        .badge-kategori {
            background-color: var(--sapa-green-light);
            color: var(--sapa-green);
        }

        /* SIDEBAR CARD & CONTENT CARD */
        .info-card {
            background: #fff;
            border: 1px solid var(--sapa-border);
            border-radius: 20px;
            padding: 1.75rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.01);
        }

        .info-card-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1.25rem;
            border-bottom: 2px solid var(--sapa-green-light);
            padding-bottom: 0.5rem;
        }

        /* MENU ITEM GRID */
        .menu-box {
            background: #fff;
            border: 1px solid var(--sapa-border);
            border-radius: 16px;
            padding: 1.25rem;
            transition: all 0.2s ease;
            height: 100%;
        }

        .menu-box:hover {
            border-color: rgba(29, 106, 74, 0.3);
            box-shadow: 0 8px 20px rgba(29, 106, 74, 0.04);
        }

        .menu-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .menu-price {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--sapa-amber);
        }

        .badge-taste {
            font-size: 0.7rem;
            background: #f3f4f6;
            color: #4b5563;
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
            margin-right: 0.25rem;
        }

        /* REVIEW COMPONENT */
        .review-item {
            border-bottom: 1px solid #f3f4f6;
            padding-bottom: 1.25rem;
            margin-bottom: 1.25rem;
        }

        .review-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
            margin-bottom: 0;
        }

        .reviewer-name {
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 0.15rem;
        }

        .review-stars {
            color: #fbbf24;
            font-size: 0.85rem;
            margin-bottom: 0.5rem;
        }

        /* FOOTER */
        .footer { 
            background: var(--sapa-dark); 
            color: rgba(255,255,255,0.7); 
            padding: 3.5rem 0 2rem; 
            margin-top: 5rem;
        }

        .footer-brand { 
            font-family: 'Playfair Display', serif; 
            font-size: 1.5rem; 
            color: #fff; 
            font-weight: 700;
        }

        .footer-desc { 
            font-size: 0.83rem; 
            line-height: 1.7; 
            margin: 0.75rem 0 0; 
            max-width: 280px; 
        }

        .footer-heading { 
            font-size: 0.75rem; 
            font-weight: 700; 
            letter-spacing: 2px; 
            text-transform: uppercase; 
            color: #fff; 
            margin-bottom: 1rem; 
        }

        .footer-link { 
            display: block; 
            font-size: 0.83rem; 
            color: rgba(255,255,255,0.6); 
            text-decoration: none; 
            margin-bottom: 0.5rem; 
            transition: color 0.2s; 
        }

        .footer-link:hover { 
            color: #6EE7B7; 
        }

        .footer-divider { 
            border-color: rgba(255,255,255,0.1); 
            margin: 2rem 0 1rem; 
        }

        .footer-copy { 
            font-size: 0.78rem; 
            color: rgba(255,255,255,0.4); 
        }
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
                    <a href="daftar-umkm.php" class="nav-link-custom active" style="background: var(--sapa-green-light); color: var(--sapa-green);">Daftar UMKM</a>
                    <a href="tentang.php" class="nav-link-custom">Tentang</a>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="../auth/login.php" class="nav-link-custom d-none d-md-block">Masuk</a>
                    <a href="../auth/register.php" class="btn-nav-cta">Daftar</a>
                </div>
            </div>
        </div>
    </nav>

    <header class="detail-hero">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb" style="font-size: 0.85rem;">
                    <li class="breadcrumb-item"><a href="daftar-umkm.php" class="text-decoration-none" style="color: var(--sapa-green);">Daftar UMKM</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </nav>

            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div>
                    <h1 class="umkm-title">Batagor Ronsep</h1>
                    <p class="text-muted mb-0">Pemilik: <span class="fw-medium text-dark">Jar</span> · Asal Daerah: <span class="fw-medium text-dark">Bandung</span></p>
                </div>
                <div class="d-flex gap-2">
                    <span class="badge-status badge-halal">✓ Terverifikasi Halal</span>
                    <span class="badge-status badge-kategori">Makanan</span>
                </div>
            </div>
        </div>
    </header>

    <main class="container my-5">
        <div class="row g-4">
            
            <div class="col-lg-8">
                
                <section class="info-card">
                    <h2 class="info-card-title">Daftar Menu Hidangan</h2>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="menu-box">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h3 class="menu-title">Cuanki Komplit</h3>
                                    <span class="badge bg-danger text-white style" style="font-size: 0.65rem; padding: 0.2rem 0.4rem;">Best Seller</span>
                                </div>
                                <p class="menu-price mb-2">Rp 20.000</p>
                                <div class="mb-0">
                                    <span class="badge-taste">Gurih</span>
                                    <span class="badge-taste">Asin</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="menu-box">
                                <h3 class="menu-title">Batagor Kuah</h3>
                                <p class="menu-price mb-2">Rp 18.000</p>
                                <div class="mb-0">
                                    <span class="badge-taste">Gurih</span>
                                    <span class="badge-taste">Pedas Opsional</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="menu-box">
                                <h3 class="menu-title">Es Teh Manis</h3>
                                <p class="menu-price mb-2">Rp 5.000</p>
                                <div class="mb-0">
                                    <span class="badge-taste">Manis</span>
                                    <span class="badge-taste">Segar</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="info-card">
                    <h2 class="info-card-title">Ulasan Pengunjung</h2>
                    
                    <div class="review-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h4 class="reviewer-name">J4RZZZ</h4>
                                <div class="review-stars">★★★★★ <span class="text-muted" style="font-size: 0.75rem;">(5.0)</span></div>
                            </div>
                            <small class="text-muted">05 Juni 2026</small>
                        </div>
                        <p class="text-muted mb-0" style="font-size: 0.9rem; line-height: 1.6;">
                            "Cuankinya juara banget, kalbunya kerasa gurih alami. Antrean rapi dan pelayanannya cepat walaupun pas jam makan siang rame."
                        </p>
                    </div>

                    <div class="review-item">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h4 class="reviewer-name">Rian F.</h4>
                                <div class="review-stars">★★★★☆ <span class="text-muted" style="font-size: 0.75rem;">(4.0)</span></div>
                            </div>
                            <small class="text-muted">01 Juni 2026</small>
                        </div>
                        <p class="text-muted mb-0" style="font-size: 0.9rem; line-height: 1.6;">
                            "Rasa batagor kuahnya enak, porsi pas kenyang di kantong mahasiswa. Tempat duduk bersih."
                        </p>
                    </div>
                </section>

            </div>

            <div class="col-lg-4">
                
                <div class="info-card">
                    <h2 class="info-card-title">Waktu Operasional</h2>
                    <div style="font-size: 0.9rem; line-height: 1.8;">
                        <div class="d-flex justify-content-between border-bottom py-1">
                            <span class="text-muted">Senin - Jumat</span>
                            <span class="fw-medium">10:00 - 19:00 WIB</span>
                        </div>
                        <div class="d-flex justify-content-between border-bottom py-1">
                            <span class="text-muted">Sabtu</span>
                            <span class="fw-medium">08:00 - 20:00 WIB</span>
                        </div>
                        <div class="d-flex justify-content-between py-1">
                            <span class="text-white bg-danger px-2 rounded fw-semibold" style="font-size: 0.75rem; align-self: center;">Minggu</span>
                            <span class="text-danger fw-medium">Tutup</span>
                        </div>
                    </div>
                </div>

                <div class="info-card">
                    <h2 class="info-card-title">Transaksi & Lokasi</h2>
                    
                    <h6 class="fw-semibold mb-2" style="font-size: 0.85rem; color: var(--sapa-muted); text-transform: uppercase; letter-spacing: 0.5px;">Metode Pembayaran</h6>
                    <div class="d-flex flex-wrap gap-1 mb-4">
                        <span class="badge bg-light text-dark border px-2 py-1" style="font-size: 0.75rem;">Tunai (Cash)</span>
                        <span class="badge bg-light text-dark border px-2 py-1" style="font-size: 0.75rem;">QRIS (Dana/OVO/GoPay)</span>
                        <span class="badge bg-light text-dark border px-2 py-1" style="font-size: 0.75rem;">Transfer Bank</span>
                    </div>

                    <h6 class="fw-semibold mb-2" style="font-size: 0.85rem; color: var(--sapa-muted); text-transform: uppercase; letter-spacing: 0.5px;">Koordinat Geospasial</h6>
                    <div class="p-3 bg-light rounded border" style="font-size: 0.82rem; font-family: monospace;">
                        <div>Latitude  : -6.910245</div>
                        <div>Longitude : 107.619082</div>
                    </div>
                    <small class="text-muted d-block mt-2" style="font-size: 0.75rem; line-height: 1.4;">*Data koordinat relasional di atas terintegrasi langsung dengan sistem pemetaan peta kuliner kawasan GOR Saparua.</small>
                </div>

            </div>

        </div>
    </main>

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