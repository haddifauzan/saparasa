<?php
require_once 'auth/middleware.php';
checkAdmin();
require_once '../config/conn.php';

$page_title = 'Data UMKM';
$topbar_title = 'Data UMKM';
include 'includes/head.php';
include 'includes/sidebar.php';
include 'includes/topbar.php';

// Fetch UMKM list
$umkm_list = [];
try {
    $result = $conn->query("SELECT u.*, k.nama_kategori FROM umkm u JOIN kategori_umkm k ON u.id_kategori = k.id_kategori ORDER BY u.id_umkm ASC");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $umkm_list[] = $row;
        }
    }
} catch (Exception $e) {
    echo "Gagal: " . $e->getMessage();
}


$statusLabel = ['active' => 'Aktif', 'pending' => 'Review', 'inactive' => 'Nonaktif'];
$categoryBadges = [
    'makanan' => 'bg-success text-white',
    'minuman' => 'bg-primary text-white',
    'makanan & minuman' => 'bg-warning text-white'
];
?>

<div id="main-content">
  <div class="page-content">
    <div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-2">
      <div>
        <h1 class="page-title"><i class="fas fa-store me-2"></i> Manajemen UMKM</h1>
        <p class="page-subtitle">Kelola data usaha mikro, kecil, dan menengah yang terdaftar</p>
      </div>
      <a href="tambah-umkm.php" class="btn btn-success"><i class="fas fa-plus me-1"></i> Tambah UMKM</a>
    </div>

    <?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $_SESSION['success'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['success']); endif; ?>
    
    <?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $_SESSION['error'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['error']); endif; ?>

    <div class="card">
      <div class="card-header">
        <h6 class="card-title">Daftar Mitra UMKM</h6>
      </div>
      <div class="card-body px-4 py-3">
        <div class="table-responsive">
          <table class="table table-striped table-hover datatable m-0">
            <thead>
              <tr>
                <th style="width: 80px;">ID</th>
                <th>Nama UMKM</th>
                <th>Kategori</th>
                <th>Pemilik</th>
                <th>Asal Daerah</th>
                <th>Halal</th>
                <th>Izin Usaha</th>
                <th style="width: 150px; text-align: center;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($umkm_list as $u): ?>
              <tr>
                <td><?= $u['id_umkm'] ?></td>
                <td><strong><?= $u['nama_umkm'] ?></strong></td>
                <td>
                  <?php 
                    $cat_lower = strtolower($u['nama_kategori']);
                    $badge_class = $categoryBadges[$cat_lower] ?? 'bg-secondary text-white';
                  ?>
                  <span class="badge <?= $badge_class ?> border"><?= $u['nama_kategori'] ?></span>
                </td>
                <td><?= $u['pemilik'] ?></td>
                <td class="text-muted"><i class="fas fa-map-marker-alt me-1"></i> <?= $u['asal_daerah'] ?></td>
                <td>
                  <span class="badge <?= $u['status_halal'] === 'sudah' ? 'bg-success' : ($u['status_halal'] === 'proses' ? 'bg-warning text-dark' : 'bg-secondary') ?>">
                    <?= ucfirst($u['status_halal']) ?>
                  </span>
                </td>
                <td>
                  <span class="badge <?= $u['izin_usaha'] === 'sudah' ? 'bg-success' : ($u['izin_usaha'] === 'proses' ? 'bg-warning text-dark' : 'bg-secondary') ?>">
                    <?= ucfirst($u['izin_usaha']) ?>
                  </span>
                </td>
                <td class="text-center">
                  <div class="d-flex justify-content-center gap-1">
                    <a href="detail-umkm.php?id=<?= $u['id_umkm'] ?>" class="btn-icon view text-decoration-none" title="Detail"><i class="fas fa-eye"></i></a>
                    <a href="edit-umkm.php?id=<?= $u['id_umkm'] ?>" class="btn-icon edit text-decoration-none" title="Edit"><i class="fas fa-edit"></i></a>
                    <button type="button" class="btn-icon delete border-0 bg-transparent" title="Hapus" data-bs-toggle="modal" data-bs-target="#deleteUMKMModal" onclick="document.getElementById('delete_id_umkm').value = '<?= $u['id_umkm'] ?>'; document.getElementById('delete_nama_umkm').innerText = '<?= addslashes(htmlspecialchars($u['nama_umkm'], ENT_QUOTES)) ?>';"><i class="fas fa-trash"></i></button>
                  </div>
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

<!-- Modal Hapus UMKM -->
<div class="modal fade" id="deleteUMKMModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="proses_umkm/hapus-umkm.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title text-danger"><i class="fas fa-exclamation-triangle me-2"></i> Konfirmasi Hapus</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Apakah Anda yakin ingin menghapus UMKM <strong id="delete_nama_umkm"></strong> beserta seluruh relasinya (menu, ulasan, foto, dll)?</p>
          <p class="text-danger mb-0"><small><i class="fas fa-info-circle me-1"></i> Tindakan ini tidak dapat dibatalkan!</small></p>
          <input type="hidden" name="id_umkm" id="delete_id_umkm" value="">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Ya, Hapus UMKM</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
