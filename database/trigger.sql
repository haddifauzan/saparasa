DELIMITER //

-- TRIGGER 1: Otomatis mencatat LOG ketika ada PENGUNJUNG memberikan REVIEW baru
DROP TRIGGER IF EXISTS after_review_insert //
CREATE TRIGGER after_review_insert
AFTER INSERT ON review_pengunjung
FOR EACH ROW
BEGIN
    INSERT INTO log_aktivitas (id_user, aktivitas, waktu)
    VALUES (
        NEW.id_user, 
        CONCAT('User memberikan review bintang ', NEW.rating, ' pada id_umkm: ', NEW.id_umkm), 
        NOW()
    );
END //


-- TRIGGER 2: Otomatis mencatat LOG ketika ADMIN MENGHAPUS MENU makanan/minuman
DROP TRIGGER IF EXISTS after_menu_delete //
CREATE TRIGGER after_menu_delete
AFTER DELETE ON menu_umkm
FOR EACH ROW
BEGIN
    -- Menggunakan id_user = 1 (Diasumsikan sebagai ID Admin utama)
    INSERT INTO log_aktivitas (id_user, aktivitas, waktu)
    VALUES (
        1, 
        CONCAT('Admin menghapus menu: ', OLD.nama_menu, ' dari id_umkm: ', OLD.id_umkm), 
        NOW()
    );
END //


-- TRIGGER 3: Otomatis mencatat LOG ketika ada USER/PENGGUNA BARU yang mendaftar akun
DROP TRIGGER IF EXISTS after_user_register //
CREATE TRIGGER after_user_register
AFTER INSERT ON users
FOR EACH ROW
BEGIN
    INSERT INTO log_aktivitas (id_user, aktivitas, waktu)
    VALUES (
        NEW.id_user, 
        CONCAT('User baru terdaftar dengan nama: ', NEW.nama, ' sebagai (Role: ', NEW.role, ')'), 
        NOW()
    );
END //


-- TRIGGER 4: Trigger Validasi Rating (Mencegah Kecurangan/Error input dari web)
DROP TRIGGER IF EXISTS before_review_insert //
CREATE TRIGGER before_review_insert
BEFORE INSERT ON review_pengunjung
FOR EACH ROW
BEGIN
    -- Jika rating kurang dari 1 atau lebih dari 5, batalkan proses dan munculkan error sistem
    IF NEW.rating < 1 OR NEW.rating > 5 THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Error: Rating yang dimasukkan harus berada di antara angka 1 sampai 5!';
    END IF;
END //


-- TRIGGER 5: Trigger Otomatis Membersihkan Seluruh Data Relasi saat UMKM Dihapus
-- Mencegah error 'Foreign Key Constraint Fails' di MySQL karena data pivot menggantung
DROP TRIGGER IF EXISTS before_umkm_delete //
CREATE TRIGGER before_umkm_delete
BEFORE DELETE ON umkm
FOR EACH ROW
BEGIN
    -- 1. Hapus jadwal operasional
    DELETE FROM operasional_umkm WHERE id_umkm = OLD.id_umkm;
    -- 2. Hapus foto-foto di galeri
    DELETE FROM galeri_umkm WHERE id_umkm = OLD.id_umkm;
    -- 3. Hapus semua review pengunjung terkait
    DELETE FROM review_pengunjung WHERE id_umkm = OLD.id_umkm;
    -- 4. Hapus data sosial media milik UMKM tersebut
    DELETE FROM sosmed_umkm WHERE id_umkm = OLD.id_umkm;
    -- 5. Hapus data di tabel pivot metode pembayaran
    DELETE FROM umkm_pembayaran WHERE id_umkm = OLD.id_umkm;
    -- 6. Hapus data di tabel pivot platform online
    DELETE FROM umkm_platform_online WHERE id_umkm = OLD.id_umkm;
    -- 7. Catat aktivitas penghapusan total ini ke log_aktivitas
    INSERT INTO log_aktivitas (id_user, aktivitas, waktu)
    VALUES (COALESCE(@current_user_id, 1), CONCAT('Admin menghapus total data UMKM: ', OLD.nama_umkm, ' (ID: ', OLD.id_umkm, ')'), NOW());
END //


-- TRIGGER 6: Validasi Batas Rating Saat User Mengubah (UPDATE) Review
DROP TRIGGER IF EXISTS before_review_update //
CREATE TRIGGER before_review_update
BEFORE UPDATE ON review_pengunjung
FOR EACH ROW
BEGIN
    IF NEW.rating < 1 OR NEW.rating > 5 THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Error: Rating hasil update harus berada di antara angka 1 sampai 5!';
    END IF;
