<?php
require_once 'auth/middleware.php';
checkAdmin();
require_once '../config/conn.php';

$page_title = 'Log Aktivitas';
$topbar_title = 'Sistem - Log Aktivitas';
include 'includes/head.php';
include 'includes/sidebar.php';
include 'includes/topbar.php';

// Fetch activity logs
$logs = [];
try {
    $result = $conn->query("SELECT l.*, u.nama FROM log_aktivitas l JOIN users u ON l.id_user = u.id_user ORDER BY l.waktu DESC LIMIT 100");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $logs[] = $row;
        }
    }
} catch (Exception $e) {
    // Database fallback
}

// Fallback to mock data if empty
if (empty($logs)) {
    $logs = [
        [
            'id_log' => 1,
            'nama' => 'Admin Gege',
            'aktivitas' => 'Melakukan login sistem admin panel',
            'waktu' => '2026-06-09 13:45:21'
        ],
        [
            'id_log' => 2,
            'nama' => 'Admin Gege',
            'aktivitas' => 'Memperbarui foto profil dan data akun admin',
            'waktu' => '2026-06-09 13:56:03'
        ],
        [
            'id_log' => 3,
            'nama' => 'Super Admin',
            'aktivitas' => 'Menambahkan kategori UMKM baru: Oleh-oleh',
            'waktu' => '2026-06-09 10:20:15'
        ],
        [
            'id_log' => 4,
            'nama' => 'User Setia',
            'aktivitas' => 'Memberikan review rating 5 pada UMKM Minang Jaya',
            'waktu' => '2026-06-09 09:12:00'
        ]
    ];
}
?>

<div id="main-content">
  <div class="page-content">
    <div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-2">
      <div>
        <h1 class="page-title"><i class="fas fa-history me-2"></i> Log Aktivitas</h1>
        <p class="page-subtitle">Daftar rekam jejak aktivitas pengguna dan sistem Saparasa</p>
      </div>
      <button class="btn btn-outline-danger btn-sm"><i class="fas fa-trash me-1"></i> Bersihkan Log</button>
    </div>

    <div class="card">
      <div class="card-header">
        <h6 class="card-title">Aktivitas Terbaru</h6>
      </div>
      <div class="card-body px-4 py-3">
        <div class="table-responsive">
          <table class="table table-striped table-hover datatable m-0">
            <thead>
              <tr>
                <th style="width: 80px;">ID</th>
                <th>Pengguna</th>
                <th>Aktivitas</th>
                <th>Waktu</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($logs as $log): ?>
              <tr>
                <td><?= $log['id_log'] ?></td>
                <td><strong><?= $log['nama'] ?></strong></td>
                <td><?= $log['aktivitas'] ?></td>
                <td class="text-muted">
                  <?= date('d M Y H:i:s', strtotime($log['waktu'])) ?>
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
