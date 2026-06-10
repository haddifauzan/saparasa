<?php
session_start();
require_once '../auth/middleware.php';
checkAdmin();
require_once '../../config/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_umkm = $_POST['id_umkm'] ?? 0;
    $platform = $_POST['platform'] ?? [];

    if ($id_umkm) {
        $conn->begin_transaction();
        try {
            $stmt = $conn->prepare("DELETE FROM umkm_platform_online WHERE id_umkm = ?");
            $stmt->bind_param("i", $id_umkm);
            $stmt->execute();

            $ins_stmt = $conn->prepare("INSERT INTO umkm_platform_online (id_umkm, id_platform, link_platform) VALUES (?, ?, ?)");
            foreach ($platform as $id_plat => $link) {
                if (!empty(trim($link))) {
                    $ins_stmt->bind_param("iis", $id_umkm, $id_plat, $link);
                    $ins_stmt->execute();
                }
            }
            
            $conn->commit();
            $_SESSION['success'] = "Platform online berhasil diperbarui.";
        } catch (Exception $e) {
            $conn->rollback();
            $_SESSION['error'] = "Gagal memperbarui platform online: " . $e->getMessage();
        }
    } else {
        $_SESSION['error'] = "Data tidak valid.";
    }
    
    header("Location: ../detail-umkm.php?id=" . $id_umkm);
    exit;
} else {
    header("Location: ../umkm.php");
    exit;
}
