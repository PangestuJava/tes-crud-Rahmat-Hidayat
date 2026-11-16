<?php
require_once __DIR__ . '/BaseModel.php';

class Cuti extends BaseModel
{
    public function all($from = '', $to = '')
    {
        $sql = "SELECT t.*, k.nik, k.nama
                FROM transaksi_cuti t
                JOIN karyawan k ON k.id = t.id_karyawan";
        $where = array();
        if ($from !== '') $where[] = "t.tanggal_mulai >= '" . $this->esc($from) . "'";
        if ($to !== '')   $where[] = "t.tanggal_mulai <= '" . $this->esc($to) . "'";
        if (!empty($where)) $sql .= " WHERE " . implode(' AND ', $where);
        $sql .= " ORDER BY t.tanggal_mulai DESC";
        return $this->fetchAll($sql);
    }

    public function summary($from = '', $to = '')
    {
        $sql = "SELECT COUNT(*) AS jumlah,
                       COALESCE(SUM(DATEDIFF(t.tanggal_selesai, t.tanggal_mulai)+1),0) AS total_hari
                FROM transaksi_cuti t";
        $where = array();
        if ($from !== '') $where[] = "t.tanggal_mulai >= '" . $this->esc($from) . "'";
        if ($to !== '')   $where[] = "t.tanggal_mulai <= '" . $this->esc($to) . "'";
        if (!empty($where)) $sql .= " WHERE " . implode(' AND ', $where);
        return $this->fetchOne($sql);
    }

    public function updateStatus($id, $status)
    {
        $id = (int)$id;
        $allowed = array('Disetujui', 'Ditolak');
        if (!in_array($status, $allowed, true)) return false;
        $status = $this->esc($status);
        // Hanya boleh memproses pengajuan yang masih Pending.
        return $this->run("UPDATE transaksi_cuti SET status='$status' WHERE id=$id AND status='Pending'");
    }

    public function create($d)
    {
        $sql = sprintf(
            "INSERT INTO transaksi_cuti (id_karyawan,tanggal_mulai,tanggal_selesai,jenis_cuti,keterangan)
             VALUES (%d,'%s','%s','%s','%s')",
            (int)$d['id_karyawan'],
            $this->esc($d['tanggal_mulai']),
            $this->esc($d['tanggal_selesai']),
            $this->esc($d['jenis_cuti']),
            $this->esc($d['keterangan'])
        );
        $this->run($sql);
        return $this->insertId();
    }
}
