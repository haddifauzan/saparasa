-- ==============================================================================
-- SCRIPT FINAL MASTER: RESET & IMPORT DATA UMKM + DAFTAR MENU LENGKAP (23 UMKM)
-- ==============================================================================

-- ------------------------------------------------------------------------------
-- FASE 1: NONAKTIFKAN FOREIGN KEY & KOSONGKAN SEMUA TABEL
-- ------------------------------------------------------------------------------
SET FOREIGN_KEY_CHECKS = 0;

TRUNCATE TABLE umkm_platform_online;
TRUNCATE TABLE umkm_pembayaran;
TRUNCATE TABLE sosmed_umkm;
TRUNCATE TABLE review_pengunjung;
TRUNCATE TABLE platform_online;
TRUNCATE TABLE operasional_umkm;
TRUNCATE TABLE metode_pembayaran;
TRUNCATE TABLE menu_umkm;
TRUNCATE TABLE menu_rasa;
TRUNCATE TABLE menu_bahan_baku;
TRUNCATE TABLE log_aktivitas;
TRUNCATE TABLE kategori_umkm;
TRUNCATE TABLE kategori_rasa;
TRUNCATE TABLE galeri_umkm;
TRUNCATE TABLE bahan_baku;
TRUNCATE TABLE umkm;
TRUNCATE TABLE users;

SET FOREIGN_KEY_CHECKS = 1;

-- ------------------------------------------------------------------------------
-- FASE 2: MEMASUKKAN DATA MASTER (KATEGORI & PLATFORM)
-- ------------------------------------------------------------------------------
INSERT INTO kategori_umkm (nama_kategori) VALUES
('Makanan'), ('Minuman'), ('Makanan & Minuman');

INSERT INTO metode_pembayaran (nama_pembayaran) VALUES
('Cash'), ('QRIS'), ('Transfer Bank'), ('Debit/Kredit');

INSERT INTO platform_online (nama_platform) VALUES
('GoFood'), ('GrabFood'), ('ShopeeFood');

