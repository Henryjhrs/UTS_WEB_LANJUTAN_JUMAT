<div class="stats-grid">
    <div class="stat-card blue">
        <div class="stat-icon">🏷</div>
        <div class="stat-val"><?= $total_kategori ?></div>
        <div class="stat-lbl">Total Kategori</div>
    </div>
    <div class="stat-card green">
        <div class="stat-icon">📦</div>
        <div class="stat-val"><?= $total_produk ?></div>
        <div class="stat-lbl">Total Produk</div>
    </div>
    <div class="stat-card amber">
        <div class="stat-icon">🏭</div>
        <div class="stat-val"><?= $total_supplier ?></div>
        <div class="stat-lbl">Total Supplier</div>
    </div>
    <div class="stat-card green">
        <div class="stat-icon">💰</div>
        <div class="stat-val">Rp <?= number_format($summary_transaksi['total_pendapatan'] ?? 0, 0, ',', '.') ?></div>
        <div class="stat-lbl">Total Pendapatan</div>
    </div>
    <div class="stat-card amber">
        <div class="stat-icon">⏳</div>
        <div class="stat-val"><?= $summary_transaksi['pending'] ?? 0 ?></div>
        <div class="stat-lbl">Transaksi Pending</div>
    </div>
    <div class="stat-card red">
        <div class="stat-icon">✕</div>
        <div class="stat-val"><?= $summary_transaksi['dibatalkan'] ?? 0 ?></div>
        <div class="stat-lbl">Dibatalkan</div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <span class="card-title">🧾 Transaksi Terbaru</span>
        <a href="?page=transaksi" class="btn btn-ghost btn-sm">Lihat Semua</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Pembeli</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($transaksi_terbaru)): ?>
                <tr><td colspan="5"><div class="empty-state">Belum ada transaksi</div></td></tr>
                <?php else: ?>
                <?php foreach ($transaksi_terbaru as $t): ?>
                <tr>
                    <td class="text-mono" style="color:var(--accent)"><?= htmlspecialchars($t['kode_transaksi']) ?></td>
                    <td><?= htmlspecialchars($t['nama_pembeli']) ?></td>
                    <td class="text-mono">Rp <?= number_format($t['total'], 0, ',', '.') ?></td>
                    <td>
                        <?php
                        $badge = ['pending'=>'amber','selesai'=>'green','dibatalkan'=>'red'][$t['status']] ?? 'blue';
                        ?>
                        <span class="badge badge-<?= $badge ?>"><?= $t['status'] ?></span>
                    </td>
                    <td class="text-muted"><?= date('d M Y', strtotime($t['tanggal'])) ?></td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
