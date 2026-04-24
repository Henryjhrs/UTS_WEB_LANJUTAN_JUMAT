<?php
require_once 'Controller.php';
require_once 'app/models/KategoriModel.php';
require_once 'app/models/ProdukModel.php';
require_once 'app/models/SupplierModel.php';
require_once 'app/models/TransaksiModel.php';

class DashboardController extends Controller {
    public function index() {
        $kategori   = new KategoriModel();
        $produk     = new ProdukModel();
        $supplier   = new SupplierModel();
        $transaksi  = new TransaksiModel();

        $data = [
            'title'             => 'Dashboard',
            'total_kategori'    => $kategori->count(),
            'total_produk'      => $produk->count(),
            'total_supplier'    => $supplier->count(),
            'summary_transaksi' => $transaksi->getSummary(),
            'transaksi_terbaru' => array_slice($transaksi->getAll(), 0, 5),
            'flash'             => $this->getFlash(),
        ];

        $this->view('dashboard', $data);
    }
}
