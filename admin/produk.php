<?php
$page_title = 'Produk';
$topbar_title = 'Produk';
include 'includes/head.php';
?>
<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/topbar.php'; ?>

<div id="main-content">
  <div class="page-content">
    <div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-2">
      <div>
        <h1 class="page-title"><i class="fas fa-box me-2"></i> Manajemen Produk</h1>
        <p class="page-subtitle">Kelola semua produk UMKM yang terdaftar di platform</p>
      </div>
      <button class="btn-primary-custom"><i class="fas fa-plus me-1"></i> Tambah Produk</button>
    </div>

    <!-- Filter Bar -->
    <div class="card mb-4">
      <div class="card-body py-3">
        <div class="row g-2 align-items-center">
          <div class="col-md-4">
            <div class="topbar-search w-100">
              <span class="search-icon"><i class="fas fa-search"></i></span>
              <input type="text" placeholder="Cari produk..." style="max-width:100%;width:100%">
            </div>
          </div>
          <div class="col-md-2">
            <select class="form-select form-select-sm">
              <option>Semua Kategori</option>
              <option>Makanan Khas</option>
              <option>Minuman</option>
              <option>Kerajinan</option>
              <option>Oleh-oleh</option>
            </select>
          </div>
          <div class="col-md-2">
            <select class="form-select form-select-sm">
              <option>Semua Status</option>
              <option>Aktif</option>
              <option>Nonaktif</option>
            </select>
          </div>
          <div class="col-md-2">
            <select class="form-select form-select-sm">
              <option>Urutkan: Terbaru</option>
              <option>Harga: Terendah</option>
              <option>Harga: Tertinggi</option>
              <option>Rating Tertinggi</option>
            </select>
          </div>
          <div class="col-md-2">
            <button class="btn btn-outline-secondary btn-sm w-100"><i class="fas fa-sync-alt me-1"></i> Reset</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Product Table -->
    <div class="card">
      <div class="card-header">
        <h6 class="card-title">Daftar Produk <span class="badge bg-primary ms-2">156</span></h6>
        <div class="d-flex gap-2">
          <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-download me-1"></i> Export</button>
          <button class="btn btn-sm btn-outline-secondary"><i class="fas fa-print me-1"></i> Print</button>
        </div>
      </div>
      <div class="card-body p-0">
        <div class="table-wrapper">
          <table class="admin-table">
            <thead>
              <tr>
                <th><input type="checkbox" class="form-check-input"></th>
                <th>Foto</th>
                <th>Nama Produk</th>
                <th>UMKM</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Rating</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $products = [
                ['Rendang Padang Spesial','Minang Jaya','Makanan Khas','Rp 150.000',24,'<i class="fas fa-star text-warning"></i> 4.9','active'],
                ['Kopi Gayo 250g','Kopi Nusantara','Minuman','Rp 85.000',3,'<i class="fas fa-star text-warning"></i> 4.8','pending'],
                ['Batik Tulis Cirebon','Batik Cirebon','Kerajinan','Rp 320.000',10,'<i class="fas fa-star text-warning"></i> 4.7','active'],
                ['Keripik Singkong Pedas','Keripik Mama','Oleh-oleh','Rp 45.000',50,'<i class="fas fa-star text-warning"></i> 4.5','active'],
                ['Sambal Matah Bali','Oleh-oleh Bali','Makanan Khas','Rp 60.000',15,'<i class="fas fa-star text-warning"></i> 4.3','inactive'],
                ['Teh Pucuk Gunung','Kopi Nusantara','Minuman','Rp 35.000',8,'<i class="fas fa-star text-warning"></i> 4.6','active'],
                ['Dodol Garut Premium','Dapur Nusantara','Oleh-oleh','Rp 75.000',20,'<i class="fas fa-star text-warning"></i> 4.4','active'],
              ];
              $icons = ['<i class="fas fa-utensils text-primary"></i>','<i class="fas fa-coffee text-primary"></i>','<i class="fas fa-palette text-primary"></i>','<i class="fas fa-seedling text-primary"></i>','<i class="fas fa-pepper-hot text-primary"></i>','<i class="fas fa-mug-hot text-primary"></i>','<i class="fas fa-candy-cane text-primary"></i>'];
              foreach($products as $i => $p): ?>
              <tr>
                <td><input type="checkbox" class="form-check-input"></td>
                <td>
                  <div style="width:40px;height:40px;border-radius:10px;background:linear-gradient(135deg,#e8ecf4,#d0d8f0);
                              display:flex;align-items:center;justify-content:center;font-size:20px">
                    <?= $icons[$i] ?>
                  </div>
                </td>
                <td><strong><?= $p[0] ?></strong></td>
                <td class="text-muted"><?= $p[1] ?></td>
                <td><span class="badge bg-light text-dark border"><?= $p[2] ?></span></td>
                <td><strong><?= $p[3] ?></strong></td>
                <td>
                  <span class="<?= $p[4] <= 5 ? 'text-danger fw-600' : '' ?>">
                    <?= $p[4] ?> unit
                  </span>
                </td>
                <td><?= $p[5] ?></td>
                <td><span class="status-badge <?= $p[6] ?>"><?= $p[6]==='active'?'Aktif':($p[6]==='pending'?'Review':'Nonaktif') ?></span></td>
                <td>
                  <button class="btn-icon view" title="Detail"><i class="fas fa-eye"></i></button>
                  <button class="btn-icon edit" title="Edit"><i class="fas fa-edit"></i></button>
                  <button class="btn-icon delete" title="Hapus"><i class="fas fa-trash"></i></button>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- Pagination -->
      <div class="card-body border-top py-3">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
          <small class="text-muted">Menampilkan 1–7 dari 156 produk</small>
          <nav>
            <ul class="pagination pagination-sm mb-0">
              <li class="page-item disabled"><a class="page-link">‹</a></li>
              <li class="page-item active"><a class="page-link">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">›</a></li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