-- ------------------------------------------------------------------------------
-- FASE 3: MEMASUKKAN 23 DATA PROFIL UMKM (ID 1 - 23)
-- ------------------------------------------------------------------------------
CALL AddNewUMKM(1, 'Dimsum Smoothies Narawi', 'Indra', 'Menjual Dimsum Mentai, dimsum goreng berbahan utama Ayam dan Sapi dengan rasa dominan Asin.', 2023, -6.907917, 107.615822, 1, NULL, 'Tiongkok', 'belum', 'sudah'); -- ID: 1
CALL AddNewUMKM(1, 'Batagor Ronsep', 'Roni', 'Menjual Batagor berbahan Tepung dan ikan tenggiri.', 2022, -6.907970, 107.615521, 0, 'Libur tidak tentu', 'Bandung', 'sudah', 'sudah'); -- ID: 2
CALL AddNewUMKM(1, 'Cimol Bojot AA', 'Pak Taufiq', 'Menjual cimol bojot berbagai isi seperti Mozzarella, beef, ayam.', 2021, -6.907884, 107.615658, 1, NULL, 'Garut', 'sudah', 'sudah'); -- ID: 3
CALL AddNewUMKM(2, 'Segar Sehat', 'Arfi', 'Menjual aneka minuman sari buah segar seperti lemon, jeruk nipis.', 2024, -6.907973, 107.615504, 1, NULL, 'Tidak ada', 'sudah', 'sudah'); -- ID: 4
CALL AddNewUMKM(2, 'Borneo Coffee', 'Ayi', 'Menjual kopi susu, Butter Scotch Sea Salt Latte, Americano, dll.', 2025, -6.908233, 107.615397, 1, NULL, 'Kalimantan Barat / Selatan', 'sudah', 'sudah'); -- ID: 5
CALL AddNewUMKM(3, 'badman coffee', 'geraldi', 'Menjual kopi, roti, indomie, cuanki, jasuke.', 2016, -6.907802, 107.616271, 1, NULL, 'Tidak ada', 'belum', 'sudah'); -- ID: 6
CALL AddNewUMKM(1, 'Churos', 'Rizki', 'Menjual Original Churros, Churros Ice Cream Spesial, dll.', 2025, -6.907738, 107.616384, 1, NULL, 'Spanyol', 'sudah', 'sudah'); -- ID: 7
CALL AddNewUMKM(1, 'Lekker Kulo', 'Teh Rara', 'Menjual Kue Laker khas Solo/Semarang.', 2025, -6.908175, 107.615376, 1, NULL, 'Solo/Semarang', 'belum', 'sudah'); -- ID: 8
CALL AddNewUMKM(2, 'Little Bar', 'Lutfan', 'Menjual Kopi Tubruk dan Kopi Butterschot khas Ciwidey.', 2023, -6.907637, 107.616760, 1, NULL, 'Ciwidey', 'sudah', 'sudah'); -- ID: 9
CALL AddNewUMKM(1, 'Es Pisang Ijo', 'Kak Siput', 'Menjual Es Pisang Ijo khas dengan susu, pisang, dan es krim.', 2024, -6.907754, 107.616368, 0, 'Sabtu Minggu buka jam 12 siang', 'Bandung', 'sudah', 'sudah'); -- ID: 10
CALL AddNewUMKM(1, 'Cemilan tutu', 'Ajey', 'Menjual Basreng, Tahu, Mix Tahu Basreng.', 2025, -6.907717, 107.616513, 0, 'Sabtu minggu hingga jam 1 malam', 'Bandung', 'sudah', 'sudah'); -- ID: 11
CALL AddNewUMKM(1, 'Pisang keju susu', 'Adit', 'Menjual aneka pisang keju.', 2024, -6.907548, 107.616844, 1, NULL, 'Tidak ada', 'sudah', 'sudah'); -- ID: 12
CALL AddNewUMKM(2, 'Minuman Rempah Dawa', 'Yoga', 'Menjual Rempah Original, STMJ, Wedang Uwuh, dll.', 2025, -6.907378, 107.616761, 1, NULL, 'Yogyakarta / Jakarta', 'sudah', 'sudah'); -- ID: 13
CALL AddNewUMKM(1, 'Royal Dimsum Mentai', 'Nisrina', 'Menjual Dimsum Mentai Gurih, Pedas, Asin.', 2025, -6.907607, 107.616787, 1, NULL, 'Tidak ada', 'sudah', 'sudah'); -- ID: 14
CALL AddNewUMKM(1, 'Kedai Tetangga Saparua', 'Riska', 'Menjual Ceker Mercon, Pempek.', 2025, -6.907634, 107.616841, 1, NULL, 'Palembang', 'belum', 'sudah'); -- ID: 15
CALL AddNewUMKM(1, 'Potato Fun Fries', 'Ibu desi', 'Menjual Kentang goreng Gurih, Pedas, Asin.', 2024, -6.907545, 107.616829, 1, NULL, 'Sunda', 'belum', 'sudah'); -- ID: 16
CALL AddNewUMKM(1, 'Chicken Karage', 'Desi', 'Menjual Chicken Karage khas Jepang.', 2024, -6.907531, 107.616790, 0, 'Sabtu Minggu sampai 1 malam', 'Jepang', 'sudah', 'sudah'); -- ID: 17
CALL AddNewUMKM(2, 'Millary Coffee', 'Sandi', 'Menjual Coffee, Non-Coffee, Manual Brew, Signature series.', 2022, -6.907518, 107.616778, 1, NULL, 'Ciwidey', 'belum', 'sudah'); -- ID: 18
CALL AddNewUMKM(1, 'Dmozz jasuke', 'Indah purnama', 'Menjual Jasuke mozzarella, Chocolate, dll.', 2019, -6.907584, 107.616623, 1, NULL, 'Tidak ada', 'sudah', 'sudah'); -- ID: 19
CALL AddNewUMKM(1, 'Gerobak Sate Taichan', 'Fafa', 'Menjual Taichan Ayam, Kulit, Usus, dll.', 2016, -6.907552, 107.616671, 1, NULL, 'Jakarta', 'proses', 'sudah'); -- ID: 20
CALL AddNewUMKM(2, 'Sawadikap Milo', 'Wening', 'Menjual Milo Original, Dancow series.', 2025, -6.907606, 107.616627, 1, NULL, 'Tidak ada', 'sudah', 'sudah'); -- ID: 21
CALL AddNewUMKM(1, 'Robaba Roti Bakar', 'Farid', 'Menjual roti bakar, roti kadet kukus.', 2026, -6.907626, 107.616575, 1, NULL, 'Tidak ada', 'sudah', 'sudah'); -- ID: 22
CALL AddNewUMKM(1, 'Roti Bakar Ice Cream', 'Bintang', 'Menjual Roti Bakar Mix, Choco Crunchy, Eskrim.', 2026, -6.907814, 107.615954, 1, NULL, 'Tidak ada', 'belum', 'sudah'); -- ID: 23

