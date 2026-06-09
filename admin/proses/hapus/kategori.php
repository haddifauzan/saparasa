<?php
require_once '../../auth/middleware.php';
checkAdmin();
require_once '../../../config/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_kategori = intval($_POST['id_kategori'] ?? 0);
    
    try {
        // Set session variable MySQL untuk dibaca oleh TRIGGER log_aktivitas
        $conn->query("SET @current_user_id = " . intval($_SESSION['id_user']));
        
        // Panggil STORED PROCEDURE untuk menghapus kategori
        $stmt = $conn->prepare("CALL sp_DeleteKategoriUMKM(?)");
        $stmt->bind_param("i", $id_kategori);
        
        if ($stmt->execute()) {
            $_SESSION['success'] = "Kategori berhasil dihapus!";
        } else {
            $_SESSION['error'] = "Gagal menghapus kategori!";
        }
    } catch (Exception $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }
}

header("Location: ../../master-kategori.php");
exit();