END //


-- =======================================================
-- AUDIT LOG TRIGGERS UNTUK DATA MASTER
-- =======================================================

-- A. TRIGGERS UNTUK KATEGORI UMKM
DROP TRIGGER IF EXISTS after_kategori_umkm_insert //
CREATE TRIGGER after_kategori_umkm_insert
AFTER INSERT ON kategori_umkm
FOR EACH ROW
BEGIN
    INSERT INTO log_aktivitas (id_user, aktivitas, waktu)
    VALUES (COALESCE(@current_user_id, 1), CONCAT('Admin menambahkan kategori UMKM baru: ', NEW.nama_kategori), NOW());
END //

DROP TRIGGER IF EXISTS after_kategori_umkm_update //
CREATE TRIGGER after_kategori_umkm_update
AFTER UPDATE ON kategori_umkm
FOR EACH ROW
BEGIN
    INSERT INTO log_aktivitas (id_user, aktivitas, waktu)
    VALUES (COALESCE(@current_user_id, 1), CONCAT('Admin mengubah kategori UMKM: ', OLD.nama_kategori, ' menjadi ', NEW.nama_kategori), NOW());
END //

DROP TRIGGER IF EXISTS after_kategori_umkm_delete //
CREATE TRIGGER after_kategori_umkm_delete
AFTER DELETE ON kategori_umkm
FOR EACH ROW
BEGIN
    INSERT INTO log_aktivitas (id_user, aktivitas, waktu)
    VALUES (COALESCE(@current_user_id, 1), CONCAT('Admin menghapus kategori UMKM: ', OLD.nama_kategori), NOW());
END //


-- B. TRIGGERS UNTUK KATEGORI RASA
DROP TRIGGER IF EXISTS after_kategori_rasa_insert //
CREATE TRIGGER after_kategori_rasa_insert
AFTER INSERT ON kategori_rasa
FOR EACH ROW
BEGIN
    INSERT INTO log_aktivitas (id_user, aktivitas, waktu)
    VALUES (COALESCE(@current_user_id, 1), CONCAT('Admin menambahkan kategori rasa baru: ', NEW.nama_rasa), NOW());
END //

DROP TRIGGER IF EXISTS after_kategori_rasa_update //
CREATE TRIGGER after_kategori_rasa_update
AFTER UPDATE ON kategori_rasa
FOR EACH ROW
BEGIN
    INSERT INTO log_aktivitas (id_user, aktivitas, waktu)
    VALUES (COALESCE(@current_user_id, 1), CONCAT('Admin mengubah kategori rasa: ', OLD.nama_rasa, ' menjadi ', NEW.nama_rasa), NOW());
END //

DROP TRIGGER IF EXISTS after_kategori_rasa_delete //
CREATE TRIGGER after_kategori_rasa_delete
AFTER DELETE ON kategori_rasa
FOR EACH ROW
BEGIN
    INSERT INTO log_aktivitas (id_user, aktivitas, waktu)
    VALUES (COALESCE(@current_user_id, 1), CONCAT('Admin menghapus kategori rasa: ', OLD.nama_rasa), NOW());
END //


-- C. TRIGGERS UNTUK BAHAN BAKU
DROP TRIGGER IF EXISTS after_bahan_baku_insert //
CREATE TRIGGER after_bahan_baku_insert
AFTER INSERT ON bahan_baku
FOR EACH ROW
BEGIN
    INSERT INTO log_aktivitas (id_user, aktivitas, waktu)
    VALUES (COALESCE(@current_user_id, 1), CONCAT('Admin menambahkan bahan baku baru: ', NEW.nama_bahan), NOW());
END //

DROP TRIGGER IF EXISTS after_bahan_baku_update //
CREATE TRIGGER after_bahan_baku_update
AFTER UPDATE ON bahan_baku
FOR EACH ROW
BEGIN
    INSERT INTO log_aktivitas (id_user, aktivitas, waktu)
    VALUES (COALESCE(@current_user_id, 1), CONCAT('Admin mengubah bahan baku: ', OLD.nama_bahan, ' menjadi ', NEW.nama_bahan), NOW());
END //