-- ------------------------------------------------------------------------------
-- FASE 4: MEMASUKKAN DAFTAR MENU UMKM (SEKARANG FULL 23 UMKM)
-- ------------------------------------------------------------------------------

-- ID 1: Dimsum Narawi Smoothies
INSERT INTO menu_umkm (id_umkm, nama_menu, harga, menu_utama, menu_terlaris) VALUES
(1, 'Spicy Mayo Isi 6', 30000, 1, 1),
(1, 'Spicy Mayo Isi 8', 38000, 0, 0),
(1, 'Spicy Mayo Isi 16', 74000, 0, 0),
(1, 'Spicy Mayo Jepang Isi 6', 23000, 0, 0),
(1, 'Spicy Mayo Jepang Isi 8', 40000, 0, 0),
(1, 'Spicy Mayo Jepang Isi 16', 83000, 0, 0),
(1, 'Original Isi 6', 28000, 1, 0),
(1, 'Original Isi 8', 35000, 0, 0),
(1, 'Original Isi 16', 64000, 0, 0),
(1, 'Paket Bundling', 61000, 0, 0),
(1, 'Mix Platter Mix', 67000, 0, 0),
(1, 'Mix Platter Mayo Jepang', 70000, 0, 0),
(1, 'Mix Platter Spicy Mayo', 65000, 0, 0),
(1, 'Mix Platter Ori', 60000, 0, 0);

-- ID 2: Batagor Ronsep (Ditambahkan dari Menu Utama)
INSERT INTO menu_umkm (id_umkm, nama_menu, harga, menu_utama, menu_terlaris) VALUES
(2, 'Batagor Ikan Tenggiri', 15000, 1, 1);

-- ID 3: Cimol Bojot AA
INSERT INTO menu_umkm (id_umkm, nama_menu, harga, menu_utama, menu_terlaris) VALUES
(3, 'Cimol Bojot Porsi Kecil', 6000, 1, 0),
(3, 'Cimol Bojot Porsi Besar', 12000, 1, 0),
(3, 'Cimol Isi Mozzarella Porsi Kecil', 10000, 1, 1),
(3, 'Cimol Isi Mozzarella Porsi Besar', 20000, 1, 1),
(3, 'Cimol Beef Burger Porsi Kecil', 10000, 1, 0),
(3, 'Cimol Beef Burger Porsi Besar', 20000, 1, 0),
(3, 'Cimol Isi Ayam Porsi Kecil', 10000, 1, 0),
(3, 'Cimol Isi Ayam Porsi Besar', 20000, 1, 0),
(3, 'Bojot Mix Moza', 16000, 0, 0),
(3, 'Bojot Mix Ayam', 16000, 0, 0),
(3, 'Bojot Mix Beef', 16000, 0, 0),
(3, 'Ayam Mix Moza', 20000, 0, 0),
(3, 'Beef Mix Ayam', 20000, 0, 0),
(3, 'Moza Mix Beef', 20000, 0, 0);

