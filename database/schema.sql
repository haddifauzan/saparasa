-- DATABASE
CREATE DATABASE saparasa;
USE saparasa;

-- TABLE USERS
CREATE TABLE users (
    id_user BIGINT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user', 'penjual') NOT NULL,
    foto_profile VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- TABLE KATEGORI UMKM
CREATE TABLE kategori_umkm (
    id_kategori BIGINT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(255) NOT NULL
);

-- TABLE UMKM
CREATE TABLE umkm (
    id_umkm BIGINT AUTO_INCREMENT PRIMARY KEY,
    id_kategori BIGINT NOT NULL,
    nama_umkm VARCHAR(255) NOT NULL,
    pemilik VARCHAR(255) NOT NULL,
    deskripsi TEXT NOT NULL,
    tahun_berdiri YEAR,
    latitude DECIMAL(10,8),
    longitude DECIMAL(11,8),
    operasional_tetap BOOLEAN NOT NULL,
    catatan_operasional TEXT,
    asal_daerah VARCHAR(255),
    status_halal ENUM('tidak', 'belum', 'proses', 'sudah') NOT NULL,
    izin_usaha ENUM('belum', 'proses', 'sudah') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_umkm_kategori FOREIGN KEY (id_kategori)
    REFERENCES kategori_umkm(id_kategori) ON DELETE CASCADE ON UPDATE CASCADE
);

-- TABLE OPERASIONAL UMKM
CREATE TABLE operasional_umkm (
    id_operasional BIGINT AUTO_INCREMENT PRIMARY KEY,
    id_umkm BIGINT NOT NULL,
    hari ENUM(
        'senin',
        'selasa',
        'rabu',
        'kamis',
        'jumat',
        'sabtu',
        'minggu'
    ) NOT NULL,
    jam_buka TIME,
    jam_tutup TIME,
    CONSTRAINT fk_operasional_umkm FOREIGN KEY (id_umkm)
    REFERENCES umkm(id_umkm) ON DELETE CASCADE ON UPDATE CASCADE
);

-- TABLE MENU UMKM
CREATE TABLE menu_umkm (
    id_menu BIGINT AUTO_INCREMENT PRIMARY KEY,
    id_umkm BIGINT NOT NULL,
    nama_menu VARCHAR(255) NOT NULL,
    harga DECIMAL(10,2) NOT NULL,
    menu_utama BOOLEAN NOT NULL,
    menu_terlaris BOOLEAN NOT NULL,
    CONSTRAINT fk_menu_umkm FOREIGN KEY (id_umkm)
    REFERENCES umkm(id_umkm) ON DELETE CASCADE ON UPDATE CASCADE
);

-- TABLE KATEGORI RASA
CREATE TABLE kategori_rasa (
    id_rasa BIGINT AUTO_INCREMENT PRIMARY KEY,
    nama_rasa VARCHAR(255) NOT NULL
);

-- TABLE BAHAN BAKU
CREATE TABLE bahan_baku (
    id_bahan BIGINT AUTO_INCREMENT PRIMARY KEY,
    nama_bahan VARCHAR(255) NOT NULL
);

-- TABLE MENU RASA
CREATE TABLE menu_rasa (
    id_menu BIGINT NOT NULL,
    id_rasa BIGINT NOT NULL,
    PRIMARY KEY (id_menu, id_rasa),
    CONSTRAINT fk_menu_rasa_menu FOREIGN KEY (id_menu)
    REFERENCES menu_umkm(id_menu) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_menu_rasa_rasa FOREIGN KEY (id_rasa)
    REFERENCES kategori_rasa(id_rasa) ON DELETE CASCADE ON UPDATE CASCADE
);

-- TABLE MENU BAHAN BAKU
CREATE TABLE menu_bahan_baku (
    id_menu BIGINT NOT NULL,
    id_bahan BIGINT NOT NULL,
    PRIMARY KEY (id_menu, id_bahan),
    CONSTRAINT fk_menu_bahan_menu FOREIGN KEY (id_menu)
    REFERENCES menu_umkm(id_menu) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_menu_bahan_bahan FOREIGN KEY (id_bahan)
    REFERENCES bahan_baku(id_bahan) ON DELETE CASCADE ON UPDATE CASCADE
);

-- TABLE GALERI UMKM
CREATE TABLE galeri_umkm (
    id_galeri BIGINT AUTO_INCREMENT PRIMARY KEY,
    id_umkm BIGINT NOT NULL,
    foto VARCHAR(255) NOT NULL,
    jenis_foto ENUM('stand', 'menu') NOT NULL,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_galeri_umkm FOREIGN KEY (id_umkm)
    REFERENCES umkm(id_umkm) ON DELETE CASCADE ON UPDATE CASCADE
);

-- TABLE SOSMED UMKM
CREATE TABLE sosmed_umkm (
    id_sosmed BIGINT AUTO_INCREMENT PRIMARY KEY,
    id_umkm BIGINT NOT NULL,
    platform ENUM('instagram', 'tiktok', 'facebook', 'x') NOT NULL,
    username VARCHAR(255) NOT NULL,
    CONSTRAINT fk_sosmed_umkm FOREIGN KEY (id_umkm)
    REFERENCES umkm(id_umkm) ON DELETE CASCADE ON UPDATE CASCADE
);

-- TABLE REVIEW PENGUNJUNG
CREATE TABLE review_pengunjung (
    id_review BIGINT AUTO_INCREMENT PRIMARY KEY,
    id_user BIGINT NOT NULL,
    id_umkm BIGINT NOT NULL,
    rating INT NOT NULL,
    komentar TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_review_user FOREIGN KEY (id_user) REFERENCES users(id_user)
    ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_review_umkm FOREIGN KEY (id_umkm) REFERENCES umkm(id_umkm)
    ON DELETE CASCADE ON UPDATE CASCADE
);

-- TABLE METODE PEMBAYARAN
CREATE TABLE metode_pembayaran (
    id_pembayaran BIGINT AUTO_INCREMENT PRIMARY KEY,
    nama_pembayaran VARCHAR(255) NOT NULL
);

-- TABLE PLATFORM ONLINE
CREATE TABLE platform_online (
    id_platform BIGINT AUTO_INCREMENT PRIMARY KEY,
    nama_platform VARCHAR(255) NOT NULL
);

-- TABLE UMKM PEMBAYARAN
CREATE TABLE umkm_pembayaran (
    id_umkm BIGINT NOT NULL,
    id_pembayaran BIGINT NOT NULL,
    PRIMARY KEY (id_umkm, id_pembayaran),
    CONSTRAINT fk_umkm_pembayaran_umkm FOREIGN KEY (id_umkm) REFERENCES umkm(id_umkm)
    ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_umkm_pembayaran_pembayaran FOREIGN KEY (id_pembayaran) REFERENCES metode_pembayaran(id_pembayaran)
    ON DELETE CASCADE ON UPDATE CASCADE
);

-- TABLE UMKM PLATFORM ONLINE
CREATE TABLE umkm_platform_online (
    id_umkm BIGINT NOT NULL,
    id_platform BIGINT NOT NULL,
    link_platform VARCHAR(255),
    PRIMARY KEY (id_umkm, id_platform),
    CONSTRAINT fk_umkm_platform_umkm FOREIGN KEY (id_umkm) REFERENCES umkm(id_umkm)
    ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_umkm_platform_platform FOREIGN KEY (id_platform) REFERENCES platform_online(id_platform)
    ON DELETE CASCADE ON UPDATE CASCADE
);

-- TABLE LOG AKTIVITAS
CREATE TABLE log_aktivitas (
    id_log BIGINT AUTO_INCREMENT PRIMARY KEY,
    id_user BIGINT NOT NULL,
    aktivitas TEXT NOT NULL,
    waktu TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_log_user FOREIGN KEY (id_user) REFERENCES users(id_user)
    ON DELETE CASCADE ON UPDATE CASCADE
);