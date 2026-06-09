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
    // Database fallback
}

// Fallback to mock data if empty
if (empty($umkm_list)) {
    $umkm_list = [
        [
            'id_umkm' => 1,
            'nama_umkm' => 'Minang Jaya',
            'nama_kategori' => 'Makanan Khas',
            'pemilik' => 'Budi Santoso',
            'asal_daerah' => 'Padang, Sumatra Barat',
            'status_halal' => 'sudah',
            'izin_usaha' => 'sudah',
            'status' => 'active'
        ],
        [
            'id_umkm' => 2,
            'nama_umkm' => 'Kopi Nusantara',
            'nama_kategori' => 'Minuman',
            'pemilik' => 'Siti Aminah',
            'asal_daerah' => 'Takengon, Aceh',
            'status_halal' => 'sudah',
            'izin_usaha' => 'sudah',
            'status' => 'active'
        ],
        [
            'id_umkm' => 3,
            'nama_umkm' => 'Batik Cirebon',
            'nama_kategori' => 'Kerajinan',
            'pemilik' => 'Ahmad Fauzi',
            'asal_daerah' => 'Cirebon, Jawa Barat',
            'status_halal' => 'tidak',
            'izin_usaha' => 'proses',
            'status' => 'active'
        ],
        [
            'id_umkm' => 4,
            'nama_umkm' => 'Keripik Mama',
            'nama_kategori' => 'Oleh-oleh',
            'pemilik' => 'Dewi Lestari',
            'asal_daerah' => 'Malang, Jawa Timur',
            'status_halal' => 'proses',
            'izin_usaha' => 'belum',
            'status' => 'pending'
        ]
    ];
}

$statusLabel = ['active' => 'Aktif', 'pending' => 'Review', 'inactive' => 'Nonaktif'];
?>

<div id="main-content">
  <div class="page-content">
    <div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-2">
      <div>
        <h1 class="page-title"><i class="fas fa-store me-2"></i> Manajemen UMKM</h1>
        <p class="page-subtitle">Kelola data usaha mikro, kecil, dan menengah yang terdaftar</p>
      </div>
      <button class="btn-primary-custom"><i class="fas fa-plus me-1"></i> Tambah UMKM</button>
    </div>

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
                <td><span class="badge bg-light text-dark border"><?= $u['nama_kategori'] ?></span></td>
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
                    <button class="btn-icon view"><i class="fas fa-eye"></i></button>
                    <button class="btn-icon edit"><i class="fas fa-edit"></i></button>
                    <button class="btn-icon delete"><i class="fas fa-trash"></i></button>
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

<?php include 'includes/footer.php'; ?>
