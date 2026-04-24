# 🛍 MandalaShop — Aplikasi E-Commerce MVC (PHP)

Aplikasi manajemen e-commerce sederhana berbasis paradigma **Model-View-Controller (MVC)** menggunakan PHP murni tanpa framework.

---

## 📁 Struktur Direktori (MVC)

```
ecommerce/
├── index.php                   ← Entry point & Router
├── database.sql                ← Skema & data sample MySQL
├── config/
│   └── database.php            ← Konfigurasi koneksi DB
└── app/
    ├── controllers/            ← CONTROLLER layer
    │   ├── Controller.php      ← Base controller
    │   ├── DashboardController.php
    │   ├── KategoriController.php
    │   ├── ProdukController.php
    │   ├── SupplierController.php
    │   └── TransaksiController.php
    ├── models/                 ← MODEL layer
    │   ├── Model.php           ← Base model (CRUD generik)
    │   ├── KategoriModel.php
    │   ├── ProdukModel.php
    │   ├── SupplierModel.php
    │   └── TransaksiModel.php
    └── views/                  ← VIEW layer
        ├── layouts/
        │   └── main.php        ← Layout utama (sidebar + topbar)
        ├── dashboard.php
        ├── kategori/
        │   ├── index.php
        │   └── form.php
        ├── produk/
        │   ├── index.php
        │   └── form.php
        ├── supplier/
        │   ├── index.php
        │   └── form.php
        └── transaksi/
            ├── index.php
            ├── form.php
            └── detail.php
```

---

## ⚙️ Cara Instalasi

### 1. Siapkan Database MySQL

```sql
-- Jalankan file database.sql di phpMyAdmin atau MySQL CLI:
mysql -u root -p < database.sql
```

### 2. Konfigurasi Koneksi

Edit file `config/database.php`:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');      // sesuaikan
define('DB_PASS', '');          // sesuaikan
define('DB_NAME', 'ecommerce_db');
```

### 3. Jalankan dengan PHP Built-in Server

```bash
cd ecommerce
php -S localhost:8000
```

Buka browser: **http://localhost:8000**

### Atau gunakan XAMPP/Laragon
Letakkan folder `ecommerce/` di dalam `htdocs/`, lalu akses:
**http://localhost/ecommerce/**

---

## 🎯 Fitur Aplikasi

| Halaman      | Fitur                                                    |
|--------------|----------------------------------------------------------|
| Dashboard    | Statistik ringkas, transaksi terbaru                    |
| Kategori     | CRUD kategori, tampil jumlah produk per kategori        |
| Produk       | CRUD produk, relasi ke kategori & supplier, indikator stok |
| Supplier     | CRUD supplier dengan info kontak lengkap                |
| Transaksi    | Buat transaksi multi-item, detail, update status        |

---

## 🏗️ Konsep MVC yang Diterapkan

- **Model** → Mengelola akses database (query SQL, CRUD)
- **View** → Menampilkan UI ke user (HTML/PHP template)
- **Controller** → Jembatan antara Model & View, menangani logika request
- **Router** → `index.php` sebagai front controller yang mendistribusikan request

---

## 🛠️ Teknologi

- PHP 8.x (tanpa framework)
- MySQL / MariaDB
- HTML5 + CSS3 (dark theme modern)
- Google Fonts (Sora + JetBrains Mono)
