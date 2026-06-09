<?php
require_once '../../auth/middleware.php';
checkAdmin();
require_once '../../../config/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_platform = intval($_POST['id_platform'] ?? 0);
    $nama_platform = trim($_POST['nama_platform'] ?? '');
    
    if (empty($nama_platform)) {
        $_SESSION['error'] = "Nama platform tidak boleh kosong!";
    } else {
        try {
            // Set session variable MySQL untuk dibaca oleh TRIGGER log_aktivitas
            $conn->query("SET @current_user_id = " . intval($_SESSION['id_user']));
            
            // Panggil STORED PROCEDURE untuk memperbarui platform online
            $stmt = $conn->prepare("CALL sp_EditPlatformOnline(?, ?)");
            $stmt->bind_param("is", $id_platform, $nama_platform);
            
            if ($stmt->execute()) {
                $_SESSION['success'] = "Platform online berhasil diperbarui!";
            } else {
                $_SESSION['error'] = "Gagal memperbarui platform online!";
            }
        } catch (Exception $e) {
            $_SESSION['error'] = "Error: " . $e->getMessage();
        }
    }
}

header("Location: ../../master-platform.php");
exit();
