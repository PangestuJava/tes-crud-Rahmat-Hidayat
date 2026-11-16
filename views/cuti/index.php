<?php ob_start(); ?>
<h2>Daftar Transaksi Cuti</h2>
<form method="get" action="<?php echo url('cuti'); ?>">
    <label>Dari: <input type="date" name="from" value="<?php echo htmlspecialchars($from); ?>"></label>
    <label>Sampai: <input type="date" name="to" value="<?php echo htmlspecialchars($to); ?>"></label>
    <button type="submit">Filter</button>
    <a href="<?php echo url('cuti'); ?>">Reset</a>
</form>
<br>
<a href="<?php echo url('cuti/tambah'); ?>">+ Tambah Pengajuan Cuti</a>
<br><br>
<div class="table-wrap">
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Jenis</th>
                <th>Mulai</th>
                <th>Selesai</th>
                <th>Hari</th>
                <th>Status</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($transaksi)): ?>
                <tr>
                    <td colspan="10">Tidak ada data.</td>
                </tr>
                <?php else: $no = 1;
                foreach ($transaksi as $t):
                    $hari = (strtotime($t['tanggal_selesai']) - strtotime($t['tanggal_mulai'])) / 86400 + 1;
                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo htmlspecialchars($t['nik']); ?></td>
                        <td><?php echo htmlspecialchars($t['nama']); ?></td>
                        <td><?php echo htmlspecialchars($t['jenis_cuti']); ?></td>
                        <td><?php echo date('d-M-Y', strtotime($t['tanggal_mulai'])); ?></td>
                        <td><?php echo date('d-M-Y', strtotime($t['tanggal_selesai'])); ?></td>
                        <td><?php echo (int)$hari; ?></td>
                        <td><span class="badge badge-<?php echo strtolower($t['status']); ?>"><?php echo htmlspecialchars($t['status']); ?></span></td>
                        <td><?php echo htmlspecialchars($t['keterangan']); ?></td>
                        <td>
                            <?php if ($t['status'] === 'Pending'): ?>
                                <form method="post" action="<?php echo url('cuti/status'); ?>" style="display:inline">
                                    <input type="hidden" name="id" value="<?php echo (int)$t['id']; ?>">
                                    <button type="submit" name="status" value="Disetujui" class="btn-sm btn-approve">Setujui</button>
                                    <button type="submit" name="status" value="Ditolak" class="btn-sm btn-reject">Tolak</button>
                                </form>
                                <?php else: ?>-<?php endif; ?>
                        </td>
                    </tr>
            <?php endforeach;
            endif; ?>
        </tbody>
    </table>
</div>
<br>
<div class="summary">
    <strong>Rekap:</strong>
    Jumlah transaksi: <strong><?php echo (int)$summary['jumlah']; ?></strong> |
    Total hari cuti: <strong><?php echo (int)$summary['total_hari']; ?></strong>
</div>
<?php $content = ob_get_clean();
include __DIR__ . '/../layouts/main.php'; ?>