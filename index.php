<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'config/conn.php';

$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

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

// CALL sp_get_umkm_list(p_search, p_category, p_today, p_limit)
$stmt = $conn->prepare("CALL sp_get_umkm_list(?, '', ?, ?)");
$limit = ($keyword !== '') ? 0 : 6;
$stmt->bind_param("ssi", $keyword, $today, $limit);
$stmt->execute();
$result = $stmt->get_result();

$umkm_list = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $foto_path = !empty($row['foto']) ? 'public/uploads/galeri_umkm/' . $row['foto'] : 'assets/img/DimsumSmoothies.jpg';
        
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
    <title>SAPARASA</title>
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css?v=1.2">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
</head>
<body>
    <?php 
    $base_path = '';
    $active_page = 'beranda';
    include 'includes/navbar.php'; 
    ?>

    <section class="hero-section" id="home">
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
                    
                    <form action="#umkm" method="GET" class="w-100 my-4" style="max-width: 500px;">
                        <div class="input-group p-2 bg-white rounded-pill shadow-sm border" style="border-color: #EAE5DC !important;">
                            <input type="text" name="keyword" class="form-control border-0 px-3 bg-transparent" placeholder="Cari menu atau jajanan... (e.g. Matcha, Dimsum)" style="box-shadow: none; font-size: 0.9rem;">
                            <button class="btn text-white rounded-pill px-4" type="submit" style="background-color: #1d6a4a; font-size: 0.9rem; font-weight: 500;">
                                Cari
                            </button>
                        </div>
                    </form>

                    <div class="d-flex flex-wrap gap-3">
                        <a href="#umkm" class="btn-hero-primary">Jelajahi UMKM</a>
                    </div>
                </div>

                <div class="col-lg-6 d-none d-lg-block">
                    <div class="row g-3 justify-content-center align-items-center">
                        <div class="col-7">
                            <div class="card border-0 rounded-4 shadow-lg overflow-hidden position-relative" style="transform: rotate(-2deg); transition: transform 0.3s;">
                                <img src="assets/img/sapa1.png" alt="Dimsum" class="card-img-top" style="height: 240px; object-fit: cover;">
                            </div>
                        </div>
                        
                        <div class="col-5 d-flex flex-column gap-3">
                            <div class="card border-0 rounded-4 shadow-sm overflow-hidden position-relative" style="transform: rotate(3deg); transition: transform 0.3s;">
                                <img src="assets/img/sapa2.png" alt="Batagor" class="card-img-top" style="height: 130px; object-fit: cover;">
                            </div>

                            <div class="card border-0 rounded-4 shadow-sm overflow-hidden position-relative" style="transform: rotate(-1deg); transition: transform 0.3s;">
                                <img src="assets/img/sapa3.png" alt="Coffee" class="card-img-top" style="height: 130px; object-fit: cover;">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="umkm-section" id="umkm">
        <div class="container">
            <div class="row align-items-end mb-5">
                <div class="col-md-7">
                    <p class="section-label">Daftar UMKM</p>
                    <div class="divider-green"></div>
                    <h2 class="section-title">UMKM Pilihan<br>di Saparua Bandung</h2>
                </div>
                <div class="col-md-5 text-md-end mt-3 mt-md-0">
                    <a href="pages/daftar-umkm.php" style="font-size: 0.88rem; font-weight:600; color:var(--sapa-green); text-decoration:none;">Lihat Semua UMKM →</a>
                </div>
            </div>
            <div class="row g-4">
                <?php if (empty($umkm_list)): ?>
                    <div class="col-12 text-center my-5">
                        <div class="fs-1 text-muted mb-3"><i class="fa-solid fa-utensils"></i></div>
                        <h4 class="text-muted">Tidak ada UMKM yang cocok dengan pencarian "<strong><?= $keyword ?></strong>"</h4>
                        <p class="text-muted">Coba cari dengan kata kunci lain seperti "Dimsum", "Kopi", atau "Pedas".</p>
                        <a href="index.php#umkm" class="btn btn-success mt-2 rounded-pill px-4" style="background-color: #1d6a4a;">Lihat Semua UMKM</a>
                    </div>
                <?php else: ?>
                    <?php foreach ($umkm_list as $umkm): ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="umkm-card" onclick="window.location.href='pages/detail-umkm.php?id=<?= $umkm['id_umkm'] ?>'">
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
                                    <a href="pages/detail-umkm.php?id=<?= $umkm['id_umkm'] ?>" class="btn-detail">Lihat Detail UMKM</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>        </div>
        </div>
    </section>


    <?php include 'includes/footer.php'; ?>
</body>
</html>