-- ID 4: Segar Sehat
INSERT INTO menu_umkm (id_umkm, nama_menu, harga, menu_utama, menu_terlaris) VALUES
(4, 'Lemon Original', 10000, 1, 0),
(4, 'Lemon Madu', 15000, 0, 0),
(4, 'Lemon Yakult', 15000, 0, 0),
(4, 'Lemon Madu Yakult', 20000, 0, 0),
(4, 'Jeruk Nipis Original', 10000, 1, 0),
(4, 'Jeruk Nipis Madu', 15000, 0, 0),
(4, 'Jeruk Nipis Yakult', 15000, 0, 0),
(4, 'Jeruk Nipis Madu Yakult', 20000, 0, 0),
(4, 'Jeruk Kunci Original', 15000, 1, 0),
(4, 'Jeruk Kunci Madu', 20000, 0, 0),
(4, 'Jeruk Kunci Yakult', 20000, 0, 0),
(4, 'Jeruk Peras Original', 15000, 1, 0),
(4, 'Jeruk Peras Murni', 25000, 0, 0),
(4, 'Jeruk Peras Madu', 20000, 0, 0),
(4, 'Jeruk Peras Yakult', 20000, 0, 0),
(4, 'Sunkist Original', 15000, 1, 1),
(4, 'Sunkist Murni', 30000, 0, 0),
(4, 'Sunkist Madu', 20000, 0, 0),
(4, 'Sunkist Yakult', 20000, 0, 0),
(4, 'Liang Tea', 10000, 0, 0),
(4, 'Susu Kedelai', 10000, 0, 0),
(4, 'Kunyit Asam', 10000, 0, 0),
(4, 'Gula Asam', 10000, 0, 0),
(4, 'Ginger Ale', 15000, 0, 0);

-- ID 5: Borneo Coffee
INSERT INTO menu_umkm (id_umkm, nama_menu, harga, menu_utama, menu_terlaris) VALUES
(5, 'Sanggau', 8000, 0, 0),
(5, 'Kopi Susu', 8000, 1, 1),
(5, 'Americano', 8000, 1, 0),
(5, 'Gula Aren', 10000, 1, 0),
(5, 'Hirangcano', 8000, 0, 0),
(5, 'Aranio', 10000, 0, 0),
(5, 'Matcha Latte', 10000, 0, 0),
(5, 'Chocolate', 10000, 0, 0),
(5, 'Butter Scotch', 10000, 0, 0),
(5, 'Caramel Macchiato', 10000, 0, 0),
(5, 'Pandan Latte', 10000, 0, 0);

-- ID 6: Badman Coffee
INSERT INTO menu_umkm (id_umkm, nama_menu, harga, menu_utama, menu_terlaris) VALUES
(6, 'Americano', 17000, 0, 0),
(6, 'Cafe Latte', 22000, 0, 0),
(6, 'Cappuccino', 22000, 0, 0),
(6, 'Vietnam Drip', 20000, 0, 0),
(6, 'Kopi Susu', 15000, 1, 1),
(6, 'Kosangsu', 22000, 0, 0),
(6, 'Signature Badman', 20000, 0, 0),
(6, 'Bad Gentleman', 23000, 0, 0),
(6, 'Chocolate', 20000, 0, 0),
(6, 'Chocomint', 22000, 0, 0),
(6, 'Lemon Squash', 20000, 0, 0),
(6, 'Lemon Berryfizz', 22000, 0, 0),
(6, 'Iced Tea', 10000, 0, 0),
(6, 'Lemon Tea', 15000, 0, 0),
(6, 'Green Tea', 20000, 0, 0),
(6, 'Thai Tea', 20000, 0, 0),
(6, 'Roti', 10000, 1, 0),
(6, 'Jasuke', 10000, 1, 0),
(6, 'Indomie Polos', 10000, 0, 0),
(6, 'Indomie Telor', 13000, 0, 0),
(6, 'Indomie Kumplit', 18000, 0, 0),
(6, 'Indomie Cuankie', 20000, 1, 0);

-- ID 7: Churros
INSERT INTO menu_umkm (id_umkm, nama_menu, harga, menu_utama, menu_terlaris) VALUES
(7, 'Original Churros', 12000, 1, 0),
(7, 'Churros Ice Cream Special', 20000, 1, 1),
(7, 'Churros Ice Cream Regular', 17000, 1, 0),
(7, 'Black Churros', 15000, 0, 0),
(7, 'Mini Churros', 12000, 0, 0);

