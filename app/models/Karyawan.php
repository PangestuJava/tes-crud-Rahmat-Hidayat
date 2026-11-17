<?php
require_once __DIR__ . '/BaseModel.php';

class Karyawan extends BaseModel
{
    public function all($search = '')
    {
        $sql = "SELECT k.*, d.nama_departemen, j.nama_jabatan
                FROM karyawan k
                JOIN departemen d ON d.id = k.id_departemen
                JOIN jabatan j ON j.id = k.id_jabatan";
        if ($search !== '') {
            $s = $this->esc($search);
            $sql .= " WHERE k.nik LIKE '%$s%' OR k.nama LIKE '%$s%' OR k.email LIKE '%$s%'";
        }
        $sql .= " ORDER BY k.id DESC";
        return $this->fetchAll($sql);
    }

    public function find(int $id)
    {
        $id = (int)$id;
        return $this->fetchOne("SELECT * FROM karyawan WHERE id = $id");
    }

    public function nikExists(string $nik, $exceptId = 0)
    {
        $nik = $this->esc($nik);
        $id  = (int)$exceptId;
        $row = $this->fetchOne("SELECT COUNT(*) AS cnt FROM karyawan WHERE nik = '$nik' AND id != $id");
        return $row['cnt'] > 0;
    }

    public function emailExists(string $email, $exceptId = 0)
    {
        $email = $this->esc($email);
        $id    = (int)$exceptId;
        $row   = $this->fetchOne("SELECT COUNT(*) AS cnt FROM karyawan WHERE email = '$email' AND id != $id");
        return $row['cnt'] > 0;
    }

    public function create(array $d)
    {
        $sql = sprintf(
            "INSERT INTO karyawan (nik,nama,email,no_telp,alamat,tanggal_lahir,tanggal_masuk,id_departemen,id_jabatan,gaji)
                VALUES ('%s','%s','%s','%s','%s','%s','%s',%d,%d,%s)",
            $this->esc($d['nik']),
            $this->esc($d['nama']),
            $this->esc($d['email']),
            $this->esc($d['no_telp']),
            $this->esc($d['alamat']),
            $this->esc($d['tanggal_lahir']),
            $this->esc($d['tanggal_masuk']),
            (int)$d['id_departemen'],
            (int)$d['id_jabatan'],
            (float)$d['gaji']
        );
        $this->run($sql);
        return $this->insertId();
    }

    public function update(int $id, array $d)
    {
        $id = (int)$id;
        $sql = sprintf(
            "UPDATE karyawan SET nik='%s',nama='%s',email='%s',no_telp='%s',alamat='%s',
                tanggal_lahir='%s',tanggal_masuk='%s',id_departemen=%d,id_jabatan=%d,gaji=%s
                WHERE id=%d",
            $this->esc($d['nik']),
            $this->esc($d['nama']),
            $this->esc($d['email']),
            $this->esc($d['no_telp']),
            $this->esc($d['alamat']),
            $this->esc($d['tanggal_lahir']),
            $this->esc($d['tanggal_masuk']),
            (int)$d['id_departemen'],
            (int)$d['id_jabatan'],
            (float)$d['gaji'],
            $id
        );
        return $this->run($sql);
    }

    public function delete(int $id)
    {
        $id = (int)$id;
        return $this->run("DELETE FROM karyawan WHERE id = $id");
    }

    public function hasCuti(int $id)
    {
        $id  = (int)$id;
        $row = $this->fetchOne("SELECT COUNT(*) AS cnt FROM transaksi_cuti WHERE id_karyawan = $id");
        return $row['cnt'] > 0;
    }

    public function dropdown()
    {
        return $this->fetchAll("SELECT k.id, k.nik, k.nama, d.nama_departemen
                                FROM karyawan k
                                JOIN departemen d ON d.id = k.id_departemen
                                ORDER BY k.nama ASC");
    }
}
