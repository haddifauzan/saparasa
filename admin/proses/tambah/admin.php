<?php
require_once '../../auth/middleware.php';
checkAdmin();
require_once '../../../config/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    
    if (empty($nama) || empty($email) || empty($password)) {
        $_SESSION['error'] = "Semua field harus diisi!";
    } else {
        try {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $role = 'admin';
            
            $stmt = $conn->prepare("INSERT INTO users (nama, email, password, role) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $nama, $email, $hashed_password, $role);
            
            if ($stmt->execute()) {
                $_SESSION['success'] = "Admin berhasil ditambahkan!";
                
                // Manual log
                $aktivitas = "Menambahkan admin baru: " . $nama;
                $log_stmt = $conn->prepare("INSERT INTO log_aktivitas (id_user, aktivitas) VALUES (?, ?)");
                $log_stmt->bind_param("is", $_SESSION['id_user'], $aktivitas);
                $log_stmt->execute();
            } else {
                $_SESSION['error'] = "Gagal menambahkan admin (Email mungkin sudah terdaftar)!";
            }
        } catch (Exception $e) {
            $_SESSION['error'] = "Error: " . $e->getMessage();
        }
    }
}
header("Location: ../../pengguna-admin.php");
exit();
