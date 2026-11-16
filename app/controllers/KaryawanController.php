<?php
require_once __DIR__ . '/../models/Karyawan.php';
require_once __DIR__ . '/../models/Departemen.php';
require_once __DIR__ . '/../models/Jabatan.php';
require_once __DIR__ . '/../services/ValidationService.php';

class KaryawanController
{
    private $model;
    private $val;

    public function __construct()
    {
        $this->model = new Karyawan();
        $this->val   = new ValidationService();
    }

    public function index()
    {
        $search   = isset($_GET['q']) ? $_GET['q'] : '';
        $karyawan = $this->model->all($search);
        $title    = 'Daftar Karyawan';
        include __DIR__ . '/../../views/karyawan/index.php';
    }

    public function tambah()
    {
        $deptModel = new Departemen();
        $jabModel  = new Jabatan();
        $departemen = $deptModel->all();
        $jabatan    = $jabModel->all();
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $required = array('nik','nama','email','no_telp','alamat','tanggal_lahir','tanggal_masuk','id_departemen','id_jabatan','gaji');
            $error = $this->val->required($required, $_POST);

            if (!$error && !$this->val->isDate($_POST['tanggal_lahir'])) $error = 'Format tanggal lahir tidak valid.';
            if (!$error && !$this->val->isDate($_POST['tanggal_masuk'])) $error = 'Format tanggal masuk tidak valid.';
            if (!$error && !$this->val->isNumeric($_POST['gaji']))       $error = 'Gaji harus berupa angka.';
            if (!$error && $this->model->nikExists($_POST['nik']))       $error = 'NIK sudah terdaftar.';
            if (!$error && $this->model->emailExists($_POST['email']))   $error = 'Email sudah terdaftar.';

            if (!$error) {
                $this->model->create($_POST);
                header('Location: ' . url('karyawan') . '?msg=added');
                exit;
            }
        }

        $title = 'Tambah Karyawan';
        include __DIR__ . '/../../views/karyawan/tambah.php';
    }

    public function edit()
    {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if (!$id) die('ID tidak valid');

        $kar = $this->model->find($id);
        if (!$kar) die('Data tidak ditemukan');

        $deptModel  = new Departemen();
        $jabModel   = new Jabatan();
        $departemen = $deptModel->all();
        $jabatan    = $jabModel->all();
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $required = array('nik','nama','email','no_telp','alamat','tanggal_lahir','tanggal_masuk','id_departemen','id_jabatan','gaji');
            $error = $this->val->required($required, $_POST);

            if (!$error && !$this->val->isDate($_POST['tanggal_lahir'])) $error = 'Format tanggal lahir tidak valid.';
            if (!$error && !$this->val->isDate($_POST['tanggal_masuk'])) $error = 'Format tanggal masuk tidak valid.';
            if (!$error && !$this->val->isNumeric($_POST['gaji']))       $error = 'Gaji harus berupa angka.';
            if (!$error && $this->model->nikExists($_POST['nik'], $id))  $error = 'NIK sudah digunakan.';
            if (!$error && $this->model->emailExists($_POST['email'], $id)) $error = 'Email sudah digunakan.';

            if (!$error) {
                $this->model->update($id, $_POST);
                header('Location: ' . url('karyawan') . '?msg=updated');
                exit;
            }
        }

        $title = 'Edit Karyawan';
        include __DIR__ . '/../../views/karyawan/edit.php';
    }

    public function hapus()
    {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if (!$id) die('ID tidak valid');

        if ($this->model->hasCuti($id)) {
            header('Location: ' . url('karyawan') . '?msg=has_cuti');
            exit;
        }

        $this->model->delete($id);
        header('Location: ' . url('karyawan') . '?msg=deleted');
        exit;
    }
}
