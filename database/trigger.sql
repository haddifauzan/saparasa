DELIMITER //

-- TRIGGER 1: Otomatis mencatat LOG ketika ada PENGUNJUNG memberikan REVIEW baru
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
    VALUES (1, CONCAT('Admin menghapus total data UMKM beserta seluruh relasinya pada id_umkm: ', OLD.id_umkm), NOW());
END //

DELIMITER ;