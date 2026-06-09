<?php
require_once '../../auth/middleware.php';
checkAdmin();
require_once '../../../config/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pembayaran = intval($_POST['id_pembayaran'] ?? 0);
    
    try {
        // Set session variable MySQL untuk dibaca oleh TRIGGER log_aktivitas
        $conn->query("SET @current_user_id = " . intval($_SESSION['id_user']));
        
        // Panggil STORED PROCEDURE untuk menghapus metode pembayaran
        $stmt = $conn->prepare("CALL sp_DeleteMetodePembayaran(?)");
        $stmt->bind_param("i", $id_pembayaran);
        
        if ($stmt->execute()) {
            $_SESSION['success'] = "Metode pembayaran berhasil dihapus!";
        } else {
            $_SESSION['error'] = "Gagal menghapus metode pembayaran!";
        }
    } catch (Exception $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }
}

header("Location: ../../master-pembayaran.php");
exit();
