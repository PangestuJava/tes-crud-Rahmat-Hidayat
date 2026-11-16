<?php $activeMenu = (strpos($_SERVER['REQUEST_URI'], '/cuti') !== false) ? 'cuti' : 'karyawan'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo isset($title) ? htmlspecialchars($title) : 'CRUD Karyawan'; ?></title>
    <base href="<?php echo url(); ?>">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container">
    <header class="app-header">
        <a href="<?php echo url(); ?>" class="navbar-brand">CRUD Karyawan</a>
        <div>
            <h1>CRUD Karyawan</h1>
            <p class="subtitle">Kelola data karyawan & pengajuan cuti</p>
        </div>
        <nav>
            <a href="<?php echo url('karyawan'); ?>" class="<?php echo $activeMenu === 'karyawan' ? 'active' : ''; ?>">Karyawan</a>
            <a href="<?php echo url('cuti'); ?>" class="<?php echo $activeMenu === 'cuti' ? 'active' : ''; ?>">Transaksi Cuti</a>
        </nav>
    </header>
    <hr>
    <?php if (isset($_GET['msg'])): $m = $_GET['msg']; ?>
        <p class="msg <?php echo ($m === 'has_cuti') ? 'msg-err' : 'msg-ok'; ?>">
            <?php
                if ($m === 'added') echo 'Data berhasil ditambahkan.';
                elseif ($m === 'updated') echo 'Data berhasil diubah.';
                elseif ($m === 'deleted') echo 'Data berhasil dihapus.';
                elseif ($m === 'approved') echo 'Pengajuan cuti disetujui.';
                elseif ($m === 'rejected') echo 'Pengajuan cuti ditolak.';
                elseif ($m === 'has_cuti') echo 'Tidak bisa hapus: karyawan memiliki data cuti. Hapus data cuti terlebih dahulu.';
            ?>
        </p>
    <?php endif; ?>
    <?php if (!empty($error)): ?>
        <p class="msg msg-err"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <?php echo $content; ?>
</div>
<script src="assets/js/app.js"></script>
</body>
</html>