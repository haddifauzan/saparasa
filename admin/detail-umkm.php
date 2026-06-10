<?php
require_once 'auth/middleware.php';
checkAdmin();
require_once '../config/conn.php';

$id = $_GET['id'] ?? 0;
if (!$id) {
    header("Location: umkm.php");
    exit;
}

// 1. Fetch UMKM Data via SP
$umkm = [];
$stmt = $conn->prepare("CALL sp_GetDetailUMKM(?)");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
if ($res->num_rows === 0) {
    $_SESSION['error'] = "UMKM tidak ditemukan.";
    header("Location: umkm.php");
    exit;
}
$umkm = $res->fetch_assoc();
$stmt->close(); // Need to close stmt when using SP to free results

// Function to safely execute query since SP leaves result in buffer
function executeQuery($conn, $query, $id) {
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $stmt->close();
    return $data;
}

// 2. Fetch Operasional
$operasional = executeQuery($conn, "SELECT * FROM operasional_umkm WHERE id_umkm = ? ORDER BY FIELD(hari, 'senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu')", $id);

// 3. Fetch Menu (Basic)
$menu = executeQuery($conn, "SELECT * FROM menu_umkm WHERE id_umkm = ? ORDER BY menu_terlaris DESC, nama_menu ASC", $id);

// 4. Fetch Pembayaran
$pembayaran = executeQuery($conn, "SELECT u.*, m.nama_pembayaran FROM umkm_pembayaran u JOIN metode_pembayaran m ON u.id_pembayaran = m.id_pembayaran WHERE u.id_umkm = ?", $id);

// 5. Fetch Platform
$platform = executeQuery($conn, "SELECT u.*, p.nama_platform FROM umkm_platform_online u JOIN platform_online p ON u.id_platform = p.id_platform WHERE u.id_umkm = ?", $id);

// 6. Fetch Sosmed
$sosmed = executeQuery($conn, "SELECT * FROM sosmed_umkm WHERE id_umkm = ?", $id);

// 7. Fetch Galeri
$galeri = executeQuery($conn, "SELECT * FROM galeri_umkm WHERE id_umkm = ? ORDER BY uploaded_at DESC", $id);

// 8. Fetch Review
$review = executeQuery($conn, "SELECT r.*, u.nama, u.foto_profile FROM review_pengunjung r JOIN users u ON r.id_user = u.id_user WHERE r.id_umkm = ? ORDER BY r.created_at DESC", $id);

// 9. Fetch Kategori Rasa & Bahan Baku
$all_rasa = $conn->query("SELECT * FROM kategori_rasa ORDER BY nama_rasa ASC")->fetch_all(MYSQLI_ASSOC);
$all_bahan = $conn->query("SELECT * FROM bahan_baku ORDER BY nama_bahan ASC")->fetch_all(MYSQLI_ASSOC);

$page_title = 'Detail UMKM: ' . $umkm['nama_umkm'];
$topbar_title = 'Detail UMKM';
include 'includes/head.php';
include 'includes/sidebar.php';
include 'includes/topbar.php';
?>

