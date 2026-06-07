<?php
$page_title = $page_title ?? 'Dashboard';
$topbar_title = $topbar_title ?? $page_title;
?>
<nav id="topbar">
  <!-- Toggle Button -->
  <button class="topbar-toggle" id="sidebarToggle" onclick="toggleSidebar()" title="Toggle Sidebar">
    ☰
  </button>

  <!-- Breadcrumb / Page Title -->
  <div class="d-none d-md-block">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="dashboard.php">Admin</a></li>
        <?php if ($topbar_title !== 'Dashboard'): ?>
        <li class="breadcrumb-item active"><?= htmlspecialchars($topbar_title) ?></li>
        <?php endif; ?>
      </ol>
    </nav>
  </div>

  <!-- Right Actions -->
  <div class="topbar-actions ms-auto">
    <div class="dropdown">
      <div class="topbar-user" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
        <div class="avatar">A</div>
        <span class="uname d-none d-sm-inline">Admin</span>
        <small><i class="fas fa-chevron-down ms-1"></i></small>
      </div>
      <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="userDropdown">
        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profileModal"><i class="fas fa-user-edit me-2"></i> Profil User</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item text-danger" href="auth/logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content border-0 shadow">
      <div class="modal-header">
        <h5 class="modal-title" id="profileModalLabel"><i class="fas fa-user-edit me-2"></i> Profil User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" value="admin">
          </div>
          <div class="mb-3">
            <label class="form-label">Password Baru</label>
            <input type="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary">Simpan Perubahan</button>
      </div>
    </div>
  </div>
</div>
