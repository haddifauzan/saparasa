<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../config/conn.php';

$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$kategori = isset($_GET['kategori']) ? trim($_GET['kategori']) : '';

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

// Fetch dynamic categories
$cat_stmt = $conn->query("SELECT nama_kategori FROM kategori_umkm ORDER BY id_kategori ASC");
$all_categories = [];
if ($cat_stmt) {
    while ($row = $cat_stmt->fetch_assoc()) {
        $all_categories[] = $row['nama_kategori'];
    }
}

$cat_param = '';
foreach ($all_categories as $cat) {
    if (strtolower($kategori) === strtolower($cat)) {
        $cat_param = $cat;
        break;
    }
}

$stmt = $conn->prepare("CALL sp_get_umkm_list(?, ?, ?, 0)");
$stmt->bind_param("sss", $keyword, $cat_param, $today);
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
while ($conn->next_result()) {
    $conn->store_result();
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
                <a href="daftar-umkm.php" class="btn-filter <?= $cat_param === '' ? 'active' : '' ?>">Semua Jajanan</a>
                <?php foreach ($all_categories as $cat): ?>
                    <a href="daftar-umkm.php?kategori=<?= urlencode(strtolower($cat)) ?>" class="btn-filter <?= $cat_param === $cat ? 'active' : '' ?>"><?= htmlspecialchars($cat) ?></a>
                <?php endforeach; ?>
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