<div id="main-content">
  <div class="page-content">
    <div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-2">
      <div>
        <h1 class="page-title"><i class="fas fa-store me-2"></i> Detail UMKM</h1>
        <p class="page-subtitle">Informasi lengkap tentang mitra UMKM</p>
      </div>
      <div>
          <a href="edit-umkm.php?id=<?= $id ?>" class="btn btn-warning text-light me-2"><i class="fas fa-edit me-1"></i> Edit UMKM</a>
          <a href="umkm.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
      </div>
    </div>
    
    <?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $_SESSION['success'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['success']); endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $_SESSION['error'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['error']); endif; ?>

    <div class="row g-4">
      <!-- Informasi Utama -->
      <div class="col-lg-8">
        <div class="card h-100">
          <div class="card-header bg-white">
            <h6 class="card-title text-dark"><i class="fas fa-info-circle me-2"></i> Informasi Utama</h6>
          </div>
          <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4 text-muted">Nama UMKM</div>
                <div class="col-md-8 fw-bold fs-5"><?= $umkm['nama_umkm'] ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 text-muted">Kategori</div>
                <div class="col-md-8"><span class="badge bg-light text-dark border"><?= $umkm['nama_kategori'] ?></span></div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 text-muted">Pemilik</div>
                <div class="col-md-8"><?= $umkm['pemilik'] ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 text-muted">Deskripsi</div>
                <div class="col-md-8"><?= nl2br($umkm['deskripsi']) ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 text-muted">Asal Daerah</div>
                <div class="col-md-8"><?= $umkm['asal_daerah'] ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 text-muted">Sertifikasi Halal</div>
                <div class="col-md-8">
                  <span class="badge <?= $umkm['status_halal'] === 'sudah' ? 'bg-success' : ($umkm['status_halal'] === 'proses' ? 'bg-warning text-dark' : 'bg-secondary') ?>">
                    <?= ucfirst($umkm['status_halal']) ?>
                  </span>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 text-muted">Izin Usaha</div>
                <div class="col-md-8">
                  <span class="badge <?= $umkm['izin_usaha'] === 'sudah' ? 'bg-success' : ($umkm['izin_usaha'] === 'proses' ? 'bg-warning text-dark' : 'bg-secondary') ?>">
                    <?= ucfirst($umkm['izin_usaha']) ?>
                  </span>
                </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Operasional & Lokasi -->
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h6 class="card-title text-dark mb-0"><i class="fas fa-clock me-2"></i> Operasional</h6>
            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalOperasional"><i class="fas fa-edit"></i></button>
          </div>
          <div class="card-body">
            <p class="mb-2"><strong>Operasional Tetap:</strong> <?= $umkm['operasional_tetap'] ? 'Ya' : 'Tidak (Bervariasi)' ?></p>
            <?php if($umkm['catatan_operasional']): ?>
              <p class="text-muted small mb-3"><i class="fas fa-info-circle me-1"></i> <?= $umkm['catatan_operasional'] ?></p>
            <?php endif; ?>
            
            <ul class="list-group list-group-flush small">
              <?php if(empty($operasional)): ?>
                  <li class="list-group-item text-center text-muted">Jadwal belum diatur</li>
              <?php else: ?>
                  <?php foreach($operasional as $op): ?>
                  <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    <span class="text-capitalize"><?= $op['hari'] ?></span>
                    <span><?= substr($op['jam_buka'], 0, 5) ?> - <?= substr($op['jam_tutup'], 0, 5) ?></span>
                  </li>
                  <?php endforeach; ?>
              <?php endif; ?>
            </ul>
          </div>
        </div>
        
        <div class="card">
          <div class="card-header bg-white">
            <h6 class="card-title text-dark"><i class="fas fa-map-marker-alt me-2"></i> Lokasi</h6>
          </div>
          <div class="card-body">
            <p class="mb-1"><strong>Latitude:</strong> <?= $umkm['latitude'] ?: '-' ?></p>
            <p class="mb-0"><strong>Longitude:</strong> <?= $umkm['longitude'] ?: '-' ?></p>
          </div>
        </div>
      </div>

      <!-- Relasi Master Data -->
      <div class="col-md-6">
        <div class="card h-100">
          <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h6 class="card-title text-dark mb-0"><i class="fas fa-wallet me-2"></i> Metode Pembayaran</h6>
            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalPembayaran"><i class="fas fa-edit"></i></button>
          </div>
          <div class="card-body">
            <?php if(empty($pembayaran)): ?>
                <p class="text-muted text-center my-3">Belum ada metode pembayaran</p>
            <?php else: ?>
                <div class="d-flex flex-wrap gap-2">
                    <?php foreach($pembayaran as $p): ?>
                        <span class="badge bg-light text-dark border p-2"><i class="fas fa-check-circle text-success me-1"></i> <?= $p['nama_pembayaran'] ?></span>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card h-100">
          <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h6 class="card-title text-dark mb-0"><i class="fas fa-globe me-2"></i> Platform Online</h6>
            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalPlatform"><i class="fas fa-edit"></i></button>
          </div>
          <div class="card-body">
            <?php if(empty($platform)): ?>
                <p class="text-muted text-center my-3">Belum terhubung platform online</p>
            <?php else: ?>
                <ul class="list-group list-group-flush">
                    <?php foreach($platform as $p): ?>
                        <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                            <span><i class="fas fa-link text-dark me-2"></i> <?= $p['nama_platform'] ?></span>
                            <?php if($p['link_platform']): ?>
                                <a href="<?= $p['link_platform'] ?>" target="_blank" class="btn btn-sm btn-light">Kunjungi</a>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <!-- Menu UMKM -->
      <div class="col-12">
        <div class="card">
          <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h6 class="card-title text-dark mb-0"><i class="fas fa-utensils me-2"></i> Menu & Produk</h6>
            <button class="btn btn-sm btn-primary-custom" data-bs-toggle="modal" data-bs-target="#modalTambahMenu"><i class="fas fa-plus me-1"></i> Tambah Menu</button>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover m-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Nama Menu</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Rasa & Bahan</th>
                            <th class="text-center pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($menu)): ?>
                            <tr><td colspan="5" class="text-center py-4 text-muted">Belum ada menu</td></tr>
                        <?php else: ?>
                            <?php foreach($menu as $m): 
                                $rasa = executeQuery($conn, "SELECT k.nama_rasa FROM menu_rasa mr JOIN kategori_rasa k ON mr.id_rasa = k.id_rasa WHERE mr.id_menu = ?", $m['id_menu']);
                                $bahan = executeQuery($conn, "SELECT b.nama_bahan FROM menu_bahan_baku mb JOIN bahan_baku b ON mb.id_bahan = b.id_bahan WHERE mb.id_menu = ?", $m['id_menu']);
                            ?>
                            <tr>
                                <td class="ps-4 fw-bold"><?= $m['nama_menu'] ?></td>
                                <td>Rp <?= number_format($m['harga'], 0, ',', '.') ?></td>
                                <td>
                                    <?php if($m['menu_terlaris']): ?> <span class="badge bg-danger">Terlaris</span> <?php endif; ?>
                                    <?php if($m['menu_utama']): ?> <span class="badge bg-info">Utama</span> <?php endif; ?>
                                </td>
                                <td>
                                    <div class="small">
                                        <span class="text-muted">Rasa:</span> <?= empty($rasa) ? '-' : implode(', ', array_column($rasa, 'nama_rasa')) ?><br>
                                        <span class="text-muted">Bahan:</span> <?= empty($bahan) ? '-' : implode(', ', array_column($bahan, 'nama_bahan')) ?>
                                    </div>
                                </td>
                                <td class="text-center pe-4">
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalEditMenu_<?= $m['id_menu'] ?>" title="Edit Menu"><i class="fas fa-edit"></i></button>
                                    <a href="proses_umkm/hapus-menu.php?id=<?= $m['id_menu'] ?>&id_umkm=<?= $id ?>" onclick="return confirm('Yakin menghapus menu ini?')" class="btn btn-sm btn-outline-danger" title="Hapus Menu"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Galeri UMKM -->
      <div class="col-12">
        <div class="card">
          <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h6 class="card-title text-dark mb-0"><i class="fas fa-images me-2"></i> Galeri UMKM</h6>
            <button class="btn btn-sm btn-primary-custom" data-bs-toggle="modal" data-bs-target="#modalTambahGaleri"><i class="fas fa-plus me-1"></i> Tambah Foto</button>
          </div>
          <div class="card-body">
            <div class="row g-3">
               <?php if(empty($galeri)): ?>
                 <div class="col-12 text-center text-muted py-3">Belum ada foto galeri</div>
               <?php else: ?>
                 <?php foreach($galeri as $g): ?>
                   <div class="col-md-3">
                     <div class="card h-100 position-relative border">
                       <img src="../public/uploads/galeri_umkm/<?= $g['foto'] ?>" class="card-img-top" alt="Galeri" style="height:150px; object-fit:cover;">
                       <div class="card-body p-2 text-center bg-light">
                         <span class="badge bg-secondary"><?= ucfirst($g['jenis_foto']) ?></span>
                       </div>
                       <a href="proses_umkm/hapus-galeri.php?id=<?= $g['id_galeri'] ?>&id_umkm=<?= $id ?>" class="btn btn-sm btn-danger position-absolute" style="top:5px; right:5px;" onclick="return confirm('Hapus foto ini?');" title="Hapus"><i class="fas fa-trash"></i></a>
                     </div>
                   </div>
                 <?php endforeach; ?>
               <?php endif; ?>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- Modal Operasional -->
