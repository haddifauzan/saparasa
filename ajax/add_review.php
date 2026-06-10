<?php
session_start();
require '../config/conn.php';

header('Content-Type: application/json');

if (!isset($_SESSION['id_user'])) {
    echo json_encode(['status' => 'error', 'message' => 'Anda harus login untuk memberikan ulasan.']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Metode request tidak diizinkan.']);
    exit();
}

$id_user = $_SESSION['id_user'];
$id_umkm = intval($_POST['id_umkm'] ?? 0);
$rating = intval($_POST['rating'] ?? 0);
$komentar = trim($_POST['komentar'] ?? '');

if ($id_umkm <= 0 || $rating < 1 || $rating > 5 || empty($komentar)) {
    echo json_encode(['status' => 'error', 'message' => 'Data ulasan tidak valid atau tidak lengkap.']);
    exit();
}

// Cek apakah user sudah mereview UMKM ini
$check = $conn->prepare("SELECT id_review FROM review_pengunjung WHERE id_user = ? AND id_umkm = ?");
$check->bind_param("ii", $id_user, $id_umkm);
$check->execute();
if ($check->get_result()->num_rows > 0) {
    echo json_encode(['status' => 'error', 'message' => 'Anda sudah memberikan ulasan untuk UMKM ini.']);
    exit();
}

// Insert review
$stmt = $conn->prepare("INSERT INTO review_pengunjung (id_user, id_umkm, rating, komentar) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iiis", $id_user, $id_umkm, $rating, $komentar);
if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Ulasan berhasil ditambahkan.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan ulasan.']);
}
