<div class="page-header">
    <h2>🧾 Buat Transaksi Baru</h2>
    <a href="?page=transaksi" class="btn btn-ghost">← Kembali</a>
</div>

<div class="card" style="max-width:780px">
    <div class="card-header">
        <span class="card-title">Form Transaksi</span>
    </div>
    <div class="card-body">
        <form method="POST" action="<?= $action ?>">
            <div class="form-grid">
                <div class="form-row">
                    <div class="form-group">
                        <label>Nama Pembeli *</label>
                        <input type="text" name="nama_pembeli" class="form-control"
                               placeholder="Nama lengkap pembeli" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal *</label>
                        <input type="date" name="tanggal" class="form-control"
                               value="<?= date('Y-m-d') ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="pending">⏳ Pending</option>
                        <option value="selesai">✓ Selesai</option>
                        <option value="dibatalkan">✕ Dibatalkan</option>
                    </select>
                </div>

                <!-- Produk items -->
                <div>
                    <label style="display:block;font-size:12px;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.8px;margin-bottom:10px">
                        Daftar Produk *
                    </label>
                    <div id="produk-list" style="display:flex;flex-direction:column;gap:10px">
                        <div class="produk-item" style="display:grid;grid-template-columns:1fr auto;gap:10px;align-items:center">
                            <select name="produk_id[]" class="form-control" required>
                                <option value="">-- Pilih Produk --</option>
                                <?php foreach ($produks as $p): ?>
                                <option value="<?= $p['id'] ?>" data-harga="<?= $p['harga'] ?>">
                                    <?= htmlspecialchars($p['nama']) ?> — Rp <?= number_format($p['harga'], 0, ',', '.') ?>
                                    (Stok: <?= $p['stok'] ?>)
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <input type="number" name="jumlah[]" class="form-control" value="1" min="1"
                                   style="width:80px" placeholder="Qty">
                        </div>
                    </div>
                    <button type="button" onclick="tambahBaris()" class="btn btn-ghost btn-sm" style="margin-top:10px">
                        + Tambah Produk
                    </button>
                </div>

                <div style="display:flex;gap:10px">
                    <button type="submit" class="btn btn-primary">💾 Buat Transaksi</button>
                    <a href="?page=transaksi" class="btn btn-ghost">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
const produkOptions = `<?php foreach ($produks as $p): ?>
    <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nama']) ?> — Rp <?= number_format($p['harga'], 0, ',', '.') ?> (Stok: <?= $p['stok'] ?>)</option>
<?php endforeach; ?>`;

function tambahBaris() {
    const list = document.getElementById('produk-list');
    const div = document.createElement('div');
    div.className = 'produk-item';
    div.style.cssText = 'display:grid;grid-template-columns:1fr auto auto;gap:10px;align-items:center';
    div.innerHTML = `
        <select name="produk_id[]" class="form-control">
            <option value="">-- Pilih Produk --</option>
            ${produkOptions}
        </select>
        <input type="number" name="jumlah[]" class="form-control" value="1" min="1" style="width:80px">
        <button type="button" onclick="this.parentElement.remove()" class="btn btn-danger btn-sm">✕</button>
    `;
    list.appendChild(div);
}
</script>
