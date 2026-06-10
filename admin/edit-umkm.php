<?php
require_once 'auth/middleware.php';
checkAdmin();
require_once '../config/conn.php';

$id = $_GET['id'] ?? 0;

if (!$id) {
    header("Location: umkm.php");
    exit;
}

// Fetch UMKM Data
$umkm = [];
try {
    $stmt = $conn->prepare("SELECT * FROM umkm WHERE id_umkm = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        $_SESSION['error'] = "UMKM tidak ditemukan.";
        header("Location: umkm.php");
        exit;
    }
    $umkm = $result->fetch_assoc();
} catch (Exception $e) {
    $_SESSION['error'] = "Gagal mengambil data UMKM.";
    header("Location: umkm.php");
    exit;
}

$page_title = 'Edit UMKM: ' . $umkm['nama_umkm'];
$topbar_title = 'Edit UMKM';
include 'includes/head.php';
include 'includes/sidebar.php';
include 'includes/topbar.php';

// Get categories
$kategori = [];
try {
    $res = $conn->query("SELECT * FROM kategori_umkm ORDER BY nama_kategori ASC");
    while ($row = $res->fetch_assoc()) {
        $kategori[] = $row;
    }
} catch (Exception $e) {}

// Retrieve old data if validation failed
$old = $_SESSION['old_input'] ?? $umkm;
unset($_SESSION['old_input']);
?>