DROP TRIGGER IF EXISTS after_bahan_baku_delete //
CREATE TRIGGER after_bahan_baku_delete
AFTER DELETE ON bahan_baku
FOR EACH ROW
BEGIN
    INSERT INTO log_aktivitas (id_user, aktivitas, waktu)
    VALUES (COALESCE(@current_user_id, 1), CONCAT('Admin menghapus bahan baku: ', OLD.nama_bahan), NOW());
END //


-- D. TRIGGERS UNTUK METODE PEMBAYARAN
DROP TRIGGER IF EXISTS after_metode_pembayaran_insert //
CREATE TRIGGER after_metode_pembayaran_insert
AFTER INSERT ON metode_pembayaran
FOR EACH ROW
BEGIN
    INSERT INTO log_aktivitas (id_user, aktivitas, waktu)
    VALUES (COALESCE(@current_user_id, 1), CONCAT('Admin menambahkan metode pembayaran baru: ', NEW.nama_pembayaran), NOW());
END //

DROP TRIGGER IF EXISTS after_metode_pembayaran_update //
CREATE TRIGGER after_metode_pembayaran_update
AFTER UPDATE ON metode_pembayaran
FOR EACH ROW
BEGIN
    INSERT INTO log_aktivitas (id_user, aktivitas, waktu)
    VALUES (COALESCE(@current_user_id, 1), CONCAT('Admin mengubah metode pembayaran: ', OLD.nama_pembayaran, ' menjadi ', NEW.nama_pembayaran), NOW());
END //

DROP TRIGGER IF EXISTS after_metode_pembayaran_delete //
CREATE TRIGGER after_metode_pembayaran_delete
AFTER DELETE ON metode_pembayaran
FOR EACH ROW
BEGIN
    INSERT INTO log_aktivitas (id_user, aktivitas, waktu)
    VALUES (COALESCE(@current_user_id, 1), CONCAT('Admin menghapus metode pembayaran: ', OLD.nama_pembayaran), NOW());
END //


-- E. TRIGGERS UNTUK PLATFORM ONLINE
DROP TRIGGER IF EXISTS after_platform_online_insert //
CREATE TRIGGER after_platform_online_insert
AFTER INSERT ON platform_online
FOR EACH ROW
BEGIN
    INSERT INTO log_aktivitas (id_user, aktivitas, waktu)
    VALUES (COALESCE(@current_user_id, 1), CONCAT('Admin menambahkan platform online baru: ', NEW.nama_platform), NOW());
END //

DROP TRIGGER IF EXISTS after_platform_online_update //
CREATE TRIGGER after_platform_online_update
AFTER UPDATE ON platform_online
FOR EACH ROW
BEGIN
    INSERT INTO log_aktivitas (id_user, aktivitas, waktu)
    VALUES (COALESCE(@current_user_id, 1), CONCAT('Admin mengubah platform online: ', OLD.nama_platform, ' menjadi ', NEW.nama_platform), NOW());
END //

DROP TRIGGER IF EXISTS after_platform_online_delete //
CREATE TRIGGER after_platform_online_delete
AFTER DELETE ON platform_online
FOR EACH ROW
BEGIN
    INSERT INTO log_aktivitas (id_user, aktivitas, waktu)
    VALUES (COALESCE(@current_user_id, 1), CONCAT('Admin menghapus platform online: ', OLD.nama_platform), NOW());
END //


-- F. TRIGGERS UNTUK UMKM
DROP TRIGGER IF EXISTS after_umkm_insert //
CREATE TRIGGER after_umkm_insert
AFTER INSERT ON umkm
FOR EACH ROW
BEGIN
    INSERT INTO log_aktivitas (id_user, aktivitas, waktu)
    VALUES (COALESCE(@current_user_id, 1), CONCAT('Admin menambahkan UMKM baru: ', NEW.nama_umkm), NOW());
END //

DROP TRIGGER IF EXISTS after_umkm_update //
CREATE TRIGGER after_umkm_update
AFTER UPDATE ON umkm
FOR EACH ROW
BEGIN
    IF OLD.nama_umkm != NEW.nama_umkm THEN
        INSERT INTO log_aktivitas (id_user, aktivitas, waktu)
        VALUES (COALESCE(@current_user_id, 1), CONCAT('Admin mengubah nama UMKM dari ', OLD.nama_umkm, ' menjadi ', NEW.nama_umkm), NOW());
    ELSE
        INSERT INTO log_aktivitas (id_user, aktivitas, waktu)
        VALUES (COALESCE(@current_user_id, 1), CONCAT('Admin memperbarui data UMKM: ', NEW.nama_umkm), NOW());
    END IF;
END //

DELIMITER ;