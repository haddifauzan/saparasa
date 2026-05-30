-- FILE: database/dummy_data.sql
-- Data Uji Coba (Dummy Data) untuk Aplikasi Web Saparasa Saparua Bandung

-- 1. INPUT DATA MASTER: KATEGORI UMKM
INSERT INTO kategori_umkm (nama_kategori) VALUES 
('Makanan'),
('Minuman'),
('Cemilan & Jajanan');

-- 2. INPUT DATA MASTER: METODE PEMBAYARAN
INSERT INTO metode_pembayaran (nama_pembayaran) VALUES 
('Tunai (Cash)'),
('QRIS / GPay / OVO / Dana'),
('Transfer Bank');

-- 3. INPUT DATA MASTER: PLATFORM ONLINE
INSERT INTO platform_online (nama_platform) VALUES 
('GoFood'),
('GrabFood'),
('ShopeeFood');

-- 4. INPUT DATA MASTER: BAHAN BAKU
INSERT INTO bahan_baku (nama_bahan) VALUES 
('Daging Ayam'),
('Daging Sapi'),
('Tepung Tapioka'),
('Cabai Rawit'),
('Susu Segar');

-- 5. INPUT DATA MASTER: KATEGORI RASA
INSERT INTO kategori_rasa (nama_rasa) VALUES 
('Pedas Jeletot'),
('Asin Gurih'),
('Manis Legit'),
('Asam Segar');

-- 6. INPUT DATA MASTER: USERS (Admin, Penjual, dan Pengunjung)
-- Password di bawah adalah simulasi teks biasa 
INSERT INTO users (nama, email, password, role, foto_profile, created_at) VALUES 
('Haddi Fauzan', 'haddi@saparasa.com', 'admin123', 'admin', 'admin.png', NOW()),
('Pak Cecep Seblak', 'cecep@saparasa.com', 'penjual123', 'penjual', 'cecep.png', NOW()),
('Siti Rahma', 'siti@gmail.com', 'user123', 'user', 'siti.png', NOW()),
('Budi Santoso', 'budi@gmail.com', 'user123', 'user', 'budi.png', NOW());

-- 7. INPUT DATA UTAMA: UMKM
-- Mematuhi aturan ENUM status_halal ('tidak', 'belum', 'proses', 'sudah') dan izin_usaha ('belum', 'proses', 'sudah')
INSERT INTO umkm (id_kategori, nama_umkm, pemilik, deskripsi, tahun_berdiri, latitude, longitude, operasional_tetap, catatan_operasional, asal_daerah, status_halal, izin_usaha, created_at) VALUES 
(1, 'Seblak GOR Saparua Pak Cecep', 'Cecep', 'Seblak basah khas Bandung dengan rempah kencur yang kuat dan pilihan toping melimpah di area kuliner Saparua.', 2018, -6.909241, 107.616353, 1, 'Buka setiap hari kecuali hari libur nasional', 'Bandung', 'sudah', 'sudah', NOW()),
(2, 'Susu Murni Saparua Segar', 'Rian', 'Susu sapi murni segar langsung dari peternakan Lembang, tersedia berbagai varian rasa.', 2020, -6.909350, 107.616460, 1, 'Buka jam 07:00 - 21:00', 'Lembang / Bandung', 'sudah', 'proses', NOW()),
(3, 'Dimsum Saparua Heritage', 'Amdani', 'Dimsum ayam dan udang hangat berukuran besar dengan saus merah asam pedas yang khas.', 2021, -6.909120, 107.616210, 0, 'Hari Minggu buka lebih pagi saat Car Free Day', 'Bandung', 'belum', 'belum', NOW());

-- 8. INPUT DATA ANAK: OPERASIONAL UMKM (Jam Buka - Tutup)
INSERT INTO operasional_umkm (id_umkm, hari, jam_buka, jam_tutup) VALUES 
(1, 'Senin - Sabtu', '10:00:00', '20:00:00'),
(2, 'Setiap Hari', '07:00:00', '21:00:00'),
(3, 'Jumat - Minggu', '06:00:00', '18:00:00');

