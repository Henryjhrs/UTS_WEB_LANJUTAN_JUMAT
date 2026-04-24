<div class="page-header">
    <h2>Detail Transaksi</h2>
    <a href="?page=transaksi" class="btn btn-ghost">← Kembali</a>
</div>

<?php if ($transaksi): ?>
<?php $badge = ['pending'=>'amber','selesai'=>'green','dibatalkan'=>'red'][$transaksi['status']] ?? 'blue'; ?>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:20px">
    <div class="card">
        <div class="card-header"><span class="card-title">Informasi Transaksi</span></div>
        <div class="card-body" style="display:flex;flex-direction:column;gap:14px">
            <div>
                <div class="text-muted" style="font-size:11px;text-transform:uppercase;letter-spacing:.8px">Kode Transaksi</div>
                <div class="text-mono" style="font-size:18px;color:var(--accent);margin-top:2px"><?= htmlspecialchars($transaksi['kode_transaksi']) ?></div>
            </div>
            <div>
                <div class="text-muted" style="font-size:11px;text-transform:uppercase;letter-spacing:.8px">Nama Pembeli</div>
                <div style="font-weight:600;margin-top:2px"><?= htmlspecialchars($transaksi['nama_pembeli']) ?></div>
            </div>
            <div>
                <div class="text-muted" style="font-size:11px;text-transform:uppercase;letter-spacing:.8px">Tanggal</div>
                <div style="margin-top:2px"><?= date('d MMMM Y', strtotime($transaksi['tanggal'])) ?></div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header"><span class="card-title">Status & Total</span></div>
        <div class="card-body" style="display:flex;flex-direction:column;gap:14px">
            <div>
                <div class="text-muted" style="font-size:11px;text-transform:uppercase;letter-spacing:.8px">Status</div>
                <div style="margin-top:6px"><span class="badge badge-<?= $badge ?>" style="font-size:13px;padding:5px 14px"><?= $transaksi['status'] ?></span></div>
            </div>
            <div>
                <div class="text-muted" style="font-size:11px;text-transform:uppercase;letter-spacing:.8px">Total Pembayaran</div>
                <div class="text-mono" style="font-size:22px;color:var(--accent2);font-weight:700;margin-top:2px">
                    Rp <?= number_format($transaksi['total'], 0, ',', '.') ?>
                </div>
            </div>
            <!-- Update Status -->
            <form method="POST" action="?page=transaksi&action=updateStatus&id=<?= $transaksi['id'] ?>" style="display:flex;gap:8px;align-items:center">
                <select name="status" class="form-control" style="flex:1">
                    <option value="pending" <?= $transaksi['status']=='pending' ? 'selected' : '' ?>>⏳ Pending</option>
                    <option value="selesai" <?= $transaksi['status']=='selesai' ? 'selected' : '' ?>>✓ Selesai</option>
                    <option value="dibatalkan" <?= $transaksi['status']=='dibatalkan' ? 'selected' : '' ?>>✕ Dibatalkan</option>
                </select>
                <button type="submit" class="btn btn-success btn-sm">Update</button>
            </form>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header"><span class="card-title">Detail Produk</span></div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Produk</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($details)): ?>
                <tr><td colspan="5"><div class="empty-state">Tidak ada detail produk.</div></td></tr>
                <?php else: ?>
                <?php foreach ($details as $i => $d): ?>
                <tr>
                    <td class="text-muted text-mono"><?= $i + 1 ?></td>
                    <td style="font-weight:500"><?= htmlspecialchars($d['nama_produk']) ?></td>
                    <td class="text-mono">Rp <?= number_format($d['harga'], 0, ',', '.') ?></td>
                    <td><span class="badge badge-blue"><?= $d['jumlah'] ?>x</span></td>
                    <td class="text-mono" style="color:var(--accent2);font-weight:600">Rp <?= number_format($d['subtotal'], 0, ',', '.') ?></td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4" style="text-align:right;font-weight:700;color:var(--muted)">TOTAL</td>
                    <td class="text-mono" style="color:var(--accent2);font-weight:700;font-size:15px">
                        Rp <?= number_format($transaksi['total'], 0, ',', '.') ?>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php else: ?>
<div class="card"><div class="card-body"><p>Transaksi tidak ditemukan.</p></div></div>
<?php endif; ?>
