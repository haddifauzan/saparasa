-- TRANSAKSI 1: REGISTRASI USER BARU & PEMBERIAN REVIEW PERDANA (DINAMIS)
-- Skenario: Pengunjung mengisi form register dan langsung menulis review pertama mereka.

START TRANSACTION;

-- 1. Memasukkan data pengguna baru secara dinamis menggunakan placeholder (?)
-- Urutan parameter PHP: nama, email, password, role, foto_profile
INSERT INTO users (nama, email, password, role, foto_profile, created_at)
VALUES (?, ?, ?, ?, ?, NOW());

-- 2. Mengambil ID User yang baru saja terbentuk otomatis di baris atas
SET @dynamic_user_id = LAST_INSERT_ID();

-- 3. Memasukkan review perdana secara dinamis
-- Urutan parameter PHP: id_umkm, rating, komentar
-- @dynamic_user_id otomatis mengikat akun yang baru mendaftar di atas
INSERT INTO review_pengunjung (id_user, id_umkm, rating, komentar, created_at)
VALUES (@dynamic_user_id, ?, ?, ?, NOW());

-- Kunci perubahan jika kedua proses berhasil tanpa interupsi
COMMIT;


-- TRANSAKSI 2: INPUT MENU BARU BESERTA DATA MASTER PIVOT (DINAMIS)
-- Skenario: Admin menambahkan menu kuliner baru melalui formulir Dashboard Admin.

START TRANSACTION;

-- 1. Masukkan data menu baru secara dinamis ke tabel menu_umkm
-- Urutan parameter PHP: id_umkm, nama_menu, harga, menu_utama, menu_terlaris
INSERT INTO menu_umkm (id_umkm, nama_menu, harga, menu_utama, menu_terlaris)
VALUES (?, ?, ?, ?, ?);

-- 2. Ambil ID Menu yang baru saja digenerate otomatis oleh database
SET @dynamic_menu_id = LAST_INSERT_ID();

-- 3. Hubungkan menu baru tersebut ke Kategori Rasa di tabel pivot 'menu_rasa'
-- Parameter PHP: id_rasa (Kategori rasa pertama dan kedua pilihan admin)
INSERT INTO menu_rasa (id_menu, id_rasa)
VALUES 
(@dynamic_menu_id, ?),
(@dynamic_menu_id, ?);

-- 4. Hubungkan menu baru tersebut ke Bahan Baku di tabel pivot 'menu_bahan_baku'
-- Parameter PHP: id_bahan (Bahan baku pertama dan kedua pilihan admin)
INSERT INTO menu_bahan_baku (id_menu, id_bahan)
VALUES 
(@dynamic_menu_id, ?),
(@dynamic_menu_id, ?);

-- 5. Audit Log Otomatis menggunakan ID Admin yang sedang login dan nama menu yang diinput
-- Parameter PHP: id_user_admin, nama_menu
INSERT INTO log_aktivitas (id_user, aktivitas, waktu)
VALUES (?, CONCAT('Admin berhasil menambahkan menu baru: ', ?), NOW());

-- Kunci transaksi
COMMIT;