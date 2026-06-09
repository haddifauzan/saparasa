<?php
require_once '../../auth/middleware.php';
checkAdmin();
require_once '../../../config/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_rasa = intval($_POST['id_rasa'] ?? 0);
    
    try {
        // Set session variable MySQL untuk dibaca oleh TRIGGER log_aktivitas
        $conn->query("SET @current_user_id = " . intval($_SESSION['id_user']));
        
        // Panggil STORED PROCEDURE untuk menghapus rasa
        $stmt = $conn->prepare("CALL sp_DeleteKategoriRasa(?)");
        $stmt->bind_param("i", $id_rasa);
        
        if ($stmt->execute()) {
            $_SESSION['success'] = "Data rasa berhasil dihapus!";
        } else {
            $_SESSION['error'] = "Gagal menghapus data rasa!";
        }
    } catch (Exception $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }
}

header("Location: ../../master-rasa.php");
exit();
