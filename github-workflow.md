# GitHub Workflow

Project SAPARASA menggunakan GitHub untuk kolaborasi tim agar pengerjaan lebih rapih, terstruktur, dan tidak saling menimpa file.

Workflow ini dibuat supaya setiap anggota memiliki tugas dan branch masing-masing.

---

# Tujuan Penggunaan GitHub

GitHub digunakan untuk:
- Menyimpan source code project
- Kolaborasi antar anggota tim
- Backup project
- Mempermudah pembagian tugas
- Menghindari konflik file
- Tracking perubahan code

---

# Struktur Branch

| Branch | Fungsi |
|---|---|
| `main` | Versi final/stable project |
| `develop` | Branch penggabungan seluruh fitur |
| `feature/database` | Pengerjaan database |
| `feature/landing-page` | Landing page user |
| `feature/admin` | Dashboard admin |
| `feature/auth` | Sistem login & register |

---

# Penjelasan Tiap Branch

## `main`
Branch utama project.

### Fungsi:
- Menyimpan versi final project
- Branch paling stabil
- Digunakan saat project selesai

### Catatan:
❌ Tidak digunakan untuk coding harian  
❌ Jangan push langsung ke branch ini

---

## `develop`
Branch penggabungan seluruh fitur.

### Fungsi:
- Tempat merge seluruh fitur
- Tempat testing gabungan project

Semua fitur dari anggota akan digabung terlebih dahulu ke branch ini sebelum masuk ke `main`.

---

## `feature/database`
Digunakan untuk:
- SQL
- Trigger
- Stored Procedure
- Transaction
- Dummy Data

---

## `feature/landing-page`
Digunakan untuk:
- Landing page user
- Halaman daftar UMKM
- Detail UMKM
- Search/filter UMKM

---

## `feature/admin`
Digunakan untuk:
- Dashboard admin
- CRUD UMKM
- CRUD menu
- CRUD kategori
- Manajemen data

---

## `feature/auth`
Digunakan untuk:
- Login
- Register
- Session
- Logout
- Middleware auth

---

# Pembagian Tugas Tim

| Anggota | Branch |
|---|---|
| Haddi/Zidan | `feature/database` |
| Fajar | `feature/landing-page` |
| Haddi/Farrel | `feature/admin` |
| Zidan/Haddi | `feature/auth` |

---

# Cara Clone Repository

Dilakukan pertama kali sebelum mulai coding.

```bash
git clone https://github.com/username/saparasa.git
```

Setelah itu masuk ke folder project:

```bash
cd saparasa
```

---

# Cara Melihat Branch

```bash
git branch
```

Branch aktif akan memiliki tanda:
```text
*
```

Contoh:
```text
* main
```

---

# Cara Melihat Semua Branch

```bash
git branch -a
```

---

# Cara Pindah Branch

Karena branch sudah dibuat sebelumnya, anggota hanya perlu pindah ke branch masing-masing.

## Contoh:

### Branch Auth
```bash
git checkout feature/auth
```

---

### Branch Landing Page
```bash
git checkout feature/landing-page
```

---

### Branch Admin
```bash
git checkout feature/admin
```

---

### Branch Database
```bash
git checkout feature/database
```

---

# Penting Sebelum Mulai Coding

Selalu ambil update terbaru terlebih dahulu agar project sinkron.

## Jalankan:

```bash
git pull origin develop
```

Tujuan:
- Mengambil update terbaru dari tim
- Menghindari konflik file
- Menghindari overwrite code teman

Karena merge conflict itu kadang lebih bikin pusing daripada logic SQL nested subquery 😭

---

# Workflow Coding Harian

## 1. Pindah ke Branch Masing-Masing

Contoh:
```bash
git checkout feature/auth
```

---

## 2. Pull Update Terbaru

```bash
git pull origin develop
```

---

## 3. Mulai Coding

Contoh:
- membuat login
- membuat CRUD
- membuat halaman UMKM
- membuat query database

---

## 4. Cek File yang Berubah

```bash
git status
```

---

## 5. Tambahkan File ke Git

```bash
git add .
```

---

## 6. Commit Perubahan

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

```bash
git commit -m "add dashboard statistics"
```

---

## 7. Push ke Branch Masing-Masing

Contoh:
```bash
git push origin feature/auth
```

---

# Merge Branch ke Develop

Dilakukan setelah fitur selesai dan sudah dicek.

Biasanya dilakukan oleh:
- ketua tim
- atau anggota yang bertanggung jawab merge

---

# Cara Merge

## 1. Pindah ke Branch Develop

```bash
git checkout develop
```

---

## 2. Pull Develop Terbaru

```bash
git pull origin develop
```

---

## 3. Merge Branch

Contoh:
```bash
git merge feature/auth
```

---

## 4. Push Hasil Merge

```bash
git push origin develop
```

---

# Alur Branch Project

```text
main
  │
  └── develop
        ├── feature/database
        ├── feature/auth
        ├── feature/landing-page
        └── feature/admin
```

---

# Aturan Kolaborasi Tim

## WAJIB
✔ Pull sebelum coding  
✔ Gunakan branch masing-masing  
✔ Commit dengan pesan jelas  
✔ Komunikasi jika mengubah struktur database  
✔ Testing sebelum push

---

## DILARANG
❌ Push langsung ke `main`  
❌ Menghapus file anggota lain  
❌ Rename folder sembarangan  
❌ Mengubah struktur database tanpa diskusi  
❌ Push file yang belum dites

---

# Command Git yang Sering Digunakan

| Command | Fungsi |
|---|---|
| `git status` | Melihat perubahan file |
| `git add .` | Menambahkan seluruh file |
| `git commit -m ""` | Menyimpan perubahan |
| `git push` | Upload ke GitHub |
| `git pull` | Mengambil update terbaru |
| `git checkout` | Pindah branch |
| `git branch` | Melihat branch |

---

# Contoh Workflow Lengkap

## Contoh Feature Auth

### Pindah branch:
```bash
git checkout feature/auth
```

---

### Ambil update terbaru:
```bash
git pull origin develop
```

---

### Setelah coding:
```bash
git add .
```

---

### Commit:
```bash
git commit -m "add register validation"
```

---

### Push:
```bash
git push origin feature/auth
```

---

# Catatan Penting

Jika ada konflik saat merge:
- jangan panik
- cek file yang conflict
- diskusikan dengan anggota terkait
- jangan asal overwrite code
---

# Penutup

Workflow GitHub ini dibuat agar:
- pengerjaan lebih rapih
- fitur tidak saling bertabrakan
- mempermudah kolaborasi tim
- mempermudah tracking perubahan code
- mempermudah proses development project SAPARASA