-- ID 8: Lekker Kulo
INSERT INTO menu_umkm (id_umkm, nama_menu, harga, menu_utama, menu_terlaris) VALUES
(8, 'Coklat', 4000, 0, 0),
(8, 'Coklat Pisang', 6000, 0, 0),
(8, 'Coklat Keju', 7000, 0, 0),
(8, 'Coklat Pisang Keju', 9000, 0, 0),
(8, 'Milo', 5000, 0, 0),
(8, 'Milo Keju', 7000, 0, 0),
(8, 'Strawberry', 5000, 0, 0),
(8, 'Strawberry Coklat', 8000, 0, 0),
(8, 'Strawberry Keju', 8000, 0, 0),
(8, 'Blueberry', 5000, 0, 0),
(8, 'Blueberry Coklat', 8000, 0, 0),
(8, 'Blueberry Keju', 8000, 0, 0),
(8, 'Oreo', 6000, 0, 0),
(8, 'Oreo Keju', 8000, 0, 0),
(8, 'Choco Crunchy', 6000, 1, 0),
(8, 'Choco Crunchy Keju', 8000, 0, 1),
(8, 'Choco Crunchy Oreo', 8000, 0, 0),
(8, 'Greentea', 7000, 0, 0),
(8, 'Greentea Coklat', 9000, 0, 0),
(8, 'Greentea Keju', 9000, 0, 0),
(8, 'Greentea Oreo', 9000, 0, 0),
(8, 'Greentea Milo', 9000, 0, 0),
(8, 'Tiramisu', 7000, 0, 0),
(8, 'Tiramisu Coklat', 9000, 0, 0),
(8, 'Tiramisu Keju', 9000, 0, 0),
(8, 'Tiramisu Milo', 9000, 0, 0),
(8, 'Keju', 6000, 0, 0),
(8, 'Skippy', 7000, 0, 0),
(8, 'Skippy Coklat', 9000, 0, 0),
(8, 'Skippy Keju', 9000, 0, 0),
(8, 'Skippy Milo', 9000, 0, 0),
(8, 'Lotus', 9000, 0, 0),
(8, 'Lotus Coklat', 11000, 0, 0),
(8, 'Lotus Keju', 11000, 0, 0),
(8, 'Lotus Milo', 11000, 0, 0),
(8, 'Lotus Oreo', 11000, 0, 0),
(8, 'Nutella', 9000, 0, 0),
(8, 'Nutella Keju', 11000, 0, 0),
(8, 'Nutella Oreo', 11000, 0, 0),
(8, 'Ovomaltine', 10000, 0, 0),
(8, 'Ovomaltine Keju', 12000, 0, 0),
(8, 'Ovomaltine Oreo', 12000, 0, 0);

-- ID 9: Little Bar
INSERT INTO menu_umkm (id_umkm, nama_menu, harga, menu_utama, menu_terlaris) VALUES
(9, 'Tubruk', 13000, 1, 0),
(9, 'Es Kosu', 15000, 0, 0),
(9, 'Americano', 15000, 0, 0),
(9, 'Vietnam Drip', 17000, 0, 0),
(9, 'V60', 17000, 0, 0),
(9, 'Japanese', 17000, 0, 0),
(9, 'Gula Aren', 17000, 0, 0),
(9, 'Dalgona Coffee', 17000, 0, 0),
(9, 'Cafe Latte', 17000, 0, 0),
(9, 'Cappucino', 17000, 0, 0),
(9, 'Mocaccino', 17000, 0, 0),
(9, 'Butterscotch', 20000, 0, 1),
(9, 'Hazel Machiato', 20000, 0, 0),
(9, 'Caramel Machiato', 20000, 0, 0),
(9, 'Cream Cheese', 20000, 0, 0),
(9, 'Tiramisu', 20000, 0, 0),
(9, 'Vanilla', 20000, 0, 0),
(9, 'Mint Milk', 20000, 0, 0),
(9, 'Banana', 20000, 0, 0),
(9, 'Matcha', 15000, 0, 0),
(9, 'Red Velvet', 15000, 0, 0),
(9, 'Taro', 15000, 0, 0),
(9, 'Strawberry', 15000, 0, 0),
(9, 'Coklat', 15000, 0, 0);

-- ID 10: Es Pisang Ijo
INSERT INTO menu_umkm (id_umkm, nama_menu, harga, menu_utama, menu_terlaris) VALUES
(10, 'Pisjo Vanilla', 15000, 1, 0),
(10, 'Pisjo Strawberry', 15000, 1, 0),
(10, 'Pisjo Coklat', 15000, 1, 0),
(10, 'Pisjo Mix Eskrim', 15000, 1, 1);

-- ID 11: Cemilan Tutu
INSERT INTO menu_umkm (id_umkm, nama_menu, harga, menu_utama, menu_terlaris) VALUES
(11, 'Basreng', 12000, 1, 1),
(11, 'Tahu', 12000, 1, 0),
(11, 'Mix Tahu Basreng', 18000, 1, 0);

