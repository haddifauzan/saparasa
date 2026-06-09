<?php
require_once 'auth/middleware.php';
checkAdmin();
require_once '../config/conn.php';

$page_title = 'Daftar Admin';
$topbar_title = 'Pengguna - Admin';
include 'includes/head.php';
include 'includes/sidebar.php';
include 'includes/topbar.php';

// Fetch admins
$admins = [];
try {
    $result = $conn->query("SELECT * FROM users WHERE role = 'admin' ORDER BY id_user ASC");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $admins[] = $row;
        }
    }
} catch (Exception $e) {
    // Database fallback
}

// Fallback to mock data if empty
if (empty($admins)) {
    $admins = [
        [
            'id_user' => 1,
            'nama' => 'Admin Gege',
            'email' => 'admin@saparasa.com',
            'role' => 'admin',
            'foto_profile' => 'default_admin.png',
            'created_at' => '2024-01-12 10:00:00'
        ],
        [
            'id_user' => 2,
            'nama' => 'Super Admin Saparasa',
            'email' => 'superadmin@saparasa.com',
            'role' => 'admin',
            'foto_profile' => 'default_user.png',
            'created_at' => '2024-01-01 09:00:00'
        ]
    ];
}
?>

<div id="main-content">
  <div class="page-content">
    <div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-2">
      <div>
        <h1 class="page-title"><i class="fas fa-user-shield me-2"></i> Manajemen Admin</h1>
        <p class="page-subtitle">Kelola akun administrator platform Saparasa</p>
      </div>
      <button class="btn-primary-custom"><i class="fas fa-plus me-1"></i> Tambah Admin</button>
    </div>

    <div class="card">
      <div class="card-header">
        <h6 class="card-title">Daftar Admin</h6>
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
              <?php foreach ($admins as $index => $adm): ?>
              <tr>
                <td><?= $adm['id_user'] ?></td>
                <td>
                  <div class="d-flex align-items-center gap-2">
                    <div style="width:34px;height:34px;border-radius:10px;overflow:hidden;background:#1d6a4a;
                                display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:13px;flex-shrink:0">
                      <?php 
                      $foto = $adm['foto_profile'] ?? 'default_user.png';
                      $foto_path = "../public/uploads/foto_profile/" . $foto;
                      if (file_exists($foto_path) && !empty($adm['foto_profile'])):
                      ?>
                        <img src="<?= $foto_path ?>" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover;">
                      <?php else: ?>
                        <?= strtoupper(substr($adm['nama'], 0, 1)) ?>
                      <?php endif; ?>
                    </div>
                    <strong><?= $adm['nama'] ?></strong>
                  </div>
                </td>
                <td class="text-muted"><?= $adm['email'] ?></td>
                <td>
                  <span class="badge bg-success text-white">
                    <?= ucfirst($adm['role']) ?>
                  </span>
                </td>
                <td class="text-muted">
                  <?= date('d M Y', strtotime($adm['created_at'])) ?>
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
