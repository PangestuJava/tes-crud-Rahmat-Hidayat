<?php ob_start(); ?>
<h2>Edit Karyawan</h2>
<form method="post" action="<?php echo url('karyawan/edit') . '?id=' . $kar['id']; ?>">
<table class="form-table">
    <tr><td>NIK</td><td><input name="nik" value="<?php echo htmlspecialchars($kar['nik']); ?>" required></td></tr>
    <tr><td>Nama</td><td><input name="nama" value="<?php echo htmlspecialchars($kar['nama']); ?>" required></td></tr>
    <tr><td>Email</td><td><input type="email" name="email" value="<?php echo htmlspecialchars($kar['email']); ?>" required></td></tr>
    <tr><td>No Telp</td><td><input name="no_telp" value="<?php echo htmlspecialchars($kar['no_telp']); ?>" required></td></tr>
    <tr><td>Alamat</td><td><textarea name="alamat" required><?php echo htmlspecialchars($kar['alamat']); ?></textarea></td></tr>
    <tr><td>Tanggal Lahir</td><td><input type="date" name="tanggal_lahir" value="<?php echo htmlspecialchars($kar['tanggal_lahir']); ?>" required></td></tr>
    <tr><td>Tanggal Masuk</td><td><input type="date" name="tanggal_masuk" value="<?php echo htmlspecialchars($kar['tanggal_masuk']); ?>" required></td></tr>
    <tr><td>Departemen</td><td>
        <select name="id_departemen" required>
            <option value="">-- Pilih --</option>
            <?php foreach ($departemen as $d): ?>
            <option value="<?php echo $d['id']; ?>" <?php echo ($kar['id_departemen'] == $d['id']) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($d['nama_departemen']); ?>
            </option>
            <?php endforeach; ?>
        </select>
    </td></tr>
    <tr><td>Jabatan</td><td>
        <select name="id_jabatan" required>
            <option value="">-- Pilih --</option>
            <?php foreach ($jabatan as $j): ?>
            <option value="<?php echo $j['id']; ?>" <?php echo ($kar['id_jabatan'] == $j['id']) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($j['nama_jabatan']); ?>
            </option>
            <?php endforeach; ?>
        </select>
    </td></tr>
    <tr><td>Gaji</td><td><input type="number" step="0.01" name="gaji" value="<?php echo htmlspecialchars($kar['gaji']); ?>" required></td></tr>
    <tr><td></td><td><button type="submit">Update</button> <a href="<?php echo url('karyawan'); ?>">Batal</a></td></tr>
</table>
</form>
<?php $content = ob_get_clean(); include __DIR__ . '/../layouts/main.php'; ?>
