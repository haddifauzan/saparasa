<?php
$current_page = basename($_SERVER['PHP_SELF']);
function is_active($pages) {
    global $current_page;
    if (is_array($pages)) return in_array($current_page, $pages) ? 'active' : '';
    return $current_page === $pages ? 'active' : '';
}
?>

<nav id="sidebar">
  <!-- Brand -->
  <a href="dashboard.php" class="sidebar-brand">
    <div class="brand-icon"><i class="fas fa-leaf"></i></div>
    <span class="brand-text">Saparasa</span>
  </a>

  <!-- Navigation -->
  <div class="sidebar-nav">
    <div class="nav-section-title">MAIN</div>
    <ul class="list-unstyled">
      <li class="nav-item">
        <a href="dashboard.php" class="nav-link <?= is_active('dashboard.php') ?>">
          <span class="nav-icon"><i class="fas fa-home"></i></span>
          <span class="nav-label">Dashboard</span>
        </a>
      </li>
    </ul>

    <div class="nav-section-title">KATALOG</div>
    <ul class="list-unstyled">
      <li class="nav-item">
        <a href="produk.php" class="nav-link <?= is_active('produk.php') ?>">
          <span class="nav-icon"><i class="fas fa-box"></i></span>
          <span class="nav-label">Produk</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="kategori.php" class="nav-link <?= is_active('kategori.php') ?>">
          <span class="nav-icon"><i class="fas fa-tags"></i></span>
          <span class="nav-label">Kategori</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="umkm.php" class="nav-link <?= is_active('umkm.php') ?>">
          <span class="nav-icon"><i class="fas fa-store"></i></span>
          <span class="nav-label">Data UMKM</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="galeri.php" class="nav-link <?= is_active('galeri.php') ?>">
          <span class="nav-icon"><i class="fas fa-images"></i></span>
          <span class="nav-label">Galeri</span>
        </a>
      </li>
    </ul>

    <div class="nav-section-title">PENGGUNA</div>
    <ul class="list-unstyled">
      <li class="nav-item">
        <a href="pengguna.php" class="nav-link <?= is_active('pengguna.php') ?>">
          <span class="nav-icon"><i class="fas fa-users"></i></span>
          <span class="nav-label">Pengguna</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="ulasan.php" class="nav-link <?= is_active('ulasan.php') ?>">
          <span class="nav-icon"><i class="fas fa-star"></i></span>
          <span class="nav-label">Ulasan</span>
        </a>
      </li>
    </ul>

    <div class="nav-section-title">SISTEM</div>
    <ul class="list-unstyled">
      <li class="nav-item">
        <a href="laporan.php" class="nav-link <?= is_active('laporan.php') ?>">
          <span class="nav-icon"><i class="fas fa-chart-bar"></i></span>
          <span class="nav-label">Laporan</span>
        </a>
      </li>
    </ul>
  </div>

  <!-- Footer user info -->
  <div class="sidebar-footer">
    <div class="sidebar-user">
      <div class="user-avatar">A</div>
      <div class="user-info">
        <div class="user-name">Administrator</div>
        <div class="user-role">Super Admin</div>
      </div>
    </div>
  </div>
</nav>
<div id="sidebar-overlay" onclick="toggleSidebar()"></div>
