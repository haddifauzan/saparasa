-- FILE: database/trigger.sql

DELIMITER //

-- TRIGGER 1: Otomatis mencatat LOG ketika ada PENGUNJUNG memberikan REVIEW baru
-- Sesuai relasi: users -> review_pengunjung -> log_aktivitas
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
-- Sesuai dengan fungsi audit log aktivitas sistem
CREATE TRIGGER after_menu_delete
AFTER DELETE ON menu_umkm
FOR EACH ROW
BEGIN
    -- Menggunakan id_user = 1 (Diasumsikan sebagai ID milik Super Admin pada tabel users)
    INSERT INTO log_aktivitas (id_user, aktivitas, waktu)
    VALUES (
        1, 
        CONCAT('Admin menghapus menu: ', OLD.nama_menu, ' dari id_umkm: ', OLD.id_umkm), 
        NOW()
    );
END //


-- TRIGGER 3: Otomatis mencatat LOG ketika ada USER/PENGGUNA BARU yang mendaftar akun
-- Berguna untuk melacak pendaftaran baru di web Saparasa
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

DELIMITER ;

-- TRIGGER 4: Trigger Validasi Rating (Mencegah Kecurangan/Error)
-- rating bintang hanya boleh diisi angka 1 sampai 5.

DELIMITER //

CREATE TRIGGER before_review_insert
BEFORE INSERT ON review_pengunjung
FOR EACH ROW
BEGIN
    -- Jika rating kurang dari 1 atau lebih dari 5, batalkan proses dan munculkan error
    IF NEW.rating < 1 OR NEW.rating > 5 THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Error: Rating yang dimasukkan harus berada di antara angka 1 sampai 5!';
    END IF;
END //

DELIMITER ;