-- ID 12: Pisang Keju Susu (Ditambahkan dari Menu Utama)
INSERT INTO menu_umkm (id_umkm, nama_menu, harga, menu_utama, menu_terlaris) VALUES
(12, 'Pisang Keju', 15000, 1, 1);

-- ID 13: Minuman Rempah Dawa
INSERT INTO menu_umkm (id_umkm, nama_menu, harga, menu_utama, menu_terlaris) VALUES
(13, 'Rempah Original', 15000, 1, 0),
(13, 'Rempah Kencur', 15000, 1, 0),
(13, 'Rempah Temulawak', 15000, 1, 0),
(13, 'Rempah Jahe Lemon', 15000, 1, 1),
(13, 'Ranjang Kopi Hitam', 17000, 0, 0),
(13, 'Bir Pletok Original', 15000, 0, 0),
(13, 'Wedang Uwuh', 10000, 0, 0),
(13, 'STMJ', 18000, 0, 0),
(13, 'Rempah Susu Aren', 16000, 0, 0),
(13, 'Temulawak Susu', 16000, 0, 0),
(13, 'Lemon Susu Madu', 16000, 0, 0),
(13, 'Ranjang Kopi Susu', 18000, 0, 0),
(13, 'Bir Pletok Susu', 16000, 0, 0);

-- ID 14: Royal Dimsum Mentai
INSERT INTO menu_umkm (id_umkm, nama_menu, harga, menu_utama, menu_terlaris) VALUES
(14, 'Troops Size', 30000, 1, 1),
(14, 'King Size', 75000, 1, 0);

-- ID 15: Kedai Tetangga Saparua
INSERT INTO menu_umkm (id_umkm, nama_menu, harga, menu_utama, menu_terlaris) VALUES
(15, 'Pempek Kapal Selam Besar', 12000, 1, 0),
(15, 'Pempek Kapal Selam Kecil', 6000, 1, 0),
(15, 'Pempek Lenjer/Adaan', 6000, 0, 0),
(15, 'Pempek Kulit', 4000, 0, 0),
(15, 'Pempek Lenggang', 18000, 0, 0),
(15, 'Ceker Mercon Small', 20000, 1, 1),
(15, 'Ceker Mercon Medium', 25000, 1, 1),
(15, 'Pentol Mercon', 3000, 0, 0),
(15, 'Chicken Wings', 5000, 0, 0);

-- ID 16: Potato Fun Fries
INSERT INTO menu_umkm (id_umkm, nama_menu, harga, menu_utama, menu_terlaris) VALUES
(16, 'Kentang Saus Original', 10000, 1, 1),
(16, 'Kentang Saus Barbeque', 10000, 1, 1),
(16, 'Kentang Saus Bulgogi', 10000, 1, 1),
(16, 'Kentang Bumbu Tabur Balado', 10000, 1, 1),
(16, 'Kentang Bumbu Tabur Keju', 10000, 1, 1),
(16, 'Kentang Bumbu Tabur Jagung Bakar', 10000, 1, 1),
(16, 'Cicos', 10000, 0, 0),
(16, 'Cibay', 10000, 0, 0),
(16, 'Cilok Jadul Bumbu Kacang', 10000, 0, 0);

-- ID 17: Chicken Karaage
INSERT INTO menu_umkm (id_umkm, nama_menu, harga, menu_utama, menu_terlaris) VALUES
(17, 'Chicken Karaage', 15000, 1, 1),
(17, 'French Fries', 10000, 0, 0),
(17, 'Mushroom Enoki', 10000, 0, 0),
(17, 'Otonomiyaki', 18000, 0, 0),
(17, 'Mix Bento', 20000, 0, 0);

