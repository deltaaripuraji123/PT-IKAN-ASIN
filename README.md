# 🐟 E-Commerce Ikan Asin – Laravel 10

![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

Aplikasi e-commerce modern untuk penjualan ikan asin secara online dengan fitur lengkap untuk customer dan admin. Dibangun menggunakan Laravel 10 dengan antarmuka yang user-friendly dan sistem manajemen yang powerful.

---

## 📚 Deskripsi Singkat

Website ini dirancang untuk mempermudah proses jual beli ikan asin secara digital. Customer dapat menjelajahi katalog produk, menambahkan ke keranjang, dan melakukan pemesanan dengan mudah. Admin memiliki kontrol penuh untuk mengelola produk, kategori, stok, harga, serta memproses pesanan dari tahap order hingga pengiriman.

---

## 🚀 Teknologi Utama

- **Backend**: Laravel 10
- **PHP**: Version 8.1 atau lebih tinggi
- **Database**: MySQL / MariaDB
- **Frontend**: Blade Templates / Livewire
- **CSS Framework**: Tailwind CSS atau Bootstrap
- **Package Manager**: Composer & NPM/Yarn

---

## 🧩 Fitur Lengkap

### 👤 Fitur Customer

- ✅ Registrasi & Login dengan validasi keamanan
- ✅ Browse katalog ikan asin dengan filter & search
- ✅ Detail produk lengkap dengan gambar dan deskripsi
- ✅ Keranjang belanja (tambah, edit, hapus item)
- ✅ Proses checkout yang mudah
- ✅ Tracking status pesanan real-time
- ✅ Riwayat order & invoice
- ✅ Manajemen profil akun

### 🔐 Fitur Admin

- ✅ Dashboard admin dengan statistik penjualan
- ✅ CRUD Produk (Create, Read, Update, Delete)
- ✅ CRUD Kategori produk
- ✅ Upload & manajemen gambar produk
- ✅ Manajemen stok & harga
- ✅ Kelola pesanan (lihat, update status)
- ✅ Update status pengiriman
- ✅ Laporan penjualan & analytics dasar
- ✅ Manajemen user & pelanggan

---

## 🗄️ Struktur Database

Database terdiri dari tabel-tabel utama berikut:

### Tabel Utama

| Tabel | Deskripsi |
|-------|-----------|
| `users` | Data pengguna (customer & admin) |
| `products` | Informasi produk ikan asin |
| `categories` | Kategori produk |
| `carts` | Keranjang belanja customer |
| `orders` | Data pesanan |
| `order_items` | Detail item dalam pesanan |

### Relasi Database

- `products` → `categories` (Many to One)
- `users` → `orders` (One to Many)
- `orders` → `order_items` (One to Many)
- `products` → `order_items` (One to Many)
- `users` → `carts` (One to Many)

---

## 🛠️ Cara Instalasi Lengkap

### Prasyarat

Pastikan sudah terinstall:
- PHP >= 8.1
- Composer
- MySQL/MariaDB
- Node.js & NPM (untuk asset compilation)
- Git

### Langkah Instalasi Step by Step
