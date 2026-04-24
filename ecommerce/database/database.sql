-- =============================================
-- DATABASE SCHEMA: ecommerce_db
-- =============================================

CREATE DATABASE IF NOT EXISTS ecommerce_db CHARACTER SET utf8 COLLATE utf8_general_ci;
USE ecommerce_db;

-- Tabel Kategori
CREATE TABLE IF NOT EXISTS kategori (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    deskripsi TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel Supplier
CREATE TABLE IF NOT EXISTS supplier (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(150) NOT NULL,
    email VARCHAR(100),
    telepon VARCHAR(20),
    alamat TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel Produk
CREATE TABLE IF NOT EXISTS produk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(150) NOT NULL,
    kategori_id INT,
    supplier_id INT,
    harga DECIMAL(15,2) NOT NULL DEFAULT 0,
    stok INT NOT NULL DEFAULT 0,
    deskripsi TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (kategori_id) REFERENCES kategori(id) ON DELETE SET NULL,
    FOREIGN KEY (supplier_id) REFERENCES supplier(id) ON DELETE SET NULL
);

-- Tabel Transaksi
CREATE TABLE IF NOT EXISTS transaksi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode_transaksi VARCHAR(50) UNIQUE NOT NULL,
    nama_pembeli VARCHAR(150) NOT NULL,
    total DECIMAL(15,2) NOT NULL DEFAULT 0,
    status ENUM('pending','selesai','dibatalkan') DEFAULT 'pending',
    tanggal DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel Detail Transaksi
CREATE TABLE IF NOT EXISTS detail_transaksi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    transaksi_id INT NOT NULL,
    produk_id INT NOT NULL,
    jumlah INT NOT NULL DEFAULT 1,
    harga DECIMAL(15,2) NOT NULL,
    subtotal DECIMAL(15,2) NOT NULL,
    FOREIGN KEY (transaksi_id) REFERENCES transaksi(id) ON DELETE CASCADE,
    FOREIGN KEY (produk_id) REFERENCES produk(id) ON DELETE RESTRICT
);

-- =============================================
-- SAMPLE DATA
-- =============================================

INSERT INTO kategori (nama, deskripsi) VALUES
('Elektronik', 'Produk-produk elektronik dan gadget'),
('Fashion', 'Pakaian dan aksesori fashion'),
('Makanan & Minuman', 'Produk makanan dan minuman'),
('Olahraga', 'Peralatan dan aksesori olahraga'),
('Buku', 'Buku, majalah, dan media cetak');

INSERT INTO supplier (nama, email, telepon, alamat) VALUES
('PT Maju Jaya', 'info@majujaya.com', '021-5550001', 'Jl. Industri No.10, Jakarta'),
('CV Berkah Abadi', 'berkah@abadi.co.id', '022-5550002', 'Jl. Raya Bandung No.5, Bandung'),
('UD Sumber Rezeki', 'sumber@rezeki.id', '031-5550003', 'Jl. Pahlawan No.22, Surabaya'),
('PT Karya Mandiri', 'info@karyamandiri.com', '024-5550004', 'Jl. Pemuda No.7, Semarang');

INSERT INTO produk (nama, kategori_id, supplier_id, harga, stok, deskripsi) VALUES
('Smartphone Android 128GB', 1, 1, 2500000, 50, 'Smartphone dengan RAM 6GB, kamera 48MP'),
('Laptop Gaming 15"', 1, 1, 12000000, 20, 'Laptop gaming dengan RTX 3060'),
('Kaos Polos Premium', 2, 2, 150000, 200, 'Kaos bahan cotton combed 30s'),
('Celana Jeans Slim Fit', 2, 2, 350000, 100, 'Celana jeans elastis nyaman dipakai'),
('Kopi Arabika 250gr', 3, 3, 85000, 300, 'Kopi arabika pilihan dari Aceh'),
('Teh Hijau Organik', 3, 3, 45000, 250, 'Teh hijau organik bebas pestisida'),
('Sepatu Running Pro', 4, 4, 750000, 80, 'Sepatu lari dengan sol cushion'),
('Dumbbell Set 20kg', 4, 4, 450000, 40, 'Set barbel untuk latihan di rumah'),
('Buku Python Programming', 5, 2, 120000, 150, 'Panduan lengkap belajar Python'),
('Novel Bestseller 2024', 5, 2, 95000, 200, 'Novel terlaris tahun ini');

INSERT INTO transaksi (kode_transaksi, nama_pembeli, total, status, tanggal) VALUES
('TRX-2024-001', 'Ahmad Fauzi', 2650000, 'selesai', '2024-01-15'),
('TRX-2024-002', 'Siti Rahayu', 500000, 'selesai', '2024-01-16'),
('TRX-2024-003', 'Budi Santoso', 12000000, 'pending', '2024-01-17'),
('TRX-2024-004', 'Dewi Lestari', 215000, 'selesai', '2024-01-18'),
('TRX-2024-005', 'Reza Pratama', 750000, 'dibatalkan', '2024-01-19');

INSERT INTO detail_transaksi (transaksi_id, produk_id, jumlah, harga, subtotal) VALUES
(1, 1, 1, 2500000, 2500000),
(1, 6, 2, 75000, 150000),
(2, 3, 2, 150000, 300000),
(2, 9, 1, 120000, 120000),
(3, 2, 1, 12000000, 12000000),
(4, 5, 1, 85000, 85000),
(4, 6, 1, 45000, 45000),
(4, 9, 1, 85000, 85000),
(5, 7, 1, 750000, 750000);
