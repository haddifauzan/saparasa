<?php
require_once 'auth/middleware.php';
checkAdmin();
require_once '../config/conn.php';

$page_title = 'Laporan Sistem';
$topbar_title = 'Laporan & Analytics';
include 'includes/head.php';
include 'includes/sidebar.php';
include 'includes/topbar.php';
?>

<div id="main-content">
  <div class="page-content">
    <div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-2">
      <div>
        <h1 class="page-title"><i class="fas fa-file-invoice me-2"></i> Laporan & Analytics</h1>
        <p class="page-subtitle">Analisis data pertumbuhan UMKM, ulasan pengunjung, dan statistik sistem</p>
      </div>
      <button class="btn btn-success btn-sm" onclick="window.print()"><i class="fas fa-print me-1"></i> Cetak Laporan</button>
    </div>

    <!-- Overview Stats Cards -->
    <div class="row g-3 mb-4">
      <div class="col-sm-6 col-lg-3">
        <div class="card p-3 d-flex flex-row align-items-center gap-3">
          <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(29, 106, 74, 0.1); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 20px;">
            <i class="fas fa-store"></i>
          </div>
          <div>
            <h6 class="text-muted mb-0" style="font-size: 12px;">Total UMKM Terdaftar</h6>
            <h4 class="fw-700 mb-0">124 Mitra</h4>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="card p-3 d-flex flex-row align-items-center gap-3">
          <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(59, 130, 246, 0.1); color: #3b82f6; display: flex; align-items: center; justify-content: center; font-size: 20px;">
            <i class="fas fa-star text-warning"></i>
          </div>
          <div>
            <h6 class="text-muted mb-0" style="font-size: 12px;">Rata-rata Rating</h6>
            <h4 class="fw-700 mb-0">4.8 / 5.0</h4>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="card p-3 d-flex flex-row align-items-center gap-3">
          <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(16, 185, 129, 0.1); color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 20px;">
            <i class="fas fa-eye"></i>
          </div>
          <div>
            <h6 class="text-muted mb-0" style="font-size: 12px;">Total Kunjungan Halaman</h6>
            <h4 class="fw-700 mb-0">8.420 View</h4>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-3">
        <div class="card p-3 d-flex flex-row align-items-center gap-3">
          <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(239, 68, 68, 0.1); color: #ef4444; display: flex; align-items: center; justify-content: center; font-size: 20px;">
            <i class="fas fa-user-friends"></i>
          </div>
          <div>
            <h6 class="text-muted mb-0" style="font-size: 12px;">Total Pengguna Aktif</h6>
            <h4 class="fw-700 mb-0">1.240 User</h4>
          </div>
        </div>
      </div>
    </div>

    <!-- Monthly Summary Table -->
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="card-title">Ringkasan Data Bulanan (Tahun 2026)</h6>
        <span class="badge bg-light text-dark border">Perluasan Sistem</span>
      </div>
      <div class="card-body p-0">
        <div class="table-wrapper">
          <table class="admin-table">
            <thead>
              <tr>
                <th>Bulan</th>
                <th>UMKM Baru</th>
                <th>Review Baru</th>
                <th>Kunjungan Portal</th>
                <th>Status Server</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>Januari 2026</strong></td>
                <td>+12 UMKM</td>
                <td>42 Ulasan</td>
                <td>1.250 views</td>
                <td><span class="badge bg-success">Optimal</span></td>
              </tr>
              <tr>
                <td><strong>Februari 2026</strong></td>
                <td>+15 UMKM</td>
                <td>58 Ulasan</td>
                <td>1.890 views</td>
                <td><span class="badge bg-success">Optimal</span></td>
              </tr>
              <tr>
                <td><strong>Maret 2026</strong></td>
                <td>+18 UMKM</td>
                <td>64 Ulasan</td>
                <td>2.410 views</td>
                <td><span class="badge bg-success">Optimal</span></td>
              </tr>
              <tr>
                <td><strong>April 2026</strong></td>
                <td>+22 UMKM</td>
                <td>81 Ulasan</td>
                <td>3.100 views</td>
                <td><span class="badge bg-success">Optimal</span></td>
              </tr>
              <tr>
                <td><strong>Mei 2026</strong></td>
                <td>+27 UMKM</td>
                <td>95 Ulasan</td>
                <td>4.500 views</td>
                <td><span class="badge bg-success">Optimal</span></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
