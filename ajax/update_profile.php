<?php
session_start();
require '../config/conn.php';

header('Content-Type: application/json');

if (!isset($_SESSION['id_user'])) {
    echo json_encode(['status' => 'error', 'message' => 'Silakan login terlebih dahulu.']);
    exit();
}

$id_user = $_SESSION['id_user'];
$nama = trim($_POST['nama'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

if (empty($nama) || empty($email)) {
    echo json_encode(['status' => 'error', 'message' => 'Nama dan Email wajib diisi.']);
    exit();
}

$updates = [];
$params = [];
$types = '';

$updates[] = "nama = ?";
$params[] = $nama;
$types .= "s";

$updates[] = "email = ?";
$params[] = $email;
$types .= "s";

if (!empty($password)) {
    $updates[] = "password = ?";
    $params[] = password_hash($password, PASSWORD_DEFAULT);
    $types .= "s";
}

// Handle Profile Picture Upload
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    $file_type = mime_content_type($_FILES['foto']['tmp_name']);
    
    if (!in_array($file_type, $allowed_types)) {
        echo json_encode(['status' => 'error', 'message' => 'Format file foto tidak valid.']);
        exit();
    }
    
    // Simpan dengan nama id_user.jpg
    $target_dir = "../public/uploads/foto_profile/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $target_file = $target_dir . $id_user . '.jpg'; // Selalu simpan sbg jpg untuk konsistensi
    
    // Resize image if it's too big, or simply move it.
    // Let's just move it for simplicity now.
    move_uploaded_file($_FILES['foto']['tmp_name'], $target_file);
}

$query = "UPDATE users SET " . implode(", ", $updates) . " WHERE id_user = ?";
$params[] = $id_user;
$types .= "i";

$stmt = $conn->prepare($query);
$stmt->bind_param($types, ...$params);

if ($stmt->execute()) {
    // Update session
    $_SESSION['nama'] = $nama;
    $_SESSION['email'] = $email;
    echo json_encode(['status' => 'success', 'message' => 'Profil berhasil diperbarui.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui profil.']);
}
