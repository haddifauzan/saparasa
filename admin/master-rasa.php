<?php
require_once 'auth/middleware.php';
checkAdmin();
require_once '../config/conn.php';

// Fetch rasa
$rasa = [];
try {
    $result = $conn->query("SELECT * FROM kategori_rasa ORDER BY id_rasa ASC");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $rasa[] = $row;
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

$page_title = 'Data Rasa';
$topbar_title = 'Data Rasa';
include 'includes/head.php';
include 'includes/sidebar.php';
include 'includes/topbar.php';
?>

<div id="main-content">
  <div class="page-content">
    <div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-2">
      <div>
        <h1 class="page-title"><i class="fas fa-cookie-bite me-2"></i> Data Rasa</h1>
        <p class="page-subtitle">Kelola kategori rasa makanan/minuman produk UMKM</p>
      </div>
      <button class="btn-primary-custom" data-bs-toggle="modal" data-bs-target="#tambahModal"><i class="fas fa-plus me-1"></i> Tambah Rasa</button>
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
        <h6 class="card-title">Daftar Kategori Rasa</h6>
      </div>
      <div class="card-body px-4 py-3">
        <div class="table-responsive">
          <table class="table table-striped table-hover datatable m-0">
            <thead>
              <tr>
                <th style="width: 50px;">No</th>
                <th>Nama Rasa</th>
                <th style="width: 150px; text-align: center;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $no = 1;
              foreach ($rasa as $r): 
              ?>
              <tr>
                <td><strong><?= $no++ ?></strong></td>
                <td><?= $r['nama_rasa'] ?></td>
                <td class="text-center">
                  <button class="btn-icon edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?= $r['id_rasa'] ?>" data-nama="<?= $r['nama_rasa'] ?>"><i class="fas fa-edit"></i></button>
                  <button class="btn-icon delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $r['id_rasa'] ?>" data-nama="<?= $r['nama_rasa'] ?>"><i class="fas fa-trash"></i></button>
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
        <h5 class="modal-title" id="tambahModalLabel"><i class="fas fa-plus me-2"></i> Tambah Rasa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="proses/tambah/rasa.php" method="POST">
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Nama Rasa</label>
            <input type="text" name="nama_rasa" class="form-control" required placeholder="Masukkan nama rasa baru...">
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
        <h5 class="modal-title" id="editModalLabel"><i class="fas fa-edit me-2"></i> Edit Rasa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="proses/edit/rasa.php" method="POST">
        <input type="hidden" name="id_rasa" id="edit-id">
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Nama Rasa</label>
            <input type="text" name="nama_rasa" id="edit-nama" class="form-control" required placeholder="Masukkan nama rasa...">
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
        <h5 class="modal-title id="deleteModalLabel" class="text-danger"><i class="fas fa-trash me-2"></i> Konfirmasi Hapus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="proses/hapus/rasa.php" method="POST">
        <input type="hidden" name="id_rasa" id="delete-id">
        <div class="modal-body">
          <p>Apakah Anda yakin ingin menghapus data rasa <strong id="delete-nama-span"></strong>? Tindakan ini tidak dapat dibatalkan.</p>
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
