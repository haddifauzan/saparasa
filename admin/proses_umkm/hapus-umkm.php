<?php
session_start();
require_once '../auth/middleware.php';
checkAdmin();
require_once '../../config/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id_umkm'] ?? 0);

    if ($id > 0) {
        try {
            $stmt = $conn->prepare("SELECT nama_umkm FROM umkm WHERE id_umkm = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $res = $stmt->get_result()->fetch_assoc();
            
            if ($res) {
                // Set session variable MySQL untuk dibaca oleh TRIGGER log_aktivitas
                $conn->query("SET @current_user_id = " . intval($_SESSION['id_user']));
                
                $del_stmt = $conn->prepare("CALL sp_DeleteUMKM(?)");
                $del_stmt->bind_param("i", $id);
                if ($del_stmt->execute()) {
                    $_SESSION['success'] = "UMKM " . htmlspecialchars($res['nama_umkm']) . " beserta seluruh datanya berhasil dihapus.";
                } else {
                    $_SESSION['error'] = "Gagal menghapus UMKM: " . $del_stmt->error;
                }
            } else {
                $_SESSION['error'] = "UMKM tidak ditemukan.";
            }
        } catch (Exception $e) {
            $_SESSION['error'] = "Terjadi kesalahan sistem: " . $e->getMessage();
        }
    } else {
        $_SESSION['error'] = "ID UMKM tidak valid.";
    }
}

header("Location: ../umkm.php");
exit;
