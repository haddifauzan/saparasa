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
          <span class="nav-icon"><i class="fas fa-chart-line"></i></span>
          <span class="nav-label">Dashboard</span>
        </a>
      </li>
    </ul>

    <div class="nav-section-title">DATA MASTER</div>
    <ul class="list-unstyled">
      <!-- Master Collapsible -->
      <li class="nav-item">
        <a class="nav-link d-flex align-items-center justify-content-between <?= is_active(['master-kategori.php', 'master-rasa.php', 'master-bahan.php', 'master-pembayaran.php', 'master-platform.php']) ?>" 
           data-bs-toggle="collapse" 
           href="#collapseMaster" 
           role="button" 
           aria-expanded="<?= is_active(['master-kategori.php', 'master-rasa.php', 'master-bahan.php', 'master-pembayaran.php', 'master-platform.php']) ? 'true' : 'false' ?>" 
           aria-controls="collapseMaster">
          <div>
            <span class="nav-icon me-2"><i class="fas fa-database"></i></span>
            <span class="nav-label">Master</span>
          </div>
          <small><i class="fas fa-chevron-down ms-1" style="font-size: 10px;"></i></small>
        </a>
        <div class="collapse <?= is_active(['master-kategori.php', 'master-rasa.php', 'master-bahan.php', 'master-pembayaran.php', 'master-platform.php']) ? 'show' : '' ?>" id="collapseMaster">
          <ul class="list-unstyled ps-3 mt-1">
            <li>
              <a href="master-kategori.php" class="nav-link <?= is_active('master-kategori.php') ?>">
                <span class="nav-icon"><i class="fas fa-circle"></i></span>
                <span class="nav-label">Kategori UMKM</span>
              </a>
            </li>
            <li>
              <a href="master-rasa.php" class="nav-link <?= is_active('master-rasa.php') ?>">
                <span class="nav-icon"><i class="fas fa-circle"></i></span>
                <span class="nav-label">Data Rasa</span>
              </a>
            </li>
            <li>
              <a href="master-bahan.php" class="nav-link <?= is_active('master-bahan.php') ?>">
                <span class="nav-icon"><i class="fas fa-circle"></i></span>
                <span class="nav-label">Data Bahan Baku</span>
              </a>
            </li>
            <li>
              <a href="master-pembayaran.php" class="nav-link <?= is_active('master-pembayaran.php') ?>">
                <span class="nav-icon"><i class="fas fa-circle"></i></span>
                <span class="nav-label">Metode Pembayaran</span>
              </a>
            </li>
            <li>
              <a href="master-platform.php" class="nav-link <?= is_active('master-platform.php') ?>">
                <span class="nav-icon"><i class="fas fa-circle"></i></span>
                <span class="nav-label">Platform Online</span>
              </a>
            </li>
          </ul>
        </div>
      </li>
    </ul>

    <div class="nav-section-title">KATALOG</div>
    <ul class="list-unstyled">
      <li class="nav-item">
        <a href="umkm.php" class="nav-link <?= is_active('umkm.php') ?>">
          <span class="nav-icon"><i class="fas fa-store"></i></span>
          <span class="nav-label">Data UMKM</span>
        </a>
      </li>
    </ul>

    <div class="nav-section-title">PENGGUNA</div>
    <ul class="list-unstyled">
      <!-- Pengguna Collapsible -->
      <li class="nav-item">
        <a class="nav-link d-flex align-items-center justify-content-between <?= is_active(['pengguna-admin.php', 'pengguna-user.php']) ?>" 
           data-bs-toggle="collapse" 
           href="#collapsePengguna" 
           role="button" 
           aria-expanded="<?= is_active(['pengguna-admin.php', 'pengguna-user.php']) ? 'true' : 'false' ?>" 
           aria-controls="collapsePengguna">
          <div>
            <span class="nav-icon me-2"><i class="fas fa-users"></i></span>
            <span class="nav-label">Pengguna</span>
          </div>
          <small><i class="fas fa-chevron-down ms-1" style="font-size: 10px;"></i></small>
        </a>
        <div class="collapse <?= is_active(['pengguna-admin.php', 'pengguna-user.php']) ? 'show' : '' ?>" id="collapsePengguna">
          <ul class="list-unstyled ps-3 mt-1">
            <li>
              <a href="pengguna-admin.php" class="nav-link <?= is_active('pengguna-admin.php') ?>">
                <span class="nav-icon"><i class="fas fa-circle" style="font-size: 8px;"></i></span>
                <span class="nav-label">Admin</span>
              </a>
            </li>
            <li>
              <a href="pengguna-user.php" class="nav-link <?= is_active('pengguna-user.php') ?>">
                <span class="nav-icon"><i class="fas fa-circle" style="font-size: 8px;"></i></span>
                <span class="nav-label">User</span>
              </a>
            </li>
          </ul>
        </div>
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
      <!-- Sistem Collapsible -->
      <li class="nav-item">
        <a class="nav-link d-flex align-items-center justify-content-between <?= is_active(['log-aktivitas.php', 'laporan.php']) ?>" 
           data-bs-toggle="collapse" 
           href="#collapseSistem" 
           role="button" 
           aria-expanded="<?= is_active(['log-aktivitas.php', 'laporan.php']) ? 'true' : 'false' ?>" 
           aria-controls="collapseSistem">
          <div>
            <span class="nav-icon me-2"><i class="fas fa-cogs"></i></span>
            <span class="nav-label">Sistem</span>
          </div>
          <small><i class="fas fa-chevron-down ms-1" style="font-size: 10px;"></i></small>
        </a>
        <div class="collapse <?= is_active(['log-aktivitas.php', 'laporan.php']) ? 'show' : '' ?>" id="collapseSistem">
          <ul class="list-unstyled ps-3 mt-1">
            <li>
              <a href="log-aktivitas.php" class="nav-link <?= is_active('log-aktivitas.php') ?>">
                <span class="nav-icon"><i class="fas fa-circle" style="font-size: 8px;"></i></span>
                <span class="nav-label">Log Aktivitas</span>
              </a>
            </li>
            <li>
              <a href="laporan.php" class="nav-link <?= is_active('laporan.php') ?>">
                <span class="nav-icon"><i class="fas fa-circle" style="font-size: 8px;"></i></span>
                <span class="nav-label">Laporan</span>
              </a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </div>

  <!-- Footer user info -->
  <div class="sidebar-footer">
    <div class="sidebar-user" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#profileModal">
      <div class="user-avatar" style="padding: 0; overflow: hidden;">
        <?php 
        $foto_profile = $_SESSION['foto_profile'] ?? 'default_user.png';
        $foto_path = "../public/uploads/foto_profile/" . $foto_profile;
        ?>
        <img src="<?= $foto_path ?>" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover;">
      </div>
      <div class="user-info">
        <div class="user-name"><?= $_SESSION['nama'] ?? 'Administrator' ?></div>
        <div class="user-role"><?= ucfirst($_SESSION['role'] ?? 'admin') ?></div>
      </div>
    </div>
  </div>
</nav>
<div id="sidebar-overlay" onclick="toggleSidebar()"></div>
