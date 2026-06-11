<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../config/conn.php';

$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$kategori = isset($_GET['kategori']) ? trim($_GET['kategori']) : '';
$min_harga = isset($_GET['min_harga']) && is_numeric($_GET['min_harga']) ? (float)$_GET['min_harga'] : 0;
$max_harga = isset($_GET['max_harga']) && is_numeric($_GET['max_harga']) ? (float)$_GET['max_harga'] : 0;
$buka_sekarang = isset($_GET['buka_sekarang']) ? true : false;
$halal = isset($_GET['halal']) ? trim($_GET['halal']) : '';
$rasa = isset($_GET['rasa']) ? trim($_GET['rasa']) : '';
$mitra = isset($_GET['mitra']) ? trim($_GET['mitra']) : '';
$pembayaran = isset($_GET['pembayaran']) ? trim($_GET['pembayaran']) : '';

// Days mapping for Indonesian
date_default_timezone_set('Asia/Jakarta');
$days = [
    'Sunday' => 'minggu', 'Monday' => 'senin', 'Tuesday' => 'selasa', 'Wednesday' => 'rabu',
    'Thursday' => 'kamis', 'Friday' => 'jumat', 'Saturday' => 'sabtu'
];
$today = $days[date('l')];
$current_time = $buka_sekarang ? date('H:i:s') : null;

// Fetch dynamic categories
$cat_stmt = $conn->query("SELECT nama_kategori FROM kategori_umkm ORDER BY id_kategori ASC");
$all_categories = [];
if ($cat_stmt) { while ($row = $cat_stmt->fetch_assoc()) { $all_categories[] = $row['nama_kategori']; } }

// Fetch other filter options
$all_rasa = [];
$res = $conn->query("SELECT nama_rasa FROM kategori_rasa ORDER BY nama_rasa ASC");
if($res) { while($row = $res->fetch_assoc()) $all_rasa[] = $row['nama_rasa']; }

$all_mitra = [];
$res = $conn->query("SELECT nama_platform FROM platform_online ORDER BY nama_platform ASC");
if($res) { while($row = $res->fetch_assoc()) $all_mitra[] = $row['nama_platform']; }

$all_pembayaran = [];
$res = $conn->query("SELECT nama_pembayaran FROM metode_pembayaran ORDER BY nama_pembayaran ASC");
if($res) { while($row = $res->fetch_assoc()) $all_pembayaran[] = $row['nama_pembayaran']; }

$cat_param = '';
foreach ($all_categories as $cat) {
    if (strtolower($kategori) === strtolower($cat)) { $cat_param = $cat; break; }
}

$stmt = $conn->prepare("CALL sp_get_umkm_list_advanced(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0)");
$null_val = null;
$stmt->bind_param("ssssddssss", 
    $keyword, 
    $cat_param, 
    $today, 
    $current_time, 
    $min_harga, 
    $max_harga, 
    $halal, 
    $rasa, 
    $mitra, 
    $pembayaran
);
$stmt->execute();
$result = $stmt->get_result();