<div class="modal fade" id="modalOperasional" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="proses_umkm/assign-operasional.php" method="POST">
      <div class="modal-header">
        <h5 class="modal-title text-dark">Kelola Jadwal Operasional</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-dark">
        <input type="hidden" name="id_umkm" value="<?= $id ?>">
        <input type="hidden" name="operasional_tetap" value="<?= $umkm['operasional_tetap'] ?>">
        
        <?php if($umkm['operasional_tetap']): ?>
            <p class="text-muted small mb-3">Tentukan jam buka dan tutup yang berlaku untuk hari-hari operasional yang dipilih.</p>
            <div class="row mb-3">
                <div class="col-6">
                    <label class="form-label small fw-bold">Jam Buka</label>
                    <?php
                    $default_buka = !empty($operasional) ? substr($operasional[0]['jam_buka'], 0, 5) : '';
                    $default_tutup = !empty($operasional) ? substr($operasional[0]['jam_tutup'], 0, 5) : '';
                    ?>
                    <input type="time" class="form-control form-control-sm" name="jam_buka_tetap" value="<?= $default_buka ?>" required>
                </div>
                <div class="col-6">
                    <label class="form-label small fw-bold">Jam Tutup</label>
                    <input type="time" class="form-control form-control-sm" name="jam_tutup_tetap" value="<?= $default_tutup ?>" required>
                </div>
            </div>
            <label class="form-label small fw-bold d-block">Pilih Hari Operasional:</label>
            <div class="d-flex flex-wrap gap-2">
                <?php
                $hari_list = ['senin','selasa','rabu','kamis','jumat','sabtu','minggu'];
                $op_map = [];
                foreach($operasional as $op) {
                    $op_map[$op['hari']] = true;
                }
                foreach($hari_list as $hari):
                    $checked = isset($op_map[$hari]) ? 'checked' : '';
                ?>
                <div class="form-check form-check-inline me-0">
                    <input class="form-check-input" type="checkbox" name="hari_tetap[]" value="<?= $hari ?>" id="hari_<?= $hari ?>" <?= $checked ?>>
                    <label class="form-check-label text-capitalize" for="hari_<?= $hari ?>"><?= $hari ?></label>
                </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-muted small mb-3">Atur jam operasional untuk tiap hari secara berbeda. Kosongkan jika tutup.</p>
            <?php
            $hari_list = ['senin','selasa','rabu','kamis','jumat','sabtu','minggu'];
            $op_map = [];
            foreach($operasional as $op) {
                $op_map[$op['hari']] = $op;
            }
            foreach($hari_list as $hari):
                $buka = isset($op_map[$hari]) ? substr($op_map[$hari]['jam_buka'], 0, 5) : '';
                $tutup = isset($op_map[$hari]) ? substr($op_map[$hari]['jam_tutup'], 0, 5) : '';
            ?>
            <div class="row mb-2 align-items-center">
                <div class="col-3 fw-bold text-capitalize"><?= $hari ?></div>
                <div class="col-4">
                    <input type="time" class="form-control form-control-sm" name="buka[<?= $hari ?>]" value="<?= $buka ?>">
                </div>
                <div class="col-1 text-center">-</div>
                <div class="col-4">
                    <input type="time" class="form-control form-control-sm" name="tutup[<?= $hari ?>]" value="<?= $tutup ?>">
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan Jadwal</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Tambah Menu -->
<div class="modal fade" id="modalTambahMenu" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="proses_umkm/tambah-menu.php" method="POST">
      <div class="modal-header">
        <h5 class="modal-title text-dark">Tambah Menu Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-dark">
        <input type="hidden" name="id_umkm" value="<?= $id ?>">
        
        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label">Nama Menu <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="nama_menu" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="harga" required>
            </div>
            
            <div class="col-12 mt-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="menu_utama" id="mu" value="1">
                    <label class="form-check-label fw-bold text-info" for="mu">Jadikan Menu Utama</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="menu_terlaris" id="mt" value="1">
                    <label class="form-check-label fw-bold text-danger" for="mt">Tandai Terlaris</label>
                </div>
            </div>

            <div class="col-md-6 mt-4">
                <label class="form-label fw-bold border-bottom w-100 pb-1">Kategori Rasa</label>
                <input type="text" class="form-control" name="rasa" placeholder="Contoh: Manis, Pedas, Asin">
                <div class="form-text small">Masukkan kategori rasa, pisahkan dengan koma.</div>
            </div>

            <div class="col-md-6 mt-4">
                <label class="form-label fw-bold border-bottom w-100 pb-1">Bahan Baku</label>
                <input type="text" class="form-control" name="bahan" placeholder="Contoh: Tepung, Ayam, Sapi">
                <div class="form-text small">Masukkan bahan baku, pisahkan dengan koma.</div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan Menu</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Tambah Galeri -->
