<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../config/conn.php';

// Get UMKM ID from query parameter
$id_umkm = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id_umkm <= 0) {
    header("Location: daftar-umkm.php");
    exit();
}

// 1. Fetch UMKM profile
$stmt = $conn->prepare("CALL sp_get_umkm_detail(?)");
$stmt->bind_param("i", $id_umkm);
$stmt->execute();
$umkm = $stmt->get_result()->fetch_assoc();
while ($conn->next_result()) { $conn->store_result(); }

if (!$umkm) {
    header("Location: daftar-umkm.php");
    exit();
}

// 2. Fetch menu list for this UMKM
$stmt = $conn->prepare("CALL sp_get_umkm_menus(?)");
$stmt->bind_param("i", $id_umkm);
$stmt->execute();
$menus = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
while ($conn->next_result()) { $conn->store_result(); }

// 3. Fetch reviews
$stmt = $conn->prepare("CALL sp_get_umkm_reviews(?)");
$stmt->bind_param("i", $id_umkm);
$stmt->execute();
$reviews = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
while ($conn->next_result()) { $conn->store_result(); }

// 4. Fetch operational schedule
$stmt = $conn->prepare("CALL sp_get_umkm_operasional(?)");
$stmt->bind_param("i", $id_umkm);
$stmt->execute();
$operasionals = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
while ($conn->next_result()) { $conn->store_result(); }

// 5. Fetch payment methods
$stmt = $conn->prepare("CALL sp_get_umkm_payments(?)");
$stmt->bind_param("i", $id_umkm);
$stmt->execute();
$payments = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
while ($conn->next_result()) { $conn->store_result(); }

// 6. Fetch online platforms
$stmt = $conn->prepare("CALL sp_get_umkm_platforms(?)");
$stmt->bind_param("i", $id_umkm);
$stmt->execute();
$platforms = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
while ($conn->next_result()) { $conn->store_result(); }

// 7. Fetch gallery photos
// 7. Fetch gallery photos – separate stand and menu
$stmt = $conn->prepare("CALL sp_get_umkm_gallery_by_type(?, 'stand')");
$stmt->bind_param("i", $id_umkm);
$stmt->execute();
$stand_gallery = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
while ($conn->next_result()) { $conn->store_result(); }

$stmt = $conn->prepare("CALL sp_get_umkm_gallery_by_type(?, 'menu')");
$stmt->bind_param("i", $id_umkm);
$stmt->execute();
$menu_gallery = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
while ($conn->next_result()) { $conn->store_result(); }

// Days mapping for Indonesian
$days = [
    'Sunday' => 'minggu',
    'Monday' => 'senin',
    'Tuesday' => 'selasa',
    'Wednesday' => 'rabu',
    'Thursday' => 'kamis',
    'Friday' => 'jumat',
    'Saturday' => 'sabtu'
];
$today = $days[date('l')];

