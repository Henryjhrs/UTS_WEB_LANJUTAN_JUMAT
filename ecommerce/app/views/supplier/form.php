<div class="page-header">
    <h2><?= htmlspecialchars($title) ?></h2>
    <a href="?page=supplier" class="btn btn-ghost">← Kembali</a>
</div>

<div class="card" style="max-width:640px">
    <div class="card-header">
        <span class="card-title"><?= $supplier ? 'Edit Data Supplier' : 'Form Supplier Baru' ?></span>
    </div>
    <div class="card-body">
        <form method="POST" action="<?= $action ?>">
            <div class="form-grid">
                <div class="form-group">
                    <label>Nama Supplier *</label>
                    <input type="text" name="nama" class="form-control"
                           value="<?= htmlspecialchars($supplier['nama'] ?? '') ?>"
                           placeholder="cth: PT Maju Jaya" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control"
                               value="<?= htmlspecialchars($supplier['email'] ?? '') ?>"
                               placeholder="info@supplier.com">
                    </div>
                    <div class="form-group">
                        <label>Telepon</label>
                        <input type="text" name="telepon" class="form-control"
                               value="<?= htmlspecialchars($supplier['telepon'] ?? '') ?>"
                               placeholder="021-0000000">
                    </div>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control"
                              placeholder="Alamat lengkap supplier..."><?= htmlspecialchars($supplier['alamat'] ?? '') ?></textarea>
                </div>
                <div style="display:flex;gap:10px">
                    <button type="submit" class="btn btn-primary">💾 Simpan</button>
                    <a href="?page=supplier" class="btn btn-ghost">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
