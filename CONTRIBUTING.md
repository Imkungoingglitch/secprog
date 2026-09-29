# 🤝 Panduan Kerja Tim & Git

Panduan supaya kerja bareng di repo ini rapi dan tidak saling timpa.

> ⚠️ Semua commit & push dilakukan **manual** oleh masing-masing anggota. Tidak ada proses otomatis di repo ini.

## 📑 Daftar Isi
- [1. Setup Pertama Kali](#1-setup-pertama-kali)
- [2. Konsep Dasar Git](#2-konsep-dasar-git)
- [3. Alur Kerja dengan Branch](#3-alur-kerja-dengan-branch-disarankan)
- [4. Membuat Pull Request](#4-membuat-pull-request-di-github)
- [5. Setelah Pull Request Di-merge](#5-setelah-pull-request-di-merge)
- [6. Cheat Sheet Perintah Git](#6-cheat-sheet-perintah-git)
- [7. Membatalkan Perubahan](#7-membatalkan-perubahan)
- [8. Aturan Penamaan Branch](#8-aturan-penamaan-branch)
- [9. Format Pesan Commit](#9-format-pesan-commit)
- [10. Pembagian File](#10-pembagian-file)
- [11. Kalau Terjadi Conflict](#11-kalau-terjadi-conflict)
- [12. Yang TIDAK Boleh Di-commit](#12-yang-tidak-boleh-di-commit)

---

## 1. Setup Pertama Kali

**Clone repository**
```bash
git clone https://github.com/Imkungoingglitch/secprog.git
cd secprog
```

**Atur identitas Git** (sekali saja, di dalam folder repo)
```bash
git config user.name "Nama Kamu"
git config user.email "email@kamu.com"
```

**Jalankan aplikasi**
```bash
cp .env.example .env
docker compose up -d --build
```

---

## 2. Konsep Dasar Git

```
 Working Directory  ──git add──▶  Staging Area  ──git commit──▶  Local Repo  ──git push──▶  GitHub
   (file yang diedit)              (siap disimpan)                 (riwayat di laptop)        (remote / origin)
                                                                         ◀──────────git pull─────────
```

| Istilah | Arti |
|---------|------|
| **Repository (repo)** | Folder project yang dilacak Git |
| **Commit** | "Save point" / snapshot perubahan beserta pesannya |
| **Branch** | Cabang kerja terpisah, supaya fitur yang belum jadi tidak mengganggu `main` |
| **`main`** | Branch utama — kode yang sudah stabil |
| **Remote / `origin`** | Repo yang ada di GitHub |
| **Push** | Mengirim commit dari laptop ke GitHub |
| **Pull** | Mengambil commit terbaru dari GitHub ke laptop |
| **Merge** | Menggabungkan satu branch ke branch lain |
| **Pull Request (PR)** | Permintaan di GitHub untuk menggabungkan branch kamu ke `main` |
| **Conflict** | Dua orang mengubah baris yang sama, Git minta dipilih manual |

---

## 3. Alur Kerja dengan Branch (Disarankan)

Setiap fitur dikerjakan di **branch sendiri**, bukan langsung di `main`.

**Langkah 1 — Update `main` dulu**
```bash
git switch main
git pull
```

**Langkah 2 — Buat branch baru untuk fitur**
```bash
git switch -c feature/login
```
> `-c` = create. Branch baru dibuat dari posisi `main` terbaru dan langsung dipindah ke sana.

**Langkah 3 — Kerjakan fitur, lalu cek perubahan**
```bash
git status          # file apa saja yang berubah
git diff            # detail baris yang berubah
```

**Langkah 4 — Tambahkan ke staging (`git add`)**
```bash
git add auth/login.php     # satu file
git add auth/              # satu folder
git add -A                 # semua perubahan
```

**Langkah 5 — Simpan perubahan (`git commit`)**
```bash
git commit -m "feat: tambah halaman login"
```
> Commit sesering mungkin dengan perubahan kecil & jelas — lebih mudah dilacak kalau ada bug.

**Langkah 6 — Kirim branch ke GitHub (`git push`)**
```bash
# Push pertama kali untuk branch baru
git push -u origin feature/login

# Push berikutnya di branch yang sama cukup
git push
```

**Langkah 7 — Buat Pull Request** di GitHub (lihat bagian 4).

---

## 4. Membuat Pull Request di GitHub

1. Buka https://github.com/Imkungoingglitch/secprog
2. Akan muncul tombol kuning **"Compare & pull request"** → klik.
   *(Kalau tidak muncul: tab **Pull requests** → **New pull request** → pilih `base: main` ← `compare: feature/login`)*
3. Isi judul & deskripsi singkat: apa yang dikerjakan, bagaimana cara ngetesnya.
4. Klik **Create pull request**.
5. Minta anggota tim lain **review** kodenya.
6. Kalau sudah oke, klik **Merge pull request** → **Confirm merge**.
7. Klik **Delete branch** (branch di GitHub sudah tidak diperlukan).

---

## 5. Setelah Pull Request Di-merge

Kembali ke `main`, ambil versi terbaru, lalu hapus branch lokal:
```bash
git switch main
git pull
git branch -d feature/login
```
Untuk fitur berikutnya, ulangi dari [Langkah 1](#3-alur-kerja-dengan-branch-disarankan).

### Branch kamu ketinggalan `main`?
Kalau teman sudah merge fitur lain ke `main` saat kamu masih mengerjakan branch-mu:
```bash
git switch main
git pull
git switch feature/login
git merge main
```

---

## 6. Cheat Sheet Perintah Git

### Status & Riwayat
| Perintah | Fungsi |
|----------|--------|
| `git status` | Lihat file yang berubah / sudah di-staging |
| `git diff` | Lihat detail perubahan yang **belum** di-add |
| `git diff --staged` | Lihat detail perubahan yang **sudah** di-add |
| `git log --oneline` | Riwayat commit (ringkas) |
| `git log --oneline --graph --all` | Riwayat commit semua branch dalam bentuk grafik |

### Branch
| Perintah | Fungsi |
|----------|--------|
| `git branch` | Lihat daftar branch lokal (`*` = branch aktif) |
| `git branch -a` | Lihat semua branch termasuk yang di GitHub |
| `git switch -c <nama>` | Buat branch baru & pindah ke sana |
| `git switch <nama>` | Pindah ke branch lain |
| `git branch -d <nama>` | Hapus branch lokal (yang sudah di-merge) |
| `git branch -D <nama>` | Paksa hapus branch lokal (walau belum di-merge) |
| `git push origin --delete <nama>` | Hapus branch di GitHub |
| `git merge <nama>` | Gabungkan branch `<nama>` ke branch aktif |

### Add, Commit, Push, Pull
| Perintah | Fungsi |
|----------|--------|
| `git add <file>` | Masukkan file ke staging |
| `git add -A` | Masukkan semua perubahan ke staging |
| `git commit -m "pesan"` | Simpan perubahan yang di-staging |
| `git push` | Kirim commit ke GitHub |
| `git push -u origin <branch>` | Push branch baru pertama kali |
| `git pull` | Ambil & gabungkan perubahan terbaru dari GitHub |
| `git fetch` | Ambil info terbaru dari GitHub **tanpa** menggabungkan |

### Simpan Sementara (Stash)
Berguna kalau harus pindah branch tapi pekerjaan belum siap di-commit.
| Perintah | Fungsi |
|----------|--------|
| `git stash` | Simpan sementara perubahan yang belum di-commit |
| `git stash list` | Lihat daftar stash |
| `git stash pop` | Kembalikan perubahan terakhir yang di-stash |

---

## 7. Membatalkan Perubahan

| Situasi | Perintah |
|---------|----------|
| Batalkan perubahan di file (belum di-add) | `git restore <file>` |
| Keluarkan file dari staging (sudah di-add, belum commit) | `git restore --staged <file>` |
| Ubah pesan commit terakhir (**belum di-push**) | `git commit --amend -m "pesan baru"` |
| Batalkan commit terakhir, perubahan tetap ada di file (**belum di-push**) | `git reset --soft HEAD~1` |
| Batalkan commit yang **sudah di-push** (aman untuk tim) | `git revert <commit-id>` |

> ⚠️ Jangan pakai `git push --force` di branch `main` — bisa menghapus commit teman.

---

## 8. Aturan Penamaan Branch

Format: `<jenis>/<nama-singkat>` — huruf kecil, pisahkan dengan `-`.

| Jenis | Dipakai untuk | Contoh |
|-------|---------------|--------|
| `feature/` | Fitur baru | `feature/login`, `feature/create-ticket` |
| `fix/` | Perbaikan bug | `fix/logout-redirect` |
| `security/` | Perbaikan keamanan | `security/csrf-token` |
| `docs/` | Dokumentasi | `docs/update-readme` |

---

## 9. Format Pesan Commit

Gunakan awalan supaya riwayat commit jelas:

| Awalan | Dipakai untuk | Contoh |
|--------|---------------|--------|
| `feat:` | Fitur baru | `feat: tambah form create ticket` |
| `fix:` | Perbaikan bug | `fix: redirect setelah logout` |
| `security:` | Perbaikan keamanan | `security: tambah CSRF token di edit ticket` |
| `style:` | Tampilan / CSS | `style: rapikan tabel tickets` |
| `docs:` | Dokumentasi | `docs: update README` |
| `chore:` | Konfigurasi, docker, dll | `chore: update docker-compose` |

---

## 10. Pembagian File

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

---

## 11. Kalau Terjadi Conflict

Saat `git pull` atau `git merge`, kalau muncul `CONFLICT`:

1. Jalankan `git status` untuk melihat file yang conflict.
2. Buka file tersebut, cari penanda berikut:
   ```
   <<<<<<< HEAD
   kode kamu
   =======
   kode teman
   >>>>>>> main
   ```
3. Pilih / gabungkan kode yang benar, lalu **hapus** semua penanda `<<<<<<<`, `=======`, `>>>>>>>`.
   *(Di VS Code bisa klik "Accept Current", "Accept Incoming", atau "Accept Both".)*
4. Simpan, lalu:
   ```bash
   git add -A
   git commit -m "fix: resolve conflict"
   git push
   ```

Kalau bingung dan ingin membatalkan merge: `git merge --abort`

---

## 12. Yang TIDAK Boleh Di-commit

- File `.env` (berisi password) — sudah ada di `.gitignore`
- Foto hasil upload di `uploads/profiles/` — sudah ada di `.gitignore`
- Password / API key asli di dalam kode
