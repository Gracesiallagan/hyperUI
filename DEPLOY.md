# 🚀 Panduan Deploy GandengTangan

## Langkah-langkah Deploy ke Hosting (Shared Hosting / VPS)

### 1. Upload File
Upload seluruh folder project ke server. Untuk shared hosting, pastikan folder `public/` diarahkan sebagai **document root**.

### 2. Buat file `.env`
Copy `.env.example` menjadi `.env`, lalu sesuaikan:
```
APP_KEY=           ← generate dengan: php artisan key:generate
APP_URL=https://yourdomain.com
DB_DATABASE=nama_database
DB_USERNAME=user_db
DB_PASSWORD=password_db
```

### 3. Install Composer Dependencies
```bash
composer install --optimize-autoloader --no-dev
```

### 4. Generate App Key
```bash
php artisan key:generate
```

### 5. Jalankan Migration + Seeder
```bash
php artisan migrate --force
php artisan db:seed --force
```

### 6. Buat Storage Link
```bash
php artisan storage:link
```

### 7. Cache Config (Opsional tapi disarankan)
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## Akun Login Default (dari Seeder)

| Role | Email | Password |
|------|-------|----------|
| Super Admin | admin@gandengtangan.id | password |
| Admin Org | pembina@gandengtangan.id | password |

> ⚠️ **Ganti password setelah pertama login!**

---

## Bug yang Sudah Diperbaiki

| # | File | Bug | Fix |
|---|------|-----|-----|
| 1 | `app/Models/Product.php` | `$fillable` pakai `'category'` (string) | Diganti `'category_id'` |
| 2 | `app/Models/User.php` | `role` & `organization_id` tidak ada di `$fillable` | Ditambahkan |
| 3 | `app/Models/Organization.php` | `$fillable` tidak cocok dengan migration | Disesuaikan (`description`, `logo`) |
| 4 | `app/Http/Controllers/Admin/ProductController.php` | Validasi pakai `category` string | Diganti `category_id` |
| 5 | `app/Http/Controllers/PublicController.php` | Filter gallery pakai `->where('category', ...)` | Diganti pakai `whereHas('category', ...)` |
| 6 | `bootstrap/app.php` | `CheckRole` middleware tidak didaftarkan | Ditambahkan alias `'role'` |
| 7 | `resources/views/admin/products/create.blade.php` | Form pakai `name="category"` | Diganti `name="category_id"` |
| 8 | `resources/views/admin/products/edit.blade.php` | Form pakai `name="category"` | Diganti `name="category_id"` |
| 9 | `resources/views/public/gallery.blade.php` | Filter kategori pakai nama string | Diganti pakai slug dari relasi |
