<?php
require_once '../../auth/middleware.php';
checkAdmin();
require_once '../../../config/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_kategori = trim($_POST['nama_kategori'] ?? '');
    
    if (empty($nama_kategori)) {
        $_SESSION['error'] = "Nama kategori tidak boleh kosong!";
    } else {
        try {
            // Set session variable MySQL untuk dibaca oleh TRIGGER log_aktivitas
            $conn->query("SET @current_user_id = " . intval($_SESSION['id_user']));
            
            // Panggil STORED PROCEDURE untuk menambahkan kategori
            $stmt = $conn->prepare("CALL sp_AddKategoriUMKM(?)");
            $stmt->bind_param("s", $nama_kategori);
            
            if ($stmt->execute()) {
                $_SESSION['success'] = "Kategori berhasil ditambahkan!";
            } else {
                $_SESSION['error'] = "Gagal menambahkan kategori!";
            }
        } catch (Exception $e) {
            $_SESSION['error'] = "Error: " . $e->getMessage();
        }
    }
}

header("Location: ../../master-kategori.php");
exit();
