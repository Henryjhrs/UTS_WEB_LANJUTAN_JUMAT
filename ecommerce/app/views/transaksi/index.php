<div class="page-header">
    <h2>🧾 Transaksi</h2>
    <a href="?page=transaksi&action=create" class="btn btn-primary">+ Buat Transaksi</a>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kode</th>
                    <th>Nama Pembeli</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($transaksis)): ?>
                <tr><td colspan="7">
                    <div class="empty-state">
                        <div class="big-icon">🧾</div>
                        <p>Belum ada transaksi.</p>
                    </div>
                </td></tr>
                <?php else: ?>
                <?php foreach ($transaksis as $i => $t): ?>
                <?php $badge = ['pending'=>'amber','selesai'=>'green','dibatalkan'=>'red'][$t['status']] ?? 'blue'; ?>
                <tr>
                    <td class="text-muted text-mono"><?= $i + 1 ?></td>
                    <td class="text-mono" style="color:var(--accent)"><?= htmlspecialchars($t['kode_transaksi']) ?></td>
                    <td style="font-weight:500"><?= htmlspecialchars($t['nama_pembeli']) ?></td>
                    <td class="text-mono" style="color:var(--accent2)">Rp <?= number_format($t['total'], 0, ',', '.') ?></td>
                    <td><span class="badge badge-<?= $badge ?>"><?= $t['status'] ?></span></td>
                    <td class="text-muted"><?= date('d M Y', strtotime($t['tanggal'])) ?></td>
                    <td>
                        <div class="actions">
                            <a href="?page=transaksi&action=detail&id=<?= $t['id'] ?>" class="btn btn-ghost btn-sm">👁 Detail</a>
                            <a href="?page=transaksi&action=delete&id=<?= $t['id'] ?>" class="btn btn-danger btn-sm"
                               onclick="return confirm('Hapus transaksi ini?')">🗑</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
