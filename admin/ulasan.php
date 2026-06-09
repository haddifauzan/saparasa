<?php
require_once 'auth/middleware.php';
checkAdmin();
require_once '../config/conn.php';

$page_title = 'Ulasan / Review';
$topbar_title = 'Ulasan Pengunjung';
include 'includes/head.php';
include 'includes/sidebar.php';
include 'includes/topbar.php';

// Fetch reviews
$reviews = [];
try {
    $result = $conn->query("SELECT r.*, u.nama as nama_user, m.nama_umkm FROM review_pengunjung r JOIN users u ON r.id_user = u.id_user JOIN umkm m ON r.id_umkm = m.id_umkm ORDER BY r.created_at DESC");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $reviews[] = $row;
        }
    }
} catch (Exception $e) {
    // Database fallback
}

// Fallback to mock data if empty
if (empty($reviews)) {
    $reviews = [
        [
            'id_review' => 1,
            'nama_user' => 'User Setia',
            'nama_umkm' => 'Minang Jaya',
            'rating' => 5,
            'komentar' => 'Makanannya enak sekali dan porsinya besar. Rendangnya juara!',
            'created_at' => '2026-06-09 13:12:00'
        ],
        [
            'id_review' => 2,
            'nama_user' => 'Budi Santoso',
            'nama_umkm' => 'Kopi Nusantara',
            'rating' => 4,
            'komentar' => 'Kopi Gayo-nya mantap, wangi sekali. Tempatnya asyik buat kerja.',
            'created_at' => '2026-06-08 15:30:00'
        ],
        [
            'id_review' => 3,
            'nama_user' => 'Siti Aminah',
            'nama_umkm' => 'Batik Cirebon',
            'rating' => 5,
            'komentar' => 'Bahan batiknya halus sekali, motifnya juga modern dan bervariasi.',
            'created_at' => '2026-06-07 10:45:00'
        ]
    ];
}
?>

<div id="main-content">
  <div class="page-content">
    <div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-2">
      <div>
        <h1 class="page-title"><i class="fas fa-star text-warning me-2"></i> Ulasan / Review</h1>
        <p class="page-subtitle">Kelola dan tinjau ulasan dari pengunjung tentang usaha mitra UMKM</p>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <h6 class="card-title">Semua Ulasan</h6>
      </div>
      <div class="card-body px-4 py-3">
        <div class="table-responsive">
          <table class="table table-striped table-hover datatable m-0">
            <thead>
              <tr>
                <th style="width: 80px;">ID</th>
                <th>Pengguna</th>
                <th>Mitra UMKM</th>
                <th>Rating</th>
                <th>Komentar</th>
                <th>Tanggal</th>
                <th style="width: 100px; text-align: center;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($reviews as $rev): ?>
              <tr>
                <td><?= $rev['id_review'] ?></td>
                <td><strong><?= $rev['nama_user'] ?></strong></td>
                <td><span class="text-primary fw-600"><?= $rev['nama_umkm'] ?></span></td>
                <td>
                  <span class="text-warning">
                    <?php for ($i = 0; $i < 5; $i++): ?>
                      <i class="<?= $i < $rev['rating'] ? 'fas' : 'far' ?> fa-star"></i>
                    <?php endfor; ?>
                  </span>
                </td>
                <td><em>"<?= $rev['komentar'] ?>"</em></td>
                <td class="text-muted">
                  <?= date('d M Y H:i', strtotime($rev['created_at'])) ?>
                </td>
                <td class="text-center">
                  <button class="btn-icon delete"><i class="fas fa-trash"></i></button>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
