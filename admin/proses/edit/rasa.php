<?php
require_once '../../auth/middleware.php';
checkAdmin();
require_once '../../../config/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_rasa = intval($_POST['id_rasa'] ?? 0);
    $nama_rasa = trim($_POST['nama_rasa'] ?? '');
    
    if (empty($nama_rasa)) {
        $_SESSION['error'] = "Nama rasa tidak boleh kosong!";
    } else {
        try {
            // Set session variable MySQL untuk dibaca oleh TRIGGER log_aktivitas
            $conn->query("SET @current_user_id = " . intval($_SESSION['id_user']));
            
            // Panggil STORED PROCEDURE untuk memperbarui rasa
            $stmt = $conn->prepare("CALL sp_EditKategoriRasa(?, ?)");
            $stmt->bind_param("is", $id_rasa, $nama_rasa);
            
            if ($stmt->execute()) {
                $_SESSION['success'] = "Data rasa berhasil diperbarui!";
            } else {
                $_SESSION['error'] = "Gagal memperbarui data rasa!";
            }
        } catch (Exception $e) {
            $_SESSION['error'] = "Error: " . $e->getMessage();
        }
    }
}

header("Location: ../../master-rasa.php");
exit();
