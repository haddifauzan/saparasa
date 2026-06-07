<?php
$page_title = 'Pengguna';
$topbar_title = 'Pengguna';
include 'includes/head.php';
?>
<?php include 'includes/sidebar.php'; ?>
<?php include 'includes/topbar.php'; ?>

<div id="main-content">
  <div class="page-content">
    <div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-2">
      <div>
        <h1 class="page-title"><i class="fas fa-users me-2"></i> Manajemen Pengguna</h1>
        <p class="page-subtitle">Kelola akun pengguna yang terdaftar di platform Saparasa</p>
      </div>
      <button class="btn-primary-custom"><i class="fas fa-plus me-1"></i> Tambah Pengguna</button>
    </div>

    <!-- Stats Row -->
    <div class="row g-3 mb-4">
      <div class="col-6 col-md-3">
        <div class="stat-card primary">
          <div class="stat-icon"><i class="fas fa-users"></i></div>
          <div class="stat-value" data-count="1240">0</div>
          <div class="stat-label">Total Pengguna</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="stat-card success">
          <div class="stat-icon"><i class="fas fa-check"></i></div>
          <div class="stat-value" data-count="1078">0</div>
          <div class="stat-label">Pengguna Aktif</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="stat-card warning">
          <div class="stat-icon"><i class="fas fa-store"></i></div>
          <div class="stat-value" data-count="42">0</div>
          <div class="stat-label">Pemilik UMKM</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="stat-card danger">
          <div class="stat-icon"><i class="fas fa-ban"></i></div>
          <div class="stat-value" data-count="12">0</div>
          <div class="stat-label">Diblokir</div>
        </div>
      </div>
    </div>

    <!-- User Table -->
    <div class="card">
      <div class="card-header">
        <h6 class="card-title">Daftar Pengguna</h6>
        <div class="d-flex gap-2">
          <div class="topbar-search" style="max-width:200px">
            <span class="search-icon"><i class="fas fa-search"></i></span>
            <input type="text" placeholder="Cari pengguna...">
          </div>
        </div>
      </div>
      <div class="card-body p-0">
        <div class="table-wrapper">
          <table class="admin-table">
            <thead>
              <tr>
                <th>#</th>
                <th>Pengguna</th>
                <th>Email</th>
                <th>Peran</th>
                <th>Bergabung</th>
                <th>Pesanan</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $users = [
                [1,'Budi Santoso','budi@email.com','Pembeli','12 Jan 2024',8,'active'],
                [2,'Siti Aminah','siti@email.com','Pemilik UMKM','5 Feb 2024',0,'active'],
                [3,'Ahmad Fauzi','ahmad@email.com','Pembeli','20 Mar 2024',3,'active'],
                [4,'Dewi Lestari','dewi@email.com','Pembeli','1 Apr 2024',1,'inactive'],
                [5,'Rudi Hartono','rudi@email.com','Pemilik UMKM','15 Apr 2024',0,'pending'],
                [6,'Maya Sari','maya@email.com','Pembeli','2 Mei 2024',12,'active'],
                [7,'Eko Prasetyo','eko@email.com','Pembeli','10 Mei 2024',0,'danger'],
              ];
              $avatarColors = ['#4361ee','#2ec4b6','#ff9f1c','#e63946','#7b2ff7','#4cc9f0','#f72585'];
              $statusLabel = ['active'=>'Aktif','inactive'=>'Nonaktif','pending'=>'Pending','danger'=>'Diblokir'];
              foreach($users as $i => $u): ?>
              <tr>
                <td><?= $u[0] ?></td>
                <td>
                  <div class="d-flex align-items-center gap-2">
                    <div style="width:34px;height:34px;border-radius:10px;background:<?= $avatarColors[$i] ?>;
                                display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:13px;flex-shrink:0">
                      <?= strtoupper(substr($u[1],0,1)) ?>
                    </div>
                    <strong><?= $u[1] ?></strong>
                  </div>
                </td>
                <td class="text-muted"><?= $u[2] ?></td>
                <td>
                  <span class="badge <?= $u[3]==='Pemilik UMKM' ? 'bg-warning text-dark' : 'bg-light text-dark border' ?>">
                    <?= $u[3] ?>
                  </span>
                </td>
                <td class="text-muted"><?= $u[4] ?></td>
                <td><?= $u[5] ?> pesanan</td>
                <td><span class="status-badge <?= $u[6] ?>"><?= $statusLabel[$u[6]] ?></span></td>
                <td>
                  <button class="btn-icon view"><i class="fas fa-eye"></i></button>
                  <button class="btn-icon edit"><i class="fas fa-edit"></i></button>
                  <button class="btn-icon delete"><i class="fas fa-trash"></i></button>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-body border-top py-3">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
          <small class="text-muted">Menampilkan 1–7 dari 1.240 pengguna</small>
          <nav>
            <ul class="pagination pagination-sm mb-0">
              <li class="page-item disabled"><a class="page-link">‹</a></li>
              <li class="page-item active"><a class="page-link">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">›</a></li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