-- ID 18: Millary Coffee
INSERT INTO menu_umkm (id_umkm, nama_menu, harga, menu_utama, menu_terlaris) VALUES
(18, 'Espresso', 15000, 1, 0),
(18, 'Americano', 15000, 1, 0),
(18, 'Cappucino', 23000, 1, 0),
(18, 'Latte', 20000, 1, 0),
(18, 'Caramel Macchiato', 25000, 1, 0),
(18, 'Kopi Susu Aren', 23000, 1, 0),
(18, 'Mocha', 23000, 1, 0),
(18, 'Coklat Original', 18000, 1, 0),
(18, 'Mojito', 20000, 1, 0),
(18, 'Lychee Tea', 20000, 1, 0),
(18, 'Green Tea', 15000, 1, 0),
(18, 'Thai Tea', 15000, 1, 0),
(18, 'V60', 23000, 1, 0),
(18, 'Japanese', 25000, 1, 0),
(18, 'Aeropress', 25000, 1, 0),
(18, 'Tubruk', 18000, 1, 0),
(18, 'Millary Coffee Milk', 30000, 1, 0),
(18, 'Salted Coffee Milk', 30000, 1, 1),
(18, 'Frezzy Coffee Milk', 28000, 1, 0),
(18, 'Milky Candy', 23000, 1, 0),
(18, 'Milky Red Velvet', 23000, 1, 0),
(18, 'Milky Matcha', 23000, 1, 0),
(18, 'Milky Taro', 23000, 1, 0),
(18, 'Milky Hazelnut', 25000, 1, 0),
(18, 'Milky Caramel', 25000, 1, 0),
(18, 'Milky Vanilla', 23000, 1, 0),
(18, 'Cookies and Cream', 25000, 1, 0),
(18, 'Strawberry Milk', 23000, 1, 0),
(18, 'Chocolate Milk', 23000, 1, 0);

-- ID 19: Dmozz Jasuke
INSERT INTO menu_umkm (id_umkm, nama_menu, harga, menu_utama, menu_terlaris) VALUES
(19, 'Jasuke Original', 15000, 1, 1),
(19, 'Jasuke Coklat', 15000, 1, 0),
(19, 'Jasuke Cream Cheese', 15000, 1, 0),
(19, 'Jasuke Green Tea', 15000, 1, 0),
(19, 'Jasuke Mozzarella', 15000, 1, 1),
(19, 'Jasuke Mozzarella Coklat', 15000, 1, 0),
(19, 'Jasuke mozzarella cream cheese', 15000, 1, 0);

-- ID 20: Gerobak Sate Taichan
INSERT INTO menu_umkm (id_umkm, nama_menu, harga, menu_utama, menu_terlaris) VALUES
(20, 'Taichan Ayam', 22000, 1, 1),
(20, 'Taichan Kulit', 22000, 1, 1),
(20, 'Taichan Kulit Goreng', 22000, 1, 0),
(20, 'Taichan Usus', 22000, 1, 0),
(20, 'Taichan Kikil', 22000, 1, 0),
(20, 'Taichan Jando', 25000, 1, 0),
(20, 'Taichan Telor', 17000, 1, 0),
(20, 'Taichan Sayap', 20000, 1, 0),
(20, 'Lontong', 6000, 1, 0),
(20, 'Nasi', 6000, 1, 0),
(20, 'Green Tea', 10000, 0, 0),
(20, 'Lemon Tea', 7000, 0, 0),
(20, 'Teh Tarik', 10000, 0, 0),
(20, 'Chocolate', 10000, 0, 0),
(20, 'Orange Milk', 10000, 0, 0),
(20, 'Orange', 7000, 0, 0),
(20, 'Sweet Tea', 5000, 0, 0),
(20, 'Mineral Water', 5000, 0, 0);

-- ID 21: Sawadikap Milo
INSERT INTO menu_umkm (id_umkm, nama_menu, harga, menu_utama, menu_terlaris) VALUES
(21, 'Milo Original', 11000, 1, 0),
(21, 'Milo Coklat', 13000, 1, 0),
(21, 'Milo Coffee', 13000, 1, 0),
(21, 'Milo Dino', 13000, 1, 1),
(21, 'Milo Strawberry', 16000, 1, 0),
(21, 'Milo Oreo', 13000, 1, 0),
(21, 'Milo Ice Cream', 16000, 1, 0),
(21, 'Dancow Milo', 18000, 1, 0),
(21, 'Dancow Strawberry', 18000, 1, 0),
(21, 'Dancow Mango', 18000, 1, 0),
(21, 'Dancow Kiwi', 18000, 1, 0),
(21, 'Dancow Blueberry', 18000, 1, 0);

