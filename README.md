# FootVibe E-Commerce Application

FootVibe adalah aplikasi web e-commerce modern yang dikembangkan untuk pengalaman jual beli sepatu yang interaktif dan responsif.

## Tech Stack
* **Framework:** Laravel 12
* **Styling:** Tailwind CSS
* **Admin Panel:** Filament PHP
* **Database:** MySQL

## Prerequisites
Sebelum memulai, pastikan kamu telah menginstal:
* PHP >= 8.2
* Composer
* Node.js & NPM
* MySQL Server (XAMPP / Laragon)

## Installation Steps

### 1. Clone & Setup
Buka terminal di direktori proyek dan jalankan perintah berikut:

```bash
# Instal dependensi PHP
composer install

# Instal dependensi Frontend
npm install
```

### 2. Environment Configuration
Salin file .env.example dan sesuaikan dengan konfigurasi lokal kamu:

```bash
cp .env.example .env
```
Buka file .env dan atur koneksi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=foot_vibe
DB_USERNAME=root
DB_PASSWORD=
```

Generate App Key:

```bash
php artisan key:generate
```

### 3. Database Setup
Buat database baru bernama foot_vibe di phpMyAdmin.

Impor file foot_vibe.sql yang tersedia di direktori proyek.

### 4. Storage & Asset Setup
Buat symlink untuk akses gambar dan compile aset frontend:
```bash
# Link storage untuk foto produk/profil
php artisan storage:link

# Compile CSS/JS
npm run dev
```

### 5. Running Application
Jalankan aplikasi di terminal:
```bash
php artisan serve
```
Aplikasi akan berjalan di http://127.0.0.1:8000

Credentials
Berikut adalah akun yang dapat digunakan untuk login admin:
email : admin@footvibe.com
password : admin123

Akses Panel Admin di: http://127.0.0.1:8000/admin

Notes
- Aplikasi ini menggunakan Filament PHP untuk dashboard admin. Pastikan kamu memiliki akses internet saat pertama kali menjalankan agar aset Filament terload dengan benar.
- Jika terjadi error 500 saat pertama kali dijalankan, pastikan folder bootstrap/cache memiliki izin tulis (write permission).
