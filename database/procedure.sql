-- FILE: database/procedure.sql

DELIMITER //

-- Prosedur 1: Mempermudah Admin Menambahkan UMKM Baru
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

-- Prosedur 2: Menampilkan Ringkasan Informasi UMKM & Rating untuk Landing Page
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

DELIMITER ;


DELIMITER //

-- Prosedur 3: Filter Daftar UMKM Berdasarkan Kategori Rasa atau Kategori UMKM
CREATE PROCEDURE GetUMKMByKategori(
    IN p_id_kategori BIGINT
)
BEGIN
    SELECT u.id_umkm, u.nama_umkm, u.pemilik, u.asal_daerah, u.status_halal
    FROM umkm u
    WHERE u.id_kategori = p_id_kategori;
END //

DELIMITER ;