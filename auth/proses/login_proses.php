<?php
// Mulai session untuk melacak login user
session_start();

// Hubungkan file koneksi database
require_once '../../config/conn.php';

// Memastikan request bertipe POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data input dan hilangkan spasi tambahan
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validasi input kosong
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Email dan kata sandi wajib diisi!";
        header("Location: ../login.php");
        exit();
    }

    // Siapkan query untuk mencegah SQL Injection
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Jika user ditemukan
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
            // Verifikasi password yang di-hash dengan password inputan
            if (password_verify($password, $user['password'])) {
                // Set variabel session
                $_SESSION['id_user'] = $user['id_user'];
                $_SESSION['nama'] = $user['nama'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['foto_profile'] = $user['foto_profile'];

                // Redirect berdasarkan role
                if ($user['role'] === 'admin') {
                    header("Location: ../../admin/dashboard.php");
                } else {
                    // Jika role adalah 'user', arahkan ke beranda (atau ganti sesuai keinginan)
                    header("Location: ../../index.php");
                }
                exit();
            }
        }
        
        $stmt->close();
    }

    // Jika gagal login, kirim pesan error dan kembali ke login.php
    $_SESSION['error'] = "Email atau kata sandi Anda salah!";
    header("Location: ../login.php");
    exit();
} else {
    // Jika diakses selain POST, kembalikan ke login.php
    header("Location: ../login.php");
    exit();
}
