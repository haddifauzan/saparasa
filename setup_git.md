# Setup Repository & Branch GitHub SAPARASA

Dokumentasi ini digunakan untuk setup repository GitHub dan workflow branch pada project SAPARASA agar kolaborasi tim menjadi lebih rapih dan terstruktur.

---

# Tujuan Penggunaan GitHub

GitHub digunakan untuk:
- Kolaborasi tim
- Backup source code
- Menghindari file project hilang
- Mengelola perubahan code
- Mempermudah pembagian tugas antar anggota

---

# Struktur Branch

Project SAPARASA menggunakan beberapa branch agar pengerjaan tiap anggota tidak saling bertabrakan.

| Branch | Fungsi |
|---|---|
| main | Branch final/stable |
| develop | Branch gabungan seluruh fitur |
| feature/database | Pengerjaan database |
| feature/landing-page | Landing page user |
| feature/dashboard-admin | Dashboard admin |
| feature/auth | Login & register |

---

# Penjelasan Branch

## `main`
Branch utama project.

### Fungsi:
- Menyimpan versi final/stable
- Tidak digunakan untuk coding harian
- Hanya menerima hasil final

### Aturan:
❌ Jangan push langsung ke `main`

---

## `develop`
Branch penggabungan seluruh fitur.

### Fungsi:
- Tempat merge seluruh feature branch
- Tempat testing gabungan project

### Aturan:
✔ Seluruh fitur akan digabung ke sini terlebih dahulu

---

## `feature/*`
Branch khusus untuk pengerjaan fitur tertentu.

### Contoh:
```text
feature/auth
feature/database
feature/landing-page
```

### Fungsi:
Agar tiap anggota bisa coding tanpa mengganggu fitur lain.

---

# Tahapan Setup Repository

---

# 1. Membuat Repository GitHub

## Langkah:
1. Buka GitHub
2. Klik:
```text
New Repository
```

3. Isi:
| Field | Isi |
|---|---|
| Repository Name | saparasa |
| Visibility | Public / Private |
| Add README | Tidak perlu |

4. Klik:
```text
Create Repository
```

---

# 2. Inisialisasi Git di Project

Buka terminal VSCode pada folder project.

## Jalankan:
```bash
git init
```

Fungsi:
- Mengaktifkan Git pada project

---

# 3. Menambahkan Remote Repository

Copy URL repository GitHub.

Contoh:
```text
https://github.com/username/saparasa.git
```

Lalu jalankan:

```bash
git remote add origin https://github.com/username/saparasa.git
```

---

# 4. Menambahkan Seluruh File

```bash
git add .
```

---

# 5. Commit Awal

```bash
git commit -m "initial project setup"
```

---

# 6. Rename Branch Menjadi Main

```bash
git branch -M main
```

---

# 7. Push ke GitHub

```bash
git push -u origin main
```

---

# 8. Membuat Branch Develop

```bash
git checkout -b develop
```

Lalu push:

```bash
git push -u origin develop
```

---

# 9. Membuat Feature Branch

## Branch Database
```bash
git checkout -b feature/database
```

Push:
```bash
git push -u origin feature/database
```

---

## Branch Landing Page
```bash
git checkout -b feature/landing-page
```

Push:
```bash
git push -u origin feature/landing-page
```

---

## Branch Dashboard Admin
```bash
git checkout -b feature/dashboard-admin
```

Push:
```bash
git push -u origin feature/dashboard-admin
```

---

## Branch Authentication
```bash
git checkout -b feature/auth
```

Push:
```bash
git push -u origin feature/auth
```

---

# Workflow Pengerjaan Tim

---

# 1. Pindah ke Branch Sendiri

Contoh:
```bash
git checkout feature/auth
```

---

# 2. Coding Fitur

Contoh:
- login
- register
- session
- middleware

---

# 3. Cek Perubahan

```bash
git status
```

---

# 4. Tambahkan File

```bash
git add .
```

---

# 5. Commit

```bash
git commit -m "add login feature"
```

Gunakan commit message yang jelas.

---

# 6. Push ke Branch

```bash
git push origin feature/auth
```

---

# 7. Merge ke Develop

Dilakukan setelah fitur selesai.

---

# Cara Merge Branch

---

# 1. Pindah ke Develop

```bash
git checkout develop
```

---

# 2. Pull Update Terbaru

```bash
git pull origin develop
```

---

# 3. Merge Branch

Contoh:
```bash
git merge feature/auth
```

---

# 4. Push Develop

```bash
git push origin develop
```

---

# Workflow Tim yang Disarankan

| Anggota | Branch |
|---|---|
| Haddi | feature/database |
| Fajar | feature/landing-page |
| Farrel | feature/dashboard-admin |
| Zidan | feature/auth |

---

# Aturan Kolaborasi

## WAJIB
- Pull sebelum coding
- Gunakan branch masing-masing
- Commit dengan pesan jelas
- Diskusi sebelum ubah database

---

## DILARANG
- Push langsung ke `main`
- Rename folder sembarangan
- Menghapus file anggota lain
- Mengubah struktur database tanpa koordinasi

Karena merge conflict itu kadang lebih brutal daripada revisi dosen 😭

---

# Perintah Git Penting

| Command | Fungsi |
|---|---|
| git status | Melihat perubahan |
| git add . | Menambahkan file |
| git commit -m "" | Commit perubahan |
| git push | Upload ke GitHub |
| git pull | Mengambil update |
| git checkout | Pindah branch |
| git branch | Melihat branch |

---

# Mengecek Branch Saat Ini

```bash
git branch
```

Branch aktif akan memiliki tanda:
```text
*
```

Contoh:
```text
* develop
```

---

# Melihat Seluruh Branch

```bash
git branch -a
```

---

# Jika Ada Perubahan dari Teman

Sebelum coding:
```bash
git pull origin develop
```

Agar project tetap sinkron.

---

# Alur Branch SAPARASA

```text
main
  │
  └── develop
        ├── feature/database
        ├── feature/auth
        ├── feature/landing-page
        └── feature/dashboard-admin
```

---

# Saran Workflow Paling Aman

## Jangan coding langsung di:
```text
main
```

Karena:
sekali error dan push:
```text
seluruh tim ikut menderita 😭
```

---

# Penutup

Workflow ini dibuat agar:
- pengerjaan lebih rapih
- fitur tidak bertabrakan
- mempermudah kolaborasi tim
- mempermudah tracking perubahan project

Project SAPARASA menggunakan pendekatan branch per fitur agar development lebih terstruktur dan aman.