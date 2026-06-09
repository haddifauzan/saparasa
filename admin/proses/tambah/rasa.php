<?php
require_once '../../auth/middleware.php';
checkAdmin();
require_once '../../../config/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_rasa = trim($_POST['nama_rasa'] ?? '');
    
    if (empty($nama_rasa)) {
        $_SESSION['error'] = "Nama rasa tidak boleh kosong!";
    } else {
        try {
            // Set session variable MySQL untuk dibaca oleh TRIGGER log_aktivitas
            $conn->query("SET @current_user_id = " . intval($_SESSION['id_user']));
            
            // Panggil STORED PROCEDURE untuk menambahkan rasa
            $stmt = $conn->prepare("CALL sp_AddKategoriRasa(?)");
            $stmt->bind_param("s", $nama_rasa);
            
            if ($stmt->execute()) {
                $_SESSION['success'] = "Data rasa berhasil ditambahkan!";
            } else {
                $_SESSION['error'] = "Gagal menambahkan data rasa!";
            }
        } catch (Exception $e) {
            $_SESSION['error'] = "Error: " . $e->getMessage();
        }
    }
}

header("Location: ../../master-rasa.php");
exit();
