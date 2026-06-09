<?php
require_once '../../auth/middleware.php';
checkAdmin();
require_once '../../../config/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_bahan = intval($_POST['id_bahan'] ?? 0);
    
    try {
        // Set session variable MySQL untuk dibaca oleh TRIGGER log_aktivitas
        $conn->query("SET @current_user_id = " . intval($_SESSION['id_user']));
        
        // Panggil STORED PROCEDURE untuk menghapus bahan baku
        $stmt = $conn->prepare("CALL sp_DeleteBahanBaku(?)");
        $stmt->bind_param("i", $id_bahan);
        
        if ($stmt->execute()) {
            $_SESSION['success'] = "Bahan baku berhasil dihapus!";
        } else {
            $_SESSION['error'] = "Gagal menghapus bahan baku!";
        }
    } catch (Exception $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }
}

header("Location: ../../master-bahan.php");
exit();
