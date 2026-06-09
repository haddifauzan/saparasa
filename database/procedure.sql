-- FILE: database/procedure.sql

DELIMITER //

-- PROSEDUR 1: Mempermudah Admin Menambahkan UMKM Baru
DROP PROCEDURE IF EXISTS AddNewUMKM //
CREATE PROCEDURE AddNewUMKM(
    IN p_id_kategori BIGINT,
    IN p_nama_umkm VARCHAR(255),
    IN p_pemilik VARCHAR(255),
    IN p_deskripsi TEXT,
    IN p_tahun_berdiri YEAR,
    IN p_latitude DECIMAL(10,8),
    IN p_longitude DECIMAL(11,8),
    IN p_operasional_tetap BOOLEAN,
    IN p_catatan_operasional TEXT,
    IN p_asal_daerah TEXT,
    IN p_status_halal VARCHAR(50),
    IN p_izin_usaha VARCHAR(50)
)
BEGIN
    INSERT INTO umkm (
        id_kategori, nama_umkm, pemilik, deskripsi, tahun_berdiri, 
        latitude, longitude, operasional_tetap, catatan_operasional, 
        asal_daerah, status_halal, izin_usaha, created_at
    )
    VALUES (
        p_id_kategori, p_nama_umkm, p_pemilik, p_deskripsi, p_tahun_berdiri, 
        p_latitude, p_longitude, p_operasional_tetap, p_catatan_operasional, 
        p_asal_daerah, p_status_halal, p_izin_usaha, NOW()
    );
END //

-- PROSEDUR 2: Menampilkan Ringkasan Informasi UMKM & Rating untuk Landing Page
DROP PROCEDURE IF EXISTS GetUMKMSummary //
CREATE PROCEDURE GetUMKMSummary(
    IN p_id_umkm BIGINT
)
BEGIN
    SELECT 
        u.id_umkm,
        u.nama_umkm,
        k.nama_kategori,
        u.asal_daerah,
        IFNULL(AVG(r.rating), 0) AS rata_rata_rating,
        COUNT(r.id_review) AS total_ulasan
    FROM umkm u
    LEFT JOIN kategori_umkm k ON u.id_kategori = k.id_kategori
    LEFT JOIN review_pengunjung r ON u.id_umkm = r.id_umkm
    WHERE u.id_umkm = p_id_umkm
    GROUP BY u.id_umkm;
END //

-- PROSEDUR 3: Filter Daftar UMKM Berdasarkan Kategori (Makanan/Minuman)
DROP PROCEDURE IF EXISTS GetUMKMByKategori //
CREATE PROCEDURE GetUMKMByKategori(
    IN p_id_kategori BIGINT
)
BEGIN
    SELECT u.id_umkm, u.nama_umkm, u.pemilik, u.asal_daerah, u.status_halal
    FROM umkm u
    WHERE u.id_kategori = p_id_kategori;
END //


-- PROSEDUR 4: Menampilkan Daftar Menu Berdasarkan ID UMKM
DROP PROCEDURE IF EXISTS GetMenuUMKM //
CREATE PROCEDURE GetMenuUMKM(
    IN p_id_umkm BIGINT
)
BEGIN
    SELECT id_menu, nama_menu, harga, menu_utama, menu_terlaris
    FROM menu_umkm
    WHERE id_umkm = p_id_umkm
    ORDER BY menu_terlaris DESC, nama_menu ASC;
END //


-- PROSEDUR 5: Menampilkan Daftar Komentar & Rating Pengunjung
DROP PROCEDURE IF EXISTS GetReviewUMKM //
CREATE PROCEDURE GetReviewUMKM(
    IN p_id_umkm BIGINT
)
BEGIN
    SELECT 
        u.nama AS nama_pengunjung, 
        u.foto_profile,
        r.rating, 
        r.komentar, 
        r.created_at
    FROM review_pengunjung r
    JOIN users u ON r.id_user = u.id_user
    WHERE r.id_umkm = p_id_umkm
    ORDER BY r.created_at DESC;
END //


-- PROSEDUR 6: Fitur Kotak Pencarian UMKM
DROP PROCEDURE IF EXISTS SearchUMKM //
CREATE PROCEDURE SearchUMKM(
    IN p_keyword VARCHAR(255)
)
BEGIN
    SELECT 
        u.id_umkm, 
        u.nama_umkm, 
        u.asal_daerah,
        IFNULL(m.nama_menu, '-') AS nama_menu, -- Menampilkan nama menu yang cocok/terkait
        IFNULL(m.harga, 0) AS harga            -- Menampilkan harga sekalian agar informatif
    FROM umkm u
    LEFT JOIN menu_umkm m ON u.id_umkm = m.id_umkm
    WHERE u.nama_umkm LIKE CONCAT('%', p_keyword, '%')
       OR u.deskripsi LIKE CONCAT('%', p_keyword, '%')
       OR m.nama_menu LIKE CONCAT('%', p_keyword, '%')
    ORDER BY u.id_umkm ASC, m.harga DESC;
