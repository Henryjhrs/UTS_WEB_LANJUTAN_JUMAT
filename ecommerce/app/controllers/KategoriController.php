<?php
require_once 'Controller.php';
require_once 'app/models/KategoriModel.php';

class KategoriController extends Controller {
    private $model;

    public function __construct() {
        $this->model = new KategoriModel();
    }

    public function index() {
        $this->view('kategori/index', [
            'title'    => 'Manajemen Kategori',
            'kategoris' => $this->model->getWithProdukCount(),
            'flash'    => $this->getFlash(),
        ]);
    }

    public function create() {
        $this->view('kategori/form', [
            'title'   => 'Tambah Kategori',
            'action'  => '?page=kategori&action=store',
            'kategori' => null,
        ]);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama     = trim($_POST['nama'] ?? '');
            $deskripsi = trim($_POST['deskripsi'] ?? '');
            if (empty($nama)) {
                $this->setFlash('error', 'Nama kategori tidak boleh kosong!');
                $this->redirect('?page=kategori&action=create');
                return;
            }
            $this->model->create($nama, $deskripsi);
            $this->setFlash('success', 'Kategori berhasil ditambahkan!');
        }
        $this->redirect('?page=kategori');
    }

    public function edit($id) {
        $this->view('kategori/form', [
            'title'   => 'Edit Kategori',
            'action'  => "?page=kategori&action=update&id={$id}",
            'kategori' => $this->model->getById($id),
        ]);
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama      = trim($_POST['nama'] ?? '');
            $deskripsi = trim($_POST['deskripsi'] ?? '');
            $this->model->update($id, $nama, $deskripsi);
            $this->setFlash('success', 'Kategori berhasil diperbarui!');
        }
        $this->redirect('?page=kategori');
    }

    public function delete($id) {
        $this->model->delete($id);
        $this->setFlash('success', 'Kategori berhasil dihapus!');
        $this->redirect('?page=kategori');
    }
}
