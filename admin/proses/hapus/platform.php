<?php
require_once '../../auth/middleware.php';
checkAdmin();
require_once '../../../config/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_platform = intval($_POST['id_platform'] ?? 0);
    
    try {
        // Set session variable MySQL untuk dibaca oleh TRIGGER log_aktivitas
        $conn->query("SET @current_user_id = " . intval($_SESSION['id_user']));
        
        // Panggil STORED PROCEDURE untuk menghapus platform online
        $stmt = $conn->prepare("CALL sp_DeletePlatformOnline(?)");
        $stmt->bind_param("i", $id_platform);
        
        if ($stmt->execute()) {
            $_SESSION['success'] = "Platform online berhasil dihapus!";
        } else {
            $_SESSION['error'] = "Gagal menghapus platform online!";
        }
    } catch (Exception $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }
}

header("Location: ../../master-platform.php");
exit();
