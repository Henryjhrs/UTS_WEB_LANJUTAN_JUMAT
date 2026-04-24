<?php
require_once 'Model.php';

class TransaksiModel extends Model {
    protected $table = 'transaksi';

    public function getAll($orderBy = 'id DESC') {
        $result = $this->db->query("SELECT * FROM transaksi ORDER BY {$orderBy}");
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function getDetailByTransaksiId($transaksi_id) {
        $sql = "SELECT dt.*, p.nama AS nama_produk
                FROM detail_transaksi dt
                JOIN produk p ON dt.produk_id = p.id
                WHERE dt.transaksi_id = {$transaksi_id}";
        $result = $this->db->query($sql);
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function create($nama_pembeli, $tanggal, $status) {
        $kode = 'TRX-' . date('Y') . '-' . str_pad($this->count() + 1, 3, '0', STR_PAD_LEFT);
        $nama_pembeli = $this->escape($nama_pembeli);
        $tanggal = $this->escape($tanggal);
        $status = $this->escape($status);
        $this->db->query("INSERT INTO transaksi (kode_transaksi, nama_pembeli, total, status, tanggal)
                          VALUES ('{$kode}', '{$nama_pembeli}', 0, '{$status}', '{$tanggal}')");
        return $this->db->insert_id;
    }

    public function addDetail($transaksi_id, $produk_id, $jumlah, $harga) {
        $subtotal = $jumlah * $harga;
        $this->db->query("INSERT INTO detail_transaksi (transaksi_id, produk_id, jumlah, harga, subtotal)
                          VALUES ({$transaksi_id}, {$produk_id}, {$jumlah}, {$harga}, {$subtotal})");
        $this->updateTotal($transaksi_id);
    }

    public function updateTotal($transaksi_id) {
        $this->db->query("UPDATE transaksi SET total = 
                         (SELECT SUM(subtotal) FROM detail_transaksi WHERE transaksi_id = {$transaksi_id})
                         WHERE id = {$transaksi_id}");
    }

    public function updateStatus($id, $status) {
        $status = $this->escape($status);
        return $this->db->query("UPDATE transaksi SET status='{$status}' WHERE id={$id}");
    }

    public function getSummary() {
        $result = $this->db->query("SELECT 
            COUNT(*) as total_transaksi,
            SUM(CASE WHEN status='selesai' THEN total ELSE 0 END) as total_pendapatan,
            SUM(CASE WHEN status='pending' THEN 1 ELSE 0 END) as pending,
            SUM(CASE WHEN status='selesai' THEN 1 ELSE 0 END) as selesai,
            SUM(CASE WHEN status='dibatalkan' THEN 1 ELSE 0 END) as dibatalkan
            FROM transaksi");
        return $result->fetch_assoc();
    }
}
