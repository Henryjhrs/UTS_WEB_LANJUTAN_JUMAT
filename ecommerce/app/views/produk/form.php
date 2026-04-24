<div class="page-header">
    <h2><?= htmlspecialchars($title) ?></h2>
    <a href="?page=produk" class="btn btn-ghost">← Kembali</a>
</div>

<div class="card" style="max-width:680px">
    <div class="card-header">
        <span class="card-title"><?= $produk ? 'Edit Data Produk' : 'Form Produk Baru' ?></span>
    </div>
    <div class="card-body">
        <form method="POST" action="<?= $action ?>">
            <div class="form-grid">
                <div class="form-group">
                    <label>Nama Produk *</label>
                    <input type="text" name="nama" class="form-control"
                           value="<?= htmlspecialchars($produk['nama'] ?? '') ?>"
                           placeholder="cth: Smartphone Android 128GB" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori_id" class="form-control">
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($kategoris as $k): ?>
                            <option value="<?= $k['id'] ?>"
                                <?= ($produk['kategori_id'] ?? '') == $k['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($k['nama']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Supplier</label>
                        <select name="supplier_id" class="form-control">
                            <option value="">-- Pilih Supplier --</option>
                            <?php foreach ($suppliers as $s): ?>
                            <option value="<?= $s['id'] ?>"
                                <?= ($produk['supplier_id'] ?? '') == $s['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($s['nama']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Harga (Rp) *</label>
                        <input type="number" name="harga" class="form-control"
                               value="<?= $produk['harga'] ?? '' ?>"
                               placeholder="0" min="0" required>
                    </div>
                    <div class="form-group">
                        <label>Stok *</label>
                        <input type="number" name="stok" class="form-control"
                               value="<?= $produk['stok'] ?? '' ?>"
                               placeholder="0" min="0" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control"
                              placeholder="Deskripsi produk..."><?= htmlspecialchars($produk['deskripsi'] ?? '') ?></textarea>
                </div>
                <div style="display:flex;gap:10px">
                    <button type="submit" class="btn btn-primary">💾 Simpan</button>
                    <a href="?page=produk" class="btn btn-ghost">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
