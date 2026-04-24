<?php
// =============================================
// BASE MODEL
// =============================================
class Model {
    protected $db;
    protected $table;

    public function __construct() {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->db->connect_error) {
            die("Koneksi database gagal: " . $this->db->connect_error);
        }
        $this->db->set_charset("utf8");
    }

    public function getAll($orderBy = 'id DESC') {
        $result = $this->db->query("SELECT * FROM {$this->table} ORDER BY {$orderBy}");
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    public function count() {
        $result = $this->db->query("SELECT COUNT(*) as total FROM {$this->table}");
        return $result->fetch_assoc()['total'];
    }

    protected function escape($value) {
        return $this->db->real_escape_string($value);
    }
}