-- ID 22: Robaba Roti Bakar
INSERT INTO menu_umkm (id_umkm, nama_menu, harga, menu_utama, menu_terlaris) VALUES
(22, 'Strawberry', 15000, 1, 0),
(22, 'Blueberry', 15000, 1, 0),
(22, 'Coklat Meses', 15000, 1, 1),
(22, 'Keju Susu Full', 15000, 1, 0),
(22, 'Selai Kacang', 15000, 1, 0),
(22, 'Meses Keju', 15000, 1, 0),
(22, 'Coklat Pasta', 18000, 1, 0),
(22, 'Taro', 18000, 1, 0),
(22, 'Tiramisu', 18000, 1, 0),
(22, 'Hazelnut', 18000, 1, 0),
(22, 'Milk Cruncy', 20000, 1, 0),
(22, 'Coklat Cruncy', 20000, 1, 0),
(22, 'Green Tea Cruncy', 20000, 1, 0),
(22, 'Coklat Pasta Full', 23000, 1, 0),
(22, 'Coklat Cruncy Keju', 23000, 1, 0),
(22, 'Green Tea Keju', 23000, 1, 0),
(22, 'Kukus Strawberry', 12000, 1, 0),
(22, 'Kukus Blueberry', 12000, 1, 0),
(22, 'Kukus Coklat Meses', 12000, 1, 0),
(22, 'Kukus Keju Full', 12000, 1, 0),
(22, 'Kukus Meses Keju', 12000, 1, 0),
(22, 'Kukus Selai Kacang', 12000, 1, 0),
(22, 'Kukus Coklat Pasta', 15000, 1, 0),
(22, 'Kukus Taro', 15000, 1, 0),
(22, 'Kukus Tiramisu', 15000, 1, 0),
(22, 'Kukus Coklat Cruncy', 15000, 1, 0),
(22, 'Kukus Green Tea', 15000, 1, 0);

-- ID 23: Roti Bakar Es Krim
INSERT INTO menu_umkm (id_umkm, nama_menu, harga, menu_utama, menu_terlaris) VALUES
(23, 'Coklat', 10000, 1, 0),
(23, 'Keju', 10000, 1, 0),
(23, 'Susu', 10000, 1, 0),
(23, 'Coklat Keju', 12000, 1, 0),
(23, 'Coklat Susu', 12000, 1, 0),
(23, 'Keju Susu', 13000, 1, 0),
(23, 'Coklat Keju Susu', 13000, 1, 1),
(23, 'Tiramisu', 12000, 1, 0),
(23, 'Oreo Crunch', 13000, 1, 0),
(23, 'Nutella Spesial', 16000, 1, 0),
(23, 'Kukus Coklat', 10000, 0, 0),
(23, 'Kukus Vanilla Susu', 10000, 0, 0),
(23, 'Kukus Keju Creamy', 12000, 0, 0),
(23, 'Kukus Coklat Keju Creamy', 12000, 0, 0),
(23, 'Kukus Strawberry Susu', 12000, 0, 0),
(23, 'Kukus Matcha Latte', 13000, 0, 0),
(23, 'Kukus Tiramisu Cream', 13000, 0, 0),
(23, 'Kukus Milo Susu', 13000, 0, 0);

-- ------------------------------------------------------------------------------
-- FASE 5: MEMASUKKAN DATA MEDIA SOSIAL (INSTAGRAM)
-- ------------------------------------------------------------------------------
INSERT INTO sosmed_umkm (id_umkm, platform, username) VALUES
(1, 'instagram', '@narawi.bandung'),
(3, 'instagram', '@cimolbojotaa'),
(5, 'instagram', '@borneocoffee_id'),
(6, 'instagram', '@badmancoffee'),
(7, 'instagram', '@churrosicecream.bdg'),
(8, 'instagram', 'lakerkulo'),
(9, 'instagram', 'little.bar_'),
(10, 'instagram', 'pisangijoeskrim_bysiput'),
(11, 'instagram', 'cemilantutu'),
(13, 'instagram', 'minumanrempah_ayu'),
(14, 'instagram', 'royal.dimsumentai'),
(15, 'instagram', 'cekertetangga'),
(18, 'instagram', 'millarycoffee'),
(19, 'instagram', 'Dmozzjasuke'),
(20, 'instagram', 'gerobaksatetaican_'),
(21, 'instagram', 'sawadikaphaphaphap');