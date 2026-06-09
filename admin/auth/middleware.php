<?php
// Memastikan session dimulai jika belum dimulai di tempat lain
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Hubungkan ke file session helper utama di root
require_once __DIR__ . '/../../auth/session.php';

// Jalankan pemeriksaan apakah user sudah login dan memiliki role admin
checkAdmin();
