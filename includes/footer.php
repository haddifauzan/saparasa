<?php 
$base_path = isset($base_path) ? $base_path : '';
?>
<footer class="footer">
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-4">
                <div class="footer-brand">SAPARASA</div>
                <p class="footer-desc">Platform informasi UMKM kuliner kawasan Saparua Bandung. Temukan, nikmati, dan dukung UMKM Lokal.</p>
            </div>
            <div class="col-6 col-lg-2">
                <div class="footer-heading">Menu</div>
                <a href="<?= $base_path ?>pages/daftar-umkm.php" class="footer-link">Daftar UMKM</a>
            </div>
            <div class="col-6 col-lg-2">
                <div class="footer-heading">Akun</div>
                <a href="<?= $base_path ?>auth/login.php" class="footer-link">Masuk</a>
                <a href="<?= $base_path ?>auth/register.php" class="footer-link">Daftar</a>
            </div>
            <div class="col-lg-4">
                <div class="footer-heading">Tentang</div>
                <p style="font-size:0.82rem; line-height:1.7; color:rgba(255,255,255,0.5);">SAPARASA merupakan website sistem informasi UMKM berbasis PHP Native dan MySQL yang digunakan untuk menampilkan informasi UMKM di kawasan Saparua Bandung.</p>
            </div>
        </div>
        <hr class="footer-divider">
        <p class="footer-copy text-center mb-0">© 2026 SAPARASA · Sistem Informasi UMKM Saparua Bandung</p>
    </div>
</footer>

<!-- Profile Modal (if logged in) -->
<?php if (isset($_SESSION['id_user'])): ?>
<div class="modal fade" id="profileModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px; border: none;">
            <div class="modal-header border-bottom-0 pb-0">
                <h5 class="modal-title fw-bold" style="color: var(--sapa-dark);">Profil Saya</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-3">
                <form id="profileForm" enctype="multipart/form-data">
                    <div class="text-center mb-4">
                        <?php 
                        $foto_profil_path = $base_path . "public/uploads/foto_profile/" . $_SESSION['id_user'] . ".jpg";
                        $foto_profil = file_exists(__DIR__ . "/../public/uploads/foto_profile/" . $_SESSION['id_user'] . ".jpg") ? $foto_profil_path : $base_path . "public/uploads/foto_profile/default_user.png"; 
                        ?>
                        <img id="profilePreview" src="<?= $foto_profil ?>" class="rounded-circle mb-2" width="80" height="80" style="object-fit: cover;" onerror="this.src='<?= $base_path ?>public/uploads/foto_profile/default_user.png'">
                        <br>
                        <label for="profileFoto" class="btn btn-sm btn-outline-secondary">Ganti Foto</label>
                        <input type="file" id="profileFoto" name="foto" class="d-none" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-size: 0.9rem; font-weight: 500;">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="<?= $_SESSION['nama'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-size: 0.9rem; font-weight: 500;">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= $_SESSION['email'] ?? '' ?>" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label" style="font-size: 0.9rem; font-weight: 500;">Password Baru <small class="text-muted">(opsional)</small></label>
                        <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah">
                    </div>
                    <button type="submit" class="btn w-100" style="background-color: var(--sapa-green); color: #fff; border-radius: 8px; font-weight: 500;">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<script src="<?= $base_path ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Logout
    const logoutBtn = document.getElementById('logoutBtn');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('Apakah Anda yakin ingin keluar?')) {
                window.location.href = '<?= $base_path ?>auth/logout.php';
            }
        });
    }

    // Profile Picture Preview
    const profileFoto = document.getElementById('profileFoto');
    const profilePreview = document.getElementById('profilePreview');
    if (profileFoto && profilePreview) {
        profileFoto.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    profilePreview.src = e.target.result;
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    // Profile Form Submit
    const profileForm = document.getElementById('profileForm');
    if (profileForm) {
        profileForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch('<?= $base_path ?>ajax/update_profile.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert(data.message);
                    location.reload();
                } else {
                    alert(data.message);
                }
            })
            .catch(err => {
                console.error(err);
                alert('Terjadi kesalahan sistem.');
            });
        });
    }
});
</script>