// Decide display category badge
$disp_kategori = $umkm['nama_kategori'];
$snack_keywords = ['cemilan', 'cimol', 'basreng', 'churos', 'churros', 'lekker', 'pisang', 'roti', 'potato', 'jasuke', 'taichan'];
$is_snack = false;
foreach ($snack_keywords as $kw) {
    if (stripos($umkm['nama_umkm'], $kw) !== false) {
        $is_snack = true;
        break;
    }
}
if ($is_snack) {
    $disp_kategori = 'Cemilan';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $umkm['nama_umkm'] ?> - Detail UMKM SAPARASA</title>
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/detail-umkm-style.css?v=<?= time() ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
</head>
<body>

    <?php 
    $base_path = '../';
    $active_page = 'daftar';
    include '../includes/navbar.php'; 
    ?>

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
                    <h1 class="umkm-title"><?= $umkm['nama_umkm'] ?></h1>
                    <p class="text-muted mb-0">Pemilik UMKM: <span class="fw-medium text-dark"><?= $umkm['pemilik'] ?></span> · Asal Daerah UMKM: <span class="fw-medium text-dark"><?= $umkm['asal_daerah'] ?: 'Tidak ada' ?></span></p>
                </div>
                <div class="d-flex gap-2">
                    <?php if ($umkm['status_halal'] === 'sudah'): ?>
                        <span class="badge-status badge-halal">✓ Terverifikasi Halal</span>
                    <?php elseif ($umkm['status_halal'] === 'proses'): ?>
                        <span class="badge-status" style="background-color: #fef3c7; color: #d97706;">⌛ Sertifikasi Halal Diproses</span>
                    <?php else: ?>
                        <span class="badge-status" style="background-color: #fee2e2; color: #991b1b;">✗ Belum Sertifikasi Halal</span>
                    <?php endif; ?>
                    <span class="badge-status badge-kategori"><?= $disp_kategori ?></span>
                </div>
            </div>
        </div>
    </header>

    <main class="container my-5">
        <div class="row g-4">
            
            <div class="col-lg-8">
                
                <section class="info-card">
                    <h2 class="info-card-title">Tentang Warung</h2>
                    <p style="font-size: 0.95rem; line-height: 1.7; color: var(--sapa-muted);">
                        <?= nl2br($umkm['deskripsi']) ?>
                    </p>
                </section>

                <?php if (!empty($stand_gallery)): ?>
                <section class="info-card">
                    <h2 class="info-card-title">Galeri Stand</h2>
                    <div class="row g-2">
                        <?php foreach ($stand_gallery as $g): ?>
                            <div class="col-4 col-md-3">
                                <img src="../public/uploads/galeri_umkm/<?= $g['foto'] ?>" class="img-fluid rounded gallery-img" data-bs-toggle="modal" data-bs-target="#galleryModal" data-src="../public/uploads/galeri_umkm/<?= $g['foto'] ?>" style="height: 120px; width: 100%; object-fit: cover; cursor:pointer;">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
                <?php endif; ?>

                <?php if (!empty($menu_gallery)): ?>
                <section class="info-card">
                    <h2 class="info-card-title">Galeri Menu</h2>
                    <div class="row g-2">
                        <?php foreach ($menu_gallery as $g): ?>
                            <div class="col-4 col-md-3">
                                <img src="../public/uploads/galeri_umkm/<?= $g['foto'] ?>" class="img-fluid rounded gallery-img" data-bs-toggle="modal" data-bs-target="#galleryModal" data-src="../public/uploads/galeri_umkm/<?= $g['foto'] ?>" style="height: 120px; width: 100%; object-fit: cover; cursor:pointer;">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
                <?php endif; ?>

                <section class="info-card">
                    <h2 class="info-card-title">Daftar Menu Hidangan</h2>
                    <div class="row g-3">
                        <?php if (empty($menus)): ?>
                            <div class="col-12">
                                <p class="text-muted mb-0">Menu hidangan belum terdaftar.</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($menus as $m): ?>
                                <div class="col-md-6">
                                    <div class="menu-box">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h3 class="menu-title"><?= $m['nama_menu'] ?></h3>
                                            <?php if ($m['menu_terlaris']): ?>
                                                <span class="badge bg-danger text-white" style="font-size: 0.65rem; padding: 0.2rem 0.4rem;">Best Seller</span>
                                            <?php elseif ($m['menu_utama']): ?>
                                                <span class="badge bg-success text-white" style="font-size: 0.65rem; padding: 0.2rem 0.4rem; background-color: var(--sapa-green) !important;">Menu Utama</span>
                                            <?php endif; ?>
                                        </div>
                                        <p class="menu-price mb-2">Rp <?= number_format($m['harga'], 0, ',', '.') ?></p>
                                        <div class="mb-0">
                                            <?php if (!empty($m['rasa'])): ?>
                                                <p class="menu-rasa mb-1" style="font-size: 0.85rem;"><strong>Rasa:</strong> <?= htmlspecialchars($m['rasa']) ?></p>
                                            <?php endif; ?>
                                            <?php if (!empty($m['bahan'])): ?>
                                                <p class="menu-bahan mb-0" style="font-size: 0.85rem;"><strong>Bahan:</strong> <?= htmlspecialchars($m['bahan']) ?></p>
                                            <?php endif; ?>
                                            <?php if (empty($m['rasa']) && empty($m['bahan'])): ?>
                                                <p class="text-muted mb-0" style="font-size: 0.85rem;">-</p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </section>

                <section class="info-card">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="info-card-title mb-0">Ulasan Pengunjung</h2>
                        <button id="addReviewBtn" class="btn btn-sm btn-success" style="background-color: var(--sapa-green); border-color: var(--sapa-green);">+ Tambah Ulasan</button>
                    </div>
                    
                    <?php if (empty($reviews)): ?>
                        <p class="text-muted mb-0" style="font-size: 0.95rem;">Belum ada ulasan untuk warung ini.</p>
                    <?php else: ?>
                        <?php foreach ($reviews as $rev): ?>
                            <div class="review-item">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h4 class="reviewer-name"><?= $rev['reviewer_name'] ?: 'Pengunjung Anonim' ?></h4>
                                        <div class="review-stars">
                                            <?= str_repeat('★', intval($rev['rating'])) ?><?= str_repeat('☆', 5 - intval($rev['rating'])) ?> 
                                            <span class="text-muted" style="font-size: 0.75rem;">(<?= number_format($rev['rating'], 1) ?>)</span>
                                        </div>
                                    </div>
                                    <small class="text-muted"><?= date('d F Y', strtotime($rev['created_at'])) ?></small>
                                </div>
                                <p class="text-muted mb-0" style="font-size: 0.9rem; line-height: 1.6;">
                                    "<?= $rev['komentar'] ?>"
                                </p>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </section>

            </div>

            <div class="col-lg-4">
                
                <div class="info-card">
                    <h2 class="info-card-title">Waktu Operasional</h2>
                    <div style="font-size: 0.9rem; line-height: 1.8;">
                        <?php if (empty($operasionals)): ?>
                            <p class="text-muted mb-0">Informasi jam operasional belum tersedia.</p>
                        <?php else: ?>
                            <?php foreach ($operasionals as $op): ?>
                                <?php
                                $hari_display = ucfirst($op['hari']);
                                $buka = $op['jam_buka'] ? date('H.i', strtotime($op['jam_buka'])) : null;
                                $tutup = $op['jam_tutup'] ? date('H.i', strtotime($op['jam_tutup'])) : null;
                                $is_today = (strtolower($op['hari']) === $today);
                                ?>
                                <div class="d-flex justify-content-between border-bottom py-1 <?= $is_today ? 'fw-bold' : '' ?>" <?= $is_today ? 'style="color: var(--sapa-green);"' : '' ?>>
                                    <span class="<?= $is_today ? 'text-dark fw-bold' : 'text-muted' ?>">
                                        <?= $hari_display ?> <?= $is_today ? '(Hari Ini)' : '' ?>
                                    </span>
                                    <span class="<?= !$buka ? 'text-danger fw-semibold' : '' ?>">
                                        <?= $buka ? "$buka - $tutup WIB" : 'Tutup' ?>
                                    </span>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="info-card">
                    <h2 class="info-card-title">Transaksi & Lokasi</h2>
                    
                    <h6 class="fw-semibold mb-2" style="font-size: 0.85rem; color: var(--sapa-muted); text-transform: uppercase; letter-spacing: 0.5px;">Metode Pembayaran</h6>
                    <div class="d-flex flex-wrap gap-1 mb-4">
                        <?php if (empty($payments)): ?>
                            <span class="text-muted" style="font-size: 0.85rem;">Tunai (Cash)</span>
                        <?php else: ?>
                            <?php foreach ($payments as $p): ?>
                                <span class="badge bg-light text-dark border px-2 py-1" style="font-size: 0.75rem;"><?= $p['nama_pembayaran'] ?></span>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($platforms)): ?>
                        <h6 class="fw-semibold mb-2" style="font-size: 0.85rem; color: var(--sapa-muted); text-transform: uppercase; letter-spacing: 0.5px;">Pesan Online</h6>
                        <div class="d-flex flex-wrap gap-1 mb-4">
                            <?php foreach ($platforms as $plat): ?>
                                <a href="<?= $plat['link_platform'] ?>" target="_blank" class="badge bg-success text-white px-2 py-1 text-decoration-none" style="font-size: 0.75rem; background-color: var(--sapa-green) !important;">
                                    <?= $plat['nama_platform'] ?> ↗
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <h6 class="fw-semibold mb-2" style="font-size: 0.85rem; color: var(--sapa-muted); text-transform: uppercase; letter-spacing: 0.5px;">Lokasi UMKM (Peta)</h6>
                    <div id="map" class="rounded border" style="height: 300px; width: 100%; z-index: 1;" data-lat="<?= $umkm['latitude'] ?>" data-lng="<?= $umkm['longitude'] ?>"></div>
                    <small class="text-muted d-block mt-2" style="font-size: 0.75rem; line-height: 1.4;">*Peta interaktif terintegrasi untuk menemukan lokasi warung dengan mudah di kawasan Saparua.</small>
                </div>

            </div>

        </div>
    </main>

    <?php include '../includes/footer.php'; ?>

    <!-- Gallery Modal -->
    <div class="modal fade" id="galleryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 bg-transparent">
                <div class="modal-body p-0 position-relative text-center">
                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close" style="z-index: 1055;"></button>
                    <img src="" id="modalImg" class="img-fluid rounded shadow-lg" alt="Foto UMKM" style="max-height: 85vh; object-fit: contain; background: #000;">
                </div>
            </div>
        </div>
    </div>

    <!-- Review Modal -->
    <div class="modal fade" id="reviewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 12px; border: none;">
                <div class="modal-header border-bottom-0 pb-0">
                    <h5 class="modal-title fw-bold" style="color: var(--sapa-dark);">Tulis Ulasan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-3">
                    <form id="reviewForm">
                        <input type="hidden" id="reviewIdUmkm" value="<?= $id_umkm ?>">
                        <div class="mb-3">
                            <label class="form-label" style="font-size: 0.9rem; font-weight: 500;">Rating</label>
                            <select id="reviewRating" class="form-select" required>
                                <option value="" disabled selected>Pilih Rating...</option>
                                <option value="5">5 Bintang (Sangat Baik)</option>
                                <option value="4">4 Bintang (Baik)</option>
                                <option value="3">3 Bintang (Cukup)</option>
                                <option value="2">2 Bintang (Kurang)</option>
                                <option value="1">1 Bintang (Sangat Kurang)</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" style="font-size: 0.9rem; font-weight: 500;">Komentar</label>
                            <textarea id="reviewKomentar" class="form-control" rows="4" placeholder="Bagaimana pengalaman Anda makan di sini?" required></textarea>
                        </div>
                        <button type="submit" class="btn w-100" style="background-color: var(--sapa-green); color: #fff; border-radius: 8px; font-weight: 500;">Kirim Ulasan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Auth Modal (if not logged in) -->
    <div class="modal fade" id="loginPromptModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center" style="border-radius: 12px; border: none; padding: 2rem;">
                <h4 class="mb-3 fw-bold" style="color: var(--sapa-dark);">Belum Masuk?</h4>
                <p class="text-muted mb-4">Silakan masuk atau daftar terlebih dahulu untuk dapat menambahkan ulasan pengunjung.</p>
                <div class="d-flex gap-2 justify-content-center">
                    <a href="../auth/login.php" class="btn btn-outline-success" style="border-color: var(--sapa-green); color: var(--sapa-green);">Masuk</a>
                    <a href="../auth/register.php" class="btn" style="background-color: var(--sapa-green); color: #fff;">Daftar Akun</a>
                </div>
            </div>
        </div>
    </div>


    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        window.isLoggedIn = <?= isset($_SESSION['id_user']) ? 'true' : 'false' ?>;
    </script>
    <script src="../assets/js/detail-umkm.js"></script>
</body>
</html>