<?php
require_once 'auth/middleware.php';
checkAdmin();
require_once '../config/conn.php';

$page_title = 'Daftar User';
$topbar_title = 'Pengguna - User';
include 'includes/head.php';
include 'includes/sidebar.php';
include 'includes/topbar.php';

// Fetch users
$users = [];
try {
    $result = $conn->query("SELECT * FROM users WHERE role = 'user' ORDER BY id_user ASC");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    }
} catch (Exception $e) {
    // Database fallback
}

// Fallback to mock data if empty
if (empty($users)) {
    $users = [
        [
            'id_user' => 3,
            'nama' => 'User Setia',
            'email' => 'user@gmail.com',
            'role' => 'user',
            'foto_profile' => 'default_user.png',
            'created_at' => '2024-02-15 11:20:00'
        ],
        [
            'id_user' => 4,
            'nama' => 'Budi Santoso',
            'email' => 'budi@email.com',
            'role' => 'user',
            'foto_profile' => 'default_user.png',
            'created_at' => '2024-03-01 14:15:00'
        ],
        [
            'id_user' => 5,
            'nama' => 'Siti Aminah',
            'email' => 'siti@email.com',
            'role' => 'user',
            'foto_profile' => 'default_user.png',
            'created_at' => '2024-03-10 16:45:00'
        ]
    ];
}
?>

<div id="main-content">
  <div class="page-content">
    <div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-2">
      <div>
        <h1 class="page-title"><i class="fas fa-users me-2"></i> Manajemen User</h1>
        <p class="page-subtitle">Kelola akun pengguna/pengunjung platform Saparasa</p>
      </div>
      <button class="btn-primary-custom"><i class="fas fa-plus me-1"></i> Tambah User</button>
    </div>

    <div class="card">
      <div class="card-header">
        <h6 class="card-title">Daftar User</h6>
      </div>
      <div class="card-body px-4 py-3">
        <div class="table-responsive">
          <table class="table table-striped table-hover datatable m-0">
            <thead>
              <tr>
                <th style="width: 80px;">ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Peran</th>
                <th>Tanggal Terdaftar</th>
                <th style="width: 150px; text-align: center;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($users as $index => $usr): ?>
              <tr>
                <td><?= $usr['id_user'] ?></td>
                <td>
                  <div class="d-flex align-items-center gap-2">
                    <div style="width:34px;height:34px;border-radius:10px;overflow:hidden;background:#3b82f6;
                                display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:13px;flex-shrink:0">
                      <?php 
                      $foto = $usr['foto_profile'] ?? 'default_user.png';
                      $foto_path = "../public/uploads/foto_profile/" . $foto;
                      if (file_exists($foto_path) && !empty($usr['foto_profile'])):
                      ?>
                        <img src="<?= $foto_path ?>" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover;">
                      <?php else: ?>
                        <?= strtoupper(substr($usr['nama'], 0, 1)) ?>
                      <?php endif; ?>
                    </div>
                    <strong><?= $usr['nama'] ?></strong>
                  </div>
                </td>
                <td class="text-muted"><?= $usr['email'] ?></td>
                <td>
                  <span class="badge bg-secondary text-white">
                    <?= ucfirst($usr['role']) ?>
                  </span>
                </td>
                <td class="text-muted">
                  <?= date('d M Y', strtotime($usr['created_at'])) ?>
                </td>
                <td class="text-center">
                  <button class="btn-icon edit"><i class="fas fa-edit"></i></button>
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