<div id="main-content">
  <div class="page-content">
    <div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-2">
      <div>
        <h1 class="page-title"><i class="fas fa-edit me-2"></i> Edit UMKM</h1>
        <p class="page-subtitle">Perbarui informasi utama UMKM</p>
      </div>
      <div>
          <a href="detail-umkm.php?id=<?= $id ?>" class="btn btn-info text-white me-2"><i class="fas fa-eye me-1"></i> Detail</a>
          <a href="umkm.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
      </div>
    </div>

    <?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i> <?= $_SESSION['error'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['error']); endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i> <?= $_SESSION['success'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['success']); endif; ?>

    <div class="card">
      <div class="card-body p-4">
        <form action="proses_umkm/edit-umkm.php" method="POST" class="needs-validation" novalidate>
          <input type="hidden" name="id_umkm" value="<?= $id ?>">
          <div class="row g-4">
            <!-- Informasi Dasar -->
            <div class="col-md-12 mb-2">
                <h5 class="text-dark border-bottom pb-2">Informasi Dasar</h5>
            </div>
            
            <div class="col-md-6">
              <label for="nama_umkm" class="form-label">Nama UMKM <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="nama_umkm" name="nama_umkm" value="<?= $old['nama_umkm'] ?? '' ?>" required>
              <div class="invalid-feedback">Nama UMKM wajib diisi.</div>
            </div>
            
            <div class="col-md-6">
              <label for="id_kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
              <select class="form-select" id="id_kategori" name="id_kategori" required>
                <option value="">-- Pilih Kategori --</option>
                <?php foreach($kategori as $k): ?>
                <option value="<?= $k['id_kategori'] ?>" <?= ($old['id_kategori'] ?? '') == $k['id_kategori'] ? 'selected' : '' ?>><?= $k['nama_kategori'] ?></option>
                <?php endforeach; ?>
              </select>
              <div class="invalid-feedback">Kategori wajib dipilih.</div>
            </div>

            <div class="col-md-6">
              <label for="pemilik" class="form-label">Nama Pemilik <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="pemilik" name="pemilik" value="<?= $old['pemilik'] ?? '' ?>" required>
              <div class="invalid-feedback">Nama Pemilik wajib diisi.</div>
            </div>

            <div class="col-md-6">
              <label for="tahun_berdiri" class="form-label">Tahun Berdiri</label>
              <input type="number" min="1900" max="<?= date('Y') ?>" class="form-control" id="tahun_berdiri" name="tahun_berdiri" value="<?= $old['tahun_berdiri'] ?? '' ?>">
            </div>

            <div class="col-md-12">
              <label for="deskripsi" class="form-label">Deskripsi UMKM <span class="text-danger">*</span></label>
              <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required><?= $old['deskripsi'] ?? '' ?></textarea>
              <div class="invalid-feedback">Deskripsi wajib diisi.</div>
            </div>

            <div class="col-md-12">
              <label for="asal_daerah" class="form-label">Asal Daerah <span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="asal_daerah" name="asal_daerah" placeholder="Contoh: Padang, Sumatra Barat" value="<?= $old['asal_daerah'] ?? '' ?>" required>
              <div class="invalid-feedback">Asal daerah wajib diisi.</div>
            </div>

            <!-- Status dan Lokasi -->
            <div class="col-md-12 mt-4 mb-2">
                <h5 class="text-dark border-bottom pb-2">Status & Lokasi</h5>
            </div>

            <div class="col-md-6">
              <label for="status_halal" class="form-label">Status Halal <span class="text-danger">*</span></label>
              <select class="form-select" id="status_halal" name="status_halal" required>
                <option value="tidak" <?= ($old['status_halal'] ?? '') == 'tidak' ? 'selected' : '' ?>>Tidak/Belum Sertifikasi</option>
                <option value="belum" <?= ($old['status_halal'] ?? '') == 'belum' ? 'selected' : '' ?>>Belum Ada Logo Halal</option>
                <option value="proses" <?= ($old['status_halal'] ?? '') == 'proses' ? 'selected' : '' ?>>Dalam Proses</option>
                <option value="sudah" <?= ($old['status_halal'] ?? '') == 'sudah' ? 'selected' : '' ?>>Sudah Bersertifikat</option>
              </select>
            </div>

            <div class="col-md-6">
              <label for="izin_usaha" class="form-label">Izin Usaha <span class="text-danger">*</span></label>
              <select class="form-select" id="izin_usaha" name="izin_usaha" required>
                <option value="belum" <?= ($old['izin_usaha'] ?? '') == 'belum' ? 'selected' : '' ?>>Belum Ada</option>
                <option value="proses" <?= ($old['izin_usaha'] ?? '') == 'proses' ? 'selected' : '' ?>>Dalam Proses</option>
                <option value="sudah" <?= ($old['izin_usaha'] ?? '') == 'sudah' ? 'selected' : '' ?>>Sudah Ada</option>
              </select>
            </div>

            <div class="col-md-6">
              <label for="latitude" class="form-label">Latitude</label>
              <input type="number" step="any" class="form-control" id="latitude" name="latitude" placeholder="Contoh: -6.200000" value="<?= $old['latitude'] ?? '' ?>">
            </div>

            <div class="col-md-6">
              <label for="longitude" class="form-label">Longitude</label>
              <input type="number" step="any" class="form-control" id="longitude" name="longitude" placeholder="Contoh: 106.816666" value="<?= $old['longitude'] ?? '' ?>">
            </div>

            <!-- Operasional -->
            <div class="col-md-12 mt-4 mb-2">
                <h5 class="text-dark border-bottom pb-2">Informasi Operasional</h5>
            </div>

            <div class="col-md-6">
              <label class="form-label d-block">Apakah Jam Operasional Tetap? <span class="text-danger">*</span></label>
              <div class="form-check form-check-inline mt-2">
                <input class="form-check-input" type="radio" name="operasional_tetap" id="op_ya" value="1" <?= ($old['operasional_tetap'] ?? '1') == '1' ? 'checked' : '' ?> required>
                <label class="form-check-label" for="op_ya">Ya, Tetap</label>
              </div>
              <div class="form-check form-check-inline mt-2">
                <input class="form-check-input" type="radio" name="operasional_tetap" id="op_tidak" value="0" <?= ($old['operasional_tetap'] ?? '') == '0' ? 'checked' : '' ?> required>
                <label class="form-check-label" for="op_tidak">Tidak, Bervariasi</label>
              </div>
            </div>

            <div class="col-md-6">
              <label for="catatan_operasional" class="form-label">Catatan Operasional (Opsional)</label>
              <textarea class="form-control" id="catatan_operasional" name="catatan_operasional" rows="2" placeholder="Contoh: Tutup pada hari libur nasional"><?= $old['catatan_operasional'] ?? '' ?></textarea>
            </div>
            
            <div class="col-12 mt-5 text-end">
              <button type="submit" class="btn btn-primary px-4 py-2"><i class="fas fa-save me-2"></i> Update UMKM</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
(function () {
  'use strict'
  var forms = document.querySelectorAll('.needs-validation')
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
        form.classList.add('was-validated')
      }, false)
    })
})()
</script>

<?php include 'includes/footer.php'; ?>
