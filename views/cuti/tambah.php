<?php ob_start(); ?>
<h2>Tambah Pengajuan Cuti</h2>
<form method="post" action="<?php echo url('cuti/tambah'); ?>">
<table class="form-table">
    <tr><td>Karyawan</td><td>
        <select name="id_karyawan" required>
            <option value="">-- Pilih Karyawan --</option>
            <?php foreach ($listKaryawan as $k): ?>
            <option value="<?php echo $k['id']; ?>" <?php echo (isset($_POST['id_karyawan']) && $_POST['id_karyawan'] == $k['id']) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($k['nik'] . ' - ' . $k['nama'] . ' (' . $k['nama_departemen'] . ')'); ?>
            </option>
            <?php endforeach; ?>
        </select>
    </td></tr>
    <tr><td>Jenis Cuti</td><td>
        <select name="jenis_cuti" required>
            <option value="">-- Pilih --</option>
            <?php foreach ($jenisCuti as $jc): ?>
            <option value="<?php echo $jc; ?>" <?php echo (isset($_POST['jenis_cuti']) && $_POST['jenis_cuti'] == $jc) ? 'selected' : ''; ?>>
                <?php echo $jc; ?>
            </option>
            <?php endforeach; ?>
        </select>
    </td></tr>
    <tr><td>Tanggal Mulai</td><td><input type="date" name="tanggal_mulai" value="<?php echo isset($_POST['tanggal_mulai']) ? htmlspecialchars($_POST['tanggal_mulai']) : ''; ?>" required></td></tr>
    <tr><td>Tanggal Selesai</td><td><input type="date" name="tanggal_selesai" value="<?php echo isset($_POST['tanggal_selesai']) ? htmlspecialchars($_POST['tanggal_selesai']) : ''; ?>" required></td></tr>
    <tr><td>Keterangan</td><td><textarea name="keterangan"><?php echo isset($_POST['keterangan']) ? htmlspecialchars($_POST['keterangan']) : ''; ?></textarea></td></tr>
    <tr><td></td><td><button type="submit">Simpan</button> <a href="<?php echo url('cuti'); ?>">Batal</a></td></tr>
</table>
</form>
<?php $content = ob_get_clean(); include __DIR__ . '/../layouts/main.php'; ?>
