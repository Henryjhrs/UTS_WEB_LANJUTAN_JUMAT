<div class="page-header">
    <h2><?= htmlspecialchars($title) ?></h2>
    <a href="?page=kategori" class="btn btn-ghost">← Kembali</a>
</div>

<div class="card" style="max-width:560px">
    <div class="card-header">
        <span class="card-title"><?= $kategori ? 'Edit Data Kategori' : 'Form Kategori Baru' ?></span>
    </div>
    <div class="card-body">
        <form method="POST" action="<?= $action ?>">
            <div class="form-grid">
                <div class="form-group">
                    <label>Nama Kategori *</label>
                    <input type="text" name="nama" class="form-control"
                           value="<?= htmlspecialchars($kategori['nama'] ?? '') ?>"
                           placeholder="cth: Elektronik" required>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control"
                              placeholder="Deskripsi singkat kategori..."><?= htmlspecialchars($kategori['deskripsi'] ?? '') ?></textarea>
                </div>
                <div style="display:flex;gap:10px">
                    <button type="submit" class="btn btn-primary">💾 Simpan</button>
                    <a href="?page=kategori" class="btn btn-ghost">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
