<?php
session_start();
require_once '../auth/middleware.php';
checkAdmin();
require_once '../../config/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_umkm = $_POST['id_umkm'] ?? 0;
    
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
    if (!$id_umkm || empty($id_kategori) || empty($nama_umkm) || empty($pemilik) || empty($deskripsi) || empty($asal_daerah) || empty($status_halal) || empty($izin_usaha)) {
        $_SESSION['error'] = "Semua field bertanda * wajib diisi.";
        $_SESSION['old_input'] = $_POST;
        header("Location: ../edit-umkm.php?id=" . $id_umkm);
        exit;
    }

    try {
        // Retrieve old name for logging
        $old_stmt = $conn->prepare("SELECT nama_umkm FROM umkm WHERE id_umkm = ?");
        $old_stmt->bind_param("i", $id_umkm);
        $old_stmt->execute();
        $old_res = $old_stmt->get_result()->fetch_assoc();
        $old_name = $old_res ? $old_res['nama_umkm'] : 'Unknown';

        // Stored procedure call for update
        $stmt = $conn->prepare("CALL sp_UpdateUMKM(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iisssiddissss", 
            $id_umkm,
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
            $aktivitas = "Admin mengubah data UMKM: " . $old_name . " menjadi " . $nama_umkm;
            $log_stmt->bind_param("is", $admin_id, $aktivitas);
            $log_stmt->execute();

            $_SESSION['success'] = "Data UMKM berhasil diperbarui!";
            header("Location: ../edit-umkm.php?id=" . $id_umkm);
            exit;
        } else {
            $_SESSION['error'] = "Gagal memperbarui UMKM: " . $stmt->error;
            $_SESSION['old_input'] = $_POST;
            header("Location: ../edit-umkm.php?id=" . $id_umkm);
            exit;
        }
    } catch (Exception $e) {
        $_SESSION['error'] = "Terjadi kesalahan sistem: " . $e->getMessage();
        $_SESSION['old_input'] = $_POST;
        header("Location: ../edit-umkm.php?id=" . $id_umkm);
        exit;
    }
} else {
    header("Location: ../umkm.php");
    exit;
}
