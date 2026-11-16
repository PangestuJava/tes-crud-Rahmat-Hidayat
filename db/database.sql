CREATE DATABASE IF NOT EXISTS db_karyawan;
USE db_karyawan;

DROP TABLE IF EXISTS transaksi_cuti;
DROP TABLE IF EXISTS karyawan;
DROP TABLE IF EXISTS jabatan;
DROP TABLE IF EXISTS departemen;

CREATE TABLE departemen (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama_departemen VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE jabatan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama_jabatan VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE karyawan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nik VARCHAR(20) NOT NULL UNIQUE,
  nama VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  no_telp VARCHAR(15) NOT NULL,
  alamat TEXT NOT NULL,
  tanggal_lahir DATE NOT NULL,
  tanggal_masuk DATE NOT NULL,
  id_departemen INT NOT NULL,
  id_jabatan INT NOT NULL,
  gaji DECIMAL(12,2) NOT NULL,
  FOREIGN KEY (id_departemen) REFERENCES departemen(id),
  FOREIGN KEY (id_jabatan) REFERENCES jabatan(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE transaksi_cuti (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_karyawan INT NOT NULL,
  tanggal_mulai DATE NOT NULL,
  tanggal_selesai DATE NOT NULL,
  jenis_cuti ENUM('Tahunan','Sakit','Melahirkan','Penting') NOT NULL,
  keterangan TEXT,
  status ENUM('Pending','Disetujui','Ditolak') DEFAULT 'Pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_karyawan) REFERENCES karyawan(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO departemen (id, nama_departemen) VALUES
  (1, 'IT'),
  (2, 'HRD'),
  (3, 'Finance'),
  (4, 'Marketing'),
  (5, 'Operasional');

INSERT INTO jabatan (id, nama_jabatan) VALUES
  (1, 'Manager'),
  (2, 'Supervisor'),
  (3, 'Staff'),
  (4, 'Admin'),
  (5, 'Magang');

INSERT INTO karyawan (id, nik, nama, email, no_telp, alamat, tanggal_lahir, tanggal_masuk, id_departemen, id_jabatan, gaji) VALUES
  (1, 'KRY-001', 'Budi Santoso', 'budi.santoso@example.com', '081234567890', 'Jl. Merdeka No.1, Jakarta', '1990-05-12', '2020-01-15', 1, 1, 15000000.00),
  (2, 'KRY-002', 'Siti Aminah', 'siti.aminah@example.com', '081298765432', 'Jl. Sudirman No.2, Bandung', '1992-08-20', '2021-03-01', 2, 2, 12000000.00),
  (3, 'KRY-003', 'Agus Pratama', 'agus.pratama@example.com', '081355667788', 'Jl. Diponegoro No.3, Surabaya', '1988-11-30', '2019-07-10', 3, 3, 10000000.00),
  (4, 'KRY-004', 'Dewi Lestari', 'dewi.lestari@example.com', '081377889900', 'Jl. Thamrin No.4, Yogyakarta', '1995-02-14', '2022-05-20', 4, 4, 9000000.00),
  (5, 'KRY-005', 'Rizki Saputra', 'rizki.saputra@example.com', '081388776655', 'Jl. Gajah Mada No.5, Medan', '1998-09-05', '2023-01-10', 5, 5, 5000000.00);

INSERT INTO transaksi_cuti (id, id_karyawan, tanggal_mulai, tanggal_selesai, jenis_cuti, keterangan, status) VALUES
  (1, 1, '2023-06-01', '2023-06-05', 'Tahunan', 'Liburan ke Bali', 'Disetujui'),
  (2, 2, '2023-02-10', '2023-02-12', 'Sakit', 'Flu', 'Disetujui'),
  (3, 3, '2023-09-15', '2023-09-20', 'Melahirkan', 'Maternity leave', 'Pending'),
  (4, 4, '2023-04-01', '2023-04-03', 'Penting', 'Urusan keluarga', 'Disetujui'),
  (5, 5, '2023-12-20', '2023-12-25', 'Tahunan', 'Libur akhir tahun', 'Pending');