$umkm_list = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $foto_path = !empty($row['foto']) ? '../public/uploads/galeri_umkm/' . $row['foto'] : '../assets/img/DimsumSmoothies.jpg';
        $umkm_list[] = [
            'id_umkm' => $row['id_umkm'],
            'nama_umkm' => $row['nama_umkm'],
            'kategori' => $row['nama_kategori'],
            'avg_rating' => $row['avg_rating'],
            'count_reviews' => $row['count_reviews'],
            'foto_path' => $foto_path,
            'op_text' => $row['op_text'] ?: 'Tutup'
        ];
    }
}
// Free result and clear multi-results from stored procedure CALL
while ($conn->more_results() && $conn->next_result()) {
    if ($res = $conn->store_result()) { $res->free(); }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Seluruh UMKM - SAPARASA</title>
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/daftar-umkm-style.css?v=<?= time() ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">

</head>
<body>

    <?php 
    $base_path = '../';
    $active_page = 'daftar';
    include '../includes/navbar.php'; 
    ?>

    <header class="catalog-header pb-4">
        <div class="container">
            <div class="row align-items-center mb-4">
                <div class="col-md-7">
                    <p class="text-success fw-semibold mb-2" style="font-size: 0.85rem; letter-spacing: 1px; text-transform: uppercase;">Eksplorasi Jajanan</p>
                    <h1 class="catalog-title">Seluruh UMKM Kuliner</h1>
                    <p class="text-muted mb-0">Menampilkan semua mitra pelaku usaha kuliner hasil pemetaan di kawasan Saparua Kota Bandung.</p>
                </div>
                
                <div class="col-md-5 mt-4 mt-md-0 text-md-end">
                    <button class="btn text-white rounded-pill px-4 py-2 shadow-sm" type="button" data-bs-toggle="collapse" data-bs-target="#advancedFilter" aria-expanded="false" aria-controls="advancedFilter" style="background-color: var(--sapa-green); font-size: 0.95rem; font-weight: 500;">
                        <i class="fas fa-filter me-2"></i> Filter & Pencarian
                    </button>
                </div>
            </div>

            <!-- Advanced Filter Panel -->
            <div class="collapse <?= ($keyword || $kategori || $min_harga || $max_harga || $buka_sekarang || $halal || $rasa || $mitra || $pembayaran) ? 'show' : '' ?>" id="advancedFilter">
                <div class="card card-body border-0 shadow-sm rounded-4 mb-4" style="background-color: #fcfbf9;">
                    <form action="daftar-umkm.php" method="GET">
                        <div class="row g-3">
                            <!-- Search -->
                            <div class="col-md-12 mb-2">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">Kata Kunci</label>
                                <input type="text" name="keyword" class="form-control rounded-3" placeholder="Cari nama UMKM atau menu..." value="<?= htmlspecialchars($keyword) ?>">
                            </div>

                            <!-- Kategori UMKM -->
                            <div class="col-md-3 col-sm-6">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">Kategori Jajanan</label>
                                <select name="kategori" class="form-select rounded-3">
                                    <option value="">Semua Kategori</option>
                                    <?php foreach ($all_categories as $cat): ?>
                                        <option value="<?= strtolower($cat) ?>" <?= ($kategori === strtolower($cat)) ? 'selected' : '' ?>><?= htmlspecialchars($cat) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Range Harga -->
                            <div class="col-md-3 col-sm-6">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">Harga Minimum (Rp)</label>
                                <input type="number" name="min_harga" class="form-control rounded-3" placeholder="0" value="<?= $min_harga ?: '' ?>">
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">Harga Maksimum (Rp)</label>
                                <input type="number" name="max_harga" class="form-control rounded-3" placeholder="100000" value="<?= $max_harga ?: '' ?>">
                            </div>

                            <!-- Status Halal -->
                            <div class="col-md-3 col-sm-6">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">Sertifikasi Halal</label>
                                <select name="halal" class="form-select rounded-3">
                                    <option value="">Semua Status</option>
                                    <option value="sudah" <?= ($halal === 'sudah') ? 'selected' : '' ?>>Sudah Sertifikasi</option>
                                    <option value="proses" <?= ($halal === 'proses') ? 'selected' : '' ?>>Proses Sertifikasi</option>
                                    <option value="belum" <?= ($halal === 'belum') ? 'selected' : '' ?>>Belum Mengurus</option>
                                    <option value="tidak" <?= ($halal === 'tidak') ? 'selected' : '' ?>>Non-Halal</option>
                                </select>
                            </div>

                            <!-- Kategori Rasa -->
                            <div class="col-md-3 col-sm-6">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">Rasa Populer</label>
                                <select name="rasa" class="form-select rounded-3">
                                    <option value="">Semua Rasa</option>
                                    <?php foreach ($all_rasa as $r): ?>
                                        <option value="<?= htmlspecialchars($r) ?>" <?= ($rasa === $r) ? 'selected' : '' ?>><?= htmlspecialchars($r) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Mitra Online -->
                            <div class="col-md-3 col-sm-6">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">Mitra Online</label>
                                <select name="mitra" class="form-select rounded-3">
                                    <option value="">Semua Platform</option>
                                    <?php foreach ($all_mitra as $m): ?>
                                        <option value="<?= htmlspecialchars($m) ?>" <?= ($mitra === $m) ? 'selected' : '' ?>><?= htmlspecialchars($m) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Metode Pembayaran -->
                            <div class="col-md-3 col-sm-6">
                                <label class="form-label fw-bold text-dark" style="font-size: 0.85rem;">Metode Pembayaran</label>
                                <select name="pembayaran" class="form-select rounded-3">
                                    <option value="">Semua Metode</option>
                                    <?php foreach ($all_pembayaran as $p): ?>
                                        <option value="<?= htmlspecialchars($p) ?>" <?= ($pembayaran === $p) ? 'selected' : '' ?>><?= htmlspecialchars($p) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Buka Sekarang & Submit -->
                            <div class="col-md-3 col-sm-6 d-flex align-items-end justify-content-between">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" name="buka_sekarang" value="1" id="bukaSekarang" <?= $buka_sekarang ? 'checked' : '' ?>>
                                    <label class="form-check-label fw-medium text-dark" for="bukaSekarang" style="font-size: 0.9rem;">
                                        Buka Saat Ini
                                    </label>
                                </div>
                                <button type="submit" class="btn text-white rounded-3 px-4" style="background-color: var(--sapa-green); font-weight: 500;">Terapkan</button>
                            </div>
                            
                            <div class="col-12 mt-2 text-end">
                                <a href="daftar-umkm.php" class="text-danger text-decoration-none" style="font-size: 0.85rem;"><i class="fas fa-times me-1"></i>Reset Filter</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <section class="catalog-section">
        <div class="container">
            <div class="row g-4">
                <?php if (empty($umkm_list)): ?>
                    <div class="col-12 text-center my-5">
                        <div class="fs-1 text-muted mb-3">🍽️</div>
                        <h4 class="text-muted">Tidak ada UMKM yang cocok dengan pencarian / filter Anda.</h4>
                        <p class="text-muted">Coba cari dengan kata kunci lain atau pilih kategori Semua Jajanan.</p>
                        <a href="daftar-umkm.php" class="btn btn-success mt-2 rounded-pill px-4" style="background-color: var(--sapa-green);">Lihat Semua UMKM</a>
                    </div>
                <?php else: ?>
                    <?php foreach ($umkm_list as $umkm): ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="umkm-card" onclick="window.location.href='detail-umkm.php?id=<?= $umkm['id_umkm'] ?>'">
                                <div class="umkm-card-img">
                                    <span class="badge-category"><?= $umkm['kategori'] ?></span>
                                    <img src="<?= $umkm['foto_path'] ?>" alt="<?= $umkm['nama_umkm'] ?>" style="height: 100%; object-fit: cover; width: 100%;">
                                </div>
                                <div class="umkm-card-body">
                                    <h3 class="umkm-name"><?= $umkm['nama_umkm'] ?></h3>
                                    <p class="umkm-clock">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"> <circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                        <?= $umkm['op_text'] ?>
                                    </p>
                                    <div class="umkm-rating">
                                        <span style="color: #d97706; font-weight: 700;">★ <?= $umkm['avg_rating'] > 0 ? $umkm['avg_rating'] : '-' ?></span>
                                        <span class="text-muted">(<?= $umkm['count_reviews'] ?> Ulasan)</span>
                                    </div>
                                    <a href="detail-umkm.php?id=<?= $umkm['id_umkm'] ?>" class="btn-detail">Lihat Detail UMKM</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php include '../includes/footer.php'; ?>
</body>
</html>