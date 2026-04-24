<?php
require_once 'Model.php';

class ProdukModel extends Model {
    protected $table = 'produk';

    public function getAllWithRelations() {
        $sql = "SELECT p.*, k.nama AS nama_kategori, s.nama AS nama_supplier
                FROM produk p
                LEFT JOIN kategori k ON p.kategori_id = k.id
                LEFT JOIN supplier s ON p.supplier_id = s.id
                ORDER BY p.id DESC";
        $result = $this->db->query($sql);
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function getByIdWithRelations($id) {
        $sql = "SELECT p.*, k.nama AS nama_kategori, s.nama AS nama_supplier
                FROM produk p
                LEFT JOIN kategori k ON p.kategori_id = k.id
                LEFT JOIN supplier s ON p.supplier_id = s.id
                WHERE p.id = {$id}";
        $result = $this->db->query($sql);
        return $result ? $result->fetch_assoc() : null;
    }

    public function create($data) {
        $nama        = $this->escape($data['nama']);
        $kategori_id = (int)$data['kategori_id'];
        $supplier_id = (int)$data['supplier_id'];
        $harga       = (float)$data['harga'];
        $stok        = (int)$data['stok'];
        $deskripsi   = $this->escape($data['deskripsi']);
        return $this->db->query("INSERT INTO produk (nama, kategori_id, supplier_id, harga, stok, deskripsi)
                                 VALUES ('{$nama}', {$kategori_id}, {$supplier_id}, {$harga}, {$stok}, '{$deskripsi}')");
    }

    public function update($id, $data) {
        $nama        = $this->escape($data['nama']);
        $kategori_id = (int)$data['kategori_id'];
        $supplier_id = (int)$data['supplier_id'];
        $harga       = (float)$data['harga'];
        $stok        = (int)$data['stok'];
        $deskripsi   = $this->escape($data['deskripsi']);
        return $this->db->query("UPDATE produk SET nama='{$nama}', kategori_id={$kategori_id}, supplier_id={$supplier_id},
                                 harga={$harga}, stok={$stok}, deskripsi='{$deskripsi}' WHERE id={$id}");
    }
}
