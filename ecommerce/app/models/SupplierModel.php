<?php
require_once 'Model.php';

class SupplierModel extends Model {
    protected $table = 'supplier';

    public function create($nama, $email, $telepon, $alamat) {
        $nama    = $this->escape($nama);
        $email   = $this->escape($email);
        $telepon = $this->escape($telepon);
        $alamat  = $this->escape($alamat);
        return $this->db->query("INSERT INTO supplier (nama, email, telepon, alamat) VALUES ('{$nama}', '{$email}', '{$telepon}', '{$alamat}')");
    }

    public function update($id, $nama, $email, $telepon, $alamat) {
        $nama    = $this->escape($nama);
        $email   = $this->escape($email);
        $telepon = $this->escape($telepon);
        $alamat  = $this->escape($alamat);
        return $this->db->query("UPDATE supplier SET nama='{$nama}', email='{$email}', telepon='{$telepon}', alamat='{$alamat}' WHERE id={$id}");
    }
}
