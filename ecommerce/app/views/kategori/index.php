<div class="page-header">
    <h2>🏷 Kategori</h2>
    <a href="?page=kategori&action=create" class="btn btn-primary">+ Tambah Kategori</a>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th>Jumlah Produk</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($kategoris)): ?>
                <tr><td colspan="6">
                    <div class="empty-state">
                        <div class="big-icon">🏷</div>
                        <p>Belum ada kategori. <a href="?page=kategori&action=create" style="color:var(--accent)">Tambah sekarang</a></p>
                    </div>
                </td></tr>
                <?php else: ?>
                <?php foreach ($kategoris as $i => $k): ?>
                <tr>
                    <td class="text-muted text-mono"><?= $i + 1 ?></td>
                    <td style="font-weight:600"><?= htmlspecialchars($k['nama']) ?></td>
                    <td class="text-muted"><?= htmlspecialchars($k['deskripsi'] ?? '-') ?></td>
                    <td><span class="badge badge-blue"><?= $k['jumlah_produk'] ?> produk</span></td>
                    <td class="text-muted"><?= date('d M Y', strtotime($k['created_at'])) ?></td>
                    <td>
                        <div class="actions">
                            <a href="?page=kategori&action=edit&id=<?= $k['id'] ?>" class="btn btn-ghost btn-sm">✏ Edit</a>
                            <a href="?page=kategori&action=delete&id=<?= $k['id'] ?>" class="btn btn-danger btn-sm"
                               onclick="return confirm('Hapus kategori ini?')">🗑 Hapus</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
