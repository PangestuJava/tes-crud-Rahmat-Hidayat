<?php

use Cuti;
use Karyawan;
use ValidationService;

class CutiController
{
    private Cuti $model;
    private ValidationService $val;

    public function __construct()
    {
        $this->model = new Cuti();
        $this->val   = new ValidationService();
    }

    public function index()
    {
        $from = isset($_GET['from']) ? $_GET['from'] : '';
        $to   = isset($_GET['to'])   ? $_GET['to']   : '';

        $transaksi = $this->model->all($from, $to);
        $summary   = $this->model->summary($from, $to);
        $title     = 'Daftar Transaksi Cuti';
        include __DIR__ . '/../../views/cuti/index.php';
    }

    public function status()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . url('cuti'));
            exit;
        }

        $id     = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        $status = isset($_POST['status']) ? $_POST['status'] : '';

        if (!$id || !in_array($status, array('Disetujui', 'Ditolak'), true)) {
            die('Permintaan tidak valid');
        }

        $this->model->updateStatus($id, $status);
        $msg = ($status === 'Disetujui') ? 'approved' : 'rejected';
        header('Location: ' . url('cuti') . '?msg=' . $msg);
        exit;
    }

    public function tambah()
    {
        $karyawanModel = new Karyawan();
        $listKaryawan  = $karyawanModel->dropdown();
        $jenisCuti     = array('Tahunan', 'Sakit', 'Melahirkan', 'Penting');
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $required = array('id_karyawan', 'tanggal_mulai', 'tanggal_selesai', 'jenis_cuti');
            $error = $this->val->required($required, $_POST);

            if (!$error && !$this->val->isDate($_POST['tanggal_mulai']))   $error = 'Format tanggal mulai tidak valid.';
            if (!$error && !$this->val->isDate($_POST['tanggal_selesai'])) $error = 'Format tanggal selesai tidak valid.';
            if (!$error && $_POST['tanggal_selesai'] < $_POST['tanggal_mulai']) $error = 'Tanggal selesai harus >= tanggal mulai.';

            if (!$error) {
                $data = $_POST;
                if (!isset($data['keterangan'])) $data['keterangan'] = '';
                $this->model->create($data);
                header('Location: ' . url('cuti') . '?msg=added');
                exit;
            }
        }

        $title = 'Tambah Pengajuan Cuti';
        include __DIR__ . '/../../views/cuti/tambah.php';
    }
}
