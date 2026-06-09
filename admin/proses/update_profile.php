<?php
// Mulai session
session_start();

// Validasi apakah user sudah login dan memiliki role admin
if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'admin') {
    $_SESSION['error'] = "Akses ditolak! Anda harus masuk sebagai Admin.";
    header("Location: ../../auth/login.php");
    exit();
}

// Hubungkan file koneksi database
require_once '../../config/conn.php';

// Memastikan request bertipe POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_SESSION['id_user'];
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $password_baru = $_POST['password_baru'];

    // Validasi input wajib
    if (empty($nama) || empty($email)) {
        $_SESSION['error'] = "Nama Lengkap dan Alamat Email tidak boleh kosong!";
        header("Location: ../dashboard.php");
        exit();
    }

    // Ambil data user saat ini untuk password lama dan foto profil lama
    $query_select = "SELECT password, foto_profile FROM users WHERE id_user = ?";
    $stmt_select = $conn->prepare($query_select);
    
    if ($stmt_select) {
        $stmt_select->bind_param("i", $id_user);
        $stmt_select->execute();
        $result = $stmt_select->get_result();
        $user = $result->fetch_assoc();
        $stmt_select->close();
    } else {
        $_SESSION['error'] = "Terjadi kesalahan sistem database.";
        header("Location: ../dashboard.php");
        exit();
    }

    $password_hash = $user['password'];
    $foto_profile = $user['foto_profile'];

    // 1. Proses update password jika password baru diisi
    if (!empty($password_baru)) {
        if (strlen($password_baru) < 6) {
            $_SESSION['error'] = "Kata sandi baru minimal harus 6 karakter!";
            header("Location: ../dashboard.php");
            exit();
        }
        $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);
    }

    // 2. Proses upload foto profil baru jika ada file yang diunggah
    if (isset($_FILES['foto_profile']) && $_FILES['foto_profile']['error'] === UPLOAD_ERR_OK) {
        $file_tmp  = $_FILES['foto_profile']['tmp_name'];
        $file_name = $_FILES['foto_profile']['name'];
        $file_size = $_FILES['foto_profile']['size'];
        $file_ext  = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Format yang diperbolehkan
        $allowed_ext = ['jpg', 'jpeg', 'png'];
        // Maksimal ukuran 2MB
        $max_size = 2 * 1024 * 1024;

        if (!in_array($file_ext, $allowed_ext)) {
            $_SESSION['error'] = "Format file tidak valid! Harap unggah foto dengan format JPG, JPEG, atau PNG.";
            header("Location: ../dashboard.php");
            exit();
        }

        if ($file_size > $max_size) {
            $_SESSION['error'] = "Ukuran file terlalu besar! Maksimal ukuran file adalah 2MB.";
            header("Location: ../dashboard.php");
            exit();
        }

        // Tentukan folder penyimpanan upload
        $upload_dir = '../../public/uploads/foto_profile/';
        
        // Buat folder jika belum ada
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        // Generate nama file baru yang unik
        $new_file_name = time() . '_' . uniqid() . '.' . $file_ext;
        $dest_path = $upload_dir . $new_file_name;

        // Pindahkan file ke folder uploads
        if (move_uploaded_file($file_tmp, $dest_path)) {
            // Hapus foto profil lama jika bukan default_user.png
            if ($foto_profile !== 'default_user.png' && !empty($foto_profile)) {
                $old_file_path = $upload_dir . $foto_profile;
                if (file_exists($old_file_path)) {
                    unlink($old_file_path);
                }
            }
            // Update nama foto profil baru
            $foto_profile = $new_file_name;
        } else {
            $_SESSION['error'] = "Gagal mengunggah foto profil baru.";
            header("Location: ../dashboard.php");
            exit();
        }
    }

    // 3. Update data ke database
    $query_update = "UPDATE users SET nama = ?, email = ?, password = ?, foto_profile = ? WHERE id_user = ?";
    $stmt_update = $conn->prepare($query_update);

    if ($stmt_update) {
        $stmt_update->bind_param("ssssi", $nama, $email, $password_hash, $foto_profile, $id_user);

        if ($stmt_update->execute()) {
            // Update data session agar langsung tersinkronisasi di tampilan
            $_SESSION['nama'] = $nama;
            $_SESSION['email'] = $email;
            $_SESSION['foto_profile'] = $foto_profile;

            $_SESSION['success'] = "Profil Anda berhasil diperbarui!";
        } else {
            $_SESSION['error'] = "Gagal memperbarui profil di database.";
        }
        $stmt_update->close();
    } else {
        $_SESSION['error'] = "Terjadi kesalahan sistem saat menyiapkan pembaruan.";
    }

    header("Location: ../dashboard.php");
    exit();
} else {
    header("Location: ../dashboard.php");
    exit();
}
