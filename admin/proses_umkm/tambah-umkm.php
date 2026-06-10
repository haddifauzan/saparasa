<?php
session_start();
require_once '../auth/middleware.php';
checkAdmin();
require_once '../../config/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate inputs
    $id_kategori = $_POST['id_kategori'] ?? '';
    $nama_umkm = $_POST['nama_umkm'] ?? '';
    $pemilik = $_POST['pemilik'] ?? '';
    $deskripsi = $_POST['deskripsi'] ?? '';
    $tahun_berdiri = !empty($_POST['tahun_berdiri']) ? $_POST['tahun_berdiri'] : NULL;
    $latitude = !empty($_POST['latitude']) ? $_POST['latitude'] : NULL;
    $longitude = !empty($_POST['longitude']) ? $_POST['longitude'] : NULL;
    $operasional_tetap = $_POST['operasional_tetap'] ?? 1;
    $catatan_operasional = $_POST['catatan_operasional'] ?? '';
    $asal_daerah = $_POST['asal_daerah'] ?? '';
    $status_halal = $_POST['status_halal'] ?? '';
    $izin_usaha = $_POST['izin_usaha'] ?? '';

    // Basic Validation
    if (empty($id_kategori) || empty($nama_umkm) || empty($pemilik) || empty($deskripsi) || empty($asal_daerah) || empty($status_halal) || empty($izin_usaha)) {
        $_SESSION['error'] = "Semua field bertanda * wajib diisi.";
        $_SESSION['old_input'] = $_POST;
        header("Location: ../tambah-umkm.php");
        exit;
    }

    try {
        $stmt = $conn->prepare("CALL AddNewUMKM(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssiddissss", 
            $id_kategori, 
            $nama_umkm, 
            $pemilik, 
            $deskripsi, 
            $tahun_berdiri, 
            $latitude, 
            $longitude, 
            $operasional_tetap, 
            $catatan_operasional, 
            $asal_daerah, 
            $status_halal, 
            $izin_usaha
        );
        
        if ($stmt->execute()) {
            $admin_id = $_SESSION['user_id'] ?? 1;
            $log_stmt = $conn->prepare("INSERT INTO log_aktivitas (id_user, aktivitas) VALUES (?, ?)");
            $aktivitas = "Admin menambahkan UMKM baru: " . $nama_umkm;
            $log_stmt->bind_param("is", $admin_id, $aktivitas);
            $log_stmt->execute();
            
            $_SESSION['success'] = "UMKM berhasil ditambahkan!";
            header("Location: ../umkm.php");
            exit;
        } else {
            $_SESSION['error'] = "Gagal menambahkan UMKM: " . $stmt->error;
            $_SESSION['old_input'] = $_POST;
            header("Location: ../tambah-umkm.php");
            exit;
        }
    } catch (Exception $e) {
        $_SESSION['error'] = "Terjadi kesalahan sistem: " . $e->getMessage();
        $_SESSION['old_input'] = $_POST;
        header("Location: ../tambah-umkm.php");
        exit;
    }
} else {
    header("Location: ../umkm.php");
    exit;
}
