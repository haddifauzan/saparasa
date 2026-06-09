-- 1. INPUT USERS
INSERT INTO users (nama, email, password, role, foto_profile) VALUES 
('Haddi Fauzan', 'admin@saparasa.com', 'admin123', 'admin', 'admin.png'),
('Pak Cecep Seblak', 'cecep@saparasa.com', 'penjual123', 'penjual', 'cecep.png'),
('Siti Rahma', 'siti@gmail.com', 'user123', 'user', 'siti.png');

-- 2. INPUT KATEGORI UMKM
INSERT INTO kategori_umkm (nama_kategori) VALUES 
('Makanan'),
('Minuman');

-- 3. INPUT UMKM
-- Mematuhi ENUM status_halal ('tidak','belum','proses','sudah') & izin_usaha ('belum','proses','sudah')
INSERT INTO umkm (id_kategori, nama_umkm, pemilik, deskripsi, tahun_berdiri, latitude, longitude, operasional_tetap, catatan_operasional, asal_daerah, status_halal, izin_usaha) VALUES 
(1, 'Seblak GOR Saparua Pak Cecep', 'Cecep', 'Seblak basah khas Bandung dengan rempah kencur.', 2018, -6.909241, 107.616353, 1, 'Tutup saat libur nasional', 'Bandung', 'sudah', 'sudah'),
(2, 'Susu Murni Saparua', 'Rian', 'Susu sapi murni dari Lembang.', 2020, -6.909350, 107.616460, 1, 'Tersedia varian hangat', 'Bandung', 'sudah', 'proses');

-- 4. INPUT OPERASIONAL UMKM
-- WAJIB mematuhi ENUM ('senin','selasa','rabu','kamis','jumat','sabtu','minggu')
-- Karena tidak bisa "Senin-Sabtu", data harus diinput per hari
INSERT INTO operasional_umkm (id_umkm, hari, jam_buka, jam_tutup) VALUES 
(1, 'senin', '10:00:00', '20:00:00'),
(1, 'selasa', '10:00:00', '20:00:00'),
(1, 'rabu', '10:00:00', '20:00:00'),
(2, 'sabtu', '06:00:00', '21:00:00'),
(2, 'minggu', '06:00:00', '21:00:00');

-- 5. INPUT GALERI UMKM
-- WAJIB mematuhi ENUM jenis_foto ('stand','menu')
INSERT INTO galeri_umkm (id_umkm, foto, jenis_foto) VALUES 
(1, 'stand_seblak_cecep.jpg', 'stand'),
(1, 'menu_seblak_komplit.jpg', 'menu'),
(2, 'stand_susu_murni.jpg', 'stand');

-- 6. INPUT SOSMED UMKM
-- WAJIB mematuhi ENUM platform ('instagram','tiktok','facebook','x')
INSERT INTO sosmed_umkm (id_umkm, platform, username) VALUES 
(1, 'instagram', '@seblak_cecep_saparua'),
(1, 'tiktok', '@seblak_saparua_asli'),
(2, 'instagram', '@susumurni_saparua');

-- 7. INPUT METODE PEMBAYARAN
INSERT INTO metode_pembayaran (nama_pembayaran) VALUES 
('Cash'),
('QRIS');

-- 8. INPUT UMKM PEMBAYARAN (PIVOT)
INSERT INTO umkm_pembayaran (id_umkm, id_pembayaran) VALUES 
(1, 1), 
(1, 2), 
(2, 1);

-- 9. INPUT PLATFORM ONLINE
INSERT INTO platform_online (nama_platform) VALUES 
('GoFood'),
('GrabFood');

-- 10. INPUT UMKM PLATFORM ONLINE (PIVOT)
INSERT INTO umkm_platform_online (id_umkm, id_platform, link_platform) VALUES 
(1, 1, 'https://gofood.link/a/seblak_cecep'),
(2, 2, 'https://grab.id/food/susu_saparua');

-- 11. INPUT MENU UMKM
INSERT INTO menu_umkm (id_umkm, nama_menu, harga, menu_utama, menu_terlaris) VALUES 
(1, 'Seblak Ceker', 15000.00, 1, 1),
(2, 'Susu Murni Strawberry', 10000.00, 1, 1);

-- 12. INPUT KATEGORI RASA & BAHAN BAKU
INSERT INTO kategori_rasa (nama_rasa) VALUES ('Pedas'), ('Gurih'), ('Manis');
INSERT INTO bahan_baku (nama_bahan) VALUES ('Kerupuk'), ('Ceker'), ('Susu Segar');

-- 13. INPUT MENU RASA & MENU BAHAN BAKU (PIVOT)
INSERT INTO menu_rasa (id_menu, id_rasa) VALUES 
(1, 1), -- Seblak -> Pedas
(2, 3); -- Susu -> Manis

INSERT INTO menu_bahan_baku (id_menu, id_bahan) VALUES 
(1, 1), -- Seblak -> Kerupuk
(1, 2), -- Seblak -> Ceker
(2, 3); -- Susu -> Susu Segar

-- 14. INPUT REVIEW PENGUNJUNG
-- Lolos trigger rating 1-5
INSERT INTO review_pengunjung (id_user, id_umkm, rating, komentar) VALUES 
(3, 1, 5, 'Enak banget seblaknya!'),
(3, 2, 4, 'Susunya segar.');