<?php
session_start();
require_once '../auth/middleware.php';
checkAdmin();
require_once '../../config/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_umkm = $_POST['id_umkm'] ?? 0;
    $nama_menu = $_POST['nama_menu'] ?? '';
    $harga = str_replace(['.', ','], '', $_POST['harga'] ?? 0);
    $menu_utama = isset($_POST['menu_utama']) ? 1 : 0;
    $menu_terlaris = isset($_POST['menu_terlaris']) ? 1 : 0;
    
    $rasa_input = $_POST['rasa'] ?? '';
    $bahan_input = $_POST['bahan'] ?? '';

    if ($id_umkm && $nama_menu && $harga) {
        $conn->begin_transaction();
        try {
            $stmt = $conn->prepare("INSERT INTO menu_umkm (id_umkm, nama_menu, harga, menu_utama, menu_terlaris) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("isdii", $id_umkm, $nama_menu, $harga, $menu_utama, $menu_terlaris);
            $stmt->execute();
            $id_menu = $conn->insert_id;
            
            // Handle Rasa
            if(!empty(trim($rasa_input))) {
                $rasa_array = array_filter(array_map('trim', explode(',', $rasa_input)));
                foreach($rasa_array as $r_name) {
                    $r_name = ucwords(strtolower($r_name));
                    $chk = $conn->prepare("SELECT id_rasa FROM kategori_rasa WHERE nama_rasa = ?");
                    $chk->bind_param("s", $r_name);
                    $chk->execute();
                    $res = $chk->get_result()->fetch_assoc();
                    if($res) {
                        $id_rasa = $res['id_rasa'];
                    } else {
                        $ins = $conn->prepare("INSERT INTO kategori_rasa (nama_rasa) VALUES (?)");
                        $ins->bind_param("s", $r_name);
                        $ins->execute();
                        $id_rasa = $conn->insert_id;
                    }
                    $conn->query("INSERT INTO menu_rasa (id_menu, id_rasa) VALUES ($id_menu, $id_rasa)");
                }
            }
            
            // Handle Bahan Baku
            if(!empty(trim($bahan_input))) {
                $bahan_array = array_filter(array_map('trim', explode(',', $bahan_input)));
                foreach($bahan_array as $b_name) {
                    $b_name = ucwords(strtolower($b_name));
                    $chk = $conn->prepare("SELECT id_bahan FROM bahan_baku WHERE nama_bahan = ?");
                    $chk->bind_param("s", $b_name);
                    $chk->execute();
                    $res = $chk->get_result()->fetch_assoc();
                    if($res) {
                        $id_bahan = $res['id_bahan'];
                    } else {
                        $ins = $conn->prepare("INSERT INTO bahan_baku (nama_bahan) VALUES (?)");
                        $ins->bind_param("s", $b_name);
                        $ins->execute();
                        $id_bahan = $conn->insert_id;
                    }
                    $conn->query("INSERT INTO menu_bahan_baku (id_menu, id_bahan) VALUES ($id_menu, $id_bahan)");
                }
            }
            
            $conn->commit();
            $_SESSION['success'] = "Menu berhasil ditambahkan.";
        } catch (Exception $e) {
            $conn->rollback();
            $_SESSION['error'] = "Gagal menambah menu: " . $e->getMessage();
        }
    } else {
        $_SESSION['error'] = "Mohon lengkapi data menu.";
    }
    header("Location: ../detail-umkm.php?id=" . $id_umkm);
    exit;
} else {
    header("Location: ../umkm.php");
    exit;
}
