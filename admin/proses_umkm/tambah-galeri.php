<?php
session_start();
require_once '../auth/middleware.php';
checkAdmin();
require_once '../../config/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_umkm = $_POST['id_umkm'] ?? 0;
    $jenis_foto = $_POST['jenis_foto'] ?? 'stand';
    
    if ($id_umkm && isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        $filename = $_FILES['foto']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        if (in_array($ext, $allowed)) {
            $new_name = 'umkm_' . $id_umkm . '_' . time() . '_' . rand(1000,9999) . '.' . $ext;
            $upload_path = '../../public/uploads/galeri_umkm/' . $new_name;
            
            // Create dir if not exist
            if(!is_dir('../../public/uploads/galeri_umkm')) {
                mkdir('../../public/uploads/galeri_umkm', 0777, true);
            }

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $upload_path)) {
                $stmt = $conn->prepare("INSERT INTO galeri_umkm (id_umkm, foto, jenis_foto) VALUES (?, ?, ?)");
                $stmt->bind_param("iss", $id_umkm, $new_name, $jenis_foto);
                if ($stmt->execute()) {
                    $_SESSION['success'] = "Foto berhasil diunggah.";
                } else {
                    $_SESSION['error'] = "Gagal menyimpan foto ke database.";
                    unlink($upload_path); // remove file if DB fails
                }
            } else {
                $_SESSION['error'] = "Gagal mengunggah file foto.";
            }
        } else {
            $_SESSION['error'] = "Format foto tidak didukung (hanya JPG/PNG/WEBP).";
        }
    } else {
        $_SESSION['error'] = "Mohon pilih file foto yang valid.";
    }
    header("Location: ../detail-umkm.php?id=" . $id_umkm);
    exit;
} else {
    header("Location: ../umkm.php");
    exit;
}
