<?php
// Memastikan session dimulai jika belum dimulai di tempat lain
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Fungsi untuk memeriksa apakah user sudah login.
 * Jika belum, akan otomatis diarahkan ke halaman login.
 * Path '../auth/login.php' di bawah dikonfigurasi untuk dipanggil dari folder level admin/ (e.g. admin/dashboard.php).
 */
function checkLogin() {
    if (!isset($_SESSION['id_user'])) {
        header("Location: ../auth/login.php");
        exit();
    }
}

/**
 * Fungsi untuk memeriksa apakah user yang login memiliki role admin.
 * Jika bukan admin, akan diarahkan kembali ke beranda utama.
 */
function checkAdmin() {
    checkLogin();
    if ($_SESSION['role'] !== 'admin') {
        header("Location: ../index.php");
        exit();
    }
}
