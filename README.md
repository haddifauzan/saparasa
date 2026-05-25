# SAPARASA - Sistem Informasi UMKM Saparua Bandung

SAPARASA merupakan website sistem informasi UMKM berbasis PHP Native dan MySQL yang digunakan untuk menampilkan informasi UMKM di kawasan Saparua Bandung. Website ini memiliki fitur landing page untuk pengunjung dan dashboard admin untuk mengelola data UMKM.

Project ini dibuat sebagai tugas kuliah dengan fokus pada:
- Normalisasi database
- Implementasi ERD
- CRUD menggunakan PHP Native
- Penggunaan SQL lanjutan:
  - Stored Procedure
  - Trigger
  - Transaction
  - Commit & Rollback

---

# Tech Stack

| Teknologi | Digunakan Untuk |
|---|---|
| PHP Native | Backend |
| MySQL | Database |
| Bootstrap 5 | Frontend UI |
| HTML/CSS/JS | Tampilan |
| Git & GitHub | Version Control |
| XAMPP | Local Server |

---

# Struktur Project

```text
saparasa/
│
├── actions/
│   ├── auth/
│   ├── menu/
│   ├── review/
│   └── umkm/
│
├── admin/
│   ├── auth/
│   └── dashboard.php
│
├── assets/
│   ├── css/
│   ├── img/
│   ├── js/
│   └── uploads/
│
├── auth/
│   ├── login.php
│   ├── logout.php
│   ├── register.php
│   └── session.php
│
├── config/
│   ├── app.php
│   └── conn.php
│
├── database/
│   ├── dummy_data.sql
│   ├── procedure.sql
│   ├── schema.sql
│   ├── transaction.sql
│   └── trigger.sql
│
├── pages/
│
├── .gitignore
├── index.php
└── README.md
```

---

# Penjelasan Struktur Folder

## `/actions`

Berisi file backend logic atau proses database.

### Fungsi:
- CRUD data
- Login & register
- Upload file
- Insert review
- Query database

### Contoh:
```text
actions/auth/login_action.php
actions/umkm/tambah_umkm.php
actions/review/tambah_review.php
```

Folder ini dipisahkan agar logic backend tidak bercampur dengan tampilan HTML.

---

## `/admin`

Berisi halaman dashboard admin.

### Fitur:
- Dashboard
- CRUD UMKM
- CRUD Menu
- CRUD Galeri
- CRUD Kategori

Halaman ini hanya dapat diakses oleh admin.

---

## `/admin/auth`

Berisi middleware atau proteksi halaman admin.

### Fungsi:
Mengecek apakah user:
- sudah login
- memiliki role admin

Jika tidak memenuhi syarat, user akan diarahkan kembali ke halaman login atau homepage.

---

## `/assets`

Berisi seluruh file static website.

| Folder | Fungsi |
|---|---|
| css | File CSS |
| js | JavaScript |
| img | Gambar website |
| uploads | Upload gambar UMKM |

---

## `/auth`

Berisi sistem autentikasi user.

| File | Fungsi |
|---|---|
| login.php | Halaman login |
| register.php | Halaman register |
| logout.php | Logout session |
| session.php | Helper session login |

---

## `/config`

Berisi konfigurasi project.

| File | Fungsi |
|---|---|
| app.php | Konfigurasi aplikasi |
| conn.php | Koneksi database |

---

## `/database`

Berisi seluruh file SQL project.

| File | Fungsi |
|---|---|
| schema.sql | Struktur database |
| dummy_data.sql | Data dummy/sample |
| procedure.sql | Stored Procedure |
| trigger.sql | Trigger database |
| transaction.sql | Transaction SQL |

---

## `/pages`

Berisi halaman umum website.

### Contoh:
- daftar UMKM
- detail UMKM
- halaman tentang

---

# Setup Project

## 1. Clone Repository

```bash
git clone https://github.com/haddifauzan/saparasa.git
```

---

## 2. Masuk ke Folder Project

```bash
cd saparasa
```

---

## 3. Pindahkan ke Folder `htdocs`

Contoh:
```text
C:/xampp/htdocs/saparasa
```

---

## 4. Jalankan Apache dan MySQL

Gunakan XAMPP lalu start:
- Apache
- MySQL

---

## 5. Import Database

Buka:
```text
http://localhost/phpmyadmin
```

### Langkah:
1. Buat database:
```text
db_saparasa
```

3. Import:
```text
database/db_saparasa.sql
```

---

## 6. Jalankan Project

Buka browser:
```text
http://localhost/saparasa
```

---

# GitHub Workflow

Project ini menggunakan GitHub untuk kolaborasi tim.

---

# Branch Structure

| Branch | Fungsi |
|---|---|
| `main` | Versi final/stable |
| `develop` | Penggabungan seluruh fitur |
| `feature/database` | Pengerjaan database |
| `feature/landing-page` | Landing page |
| `feature/dashboard-admin` | Dashboard admin |
| `feature/auth` | Sistem login/register |

---

# Workflow Git

## Pull Update Terbaru

```bash
git pull origin develop
```

---

## Membuat Branch Baru

```bash
git checkout -b feature/nama-fitur
```

Contoh:
```bash
git checkout -b feature/auth
```

---

## Push Branch

```bash
git push origin feature/auth
```

---

## Merge ke Develop

Dilakukan setelah fitur selesai dan dicek.

---

# Aturan Commit

Gunakan commit message yang jelas.

### Contoh:
```bash
git commit -m "add login feature"
```

```bash
git commit -m "create CRUD menu"
```

```bash
git commit -m "fix review validation"
```

---

# Aturan Kolaborasi

## Wajib
- Pull sebelum coding
- Gunakan branch masing-masing
- Commit dengan pesan yang jelas
- Diskusi sebelum mengubah struktur database

---

## Dilarang
- Push langsung ke `main`
- Mengubah database tanpa koordinasi
- Upload folder XAMPP
- Rename folder project tanpa diskusi

Karena merge conflict itu kadang lebih bikin stres dibanding revisi dosen 😭

---

# Fitur Utama Sistem

## Landing Page
- Daftar UMKM
- Detail UMKM
- Menu UMKM
- Galeri UMKM
- Review UMKM

---

## Dashboard Admin
- Login admin
- CRUD UMKM
- CRUD menu
- CRUD galeri
- CRUD kategori

---

## Authentication
- Register user
- Login user/admin
- Session login
- Logout

---

# Advanced SQL Features

Project ini menggunakan fitur SQL lanjutan:

## Stored Procedure
Digunakan untuk:
- Menampilkan detail UMKM
- Menampilkan data menu

---

## Trigger
Digunakan untuk:
- Log aktivitas otomatis

---

## Transaction
Digunakan untuk:
- Insert data UMKM dan menu secara aman

---

# Catatan Penting

- User hanya dapat memberikan review jika login
- Guest tetap bisa melihat seluruh data UMKM
- Admin dibuat manual melalui database
- Password wajib menggunakan:
```php
password_hash()
```

---

# Future Improvement

Fitur yang dapat dikembangkan:
- Search UMKM
- Filter kategori
- Maps lokasi UMKM
- Favorite UMKM
- Pagination
- API integration

---

# Nama Website

# SAPARASA
### Eksplorasi UMKM Kuliner Saparua Bandung
