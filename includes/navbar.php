<?php 
$base_path = isset($base_path) ? $base_path : '';
$active_page = isset($active_page) ? $active_page : '';
?>
<nav class="navbar navbar-expand-md navbar-custom">
    <div class="container">
        <a href="<?= $base_path ?>index.php" class="text-decoration-none navbar-brand m-0 p-0">
            <span class="name">SAPARASA</span>
            <span class="sub">Kuliner Saparua Bandung</span>
        </a>
        
        <button class="navbar-toggler border-0 shadow-none px-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars" style="color: var(--sapa-dark); font-size: 1.25rem;"></i>
        </button>

        <div class="collapse navbar-collapse justify-content-end align-items-center mt-3 mt-md-0" id="navbarContent">
            <div class="navbar-nav me-md-4 gap-2 gap-md-1 mb-3 mb-md-0">
                <a href="<?= $base_path ?>index.php" class="nav-link-custom <?= $active_page === 'beranda' ? 'active' : '' ?>" <?= $active_page === 'beranda' ? 'style="background: var(--sapa-green-light); color: var(--sapa-green);"' : '' ?>>Beranda</a>
                <a href="<?= $base_path ?>pages/daftar-umkm.php" class="nav-link-custom <?= $active_page === 'daftar' ? 'active' : '' ?>" <?= $active_page === 'daftar' ? 'style="background: var(--sapa-green-light); color: var(--sapa-green);"' : '' ?>>Daftar UMKM</a>
                <a href="<?= $base_path ?>pages/tentang.php" class="nav-link-custom <?= $active_page === 'tentang' ? 'active' : '' ?>" <?= $active_page === 'tentang' ? 'style="background: var(--sapa-green-light); color: var(--sapa-green);"' : '' ?>>Tentang</a>
            </div>
            
            <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center gap-3">
                <?php if (isset($_SESSION['id_user'])): ?>
                    <?php if ($_SESSION['role'] === 'admin'): ?>
                        <a href="<?= $base_path ?>admin/dashboard.php" class="btn-nav-cta">Dashboard Admin</a>
                    <?php else: ?>
                        <div class="nav-profile dropdown w-100">
                            <a href="#" class="dropdown-toggle text-decoration-none d-flex align-items-center gap-2" data-bs-toggle="dropdown" style="color: var(--sapa-dark);">
                                <?php 
                                $foto_profil_path = $base_path . "public/uploads/foto_profile/" . $_SESSION['id_user'] . ".jpg";
                                $foto_profil = file_exists(__DIR__ . "/../public/uploads/foto_profile/" . $_SESSION['id_user'] . ".jpg") ? $foto_profil_path : $base_path . "public/uploads/foto_profile/default_user.png"; 
                                ?>
                                <img src="<?= $foto_profil ?>" class="rounded-circle" width="35" height="35" style="object-fit: cover;" onerror="this.src='<?= $base_path ?>public/uploads/foto_profile/default_user.png'">
                                <span style="font-weight: 500;"><?= $_SESSION['nama'] ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="border-radius: 12px; position: absolute;">
                                <li><a class="dropdown-item py-2" href="#" data-bs-toggle="modal" data-bs-target="#profileModal">Profil Saya</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item py-2 text-danger" href="#" id="logoutBtn">Keluar</a></li>
                            </ul>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="<?= $base_path ?>auth/login.php" class="nav-link-custom">Masuk</a>
                    <a href="<?= $base_path ?>auth/register.php" class="btn-nav-cta">Daftar</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
