<?php
require_once 'auth/middleware.php';

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

    <!-- TAMPILKAN PESAN ERROR/SUKSES DARI PROSES BACKGROUND -->
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 10px;">
            <i class="fas fa-exclamation-circle me-2"></i><?= $_SESSION['error']; unset($_SESSION['error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 10px;">
            <i class="fas fa-check-circle me-2"></i><?= $_SESSION['success']; unset($_SESSION['success']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Welcome Banner -->
    <div class="welcome-banner">
      <div class="row align-items-center">
        <div class="col-md-8">
          <div class="date-badge"><i class="fas fa-calendar-alt me-2"></i> <span id="live-time">Memuat...</span></div>
          <h2>Selamat datang, <?= $_SESSION['nama'] ?? 'Administrator' ?>!</h2>
          <p>Pantau dan kelola semua aktivitas platform Saparasa dari sini. Hari ini ada 5 pesanan baru yang menunggu konfirmasi.</p>
        </div>
        <div class="col-md-4 d-none d-md-flex justify-content-end">
          <div style="font-size:80px;opacity:0.3;"><i class="fas fa-leaf"></i></div>
        </div>
      </div>
    </div>

  </div><!-- /.page-content -->
</div><!-- /#main-content -->

<?php include 'includes/footer.php'; ?>
