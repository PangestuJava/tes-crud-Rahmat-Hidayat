<?php ob_start(); ?>
<h2>Tambah Karyawan</h2>
<form method="post" action="<?php echo url('karyawan/tambah'); ?>">
<table class="form-table">
    <tr><td>NIK</td><td><input name="nik" value="<?php echo isset($_POST['nik']) ? htmlspecialchars($_POST['nik']) : ''; ?>" required></td></tr>
    <tr><td>Nama</td><td><input name="nama" value="<?php echo isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : ''; ?>" required></td></tr>
    <tr><td>Email</td><td><input type="email" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required></td></tr>
    <tr><td>No Telp</td><td><input name="no_telp" value="<?php echo isset($_POST['no_telp']) ? htmlspecialchars($_POST['no_telp']) : ''; ?>" required></td></tr>
    <tr><td>Alamat</td><td><textarea name="alamat" required><?php echo isset($_POST['alamat']) ? htmlspecialchars($_POST['alamat']) : ''; ?></textarea></td></tr>
    <tr><td>Tanggal Lahir</td><td><input type="date" name="tanggal_lahir" value="<?php echo isset($_POST['tanggal_lahir']) ? htmlspecialchars($_POST['tanggal_lahir']) : ''; ?>" required></td></tr>
    <tr><td>Tanggal Masuk</td><td><input type="date" name="tanggal_masuk" value="<?php echo isset($_POST['tanggal_masuk']) ? htmlspecialchars($_POST['tanggal_masuk']) : ''; ?>" required></td></tr>
    <tr><td>Departemen</td><td>
        <select name="id_departemen" required>
            <option value="">-- Pilih --</option>
            <?php foreach ($departemen as $d): ?>
            <option value="<?php echo $d['id']; ?>" <?php echo (isset($_POST['id_departemen']) && $_POST['id_departemen'] == $d['id']) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($d['nama_departemen']); ?>
            </option>
            <?php endforeach; ?>
        </select>
    </td></tr>
    <tr><td>Jabatan</td><td>
        <select name="id_jabatan" required>
            <option value="">-- Pilih --</option>
            <?php foreach ($jabatan as $j): ?>
            <option value="<?php echo $j['id']; ?>" <?php echo (isset($_POST['id_jabatan']) && $_POST['id_jabatan'] == $j['id']) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($j['nama_jabatan']); ?>
            </option>
            <?php endforeach; ?>
        </select>
    </td></tr>
    <tr><td>Gaji</td><td><input type="number" step="0.01" name="gaji" value="<?php echo isset($_POST['gaji']) ? htmlspecialchars($_POST['gaji']) : ''; ?>" required></td></tr>
    <tr><td></td><td><button type="submit">Simpan</button> <a href="<?php echo url('karyawan'); ?>">Batal</a></td></tr>
</table>
</form>
<?php $content = ob_get_clean(); include __DIR__ . '/../layouts/main.php'; ?>