<div class="modal fade" id="modalTambahGaleri" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="proses_umkm/tambah-galeri.php" method="POST" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title text-dark">Tambah Foto Galeri</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-dark">
        <input type="hidden" name="id_umkm" value="<?= $id ?>">
        
        <div class="mb-3">
            <label class="form-label">Pilih Foto <span class="text-danger">*</span></label>
            <input type="file" class="form-control" name="foto" accept="image/jpeg, image/png, image/webp" required>
            <div class="form-text">Format: JPG, PNG, WEBP</div>
        </div>

        <div class="mb-3">
            <label class="form-label">Jenis Foto <span class="text-danger">*</span></label>
            <select class="form-select" name="jenis_foto" required>
                <option value="stand">Stand / Tempat</option>
                <option value="menu">Menu / Produk</option>
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Unggah Foto</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Pembayaran -->
<div class="modal fade" id="modalPembayaran" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="proses_umkm/assign-pembayaran.php" method="POST">
      <div class="modal-header">
        <h5 class="modal-title text-dark">Kelola Metode Pembayaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-dark">
        <input type="hidden" name="id_umkm" value="<?= $id ?>">
        <p class="text-muted small">Pilih metode pembayaran yang didukung oleh UMKM ini:</p>
        <?php
        $all_pem = $conn->query("SELECT * FROM metode_pembayaran ORDER BY nama_pembayaran ASC");
        $assigned_pem = array_column($pembayaran, 'id_pembayaran');
        while($p = $all_pem->fetch_assoc()):
            $checked = in_array($p['id_pembayaran'], $assigned_pem) ? 'checked' : '';
        ?>
        <div class="form-check mb-2">
          <input class="form-check-input" type="checkbox" name="pembayaran[]" value="<?= $p['id_pembayaran'] ?>" id="pem_<?= $p['id_pembayaran'] ?>" <?= $checked ?>>
          <label class="form-check-label" for="pem_<?= $p['id_pembayaran'] ?>">
            <?= $p['nama_pembayaran'] ?>
          </label>
        </div>
        <?php endwhile; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Platform -->
