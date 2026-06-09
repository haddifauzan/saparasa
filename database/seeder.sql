-- ==========================================
-- SEEDER DATA AKUN UJI COBA (USERS) SAPARASA
-- ==========================================

-- Pastikan database yang digunakan adalah saparasa
USE saparasa;

-- Hapus data user lama agar tidak terjadi duplikasi email
DELETE FROM users WHERE email IN ('admin@saparasa.com', 'user@saparasa.com');

-- Masukkan data akun baru dengan password yang sudah di-hash (menggunakan password_hash() BCRYPT)
-- Semua password asli adalah: admin123 (untuk admin), user123 (untuk user)
INSERT INTO users (nama, email, password, role, foto_profile, created_at) VALUES
(
    'Admin Gege', 
    'admin@saparasa.com', 
    '$2y$12$RkE4nVoEpcIruLhIGsLjD.eZLQhql.UfINELYwtQ5L9wjsSDO2.KW', -- hash dari 'admin123'
    'admin', 
    'default_admin.png', 
    NOW()
),
(
    'User Setia', 
    'user@gmail.com', 
    '$2y$12$TRBlxorrKdpb64z9ZGwWyu2wk/PQkdUBa7ZONPz4uIQEowbT/zuSK', -- hash dari 'user123'
    'user', 
    'default_user.png', 
    NOW()
);
