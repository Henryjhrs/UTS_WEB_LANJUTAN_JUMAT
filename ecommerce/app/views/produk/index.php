<div class="page-header">
    <h2>📦 Produk</h2>
    <a href="?page=produk&action=create" class="btn btn-primary">+ Tambah Produk</a>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Supplier</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($produks)): ?>
                <tr><td colspan="7">
                    <div class="empty-state">
                        <div class="big-icon">📦</div>
                        <p>Belum ada produk. <a href="?page=produk&action=create" style="color:var(--accent)">Tambah sekarang</a></p>
                    </div>
                </td></tr>
                <?php else: ?>
                <?php foreach ($produks as $i => $p): ?>
                <tr>
                    <td class="text-muted text-mono"><?= $i + 1 ?></td>
                    <td>
                        <div style="font-weight:600"><?= htmlspecialchars($p['nama']) ?></div>
                        <?php if (!empty($p['deskripsi'])): ?>
                        <div class="text-muted" style="font-size:12px;margin-top:2px">
                            <?= htmlspecialchars(substr($p['deskripsi'], 0, 50)) ?>...
                        </div>
                        <?php endif; ?>
                    </td>
                    <td><span class="badge badge-blue"><?= htmlspecialchars($p['nama_kategori'] ?? '-') ?></span></td>
                    <td class="text-muted"><?= htmlspecialchars($p['nama_supplier'] ?? '-') ?></td>
                    <td class="text-mono" style="color:var(--accent2)">Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>
                    <td>
                        <?php $stokClass = $p['stok'] < 10 ? 'badge-red' : ($p['stok'] < 50 ? 'badge-amber' : 'badge-green'); ?>
                        <span class="badge <?= $stokClass ?>"><?= $p['stok'] ?></span>
                    </td>
                    <td>
                        <div class="actions">
                            <a href="?page=produk&action=edit&id=<?= $p['id'] ?>" class="btn btn-ghost btn-sm">✏ Edit</a>
                            <a href="?page=produk&action=delete&id=<?= $p['id'] ?>" class="btn btn-danger btn-sm"
                               onclick="return confirm('Hapus produk ini?')">🗑</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
