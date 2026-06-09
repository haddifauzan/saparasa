<?php
// Mulai session
session_start();

// Hubungkan file koneksi database
require_once '../../config/conn.php';

// Memastikan request bertipe POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data input dan bersihkan
    $nama             = trim($_POST['nama']);
    $email            = trim($_POST['email']);
    $password         = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validasi input kosong
    if (empty($nama) || empty($email) || empty($password) || empty($confirm_password)) {
        $_SESSION['error'] = "Semua kolom wajib diisi!";
        header("Location: ../register.php");
        exit();
    }

    // Validasi kecocokan password
    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Konfirmasi kata sandi tidak cocok!";
        header("Location: ../register.php");
        exit();
    }

    // Validasi panjang password minimal
    if (strlen($password) < 6) {
        $_SESSION['error'] = "Kata sandi minimal harus 6 karakter!";
        header("Location: ../register.php");
        exit();
    }

    // Cek apakah email sudah digunakan
    $check_query = "SELECT id_user FROM users WHERE email = ?";
    $stmt = $conn->prepare($check_query);
    
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['error'] = "Alamat email ini sudah terdaftar!";
            header("Location: ../register.php");
            exit();
        }
        $stmt->close();
    }

    // Enkripsi password dengan password_hash() BCRYPT bawaan PHP
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Set default value
    $default_role = 'user';
    $default_profile = 'default_user.png'; // default avatar

    // Lakukan pendaftaran user baru
    $insert_query = "INSERT INTO users (nama, email, password, role, foto_profile) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    
    if ($stmt) {
        $stmt->bind_param("sssss", $nama, $email, $hashed_password, $default_role, $default_profile);
        
        if ($stmt->execute()) {
            $_SESSION['success'] = "Pendaftaran berhasil! Silakan masuk menggunakan akun baru Anda.";
            header("Location: ../login.php");
            exit();
        } else {
            $_SESSION['error'] = "Gagal mendaftarkan akun. Silakan coba lagi.";
            header("Location: ../register.php");
            exit();
        }
        $stmt->close();
    } else {
        $_SESSION['error'] = "Terjadi kesalahan pada sistem database.";
        header("Location: ../register.php");
        exit();
    }
} else {
    // Jika diakses selain POST, kembalikan ke register.php
    header("Location: ../register.php");
    exit();
}