<div class="modal fade" id="modalPlatform" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="proses_umkm/assign-platform.php" method="POST">
      <div class="modal-header">
        <h5 class="modal-title text-dark">Kelola Platform Online</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-dark">
        <input type="hidden" name="id_umkm" value="<?= $id ?>">
        <p class="text-muted small">Masukkan link untuk platform online yang digunakan:</p>
        <?php
        $all_plat = $conn->query("SELECT * FROM platform_online ORDER BY nama_platform ASC");
        $assigned_plat = [];
        foreach($platform as $pl) {
            $assigned_plat[$pl['id_platform']] = $pl['link_platform'];
        }
        while($p = $all_plat->fetch_assoc()):
            $link = $assigned_plat[$p['id_platform']] ?? '';
        ?>
        <div class="row mb-3 align-items-center">
            <div class="col-md-4">
                <label class="form-label mb-0 fw-bold"><?= $p['nama_platform'] ?></label>
            </div>
            <div class="col-md-8">
                <input type="url" class="form-control form-control-sm" name="platform[<?= $p['id_platform'] ?>]" value="<?= $link ?>" placeholder="https://...">
            </div>
        </div>
        <?php endwhile; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit Menu Loop -->
<?php foreach($menu as $m): 
    $assigned_rasa = array_column(executeQuery($conn, "SELECT id_rasa FROM menu_rasa WHERE id_menu = ?", $m['id_menu']), 'id_rasa');
    $assigned_bahan = array_column(executeQuery($conn, "SELECT id_bahan FROM menu_bahan_baku WHERE id_menu = ?", $m['id_menu']), 'id_bahan');
    
    // Fetch names for text input
    $assigned_rasa_names = array_column(executeQuery($conn, "SELECT k.nama_rasa FROM menu_rasa mr JOIN kategori_rasa k ON mr.id_rasa=k.id_rasa WHERE mr.id_menu = ?", $m['id_menu']), 'nama_rasa');
    $assigned_bahan_names = array_column(executeQuery($conn, "SELECT b.nama_bahan FROM menu_bahan_baku mb JOIN bahan_baku b ON mb.id_bahan=b.id_bahan WHERE mb.id_menu = ?", $m['id_menu']), 'nama_bahan');
