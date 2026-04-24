<?php
require_once 'Controller.php';
require_once 'app/models/TransaksiModel.php';
require_once 'app/models/ProdukModel.php';

class TransaksiController extends Controller {
    private $model;

    public function __construct() {
        $this->model = new TransaksiModel();
    }

    public function index() {
        $this->view('transaksi/index', [
            'title'      => 'Manajemen Transaksi',
            'transaksis' => $this->model->getAll(),
            'flash'      => $this->getFlash(),
        ]);
    }

    public function detail($id) {
        $this->view('transaksi/detail', [
            'title'     => 'Detail Transaksi',
            'transaksi' => $this->model->getById($id),
            'details'   => $this->model->getDetailByTransaksiId($id),
        ]);
    }

    public function create() {
        $produkModel = new ProdukModel();
        $this->view('transaksi/form', [
            'title'   => 'Buat Transaksi Baru',
            'action'  => '?page=transaksi&action=store',
            'produks' => $produkModel->getAllWithRelations(),
        ]);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama_pembeli = trim($_POST['nama_pembeli'] ?? '');
            $tanggal      = $_POST['tanggal'] ?? date('Y-m-d');
            $status       = $_POST['status'] ?? 'pending';
            $produk_ids   = $_POST['produk_id'] ?? [];
            $jumlah_arr   = $_POST['jumlah'] ?? [];

            if (empty($nama_pembeli) || empty($produk_ids)) {
                $this->setFlash('error', 'Nama pembeli dan produk harus diisi!');
                $this->redirect('?page=transaksi&action=create');
                return;
            }

            $transaksi_id = $this->model->create($nama_pembeli, $tanggal, $status);
            $produkModel  = new ProdukModel();

            foreach ($produk_ids as $i => $produk_id) {
                if (empty($produk_id)) continue;
                $produk  = $produkModel->getById($produk_id);
                $jumlah  = max(1, (int)($jumlah_arr[$i] ?? 1));
                $this->model->addDetail($transaksi_id, $produk_id, $jumlah, $produk['harga']);
            }

            $this->setFlash('success', 'Transaksi berhasil dibuat!');
        }
        $this->redirect('?page=transaksi');
    }

    public function updateStatus($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->updateStatus($id, $_POST['status']);
            $this->setFlash('success', 'Status transaksi berhasil diperbarui!');
        }
        $this->redirect('?page=transaksi');
    }

    public function delete($id) {
        $this->model->delete($id);
        $this->setFlash('success', 'Transaksi berhasil dihapus!');
        $this->redirect('?page=transaksi');
    }
}
