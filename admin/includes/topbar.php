<?php
$page_title = $page_title ?? 'Dashboard';
$topbar_title = $topbar_title ?? $page_title;
?>
<nav id="topbar">
  <!-- Toggle Button -->
  <button class="topbar-toggle" id="sidebarToggle" onclick="toggleSidebar()" title="Toggle Sidebar">
    <i class="fas fa-bars"></i>
  </button>

  <!-- Breadcrumb / Page Title -->
  <div class="d-none d-md-block">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="dashboard.php">Admin</a></li>
        <?php if ($topbar_title !== 'Dashboard'): ?>
        <li class="breadcrumb-item active"><?= $topbar_title ?></li>
        <?php endif; ?>
      </ol>
    </nav>
  </div>

  <!-- Right Actions -->
  <div class="topbar-actions ms-auto">
    <div class="dropdown">
      <div class="topbar-user" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
        <div class="avatar" style="padding: 0; overflow: hidden;">
          <?php 
          $foto_profile = $_SESSION['foto_profile'] ?? 'default_user.png';
          $foto_path = "../public/uploads/foto_profile/" . $foto_profile;
          ?>
          <img src="<?= $foto_path ?>" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover;">
        </div>
        <span class="uname d-none d-sm-inline"><?= $_SESSION['nama'] ?? 'Admin' ?></span>
        <small><i class="fas fa-chevron-down ms-1"></i></small>
      </div>
      <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="userDropdown">
        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profileModal"><i class="fas fa-user-edit me-2"></i> Profil User</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content border-0 shadow" style="border-radius: 12px;">
      <div class="modal-header">
        <h5 class="modal-title" id="profileModalLabel"><i class="fas fa-user-edit me-2"></i> Profil User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="proses/update_profile.php" method="POST" enctype="multipart/form-data">
          <!-- Tampilkan foto profil saat ini -->
          <div class="text-center mb-4">
            <?php 
            $current_foto = $_SESSION['foto_profile'] ?? 'default_user.png';
            $current_foto_path = "../public/uploads/foto_profile/" . $current_foto;
            ?>
            <img src="<?= $current_foto_path ?>" 
                 alt="Profil" 
                 class="rounded-circle img-thumbnail shadow-sm" 
                 style="width: 100px; height: 100px; object-fit: cover;">
          </div>
          
          <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" value="<?= $_SESSION['nama'] ?? '' ?>" required>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Alamat Email</label>
            <input type="email" name="email" class="form-control" value="<?= $_SESSION['email'] ?? '' ?>" required>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Ubah Foto Profil</label>
            <input type="file" name="foto_profile" class="form-control" accept="image/*">
            <small class="text-muted" style="font-size: 11px;">Format: JPG, JPEG, PNG. Maksimal 2MB. Kosongkan jika tidak ingin mengubah.</small>
          </div>
          
          <div class="mb-3">
            <label class="form-label">Kata Sandi Baru</label>
            <input type="password" name="password_baru" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah">
          </div>
          
          <div class="modal-footer px-0 pb-0 border-0 pt-3">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 8px;">Batal</button>
            <button type="submit" class="btn btn-primary" style="border-radius: 8px; background: var(--primary); border: none;">Simpan Perubahan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Logout Confirmation Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 380px;">
    <div class="modal-content border-0 shadow" style="border-radius: 12px;">
      <div class="modal-header border-0 pb-0 justify-content-end">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center pt-0">
        <div class="text-danger mb-3" style="font-size: 50px;">
          <i class="fas fa-exclamation-circle"></i>
        </div>
        <h5 class="modal-title fw-bold mb-2" id="logoutModalLabel">Konfirmasi Keluar</h5>
        <p class="text-muted mb-4" style="font-size: 13.5px;">Apakah Anda yakin ingin keluar dari sistem Saparasa?</p>
        <div class="d-flex justify-content-center gap-2">
          <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal" style="border-radius: 8px;">Batal</button>
          <a href="../auth/logout.php" class="btn btn-danger px-4" style="border-radius: 8px;">Ya, Keluar</a>
        </div>
      </div>
    </div>
  </div>
</div>
