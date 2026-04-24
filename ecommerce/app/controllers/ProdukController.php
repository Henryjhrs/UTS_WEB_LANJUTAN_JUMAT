<?php
require_once 'Controller.php';
require_once 'app/models/ProdukModel.php';
require_once 'app/models/KategoriModel.php';
require_once 'app/models/SupplierModel.php';

class ProdukController extends Controller {
    private $model;

    public function __construct() {
        $this->model = new ProdukModel();
    }

    public function index() {
        $this->view('produk/index', [
            'title'   => 'Manajemen Produk',
            'produks' => $this->model->getAllWithRelations(),
            'flash'   => $this->getFlash(),
        ]);
    }

    public function create() {
        $kategoriModel = new KategoriModel();
        $supplierModel = new SupplierModel();
        $this->view('produk/form', [
            'title'      => 'Tambah Produk',
            'action'     => '?page=produk&action=store',
            'produk'     => null,
            'kategoris'  => $kategoriModel->getAll('nama ASC'),
            'suppliers'  => $supplierModel->getAll('nama ASC'),
        ]);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->create($_POST);
            $this->setFlash('success', 'Produk berhasil ditambahkan!');
        }
        $this->redirect('?page=produk');
    }

    public function edit($id) {
        $kategoriModel = new KategoriModel();
        $supplierModel = new SupplierModel();
        $this->view('produk/form', [
            'title'     => 'Edit Produk',
            'action'    => "?page=produk&action=update&id={$id}",
            'produk'    => $this->model->getByIdWithRelations($id),
            'kategoris' => $kategoriModel->getAll('nama ASC'),
            'suppliers' => $supplierModel->getAll('nama ASC'),
        ]);
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, $_POST);
            $this->setFlash('success', 'Produk berhasil diperbarui!');
        }
        $this->redirect('?page=produk');
    }

    public function delete($id) {
        $this->model->delete($id);
        $this->setFlash('success', 'Produk berhasil dihapus!');
        $this->redirect('?page=produk');
    }
}