END //


-- ==========================================
-- PROSEDUR CRUD UNTUK DATA MASTER
-- ==========================================

-- A. PROSEDUR KATEGORI UMKM
DROP PROCEDURE IF EXISTS sp_AddKategoriUMKM //
CREATE PROCEDURE sp_AddKategoriUMKM(IN p_nama VARCHAR(255))
BEGIN
    INSERT INTO kategori_umkm (nama_kategori) VALUES (p_nama);
END //

DROP PROCEDURE IF EXISTS sp_EditKategoriUMKM //
CREATE PROCEDURE sp_EditKategoriUMKM(IN p_id BIGINT, IN p_nama VARCHAR(255))
BEGIN
    UPDATE kategori_umkm SET nama_kategori = p_nama WHERE id_kategori = p_id;
END //

DROP PROCEDURE IF EXISTS sp_DeleteKategoriUMKM //
CREATE PROCEDURE sp_DeleteKategoriUMKM(IN p_id BIGINT)
BEGIN
    DELETE FROM kategori_umkm WHERE id_kategori = p_id;
END //


-- B. PROSEDUR KATEGORI RASA
DROP PROCEDURE IF EXISTS sp_AddKategoriRasa //
CREATE PROCEDURE sp_AddKategoriRasa(IN p_nama VARCHAR(255))
BEGIN
    INSERT INTO kategori_rasa (nama_rasa) VALUES (p_nama);
END //

DROP PROCEDURE IF EXISTS sp_EditKategoriRasa //
CREATE PROCEDURE sp_EditKategoriRasa(IN p_id BIGINT, IN p_nama VARCHAR(255))
BEGIN
    UPDATE kategori_rasa SET nama_rasa = p_nama WHERE id_rasa = p_id;
END //

DROP PROCEDURE IF EXISTS sp_DeleteKategoriRasa //
CREATE PROCEDURE sp_DeleteKategoriRasa(IN p_id BIGINT)
BEGIN
    DELETE FROM kategori_rasa WHERE id_rasa = p_id;
END //


-- C. PROSEDUR BAHAN BAKU
DROP PROCEDURE IF EXISTS sp_AddBahanBaku //
CREATE PROCEDURE sp_AddBahanBaku(IN p_nama VARCHAR(255))
BEGIN
    INSERT INTO bahan_baku (nama_bahan) VALUES (p_nama);
END //

DROP PROCEDURE IF EXISTS sp_EditBahanBaku //
CREATE PROCEDURE sp_EditBahanBaku(IN p_id BIGINT, IN p_nama VARCHAR(255))
BEGIN
    UPDATE bahan_baku SET nama_bahan = p_nama WHERE id_bahan = p_id;
END //

DROP PROCEDURE IF EXISTS sp_DeleteBahanBaku //
CREATE PROCEDURE sp_DeleteBahanBaku(IN p_id BIGINT)
BEGIN
    DELETE FROM bahan_baku WHERE id_bahan = p_id;
END //


-- D. PROSEDUR METODE PEMBAYARAN
DROP PROCEDURE IF EXISTS sp_AddMetodePembayaran //
CREATE PROCEDURE sp_AddMetodePembayaran(IN p_nama VARCHAR(255))
BEGIN
    INSERT INTO metode_pembayaran (nama_pembayaran) VALUES (p_nama);
END //

DROP PROCEDURE IF EXISTS sp_EditMetodePembayaran //
CREATE PROCEDURE sp_EditMetodePembayaran(IN p_id BIGINT, IN p_nama VARCHAR(255))
BEGIN
    UPDATE metode_pembayaran SET nama_pembayaran = p_nama WHERE id_pembayaran = p_id;
END //

DROP PROCEDURE IF EXISTS sp_DeleteMetodePembayaran //
CREATE PROCEDURE sp_DeleteMetodePembayaran(IN p_id BIGINT)
BEGIN
    DELETE FROM metode_pembayaran WHERE id_pembayaran = p_id;
END //


-- E. PROSEDUR PLATFORM ONLINE
DROP PROCEDURE IF EXISTS sp_AddPlatformOnline //
CREATE PROCEDURE sp_AddPlatformOnline(IN p_nama VARCHAR(255))
BEGIN
    INSERT INTO platform_online (nama_platform) VALUES (p_nama);
END //

DROP PROCEDURE IF EXISTS sp_EditPlatformOnline //
CREATE PROCEDURE sp_EditPlatformOnline(IN p_id BIGINT, IN p_nama VARCHAR(255))
BEGIN
    UPDATE platform_online SET nama_platform = p_nama WHERE id_platform = p_id;
END //

DROP PROCEDURE IF EXISTS sp_DeletePlatformOnline //
CREATE PROCEDURE sp_DeletePlatformOnline(IN p_id BIGINT)
BEGIN
    DELETE FROM platform_online WHERE id_platform = p_id;
END //

DELIMITER ;