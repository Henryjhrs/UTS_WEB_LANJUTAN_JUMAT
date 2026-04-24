<?php
// =============================================
// ENTRY POINT - Router Utama
// =============================================
session_start();
require_once 'config/database.php';

// Auto-load controllers & models
spl_autoload_register(function ($class) {
    $paths = ['app/controllers/', 'app/models/'];
    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Routing sederhana berdasarkan query parameter
$page = $_GET['page'] ?? 'dashboard';
$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

// Map halaman ke controller
$routes = [
    'dashboard'  => 'DashboardController',
    'kategori'   => 'KategoriController',
    'produk'     => 'ProdukController',
    'supplier'   => 'SupplierController',
    'transaksi'  => 'TransaksiController',
];

if (array_key_exists($page, $routes)) {
    $controllerClass = $routes[$page];
    $controller = new $controllerClass();

    if (method_exists($controller, $action)) {
        $controller->$action($id);
    } else {
        $controller->index();
    }
} else {
    http_response_code(404);
    echo "<h1>404 - Halaman tidak ditemukan</h1>";
}
