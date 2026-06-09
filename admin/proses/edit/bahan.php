<?php
require_once '../../auth/middleware.php';
checkAdmin();
require_once '../../../config/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_bahan = intval($_POST['id_bahan'] ?? 0);
    $nama_bahan = trim($_POST['nama_bahan'] ?? '');
    
    if (empty($nama_bahan)) {
        $_SESSION['error'] = "Nama bahan baku tidak boleh kosong!";
    } else {
        try {
            // Set session variable MySQL untuk dibaca oleh TRIGGER log_aktivitas
            $conn->query("SET @current_user_id = " . intval($_SESSION['id_user']));
            
            // Panggil STORED PROCEDURE untuk memperbarui bahan baku
            $stmt = $conn->prepare("CALL sp_EditBahanBaku(?, ?)");
            $stmt->bind_param("is", $id_bahan, $nama_bahan);
            
            if ($stmt->execute()) {
                $_SESSION['success'] = "Bahan baku berhasil diperbarui!";
            } else {
                $_SESSION['error'] = "Gagal memperbarui bahan baku!";
            }
        } catch (Exception $e) {
            $_SESSION['error'] = "Error: " . $e->getMessage();
        }
    }
}

header("Location: ../../master-bahan.php");
exit();
