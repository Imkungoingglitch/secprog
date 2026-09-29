# 🛠️ IT Helpdesk

Aplikasi **IT Helpdesk** (sistem tiket keluhan/permintaan IT) untuk tugas mata kuliah **Secure Programming**.
Dibangun dengan **PHP Native + Apache + MariaDB**, dijalankan menggunakan **Docker**.

---

## 📑 Daftar Isi
- [Fitur](#-fitur)
- [Tech Stack](#-tech-stack)
- [Struktur Folder](#-struktur-folder)
- [Menjalankan Aplikasi (Docker)](#-menjalankan-aplikasi-docker)
- [Menjalankan di WSL](#-menjalankan-di-wsl-windows)
- [Perintah Docker yang Sering Dipakai](#-perintah-docker-yang-sering-dipakai)
- [Environment Variables](#%EF%B8%8F-environment-variables)
- [Checklist Keamanan](#-checklist-keamanan)
- [Troubleshooting](#-troubleshooting)
- [Kerja Tim](#-kerja-tim)

---

## ✨ Fitur

| No | Fitur | File | Akses |
|----|-------|------|-------|
| 1 | Login | `auth/login.php` | Guest |
| 2 | Register | `auth/register.php` | Guest |
| 3 | Forgot Password | `auth/forgot-password.php` | Guest |
| 4 | Dashboard | `index.php` | User, Admin |
| 5 | All / My Tickets | `tickets/index.php` | User (tiket sendiri), Admin (semua) |
| 6 | Create Ticket | `tickets/create.php` | User, Admin |
| 7 | Ticket Detail | `tickets/detail.php` | Pemilik tiket, Admin |
| 8 | Edit Ticket | `tickets/edit.php` | Pemilik tiket, Admin |
| 9 | Manage Categories | `admin/categories.php` | Admin |
| 10 | Manage Users | `admin/users.php` | Admin |
| 11 | Profile | `profile/index.php` | User, Admin |
| 12 | Change Profile Photo | `profile/index.php` | User, Admin |

---

## 🧰 Tech Stack

| Komponen | Versi |
|----------|-------|
| PHP | 8.3 (image `php:8.3-apache`) |
| Web Server | Apache 2.4 |
| Database | MariaDB 11 |
| DB Admin | phpMyAdmin 5 |
| Container | Docker + Docker Compose |

---

## 📁 Struktur Folder

```
helpdesk/
├── config/
│   └── database.php              # koneksi database (PDO)
├── auth/
│   ├── login.php
│   ├── register.php
│   ├── logout.php
│   └── forgot-password.php
├── tickets/
│   ├── index.php                 # all / my tickets
│   ├── create.php
│   ├── edit.php
│   ├── detail.php
│   └── delete.php
├── admin/
│   ├── users.php                 # manage users
│   └── categories.php            # manage categories
├── profile/
│   └── index.php                 # profile & ganti foto
├── uploads/
│   └── profiles/                 # foto profil hasil upload (tidak di-commit)
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
├── includes/
│   ├── auth.php                  # session, cek login/role, CSRF helper
│   ├── header.php
│   └── footer.php
├── database/
│   └── schema.sql                # skema tabel, dijalankan otomatis oleh MariaDB
├── docker/
│   ├── php/php.ini               # konfigurasi PHP (hardening)
│   └── apache/zz-hardening.conf  # konfigurasi Apache (hardening)
├── Dockerfile
├── docker-compose.yml
├── .env.example                  # contoh konfigurasi environment
└── index.php                     # dashboard
```

---

## 🚀 Menjalankan Aplikasi (Docker)

### Prasyarat
- [Docker Desktop](https://www.docker.com/products/docker-desktop/) **atau** Docker di WSL (lihat bagian [WSL](#-menjalankan-di-wsl-windows))
- Git

### Langkah

**1. Clone repository**
```bash
git clone https://github.com/Imkungoingglitch/secprog.git
cd secprog
```

**2. Buat file `.env` dari contoh**
```bash
cp .env.example .env
```
Lalu buka `.env` dan ganti `DB_PASS` & `DB_ROOT_PASS` dengan password kamu sendiri.

**3. Build & jalankan container**
```bash
docker compose up -d --build
```

**4. Buka di browser**

| Service | URL |
|---------|-----|
| Aplikasi Helpdesk | http://localhost:8080 |
| phpMyAdmin | http://localhost:8081 |

Login phpMyAdmin memakai `DB_USER` / `DB_PASS` dari file `.env`.

> 💡 Folder project di-*mount* ke dalam container, jadi setiap perubahan file PHP **langsung terlihat** tanpa perlu build ulang — cukup refresh browser.

---

## 🐧 Menjalankan di WSL (Windows)

Kalau tidak memakai Docker Desktop, Docker bisa dijalankan di WSL Ubuntu.

**Setup sekali saja** (di terminal WSL):
```bash
# Install Docker + plugin compose
sudo apt update
sudo apt install -y docker.io docker-compose-v2

# Supaya docker bisa dipakai tanpa sudo
sudo usermod -aG docker $USER
```
Tutup terminal WSL, jalankan `wsl --shutdown` dari PowerShell, lalu buka WSL lagi.

**Menjalankan project** — folder Windows bisa diakses dari WSL lewat `/mnt/<drive>/`. Contoh:
```bash
cd /mnt/e/me/secprog/aol/helpdesk
docker compose up -d --build
```
Aplikasi tetap dibuka dari browser Windows di http://localhost:8080.

---

## 🐳 Perintah Docker yang Sering Dipakai

| Perintah | Fungsi |
|----------|--------|
| `docker compose up -d` | Menjalankan semua container |
| `docker compose up -d --build` | Build ulang image lalu jalankan (setelah ubah `Dockerfile` / `docker/`) |
| `docker compose down` | Menghentikan container (data database **tetap ada**) |
| `docker compose down -v` | Menghentikan container **dan menghapus data database** |
| `docker compose ps` | Melihat status container |
| `docker compose logs -f web` | Melihat log Apache/PHP (termasuk error PHP) |
| `docker compose exec web bash` | Masuk ke dalam container web |
| `docker compose exec db mariadb -u helpdesk -p helpdesk` | Masuk ke console database |

### Reset database
`database/schema.sql` hanya dijalankan saat database **pertama kali** dibuat.
Kalau skema diubah dan ingin dijalankan ulang:
```bash
docker compose down -v
docker compose up -d
```
> ⚠️ Perintah ini **menghapus semua data** di database.

---

## ⚙️ Environment Variables

Diatur lewat file `.env` (salin dari `.env.example`). File `.env` **tidak di-commit** ke GitHub.

| Variable | Default | Keterangan |
|----------|---------|------------|
| `APP_PORT` | `8080` | Port aplikasi di host |
| `PMA_PORT` | `8081` | Port phpMyAdmin di host |
| `DB_NAME` | `helpdesk` | Nama database |
| `DB_USER` | `helpdesk` | User database aplikasi |
| `DB_PASS` | — (wajib) | Password user database |
| `DB_ROOT_PASS` | — (wajib) | Password root MariaDB |

Di dalam PHP, nilai ini dibaca dengan `getenv('DB_HOST')`, `getenv('DB_NAME')`, dst.

---

## 🔒 Checklist Keamanan

Target keamanan aplikasi ini (centang saat sudah diimplementasi):

**Autentikasi & Session**
- [ ] Password di-hash dengan `password_hash()` dan dicek dengan `password_verify()`
- [ ] `session_regenerate_id(true)` setelah login
- [x] Cookie session `HttpOnly` + `SameSite` *(diatur di `docker/php/php.ini`)*
- [ ] Batasi percobaan login (brute force protection)
- [ ] Token reset password acak (`random_bytes`), di-hash, dan punya masa berlaku
- [ ] Pesan error login / forgot password generik (cegah user enumeration)

**Input & Output**
- [ ] Semua query memakai **prepared statement** (PDO) — cegah SQL Injection
- [ ] Semua output di-escape dengan `htmlspecialchars()` — cegah XSS
- [ ] Validasi input di sisi server
- [ ] Token **CSRF** di setiap form POST

**Otorisasi**
- [ ] Cek login di setiap halaman yang butuh login
- [ ] Cek role admin di halaman `admin/`
- [ ] Cek kepemilikan tiket di detail/edit/delete — cegah **IDOR**
- [ ] Aksi delete hanya lewat POST

**Upload File**
- [ ] Validasi MIME type (`finfo`), ekstensi, dan ukuran file
- [ ] Rename file dengan nama acak
- [x] Eksekusi PHP di folder `uploads/` dimatikan *(diatur di `docker/apache/zz-hardening.conf`)*

**Konfigurasi Server**
- [x] `expose_php = Off`, `ServerTokens Prod`, `ServerSignature Off`
- [x] Error PHP tidak ditampilkan ke user (hanya di log)
- [x] Directory listing dimatikan
- [x] Folder `config/`, `includes/`, `database/` dan file `.env` tidak bisa diakses dari browser
- [x] Security headers (`X-Content-Type-Options`, `X-Frame-Options`, `Referrer-Policy`)

---

## 🩺 Troubleshooting

| Masalah | Solusi |
|---------|--------|
| `Isi DB_PASS di file .env` | File `.env` belum dibuat. Jalankan `cp .env.example .env` |
| `port is already allocated` | Port 8080/8081 sudah dipakai. Ganti `APP_PORT` / `PMA_PORT` di `.env` |
| Halaman blank / error 500 | Lihat error di `docker compose logs -f web` (error tidak ditampilkan di browser) |
| Perubahan `schema.sql` tidak masuk | Reset database (lihat [Reset database](#reset-database)) |
| `permission denied ... docker.sock` (WSL) | Jalankan `sudo usermod -aG docker $USER` lalu `wsl --shutdown` |
| `unknown command: docker compose` (WSL) | Install plugin: `sudo apt install -y docker-compose-v2` |

---

## 👥 Kerja Tim

Panduan alur kerja Git untuk anggota tim ada di **[CONTRIBUTING.md](CONTRIBUTING.md)**.

### Anggota Tim
| Nama | NIM | Bagian |
|------|-----|--------|
| | | |
| | | |
