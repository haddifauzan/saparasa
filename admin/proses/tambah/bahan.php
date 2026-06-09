<?php
require_once '../../auth/middleware.php';
checkAdmin();
require_once '../../../config/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_bahan = trim($_POST['nama_bahan'] ?? '');
    
    if (empty($nama_bahan)) {
        $_SESSION['error'] = "Nama bahan baku tidak boleh kosong!";
    } else {
        try {
            // Set session variable MySQL untuk dibaca oleh TRIGGER log_aktivitas
            $conn->query("SET @current_user_id = " . intval($_SESSION['id_user']));
            
            // Panggil STORED PROCEDURE untuk menambahkan bahan baku
            $stmt = $conn->prepare("CALL sp_AddBahanBaku(?)");
            $stmt->bind_param("s", $nama_bahan);
            
            if ($stmt->execute()) {
                $_SESSION['success'] = "Bahan baku berhasil ditambahkan!";
            } else {
                $_SESSION['error'] = "Gagal menambahkan bahan baku!";
            }
        } catch (Exception $e) {
            $_SESSION['error'] = "Error: " . $e->getMessage();
        }
    }
}

header("Location: ../../master-bahan.php");
exit();
