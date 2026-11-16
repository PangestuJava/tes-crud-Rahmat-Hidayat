# Product Requirements Document: CRUD Karyawan PHP 5.6

## 1. Overview
Aplikasi CRUD sederhana untuk mengelola data karyawan menggunakan PHP 5.6 dan MySQL. Aplikasi ini memenuhi paket tes yang mencakup instalasi, desain database, implementasi CRUD, fitur transaksi, dan pengelolaan versi Git.

## 2. Functional Requirements

### 2.1 Instalasi (Req-001)
- Install XAMPP 5.6.x (PHP 5.6 + Apache + MySQL).
- Jalankan Apache dan MySQL.
- Buat file `info.php` berisi `phpinfo()` dan akses melalui browser.
- Verifikasi ekstensi `mysql` aktif (fungsi `mysql_*`).

### 2.2 Database & Tabel (Req-002)
- Desain database dan tabel untuk menyimpan data karyawan.
- **Minimum 2 tabel**: tabel utama (karyawan) dan tabel pendukung/master (misal: departemen, jabatan).
- Setiap tabel harus memiliki primary key.
- Foreign key antara tabel utama dan tabel pendukung.
- Isi minimal 5 data contoh per tabel.
- Tipe data harus ketepatan dan kolom wajib ada alasan bisnis.

### 2.3 Aplikasi CRUD (Req-003)
- **koneksi.php**: Koneksi menggunakan fungsi `mysql_*` (`mysql_connect`, `mysql_select_db`, `mysql_query`, `mysql_fetch_array`).
- **index.php**: Tampilkan semua data karyawan dalam tabel HTML beserta kolom dari tabel pendukung (via JOIN). Sertakan tombol Edit dan Hapus.
- **tambah.php**: Form tambah data karyawan. Dropdown pilihan dari tabel pendukung diambil dari database.
- **edit.php**: Form ubah data berdasarkan ID dan update ke database. Dropdown diisi data saat ini.
- **hapus.php**: Hapus data dengan konfirmasi JavaScript `confirm` terlebih dahulu.
- **Keamanan**: Aplikasi harus aman dari SQL Injection (gunakan `mysql_real_escape_string` atau persiapan prepared statement meski PHP 5.6 mysql_* tidak support parameter bound, gunakan escaping).
- **Validasi**:
  - Semua field wajib diisi.
  - Data yang seharusnya unik (misal: NIK, email) tidak boleh duplicate.
  - Input angka/tanggal harus sesuai format.
  - Validasi lain sesuai keputusan developer.

### 2.4 Fitur Transaksi (Req-004)
- **Tabel transaksi**: Rancang sendiri (misal: `transaksi_cuti`) dan relasikan ke tabel utama (karyawan).
- **Form input transaksi**: Pilih karyawan dari dropdown.
- **Halaman daftar transaksi**: Tampilkan dengan query JOIN minimal 2 tabel.
- **Filter**: Filter daftar transaksi berdasarkan rentang tanggal.
- **Rekap**: Tampilkan total/rekap di bawah daftar (misal: jumlah transaksi, total nilai).
- **Validasi**: Field wajib diisi, format tanggal benar.

### 2.5 Push ke GitHub (Req-005)
- Buat repository baru di GitHub dengan nama `tes-crud-<nama>`.
- Ekspor database ke file `.sql` dan sertakan di repository.
- Buat `README.md` berisi penjelasan singkat aplikasi dan cara menjalankannya.
- Lakukan `git init`, commit bertahap minimal 3 commit (bukan sekali di akhir), lalu push ke repository.
- Serahkan link repository ke penguji.

## 3. Non-Functional Requirements
- Compatible with XAMPP 5.6 / PHP 5.6.
- Use procedural `mysql_*` functions (not PDO/mysqli).
- Browser‑friendly HTML output.
- No hard‑coded values; all data comes from database.

## 4. Success Criteria
- XAMPP stack runs; `phpinfo()` accessible.
- Database created with at least 2 related tables, 5 sample rows each.
- All CRUD pages functional; JOIN works on index page; dropdowns populated.
- Transaksi feature: add, list with filter, recap totals.
- Git repository initialized, 3+ commits, `.sql` and `README.md` present; link provided.