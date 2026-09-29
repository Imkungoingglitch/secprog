# 🤝 Panduan Kerja Tim

Panduan singkat supaya kerja bareng di repo ini tidak saling timpa.

## 1. Setup Pertama Kali

```bash
git clone https://github.com/Imkungoingglitch/secprog.git
cd secprog
cp .env.example .env
docker compose up -d --build
```

Atur identitas Git (sekali saja, di dalam folder repo):
```bash
git config user.name "Nama Kamu"
git config user.email "email@kamu.com"
```

## 2. Alur Kerja Harian

> ⚠️ Semua push dilakukan **manual** oleh masing-masing anggota. Tidak ada proses otomatis di repo ini.

```bash
# 1. Ambil perubahan terbaru SEBELUM mulai kerja
git pull

# 2. Kerjakan fitur...

# 3. Cek file apa saja yang berubah
git status

# 4. Simpan perubahan
git add -A
git commit -m "feat: tambah halaman login"

# 5. Ambil lagi perubahan teman (kalau ada), lalu kirim
git pull
git push
```

## 3. Pembagian File

Supaya tidak bentrok, **satu file dikerjakan satu orang** dalam satu waktu. Isi tabel ini sesuai pembagian tim:

| Folder / File | PIC |
|---------------|-----|
| `config/`, `includes/`, `database/schema.sql` | |
| `auth/` | |
| `tickets/` | |
| `admin/` | |
| `profile/` | |
| `index.php`, `assets/` | |

> File bersama seperti `includes/auth.php` dan `database/schema.sql` — **kabari tim** sebelum mengubah.

## 4. Format Pesan Commit

Gunakan awalan supaya riwayat commit jelas:

| Awalan | Dipakai untuk | Contoh |
|--------|---------------|--------|
| `feat:` | Fitur baru | `feat: tambah form create ticket` |
| `fix:` | Perbaikan bug | `fix: redirect setelah logout` |
| `security:` | Perbaikan keamanan | `security: tambah CSRF token di edit ticket` |
| `style:` | Tampilan / CSS | `style: rapikan tabel tickets` |
| `docs:` | Dokumentasi | `docs: update README` |
| `chore:` | Konfigurasi, docker, dll | `chore: update docker-compose` |

## 5. Kalau Terjadi Conflict

Saat `git pull`, kalau muncul `CONFLICT`:

1. Buka file yang conflict, cari penanda berikut:
   ```
   <<<<<<< HEAD
   kode kamu
   =======
   kode teman
   >>>>>>> origin/main
   ```
2. Pilih / gabungkan kode yang benar, lalu **hapus** semua penanda `<<<<<<<`, `=======`, `>>>>>>>`.
3. Simpan, lalu:
   ```bash
   git add -A
   git commit -m "fix: resolve conflict"
   git push
   ```

## 6. Yang TIDAK Boleh Di-commit

- File `.env` (berisi password) — sudah ada di `.gitignore`
- Foto hasil upload di `uploads/profiles/` — sudah ada di `.gitignore`
- Password / API key asli di dalam kode
