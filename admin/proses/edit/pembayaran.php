<?php
require_once '../../auth/middleware.php';
checkAdmin();
require_once '../../../config/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pembayaran = intval($_POST['id_pembayaran'] ?? 0);
    $nama_pembayaran = trim($_POST['nama_pembayaran'] ?? '');
    
    if (empty($nama_pembayaran)) {
        $_SESSION['error'] = "Nama metode pembayaran tidak boleh kosong!";
    } else {
        try {
            // Set session variable MySQL untuk dibaca oleh TRIGGER log_aktivitas
            $conn->query("SET @current_user_id = " . intval($_SESSION['id_user']));
            
            // Panggil STORED PROCEDURE untuk memperbarui metode pembayaran
            $stmt = $conn->prepare("CALL sp_EditMetodePembayaran(?, ?)");
            $stmt->bind_param("is", $id_pembayaran, $nama_pembayaran);
            
            if ($stmt->execute()) {
                $_SESSION['success'] = "Metode pembayaran berhasil diperbarui!";
            } else {
                $_SESSION['error'] = "Gagal memperbarui metode pembayaran!";
            }
        } catch (Exception $e) {
            $_SESSION['error'] = "Error: " . $e->getMessage();
        }
    }
}

header("Location: ../../master-pembayaran.php");
exit();
