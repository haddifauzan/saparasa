<?php
$page_title = 'Dashboard';
$topbar_title = 'Dashboard';
include 'includes/head.php';
?>

<?php include 'includes/sidebar.php'; ?>

<!-- Top Bar -->
<?php include 'includes/topbar.php'; ?>

<!-- Main Content -->
<div id="main-content">
  <div class="page-content">

    <!-- Welcome Banner -->
    <div class="welcome-banner">
      <div class="row align-items-center">
        <div class="col-md-8">
          <div class="date-badge"><i class="fas fa-calendar-alt me-2"></i> <span id="live-time">Memuat...</span></div>
          <h2>Selamat datang, Administrator!</h2>
          <p>Pantau dan kelola semua aktivitas platform Saparasa dari sini. Hari ini ada 5 pesanan baru yang menunggu konfirmasi.</p>
        </div>
        <div class="col-md-4 d-none d-md-flex justify-content-end">
          <div style="font-size:80px;opacity:0.3;"><i class="fas fa-leaf"></i></div>
        </div>
      </div>
    </div>

    <!-- Stat Cards -->
    <div class="row g-3 mb-4">
      <div class="col-6 col-xl-3">
        <div class="stat-card primary">
          <div class="stat-icon"><i class="fas fa-money-bill-wave"></i></div>
          <div class="stat-value" data-count="18450000" data-prefix="Rp ">Rp 0</div>
          <div class="stat-label">Total Pendapatan</div>
          <div class="stat-change up">▲ 12.5% dari bulan lalu</div>
        </div>
      </div>
      <div class="col-6 col-xl-3">
        <div class="stat-card success">
          <div class="stat-icon"><i class="fas fa-shopping-cart"></i></div>
          <div class="stat-value" data-count="284">0</div>
          <div class="stat-label">Total Pesanan</div>
          <div class="stat-change up">▲ 8.2% dari bulan lalu</div>
        </div>
      </div>
      <div class="col-6 col-xl-3">
        <div class="stat-card warning">
          <div class="stat-icon"><i class="fas fa-box"></i></div>
          <div class="stat-value" data-count="156">0</div>
          <div class="stat-label">Total Produk</div>
          <div class="stat-change up">▲ 3 produk baru</div>
        </div>
      </div>
      <div class="col-6 col-xl-3">
        <div class="stat-card danger">
          <div class="stat-icon"><i class="fas fa-users"></i></div>
          <div class="stat-value" data-count="1240">0</div>
          <div class="stat-label">Pengguna Aktif</div>
          <div class="stat-change down">▼ 1.3% minggu ini</div>
        </div>
      </div>
    </div>

    <!-- Charts Row -->
    <div class="row g-3 mb-4">
      <!-- Revenue Chart -->
      <div class="col-lg-8">
        <div class="card">
          <div class="card-header">
            <h6 class="card-title"><i class="fas fa-chart-line me-2"></i> Ringkasan Pendapatan</h6>
            <div class="d-flex gap-2">
              <button class="btn btn-sm btn-outline-secondary active">Bulanan</button>
              <button class="btn btn-sm btn-outline-secondary">Tahunan</button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart-area">
              <svg class="chart-svg" viewBox="0 0 600 200" preserveAspectRatio="none">
                <defs>
                  <linearGradient id="chartGrad" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0%" stop-color="#4361ee" stop-opacity="0.3"/>
                    <stop offset="100%" stop-color="#4361ee" stop-opacity="0"/>
                  </linearGradient>
                </defs>
                <!-- Grid lines -->
                <line x1="0" y1="40" x2="600" y2="40" stroke="#e8ecf4" stroke-width="1"/>
                <line x1="0" y1="80" x2="600" y2="80" stroke="#e8ecf4" stroke-width="1"/>
                <line x1="0" y1="120" x2="600" y2="120" stroke="#e8ecf4" stroke-width="1"/>
                <line x1="0" y1="160" x2="600" y2="160" stroke="#e8ecf4" stroke-width="1"/>
                <!-- Fill area -->
                <path d="M0,160 L50,130 L100,140 L150,90 L200,100 L250,70 L300,80 L350,50 L400,60 L450,40 L500,30 L550,20 L600,10 L600,200 L0,200 Z"
                      fill="url(#chartGrad)"/>
                <!-- Line -->
                <polyline points="0,160 50,130 100,140 150,90 200,100 250,70 300,80 350,50 400,60 450,40 500,30 550,20 600,10"
                          fill="none" stroke="#4361ee" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                <!-- Dots -->
                <circle cx="350" cy="50" r="4" fill="#4361ee"/>
                <circle cx="550" cy="20" r="4" fill="#7b2ff7"/>
              </svg>
            </div>
            <!-- Month labels -->
            <div class="d-flex justify-content-between px-1 mt-2">
              <?php
              $months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
              foreach($months as $m) echo '<small class="text-muted">'.$m.'</small>';
              ?>
            </div>
          </div>
        </div>
      </div>

      <!-- Kategori Produk -->
      <div class="col-lg-4">
        <div class="card h-100">
          <div class="card-header">
            <h6 class="card-title"><i class="fas fa-tags me-2"></i> Produk per Kategori</h6>
          </div>
          <div class="card-body">
            <?php
            $categories = [
              ['label' => 'Makanan Khas', 'value' => 72, 'color' => '#4361ee'],
              ['label' => 'Minuman',       'value' => 55, 'color' => '#2ec4b6'],
              ['label' => 'Kerajinan',     'value' => 48, 'color' => '#ff9f1c'],
              ['label' => 'Oleh-oleh',     'value' => 38, 'color' => '#e63946'],
              ['label' => 'Lainnya',       'value' => 22, 'color' => '#7b2ff7'],
            ];
            foreach($categories as $cat): ?>
            <div class="mb-3">
              <div class="d-flex justify-content-between mb-1">
                <span class="fw-500" style="font-size:13px"><?= $cat['label'] ?></span>
                <span class="text-muted" style="font-size:12px"><?= $cat['value'] ?> produk</span>
              </div>
              <div class="progress-custom">
                <div class="progress-fill" style="background:<?= $cat['color'] ?>"
                     data-width="<?= round($cat['value']/72*100) ?>"></div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>

    <!-- Table + Timeline Row -->
    <div class="row g-3">
      <!-- Pesanan Terbaru -->
      <div class="col-lg-7">
        <div class="card">
          <div class="card-header">
            <h6 class="card-title"><i class="fas fa-shopping-cart me-2"></i> Pesanan Terbaru</h6>
            <a href="pesanan.php" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
          </div>
          <div class="card-body p-0">
            <div class="table-wrapper">
              <table class="admin-table">
                <thead>
                  <tr>
                    <th>ID Pesanan</th>
                    <th>Pelanggan</th>
                    <th>Produk</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $orders = [
                    ['#ORD-0091','Budi Santoso','Rendang Padang','Rp 150.000','active','Selesai'],
                    ['#ORD-0090','Siti Aminah','Kopi Gayo 250g','Rp 85.000','pending','Pending'],
                    ['#ORD-0089','Ahmad Fauzi','Batik Tulis','Rp 320.000','active','Selesai'],
                    ['#ORD-0088','Dewi Lestari','Keripik Singkong','Rp 45.000','inactive','Dibatalkan'],
                    ['#ORD-0087','Rudi Hartono','Sambal Matah','Rp 60.000','pending','Pending'],
                  ];
                  foreach($orders as $o): ?>
                  <tr>
                    <td><strong><?= $o[0] ?></strong></td>
                    <td><?= $o[1] ?></td>
                    <td class="text-muted"><?= $o[2] ?></td>
                    <td><strong><?= $o[3] ?></strong></td>
                    <td><span class="status-badge <?= $o[4] ?>"><?= $o[5] ?></span></td>
                    <td>
                      <button class="btn-icon view" title="Lihat"><i class="fas fa-eye"></i></button>
                      <button class="btn-icon edit" title="Edit"><i class="fas fa-edit"></i></button>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <!-- Aktivitas Terbaru -->
      <div class="col-lg-5">
        <div class="card h-100">
          <div class="card-header">
            <h6 class="card-title"><i class="fas fa-clock me-2"></i> Aktivitas Terbaru</h6>
          </div>
          <div class="card-body">
            <ul class="timeline">
              <li class="timeline-item">
                <div class="timeline-dot primary"><i class="fas fa-box"></i></div>
                <div class="timeline-content">
                  <div class="timeline-title">Produk baru ditambahkan</div>
                  <div class="timeline-desc">Rendang Padang Spesial — oleh Toko Minang Jaya</div>
                  <div class="timeline-time">2 menit lalu</div>
                </div>
              </li>
              <li class="timeline-item">
                <div class="timeline-dot success"><i class="fas fa-check"></i></div>
                <div class="timeline-content">
                  <div class="timeline-title">Pesanan #ORD-0091 selesai</div>
                  <div class="timeline-desc">Pembayaran dikonfirmasi oleh sistem</div>
                  <div class="timeline-time">15 menit lalu</div>
                </div>
              </li>
              <li class="timeline-item">
                <div class="timeline-dot warning"><i class="fas fa-user"></i></div>
                <div class="timeline-content">
                  <div class="timeline-title">Pengguna baru terdaftar</div>
                  <div class="timeline-desc">dewi.lestari@email.com bergabung</div>
                  <div class="timeline-time">1 jam lalu</div>
                </div>
              </li>
              <li class="timeline-item">
                <div class="timeline-dot danger"><i class="fas fa-exclamation-triangle"></i></div>
                <div class="timeline-content">
                  <div class="timeline-title">Stok produk menipis</div>
                  <div class="timeline-desc">Kopi Gayo 250g — sisa 3 unit</div>
                  <div class="timeline-time">2 jam lalu</div>
                </div>
              </li>
              <li class="timeline-item">
                <div class="timeline-dot success"><i class="fas fa-star"></i></div>
                <div class="timeline-content">
                  <div class="timeline-title">Ulasan baru diterima</div>
                  <div class="timeline-desc">Rating 5<i class="fas fa-star text-warning fa-xs"></i> untuk Batik Tulis Jepara</div>
                  <div class="timeline-time">3 jam lalu</div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- UMKM & Quick Stats -->
    <div class="row g-3 mt-1">
      <!-- Top UMKM -->
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header">
            <h6 class="card-title"><i class="fas fa-store me-2"></i> UMKM Teratas</h6>
            <a href="umkm.php" class="btn btn-sm btn-outline-primary">Semua</a>
          </div>
          <div class="card-body p-0">
            <table class="admin-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama UMKM</th>
                  <th>Produk</th>
                  <th>Rating</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $umkm = [
                  [1,'Minang Jaya',24,'<i class="fas fa-star text-warning"></i> 4.9','active'],
                  [2,'Kopi Nusantara',18,'<i class="fas fa-star text-warning"></i> 4.8','active'],
                  [3,'Batik Cirebon',15,'<i class="fas fa-star text-warning"></i> 4.7','active'],
                  [4,'Keripik Mama',12,'<i class="fas fa-star text-warning"></i> 4.5','pending'],
                  [5,'Oleh-oleh Bali',10,'<i class="fas fa-star text-warning"></i> 4.3','inactive'],
                ];
                foreach($umkm as $u): ?>
                <tr>
                  <td><strong><?= $u[0] ?></strong></td>
                  <td><?= $u[1] ?></td>
                  <td><?= $u[2] ?> produk</td>
                  <td><?= $u[3] ?></td>
                  <td><span class="status-badge <?= $u[4] ?>"><?= ucfirst($u[4]) ?></span></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Quick Info -->
      <div class="col-lg-6">
        <div class="row g-3 h-100">
          <div class="col-6">
            <div class="card text-center p-3" style="height:100%">
              <div style="font-size:36px"><i class="fas fa-trophy text-primary"></i></div>
              <div class="stat-value mt-2" data-count="42">0</div>
              <div class="text-muted" style="font-size:13px">UMKM Terdaftar</div>
            </div>
          </div>
          <div class="col-6">
            <div class="card text-center p-3" style="height:100%">
              <div style="font-size:36px"><i class="fas fa-star text-warning"></i></div>
              <div class="stat-value mt-2">4.7</div>
              <div class="text-muted" style="font-size:13px">Rating Rata-rata</div>
            </div>
          </div>
          <div class="col-6">
            <div class="card text-center p-3" style="height:100%">
              <div style="font-size:36px"><i class="fas fa-camera text-info"></i></div>
              <div class="stat-value mt-2" data-count="380">0</div>
              <div class="text-muted" style="font-size:13px">Total Galeri</div>
            </div>
          </div>
          <div class="col-6">
            <div class="card text-center p-3" style="height:100%">
              <div style="font-size:36px"><i class="fas fa-comment-dots text-success"></i></div>
              <div class="stat-value mt-2" data-count="96">0</div>
              <div class="text-muted" style="font-size:13px">Ulasan Masuk</div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div><!-- /.page-content -->
</div><!-- /#main-content -->

<?php include 'includes/footer.php'; ?>
