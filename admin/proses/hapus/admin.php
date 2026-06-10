<?php
require_once '../../auth/middleware.php';
checkAdmin();
require_once '../../../config/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id_user'] ?? 0);
    
    if ($id > 0) {
        if ($id == $_SESSION['id_user']) {
            $_SESSION['error'] = "Anda tidak dapat menghapus akun Anda sendiri!";
        } else {
            try {
                // Get name for logging
                $name_stmt = $conn->prepare("SELECT nama FROM users WHERE id_user = ?");
                $name_stmt->bind_param("i", $id);
                $name_stmt->execute();
                $res = $name_stmt->get_result();
                $nama_admin = "";
                if ($row = $res->fetch_assoc()) {
                    $nama_admin = $row['nama'];
                }

                $stmt = $conn->prepare("DELETE FROM users WHERE id_user = ? AND role = 'admin'");
                $stmt->bind_param("i", $id);
                
                if ($stmt->execute()) {
                    $_SESSION['success'] = "Admin berhasil dihapus!";
                    
                    if (!empty($nama_admin)) {
                        $aktivitas = "Menghapus admin: " . $nama_admin;
                        $log_stmt = $conn->prepare("INSERT INTO log_aktivitas (id_user, aktivitas) VALUES (?, ?)");
                        $log_stmt->bind_param("is", $_SESSION['id_user'], $aktivitas);
                        $log_stmt->execute();
                    }
                } else {
                    $_SESSION['error'] = "Gagal menghapus admin!";
                }
            } catch (Exception $e) {
                $_SESSION['error'] = "Error: " . $e->getMessage();
            }
        }
    } else {
        $_SESSION['error'] = "ID tidak valid!";
    }
}
header("Location: ../../pengguna-admin.php");
exit();
