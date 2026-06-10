<?php
require_once 'auth/middleware.php';
require_once '../config/conn.php';

$page_title = 'Dashboard';
$topbar_title = 'Dashboard';
include 'includes/head.php';

// Fetch Metrics
$total_umkm = $conn->query("SELECT COUNT(*) AS total FROM umkm")->fetch_assoc()['total'] ?? 0;
$total_user = $conn->query("SELECT COUNT(*) AS total FROM users WHERE role = 'user'")->fetch_assoc()['total'] ?? 0;
$total_review = $conn->query("SELECT COUNT(*) AS total FROM review_pengunjung")->fetch_assoc()['total'] ?? 0;
$total_menu = $conn->query("SELECT COUNT(*) AS total FROM menu_umkm")->fetch_assoc()['total'] ?? 0;

// Fetch Review Ratings for Chart
$res_ratings = $conn->query("SELECT rating, COUNT(*) AS total FROM review_pengunjung GROUP BY rating");
$ratings_data = [1=>0, 2=>0, 3=>0, 4=>0, 5=>0];
if ($res_ratings) {
    while ($row = $res_ratings->fetch_assoc()) {
        $ratings_data[$row['rating']] = $row['total'];
    }
}

// Fetch Recent Logs
$res_logs = $conn->query("
    SELECT l.*, u.nama 
    FROM log_aktivitas l 
    LEFT JOIN users u ON l.id_user = u.id_user 
    ORDER BY l.waktu DESC 
    LIMIT 5
");
$recent_logs = [];
if ($res_logs) {
    while ($row = $res_logs->fetch_assoc()) {
        $recent_logs[] = $row;
    }
}

// Fetch Recent UMKM
$res_recent_umkm = $conn->query("
    SELECT nama_umkm, pemilik 
    FROM umkm 
    ORDER BY id_umkm DESC 
    LIMIT 5
");
$recent_umkm = [];
if ($res_recent_umkm) {
    while ($row = $res_recent_umkm->fetch_assoc()) {
        $recent_umkm[] = $row;
    }
}
?>

<?php include 'includes/sidebar.php'; ?>

<!-- Top Bar -->
<?php include 'includes/topbar.php'; ?>

<!-- Main Content -->
<div id="main-content">
  <div class="page-content">

    <!-- TAMPILKAN PESAN ERROR/SUKSES DARI PROSES BACKGROUND -->
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 10px;">
            <i class="fas fa-exclamation-circle me-2"></i><?= $_SESSION['error']; unset($_SESSION['error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 10px;">
            <i class="fas fa-check-circle me-2"></i><?= $_SESSION['success']; unset($_SESSION['success']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Welcome Banner -->
    <div class="welcome-banner mb-4">
      <div class="row align-items-center">
        <div class="col-md-8">
          <div class="date-badge"><i class="fas fa-calendar-alt me-2"></i> <span id="live-time">Memuat...</span></div>
          <h2>Selamat datang, <?= $_SESSION['nama'] ?? 'Administrator' ?>!</h2>
          <p class="mb-0">Pantau dan kelola semua statistik serta aktivitas platform Saparasa dari satu tempat.</p>
        </div>
        <div class="col-md-4 d-none d-md-flex justify-content-end">
          <div style="font-size:80px;opacity:0.3;"><i class="fas fa-leaf"></i></div>
        </div>
      </div>
    </div>

    <!-- Cards Section -->
    <div class="row g-3 mb-4">
        <!-- Card UMKM -->
        <div class="col-md-3">
            <div class="card bg-primary text-white h-100 shadow-sm border-0" style="border-radius: 12px;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-2 fw-bold" style="opacity: 0.8; font-size: 0.75rem;">Total UMKM</h6>
                            <h2 class="mb-0 fw-bold"><?= $total_umkm ?></h2>
                        </div>
                        <div class="fs-1" style="opacity: 0.4;"><i class="fas fa-store"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Card User -->
        <div class="col-md-3">
            <div class="card text-white h-100 shadow-sm border-0" style="background-color: #059669; border-radius: 12px;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-2 fw-bold" style="opacity: 0.8; font-size: 0.75rem;">Total User</h6>
                            <h2 class="mb-0 fw-bold"><?= $total_user ?></h2>
                        </div>
                        <div class="fs-1" style="opacity: 0.4;"><i class="fas fa-users"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Card Review -->
        <div class="col-md-3">
            <div class="card text-dark h-100 shadow-sm border-0" style="background-color: #fbbf24; border-radius: 12px;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-2 fw-bold text-light" style="font-size: 0.75rem;">Total Ulasan</h6>
                            <h2 class="mb-0 fw-bold text-light"><?= $total_review ?></h2>
                        </div>
                        <div class="fs-1" style="opacity: 0.4;"><i class="fas fa-star text-light"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Card Menu -->
        <div class="col-md-3">
            <div class="card text-white h-100 shadow-sm border-0" style="background-color: #ea580c; border-radius: 12px;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-2 fw-bold" style="opacity: 0.8; font-size: 0.75rem;">Total Menu</h6>
                            <h2 class="mb-0 fw-bold"><?= $total_menu ?></h2>
                        </div>
                        <div class="fs-1" style="opacity: 0.4;"><i class="fas fa-utensils"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Recent UMKM -->
    <div class="row g-3 mb-4">
        <!-- Chart Ulasan -->
        <div class="col-md-7">
            <div class="card h-100 shadow-sm border-0" style="border-radius: 12px;">
                <div class="card-header bg-white border-bottom-0 pt-3 pb-0">
                    <h6 class="card-title mb-0 fw-bold"><i class="fas fa-chart-bar me-2 text-dark"></i> Statistik Ulasan Bintang</h6>
                </div>
                <div class="card-body">
                    <div style="position: relative; height: 250px; width: 100%;">
                        <canvas id="reviewChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- UMKM Terbaru -->
        <div class="col-md-5">
            <div class="card h-100 shadow-sm border-0" style="border-radius: 12px;">
                <div class="card-header bg-white border-bottom-0 pt-3 pb-0">
                    <h6 class="card-title mb-0 fw-bold"><i class="fas fa-store-alt me-2 text-dark"></i> UMKM Terbaru</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <?php if (empty($recent_umkm)): ?>
                            <li class="list-group-item text-muted border-0 px-0">Belum ada UMKM terdaftar.</li>
                        <?php else: ?>
                            <?php foreach($recent_umkm as $umkm): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 py-2 mb-1">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center text-secondary me-3" style="width: 40px; height: 40px;">
                                            <i class="fas fa-store"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-bold" style="font-size: 0.9rem;"><?= $umkm['nama_umkm'] ?></h6>
                                        </div>
                                    </div>
                                    <span class="badge bg-light text-dark border"><?= $umkm['pemilik'] ?></span>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Log Aktivitas Terbaru -->
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px;">
        <div class="card-header bg-white border-bottom-0 pt-3 pb-2 d-flex justify-content-between align-items-center">
            <h6 class="card-title mb-0 fw-bold"><i class="fas fa-history me-2 text-dark"></i> Log Aktivitas Terbaru</h6>
            <a href="log-aktivitas.php" class="btn btn-sm btn-outline-primary" style="border-radius: 6px;">Lihat Semua</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle m-0">
                    <thead class="table-light text-muted" style="font-size: 0.85rem;">
                        <tr>
                            <th class="ps-4">Waktu</th>
                            <th>User</th>
                            <th class="pe-4">Deskripsi Aktivitas</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 0.9rem;">
                        <?php if (empty($recent_logs)): ?>
                            <tr><td colspan="3" class="text-center text-muted py-4">Belum ada aktivitas tercatat.</td></tr>
                        <?php else: ?>
                            <?php foreach($recent_logs as $log): ?>
                                <tr>
                                    <td class="ps-4" style="width: 200px;">
                                        <span class="text-muted"><i class="far fa-clock me-1"></i> <?= date('d M Y H:i', strtotime($log['waktu'])) ?></span>
                                    </td>
                                    <td>
                                        <span class="px-3 py-1">
                                            <i class="fas fa-user-circle me-1"></i> <?= $log['nama'] ?? 'Sistem' ?>
                                        </span>
                                    </td>
                                    <td class="pe-4 text-dark"><?= $log['aktivitas'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

  </div><!-- /.page-content -->
</div><!-- /#main-content -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const ctx = document.getElementById('reviewChart');
    if(ctx) {
        new Chart(ctx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['Bintang 1', 'Bintang 2', 'Bintang 3', 'Bintang 4', 'Bintang 5'],
                datasets: [{
                    label: 'Jumlah Ulasan',
                    data: [
                        <?= $ratings_data[1] ?>,
                        <?= $ratings_data[2] ?>,
                        <?= $ratings_data[3] ?>,
                        <?= $ratings_data[4] ?>,
                        <?= $ratings_data[5] ?>
                    ],
                    backgroundColor: [
                        'rgba(239, 68, 68, 0.8)',   // 1 star (Red)
                        'rgba(249, 115, 22, 0.8)',  // 2 star (Orange)
                        'rgba(250, 204, 21, 0.8)',  // 3 star (Yellow)
                        'rgba(132, 204, 22, 0.8)',  // 4 star (Light Green)
                        'rgba(34, 197, 94, 0.8)'    // 5 star (Green)
                    ],
                    borderRadius: 6,
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { 
                            precision: 0,
                            stepSize: 1
                        },
                        grid: {
                            borderDash: [5, 5]
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 10,
                        cornerRadius: 8
                    }
                }
            }
        });
    }
});
</script>

<?php include 'includes/footer.php'; ?>
