# Tes CRUD Karyawan & Transaksi Cuti (PHP 5.6)

Aplikasi CRUD data karyawan dan transaksi cuti, dibangun dengan PHP 5.6 prosedural dan ekstensi `mysql_*` (sesuai ketentuan PRD).

## Kebutuhan

- PHP **5.6.x** (termasuk ekstensi `php_mysql.dll`)
- Apache
- MySQL 5.x / 8.x
- Bisa memakai **XAMPP 5.6.x** atau **Laragon** dengan PHP 5.6

Cek ekstensi lewat browser:

```
http://localhost/test-5.6/public/info.php
```

Halaman `info.php` berisi `phpinfo()`. Pastikan ada bagian **mysql** dengan status *enabled*.

## Cara Menjalankan

1. Salin folder project ke document root:
   - XAMPP: `htdocs/test-5.6/`
   - Laragon: `C:\laragon\www\test-5.6\`
2. Jalankan Apache dan MySQL.
3. Import `db/database.sql` ke database `db_karyawan` (via phpMyAdmin atau CLI):
   ```bash
   mysql -u root < db/database.sql
   ```
4. Sesuaikan koneksi di `.env` (contoh tersedia di `.env.example`):
   ```ini
   DB_HOST=localhost
   DB_USER=root
   DB_PASS=
   DB_NAME=db_karyawan
   ```
5. Buka aplikasi:
   ```
   http://localhost/test-5.6/
   ```
   Front controller berada di `public/index.php`, jadi `public/` harus menjadi base URL aplikasi.

## Struktur Folder

- `public/` — front controller (`index.php`), aset (`assets/css`, `assets/js`), dan `info.php`.
- `app/` — logic: `controllers/`, `models/`, `services/`, `traits/`.
- `views/` — tampilan HTML (`layouts/`, `karyawan/`, `cuti/`).
- `routes/` — definisi routing.
- `config/` — konfigurasi; `database.php` membaca `.env`.
- `db/` — `database.sql` (skema + data contoh).
- `koneksi.php` — koneksi database memakai `mysql_*`.
- `docs/` — dokumentasi tambahan.

## Fitur

- CRUD Karyawan (tambah, lihat, ubah, hapus).
- Transaksi Cuti dengan filter tanggal dan karyawan.
- Status cuti: **Pending / Disetujui / Ditolak** (tombol Setujui & Tolak).
- Navbar menandai menu aktif.
- Format tanggal `d-M-Y`.
- Notifikasi popup saat gagal hapus karena data cuti masih ada.
- Sorting tabel dan auto-dismiss pesan.

## Catatan PHP 5.6

- Fungsi `mysql_*` sudah deprecated di PHP 5.6 tetapi masih berfungsi.
- Notifikasi deprecated ditekan di `koneksi.php` lewat `error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE)`.
- Aplikasi **tidak kompatibel** dengan PHP 7+ karena fungsi `mysql_*` sudah dihapus.

## Commit Log (Contoh Bertahap)

1. Initial structure and DB design.
2. CRUD logic implemented (Karyawan).
3. Transaksi Cuti feature added with filtering.
4. Status approval, UI styling, dan notifikasi ditambahkan.

Link Repo: [Link GitHub Anda]
