<?php
session_start();
require_once '../auth/middleware.php';
checkAdmin();
require_once '../../config/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_umkm = $_POST['id_umkm'] ?? 0;
    $pembayaran = $_POST['pembayaran'] ?? [];

    if ($id_umkm) {
        $conn->begin_transaction();
        try {
            $stmt = $conn->prepare("DELETE FROM umkm_pembayaran WHERE id_umkm = ?");
            $stmt->bind_param("i", $id_umkm);
            $stmt->execute();

            if (!empty($pembayaran)) {
                $ins_stmt = $conn->prepare("INSERT INTO umkm_pembayaran (id_umkm, id_pembayaran) VALUES (?, ?)");
                foreach ($pembayaran as $id_pem) {
                    $ins_stmt->bind_param("ii", $id_umkm, $id_pem);
                    $ins_stmt->execute();
                }
            }
            
            $conn->commit();
            $_SESSION['success'] = "Metode pembayaran berhasil diperbarui.";
        } catch (Exception $e) {
            $conn->rollback();
            $_SESSION['error'] = "Gagal memperbarui metode pembayaran: " . $e->getMessage();
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
