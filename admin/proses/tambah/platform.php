<?php
require_once '../../auth/middleware.php';
checkAdmin();
require_once '../../../config/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_platform = trim($_POST['nama_platform'] ?? '');
    
    if (empty($nama_platform)) {
        $_SESSION['error'] = "Nama platform tidak boleh kosong!";
    } else {
        try {
            // Set session variable MySQL untuk dibaca oleh TRIGGER log_aktivitas
            $conn->query("SET @current_user_id = " . intval($_SESSION['id_user']));
            
            // Panggil STORED PROCEDURE untuk menambahkan platform online
            $stmt = $conn->prepare("CALL sp_AddPlatformOnline(?)");
            $stmt->bind_param("s", $nama_platform);
            
            if ($stmt->execute()) {
                $_SESSION['success'] = "Platform online berhasil ditambahkan!";
            } else {
                $_SESSION['error'] = "Gagal menambahkan platform online!";
            }
        } catch (Exception $e) {
            $_SESSION['error'] = "Error: " . $e->getMessage();
        }
    }
}

header("Location: ../../master-platform.php");
exit();
