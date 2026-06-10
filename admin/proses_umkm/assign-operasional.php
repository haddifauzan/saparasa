<?php
session_start();
require_once '../auth/middleware.php';
checkAdmin();
require_once '../../config/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_umkm = $_POST['id_umkm'] ?? 0;
    
    $operasional_tetap = $_POST['operasional_tetap'] ?? 0;
    
    if ($id_umkm) {
        $conn->begin_transaction();
        try {
            $stmt = $conn->prepare("DELETE FROM operasional_umkm WHERE id_umkm = ?");
            $stmt->bind_param("i", $id_umkm);
            $stmt->execute();
            
            $ins_stmt = $conn->prepare("INSERT INTO operasional_umkm (id_umkm, hari, jam_buka, jam_tutup) VALUES (?, ?, ?, ?)");
            $hari_list = ['senin','selasa','rabu','kamis','jumat','sabtu','minggu'];
            
            if ($operasional_tetap == '1') {
                $jam_buka = $_POST['jam_buka_tetap'] ?? '';
                $jam_tutup = $_POST['jam_tutup_tetap'] ?? '';
                $hari_tetap = $_POST['hari_tetap'] ?? [];
                
                if (!empty($jam_buka) && !empty($jam_tutup) && !empty($hari_tetap)) {
                    foreach($hari_tetap as $hari) {
                        if (in_array($hari, $hari_list)) {
                            $ins_stmt->bind_param("isss", $id_umkm, $hari, $jam_buka, $jam_tutup);
                            $ins_stmt->execute();
                        }
                    }
                }
            } else {
                foreach($hari_list as $hari) {
                    if(isset($_POST['buka'][$hari]) && isset($_POST['tutup'][$hari]) && !empty($_POST['buka'][$hari]) && !empty($_POST['tutup'][$hari])) {
                        $buka = $_POST['buka'][$hari];
                        $tutup = $_POST['tutup'][$hari];
                        $ins_stmt->bind_param("isss", $id_umkm, $hari, $buka, $tutup);
                        $ins_stmt->execute();
                    }
                }
            }
            $conn->commit();
            $_SESSION['success'] = "Jadwal operasional berhasil diperbarui.";
        } catch (Exception $e) {
            $conn->rollback();
            $_SESSION['error'] = "Gagal memperbarui operasional: " . $e->getMessage();
        }
    }
    header("Location: ../detail-umkm.php?id=" . $id_umkm);
    exit;
} else {
    header("Location: ../umkm.php");
    exit;
}
