<?php
session_start();
require_once '../auth/middleware.php';
checkAdmin();
require_once '../../config/conn.php';

$id_galeri = $_GET['id'] ?? 0;
$id_umkm = $_GET['id_umkm'] ?? 0;

if ($id_galeri && $id_umkm) {
    try {
        $s = $conn->prepare("SELECT foto FROM galeri_umkm WHERE id_galeri = ?");
        $s->bind_param("i", $id_galeri);
        $s->execute();
        $res = $s->get_result()->fetch_assoc();
        
        if($res) {
            $stmt = $conn->prepare("DELETE FROM galeri_umkm WHERE id_galeri = ?");
            $stmt->bind_param("i", $id_galeri);
            if($stmt->execute()) {
                $file = '../../public/uploads/galeri_umkm/' . $res['foto'];
                if(file_exists($file)) {
                    unlink($file);
                }
                $_SESSION['success'] = "Foto galeri berhasil dihapus.";
            } else {
                $_SESSION['error'] = "Gagal menghapus foto: " . $stmt->error;
            }
        }
    } catch (Exception $e) {
        $_SESSION['error'] = "Terjadi kesalahan: " . $e->getMessage();
    }
    header("Location: ../detail-umkm.php?id=" . $id_umkm);
    exit;
} else {
    header("Location: ../umkm.php");
    exit;
}
