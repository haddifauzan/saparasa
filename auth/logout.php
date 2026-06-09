<?php
// Mulai session
session_start();

// Hapus semua data session
session_unset();

// Hancurkan session aktif
session_destroy();

// Alihkan kembali ke halaman login
header("Location: login.php");
exit();
