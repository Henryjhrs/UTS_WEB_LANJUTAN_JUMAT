<?php
require_once 'Model.php';

class KategoriModel extends Model {
    protected $table = 'kategori';

    public function create($nama, $deskripsi) {
        $nama = $this->escape($nama);
        $deskripsi = $this->escape($deskripsi);
        return $this->db->query("INSERT INTO kategori (nama, deskripsi) VALUES ('{$nama}', '{$deskripsi}')");
    }

    public function update($id, $nama, $deskripsi) {
        $nama = $this->escape($nama);
        $deskripsi = $this->escape($deskripsi);
        return $this->db->query("UPDATE kategori SET nama='{$nama}', deskripsi='{$deskripsi}' WHERE id={$id}");
    }

    public function getWithProdukCount() {
        $sql = "SELECT k.*, COUNT(p.id) as jumlah_produk 
                FROM kategori k LEFT JOIN produk p ON k.id = p.kategori_id 
                GROUP BY k.id ORDER BY k.id DESC";
        $result = $this->db->query($sql);
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }
}
