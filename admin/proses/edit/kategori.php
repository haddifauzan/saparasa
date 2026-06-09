<?php
require_once '../../auth/middleware.php';
checkAdmin();
require_once '../../../config/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_kategori = intval($_POST['id_kategori'] ?? 0);
    $nama_kategori = trim($_POST['nama_kategori'] ?? '');
    
    if (empty($nama_kategori)) {
        $_SESSION['error'] = "Nama kategori tidak boleh kosong!";
    } else {
        try {
            // Set session variable MySQL untuk dibaca oleh TRIGGER log_aktivitas
            $conn->query("SET @current_user_id = " . intval($_SESSION['id_user']));
            
            // Panggil STORED PROCEDURE untuk memperbarui kategori
            $stmt = $conn->prepare("CALL sp_EditKategoriUMKM(?, ?)");
            $stmt->bind_param("is", $id_kategori, $nama_kategori);
            
            if ($stmt->execute()) {
                $_SESSION['success'] = "Kategori berhasil diperbarui!";
            } else {
                $_SESSION['error'] = "Gagal memperbarui kategori!";
            }
        } catch (Exception $e) {
            $_SESSION['error'] = "Error: " . $e->getMessage();
        }
    }
}

header("Location: ../../master-kategori.php");
exit();
