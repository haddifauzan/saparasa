<?php
session_start();
require_once '../auth/middleware.php';
checkAdmin();
require_once '../../config/conn.php';

$id_menu = $_GET['id'] ?? 0;
$id_umkm = $_GET['id_umkm'] ?? 0;

if ($id_menu && $id_umkm) {
    try {
        $stmt = $conn->prepare("DELETE FROM menu_umkm WHERE id_menu = ?");
        $stmt->bind_param("i", $id_menu);
        $stmt->execute();
        $_SESSION['success'] = "Menu berhasil dihapus.";
    } catch (Exception $e) {
        $_SESSION['error'] = "Gagal menghapus menu: " . $e->getMessage();
    }
    header("Location: ../detail-umkm.php?id=" . $id_umkm);
    exit;
} else {
    header("Location: ../umkm.php");
    exit;
}
