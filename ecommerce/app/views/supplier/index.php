<div class="page-header">
    <h2>🏭 Supplier</h2>
    <a href="?page=supplier&action=create" class="btn btn-primary">+ Tambah Supplier</a>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Supplier</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($suppliers)): ?>
                <tr><td colspan="6">
                    <div class="empty-state">
                        <div class="big-icon">🏭</div>
                        <p>Belum ada supplier. <a href="?page=supplier&action=create" style="color:var(--accent)">Tambah sekarang</a></p>
                    </div>
                </td></tr>
                <?php else: ?>
                <?php foreach ($suppliers as $i => $s): ?>
                <tr>
                    <td class="text-muted text-mono"><?= $i + 1 ?></td>
                    <td style="font-weight:600"><?= htmlspecialchars($s['nama']) ?></td>
                    <td class="text-muted"><?= htmlspecialchars($s['email'] ?? '-') ?></td>
                    <td class="text-mono"><?= htmlspecialchars($s['telepon'] ?? '-') ?></td>
                    <td class="text-muted" style="max-width:200px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                        <?= htmlspecialchars($s['alamat'] ?? '-') ?>
                    </td>
                    <td>
                        <div class="actions">
                            <a href="?page=supplier&action=edit&id=<?= $s['id'] ?>" class="btn btn-ghost btn-sm">✏ Edit</a>
                            <a href="?page=supplier&action=delete&id=<?= $s['id'] ?>" class="btn btn-danger btn-sm"
                               onclick="return confirm('Hapus supplier ini?')">🗑 Hapus</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
