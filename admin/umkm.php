<?php
$page_title = 'Data UMKM';
$topbar_title = 'Data UMKM';
include 'includes/head.php';
?>
<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/topbar.php'; ?>

<div id="main-content">
  <div class="page-content">
    <div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-2">
      <div>
        <h1 class="page-title"><i class="fas fa-store me-2"></i> Manajemen UMKM</h1>
        <p class="page-subtitle">Kelola data usaha mikro, kecil, dan menengah yang terdaftar</p>
      </div>
      <button class="btn-primary-custom"><i class="fas fa-plus me-1"></i> Tambah UMKM</button>
    </div>

    <!-- UMKM Cards Grid -->
    <div class="row g-3 mb-4">
      <?php
      $umkm_list = [
        ['Minang Jaya','Padang, Sumatra Barat','Makanan Khas','24 Produk','<i class="fas fa-star text-warning"></i> 4.9','active','<i class="fas fa-utensils text-primary"></i>','Budi Santoso'],
        ['Kopi Nusantara','Takengon, Aceh','Minuman','18 Produk','<i class="fas fa-star text-warning"></i> 4.8','active','<i class="fas fa-coffee text-primary"></i>','Siti Aminah'],
        ['Batik Cirebon','Cirebon, Jawa Barat','Kerajinan','15 Produk','<i class="fas fa-star text-warning"></i> 4.7','active','<i class="fas fa-palette text-primary"></i>','Ahmad Fauzi'],
        ['Keripik Mama','Malang, Jawa Timur','Oleh-oleh','12 Produk','<i class="fas fa-star text-warning"></i> 4.5','pending','<i class="fas fa-seedling text-primary"></i>','Dewi Lestari'],
        ['Oleh-oleh Bali','Denpasar, Bali','Oleh-oleh','10 Produk','<i class="fas fa-star text-warning"></i> 4.3','inactive','<i class="fas fa-umbrella-beach text-primary"></i>','Rudi Hartono'],
        ['Dapur Nusantara','Yogyakarta, DIY','Makanan Khas','8 Produk','<i class="fas fa-star text-warning"></i> 4.6','active','<i class="fas fa-concierge-bell text-primary"></i>','Maya Sari'],
      ];
      $statusLabel = ['active'=>'Aktif','pending'=>'Review','inactive'=>'Nonaktif'];
      foreach($umkm_list as $u): ?>
      <div class="col-md-6 col-xl-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="d-flex align-items-start gap-3 mb-3">
              <div style="width:52px;height:52px;border-radius:14px;background:linear-gradient(135deg,#e8ecf4,#d0d8f0);
                          display:flex;align-items:center;justify-content:center;font-size:26px;flex-shrink:0">
                <?= $u[6] ?>
              </div>
              <div class="flex-1">
                <h6 class="fw-700 mb-1" style="font-size:15px"><?= $u[0] ?></h6>
                <small class="text-muted"><i class="fas fa-map-marker-alt me-1"></i> <?= $u[1] ?></small>
              </div>
              <span class="status-badge <?= $u[5] ?>"><?= $statusLabel[$u[5]] ?></span>
            </div>
            <div class="d-flex gap-3 mb-3" style="font-size:13px">
              <div><span class="text-muted">Kategori:</span> <strong><?= $u[2] ?></strong></div>
              <div><span class="text-muted">Produk:</span> <strong><?= $u[3] ?></strong></div>
              <div><strong><?= $u[4] ?></strong></div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <small class="text-muted"><i class="fas fa-user me-1"></i> <?= $u[7] ?></small>
              <div class="d-flex gap-1">
                <button class="btn-icon view"><i class="fas fa-eye"></i></button>
                <button class="btn-icon edit"><i class="fas fa-edit"></i></button>
                <button class="btn-icon delete"><i class="fas fa-trash"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
