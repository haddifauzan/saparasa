<?php
$pages = [
  'kategori'   => ['Kategori','<i class="fas fa-tags"></i>','Kelola kategori produk UMKM'],
  'galeri'     => ['Galeri','<i class="fas fa-images"></i>','Kelola galeri foto produk dan UMKM'],
  'ulasan'     => ['Ulasan','<i class="fas fa-star text-warning"></i>','Kelola ulasan dan rating dari pelanggan'],
  'laporan'    => ['Laporan','<i class="fas fa-chart-bar"></i>','Laporan penjualan, pendapatan, dan aktivitas platform'],
];

$page_name = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
$info = $pages[$page_name] ?? ['Halaman','<i class="fas fa-file"></i>',''];
$page_title    = $info[0];
$topbar_title  = $info[0];
include 'includes/head.php';
?>
<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/topbar.php'; ?>

<div id="main-content">
  <div class="page-content">
    <div class="page-header">
      <h1 class="page-title"><?= $info[1] ?> <?= $info[0] ?></h1>
      <p class="page-subtitle"><?= $info[2] ?></p>
    </div>

    <div class="card">
      <div class="card-body text-center py-5">
        <div style="font-size:64px;margin-bottom:16px"><?= $info[1] ?></div>
        <h5 class="fw-700">Halaman <?= $info[0] ?></h5>
        <p class="text-muted">Konten halaman ini akan tersedia setelah integrasi data.</p>
        <a href="dashboard.php" class="btn-primary-custom d-inline-flex"><i class="fas fa-arrow-left me-2"></i> Kembali ke Dashboard</a>
      </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