-- 9. INPUT DATA ANAK: GALERI UMKM (Foto untuk Landing Page)
INSERT INTO galeri_umkm (id_umkm, foto, caption) VALUES 
(1, 'seblak_cecep_1.jpg', 'Tampilan seblak komplit dengan ceker dan kerupuk basah.'),
(1, 'seblak_cecep_2.jpg', 'Antrean pelanggan di kedai Pak Cecep.'),
(2, 'susu_murni.jpg', 'Varian rasa susu murni strawberi dan cokelat.');

-- 10. INPUT DATA ANAK: SOSIAL MEDIA UMKM
INSERT INTO sosmed_umkm (id_umkm, nama_platform, username, link_sosmed) VALUES 
(1, 'Instagram', '@seblak_cecep_saparua', 'https://instagram.com/seblak_cecep_saparua'),
(2, 'Instagram', '@susumurni_saparua', 'https://instagram.com/susumurni_saparua');

-- 11. INPUT DATA PIVOT MANY-TO-MANY: UMKM PEMBAYARAN
INSERT INTO umkm_pembayaran (id_umkm, id_pembayaran) VALUES 
(1, 1), -- Seblak Pak Cecep bisa Cash
(1, 2), -- Seblak Pak Cecep bisa QRIS
(2, 1), -- Susu Murni bisa Cash
(2, 2), -- Susu Murni bisa QRIS
(3, 1); -- Dimsum hanya bisa Cash

-- 12. INPUT DATA PIVOT MANY-TO-MANY: UMKM PLATFORM ONLINE
INSERT INTO umkm_platform_online (id_umkm, id_platform, link_platform) VALUES 
(1, 1, 'https://gofood.link/a/seblak_cecep'),
(1, 2, 'https://grab.id/food/seblak_cecep'),
(2, 1, 'https://gofood.link/a/susu_saparua');

-- 13. INPUT DATA UTAMA: MENU UMKM
INSERT INTO menu_umkm (id_umkm, nama_menu, harga, menu_utama, menu_terlaris) VALUES 
(1, 'Seblak Ceker Jeletot', 15000.00, 1, 1),
(1, 'Seblak Batagor Kering', 12000.00, 0, 0),
(2, 'Susu Murni Strawberry', 10000.00, 1, 1),
(2, 'Susu Murni Melon', 10000.00, 0, 0),
(3, 'Dimsum Ayam Jumbo (Isi 4)', 17000.00, 1, 1);

-- 14. INPUT DATA PIVOT MANY-TO-MANY: MENU RASA
INSERT INTO menu_rasa (id_menu, id_rasa) VALUES 
(1, 1), -- Seblak Ceker -> Pedas Jeletot
(1, 2), -- Seblak Ceker -> Asin Gurih
(3, 2); -- Dimsum -> Asin Gurih

-- 15. INPUT DATA PIVOT MANY-TO-MANY: MENU BAHAN BAKU
INSERT INTO menu_bahan_baku (id_menu, id_bahan) VALUES 
(1, 3), -- Seblak Ceker pakai Tepung Tapioka
(1, 4), -- Seblak Ceker pakai Cabai Rawit
(3, 1), -- Dimsum pakai Daging Ayam
(3, 3); -- Dimsum pakai Tepung Tapioka

-- 16. INPUT DATA UTAMA: REVIEW PENGUNJUNG
-- Data ini sengaja dibuat sah (rating 1-5) agar lolos dari Trigger 4 (before_review_insert)
INSERT INTO review_pengunjung (id_user, id_umkm, rating, komentar, created_at) VALUES 
(3, 1, 5, 'Seblaknya juara! Pedasnya nampol dan rempahnya kerasa banget.', NOW()),
(4, 1, 4, 'Enak tapi kalau jam makan siang antreannya panjang banget.', NOW()),
(3, 2, 5, 'Susunya segar, manisnya pas, cocok diminum setelah olahraga di GOR Saparua.', NOW());