?>
<div class="modal fade" id="modalEditMenu_<?= $m['id_menu'] ?>" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="proses_umkm/edit-menu.php" method="POST">
      <div class="modal-header">
        <h5 class="modal-title text-dark">Edit Menu: <?= $m['nama_menu'] ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-dark">
        <input type="hidden" name="id_umkm" value="<?= $id ?>">
        <input type="hidden" name="id_menu" value="<?= $m['id_menu'] ?>">
        
        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label">Nama Menu <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="nama_menu" value="<?= $m['nama_menu'] ?>" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="harga" value="<?= round($m['harga']) ?>" required>
            </div>
            
            <div class="col-12 mt-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="menu_utama" id="mu_<?= $m['id_menu'] ?>" value="1" <?= $m['menu_utama'] ? 'checked' : '' ?>>
                    <label class="form-check-label fw-bold text-info" for="mu_<?= $m['id_menu'] ?>">Jadikan Menu Utama</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="menu_terlaris" id="mt_<?= $m['id_menu'] ?>" value="1" <?= $m['menu_terlaris'] ? 'checked' : '' ?>>
                    <label class="form-check-label fw-bold text-danger" for="mt_<?= $m['id_menu'] ?>">Tandai Terlaris</label>
                </div>
            </div>

            <div class="col-md-6 mt-4">
                <label class="form-label fw-bold border-bottom w-100 pb-1">Kategori Rasa</label>
                <input type="text" class="form-control" name="rasa" value="<?= implode(', ', $assigned_rasa_names) ?>" placeholder="Contoh: Manis, Pedas, Asin">
                <div class="form-text small">Masukkan kategori rasa, pisahkan dengan koma.</div>
            </div>

            <div class="col-md-6 mt-4">
                <label class="form-label fw-bold border-bottom w-100 pb-1">Bahan Baku</label>
                <input type="text" class="form-control" name="bahan" value="<?= implode(', ', $assigned_bahan_names) ?>" placeholder="Contoh: Tepung, Ayam, Sapi">
                <div class="form-text small">Masukkan bahan baku, pisahkan dengan koma.</div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach; ?>

<?php include 'includes/footer.php'; ?>
