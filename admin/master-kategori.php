<?php
require_once 'auth/middleware.php';
checkAdmin();
require_once '../config/conn.php';

// Fetch categories
$categories = [];
try {
    $result = $conn->query("SELECT * FROM kategori_umkm ORDER BY id_kategori ASC");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

$page_title = 'Kategori UMKM';
$topbar_title = 'Kategori UMKM';
include 'includes/head.php';
include 'includes/sidebar.php';
include 'includes/topbar.php';
?>

<div id="main-content">
  <div class="page-content">
    <div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-2">
      <div>
        <h1 class="page-title"><i class="fas fa-tags me-2"></i> Kategori UMKM</h1>
        <p class="page-subtitle">Kelola kategori pengelompokkan jenis usaha UMKM Saparasa</p>
      </div>
      <button class="btn-primary-custom" data-bs-toggle="modal" data-bs-target="#tambahModal"><i class="fas fa-plus me-1"></i> Tambah Kategori</button>
    </div>

    <!-- Alert Success/Error from Session -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 8px;">
            <i class="fas fa-check-circle me-2"></i>
            <?= $_SESSION['success']; unset($_SESSION['success']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 8px;">
            <i class="fas fa-exclamation-circle me-2"></i>
            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card">
      <div class="card-header">
        <h6 class="card-title">Daftar Kategori</h6>
      </div>
      <div class="card-body px-4 py-3">
        <div class="table-responsive">
          <table class="table table-striped table-hover datatable m-0">
            <thead>
              <tr>
                <th style="width: 50px;">No</th>
                <th>Nama Kategori</th>
                <th style="width: 150px; text-align: center;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $no = 1;
              foreach ($categories as $cat): 
              ?>
              <tr>
                <td><strong><?= $no++ ?></strong></td>
                <td><?= $cat['nama_kategori'] ?></td>
                <td class="text-center">
                  <button class="btn-icon edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $cat['id_kategori'] ?>" data-nama="<?= $cat['nama_kategori'] ?>"><i class="fas fa-edit"></i></button>
                  <button class="btn-icon delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $cat['id_kategori'] ?>" data-nama="<?= $cat['nama_kategori'] ?>"><i class="fas fa-trash"></i></button>
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

<!-- Modal Tambah -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content border-0 shadow" style="border-radius: 12px;">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahModalLabel"><i class="fas fa-plus me-2"></i> Tambah Kategori</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="proses/tambah/kategori.php" method="POST">
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Nama Kategori</label>
            <input type="text" name="nama_kategori" class="form-control" required placeholder="Masukkan nama kategori baru...">
          </div>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 8px;">Batal</button>
          <button type="submit" class="btn btn-success" style="border-radius: 8px;">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content border-0 shadow" style="border-radius: 12px;">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel"><i class="fas fa-edit me-2"></i> Edit Kategori</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="proses/edit/kategori.php" method="POST">
        <input type="hidden" name="id_kategori" id="edit-id">
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Nama Kategori</label>
            <input type="text" name="nama_kategori" id="edit-nama" class="form-control" required placeholder="Masukkan nama kategori...">
          </div>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 8px;">Batal</button>
          <button type="submit" class="btn btn-success" style="border-radius: 8px;">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content border-0 shadow" style="border-radius: 12px;">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel" class="text-danger"><i class="fas fa-trash me-2"></i> Konfirmasi Hapus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="proses/hapus/kategori.php" method="POST">
        <input type="hidden" name="id_kategori" id="delete-id">
        <div class="modal-body">
          <p>Apakah Anda yakin ingin menghapus kategori <strong id="delete-nama-span"></strong>? Tindakan ini tidak dapat dibatalkan.</p>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 8px;">Batal</button>
          <button type="submit" class="btn btn-danger" style="border-radius: 8px;">Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const editModal = document.getElementById('editModal');
    if (editModal) {
        editModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const nama = button.getAttribute('data-nama');
            
            editModal.querySelector('#edit-id').value = id;
            editModal.querySelector('#edit-nama').value = nama;
        });
    }

    const deleteModal = document.getElementById('deleteModal');
    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const nama = button.getAttribute('data-nama');
            
            deleteModal.querySelector('#delete-id').value = id;
            deleteModal.querySelector('#delete-nama-span').textContent = nama;
        });
    }
});
</script>

<?php include 'includes/footer.php'; ?>
