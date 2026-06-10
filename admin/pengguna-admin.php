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
    echo "Gagal: " . $e->getMessage();
}

?>

<div id="main-content">
  <div class="page-content">
    <div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-2">
      <div>
        <h1 class="page-title"><i class="fas fa-user-shield me-2"></i> Manajemen Admin</h1>
        <p class="page-subtitle">Kelola akun administrator platform Saparasa</p>
      </div>
      <button class="btn-primary-custom" data-bs-toggle="modal" data-bs-target="#addAdminModal"><i class="fas fa-plus me-1"></i> Tambah Admin</button>
    </div>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $_SESSION['success'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $_SESSION['error'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

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
                <th>Role</th>
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
                  <?php if ($adm['id_user'] != $_SESSION['id_user']): ?>
                    <form action="proses/hapus/admin.php" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus admin ini?');">
                        <input type="hidden" name="id_user" value="<?= $adm['id_user'] ?>">
                        <button type="submit" class="btn-icon delete"><i class="fas fa-trash"></i></button>
                    </form>
                  <?php else: ?>
                    <button class="btn-icon text-muted" disabled title="Anda tidak bisa menghapus akun Anda sendiri"><i class="fas fa-trash"></i></button>
                  <?php endif; ?>
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

<!-- Modal Tambah Admin -->
<div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="proses/tambah/admin.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="addAdminModalLabel">Tambah Admin Baru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" name="nama" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
