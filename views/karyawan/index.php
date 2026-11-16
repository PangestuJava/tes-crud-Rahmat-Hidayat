<?php ob_start(); ?>
<h2>Daftar Karyawan</h2>
<form method="get" action="<?php echo url('karyawan'); ?>">
    <input type="text" name="q" placeholder="Cari NIK/Nama/Email" value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>">
    <button type="submit">Cari</button>
    <a href="<?php echo url('karyawan'); ?>">Reset</a>
</form>
<br>
<a href="<?php echo url('karyawan/tambah'); ?>">+ Tambah Karyawan</a>
<br><br>
<div class="table-wrap">
<table class="table">
    <thead>
        <tr>
            <th>No</th><th>NIK</th><th>Nama</th><th>Email</th><th>No Telp</th>
            <th>Departemen</th><th>Jabatan</th><th>Gaji</th><th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php if (empty($karyawan)): ?>
        <tr><td colspan="9">Tidak ada data.</td></tr>
    <?php else: $no = 1; foreach ($karyawan as $k): ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo htmlspecialchars($k['nik']); ?></td>
            <td><?php echo htmlspecialchars($k['nama']); ?></td>
            <td><?php echo htmlspecialchars($k['email']); ?></td>
            <td><?php echo htmlspecialchars($k['no_telp']); ?></td>
            <td><?php echo htmlspecialchars($k['nama_departemen']); ?></td>
            <td><?php echo htmlspecialchars($k['nama_jabatan']); ?></td>
            <td>Rp <?php echo number_format($k['gaji'], 0, ',', '.'); ?></td>
            <td>
                <a href="<?php echo url('karyawan/edit') . '?id=' . $k['id']; ?>" class="btn btn-sm btn-edit">Edit</a>
                <a href="<?php echo url('karyawan/hapus') . '?id=' . $k['id']; ?>" onclick="return confirmHapus()" class="btn btn-sm btn-delete">Hapus</a>
            </td>
        </tr>
    <?php endforeach; endif; ?>
    </tbody>
</table>
</div>
<?php $content = ob_get_clean(); include __DIR__ . '/../layouts/main.php'; ?>
