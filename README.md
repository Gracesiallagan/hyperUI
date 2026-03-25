# 🤝 Gandeng Tangan — Laravel

<p align="center"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></p>

Marketplace karya seni anak disabilitas Indonesia. Dibangun dengan Laravel, menghubungkan seniman disabilitas dengan pembeli melalui galeri digital yang inklusif.

## ✨ Fitur Utama
- 🖼️ Galeri karya seni dengan filter kategori & tipe disabilitas
- 🤝 Integrasi WhatsApp untuk pemesanan langsung
- 📊 Dashboard admin untuk manajemen produk & seniman
- 🔍 Scraper otomatis dari Lingkar Sosial
- 👥 Multi-level user (Super Admin, Org Admin)

## 📋 Persyaratan Sistem
- PHP >= 8.2
- Composer
- MySQL / MariaDB (>= 5.7)
- Node.js >= 18
- NPM atau Yarn
- Extension PHP: BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML

## 🚀 Instalasi Cepat (5 Menit)

```bash
# 1. Extract project (jika dari archive)
tar -xzf gandeng-tangan-laravel-complete.tar.gz
cd gandeng-tangan-laravel

# 2. Install dependencies PHP & JavaScript
composer install
npm install

# 3. Setup environment
cp .env.example .env
php artisan key:generate

# 4. Buat database MySQL
#   - Nama database: gandeng_tangan
#   - User: root (default)
#   - Password: (sesuaikan di .env)

# 5. Jalankan migrasi dan seeder
php artisan migrate
php artisan db:seed

# 6. Link storage untuk akses gambar
php artisan storage:link

# 7. Build assets frontend
npm run build

# 8. Jalankan server
php artisan serve