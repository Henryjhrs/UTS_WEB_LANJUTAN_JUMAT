<?php
require_once 'Controller.php';
require_once 'app/models/SupplierModel.php';

class SupplierController extends Controller {
    private $model;

    public function __construct() {
        $this->model = new SupplierModel();
    }

    public function index() {
        $this->view('supplier/index', [
            'title'     => 'Manajemen Supplier',
            'suppliers' => $this->model->getAll(),
            'flash'     => $this->getFlash(),
        ]);
    }

    public function create() {
        $this->view('supplier/form', [
            'title'    => 'Tambah Supplier',
            'action'   => '?page=supplier&action=store',
            'supplier' => null,
        ]);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->create(
                trim($_POST['nama'] ?? ''),
                trim($_POST['email'] ?? ''),
                trim($_POST['telepon'] ?? ''),
                trim($_POST['alamat'] ?? '')
            );
            $this->setFlash('success', 'Supplier berhasil ditambahkan!');
        }
        $this->redirect('?page=supplier');
    }

    public function edit($id) {
        $this->view('supplier/form', [
            'title'    => 'Edit Supplier',
            'action'   => "?page=supplier&action=update&id={$id}",
            'supplier' => $this->model->getById($id),
        ]);
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id,
                trim($_POST['nama'] ?? ''),
                trim($_POST['email'] ?? ''),
                trim($_POST['telepon'] ?? ''),
                trim($_POST['alamat'] ?? '')
            );
            $this->setFlash('success', 'Supplier berhasil diperbarui!');
        }
        $this->redirect('?page=supplier');
    }

    public function delete($id) {
        $this->model->delete($id);
        $this->setFlash('success', 'Supplier berhasil dihapus!');
        $this->redirect('?page=supplier');
    }
}
