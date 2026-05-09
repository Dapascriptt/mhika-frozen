# Mhika Frozen Food

Website katalog dan CMS sederhana untuk **Mhika Frozen Food Balikpapan**. Aplikasi ini dibuat dengan Laravel 10, Bootstrap dari template Foody2, dan frontend yang dioptimasi untuk katalog frozen food dengan banyak gambar produk.

## Fitur Utama

- Frontend publik: Home, Products, Product Detail, Contact.
- Katalog produk dengan kategori, pencarian live, pagination, dan URL slug.
- CMS admin custom melalui `/login`.
- Dashboard admin berisi ringkasan produk dan kategori.
- CRUD produk dengan upload gambar.
- CRUD kategori produk.
- SEO dasar: meta title, description, keywords, canonical, Open Graph, Twitter Card, JSON-LD, sitemap XML, dan robots.txt.
- Optimasi gambar produk dengan folder thumbnail dan lazy loading.

## Teknologi

- PHP 8.1+
- Laravel 10
- MySQL
- Bootstrap 5 dari template Foody2
- Blade

## Route Penting

Frontend:

```text
/                       Home
/products               Katalog produk
/products/{slug}        Detail produk
/category/{slug}        Produk berdasarkan kategori
/contact                Kontak dan lokasi
/sitemap.xml            Sitemap SEO
```

Admin:

```text
/login                  Login admin
/admin/dashboard        Dashboard admin
/admin/products         CRUD produk
/admin/categories       CRUD kategori
```

## Instalasi

1. Install dependency PHP:

```bash
composer install
```

2. Salin file environment:

```bash
copy .env.example .env
```

3. Generate app key:

```bash
php artisan key:generate
```

4. Atur koneksi database di `.env`, contoh:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

5. Jalankan migration dan seeder:

```bash
php artisan migrate --seed
```

6. Jalankan server lokal:

```bash
php artisan serve
```

Akses website di:

```text
http://127.0.0.1:8000
```

## Akun Admin Default

Seeder membuat akun admin default:

```text
Email: admin@mhika.test
Password: password
```

Login melalui:

```text
http://127.0.0.1:8000/login
```

## Pengelolaan Produk

Masuk ke admin, lalu buka:

```text
/admin/products
```

Field produk:

- Nama produk
- Kategori
- Harga
- Deskripsi
- Gambar
- Status aktif
- Produk unggulan

Slug produk dibuat otomatis dari nama produk. Produk aktif akan tampil di katalog publik. Produk unggulan akan tampil di section Produk Unggulan pada homepage.

## Pengelolaan Kategori

Masuk ke admin, lalu buka:

```text
/admin/categories
```

Kategori awal dari seeder:

- Sosis
- Nugget
- Kentang
- Ayam Siap Makan
- Bakso
- Aneka Frozen
- Perdagingan
- Beef Burger
- Sayur dan Buah

Slug kategori dibuat otomatis dari nama kategori.

## Upload Gambar Produk

Upload gambar dilakukan dari form tambah/edit produk di admin.

Struktur folder gambar:

```text
public/images/products/originals/
public/images/products/thumbs/
```

Card produk publik membaca gambar dari folder thumbnail. Jika gambar tidak ditemukan, sistem memakai fallback:

```text
public/assets/img/product-1.jpg
```

Format yang diterima:

```text
jpg, jpeg, png, webp
```

Ukuran maksimal upload:

```text
2 MB
```

## SEO

SEO yang sudah diterapkan:

- Meta title unik untuk Home, Products, Product Detail, Contact.
- Meta description dan keywords lokal Balikpapan.
- Canonical URL.
- Open Graph dan Twitter Card.
- JSON-LD `Store`.
- Sitemap XML di `/sitemap.xml`.
- Robots.txt mengizinkan indexing.
- URL slug untuk produk dan kategori.
- Alt image produk berisi nama produk dan lokasi Balikpapan.

Target keyword:

```text
frozen food balikpapan
frozen food murah balikpapan
jual frozen food balikpapan
supplier frozen food balikpapan
mhika frozen food
frozen food terdekat balikpapan
```

## Optimasi Performa

- Produk memakai pagination, tidak menampilkan semua item sekaligus.
- Product card memakai `loading="lazy"`.
- Gambar card memakai thumbnail.
- Gambar memiliki atribut `width` dan `height`.
- Admin tidak memakai template berat.
- Plugin berat template yang tidak dipakai tidak diload di halaman publik.

## Asset Template

Asset Foody2 berada di:

```text
public/assets/
```

Struktur utama:

```text
public/assets/css/
public/assets/js/
public/assets/img/
public/assets/lib/
public/assets/scss/
```

Icon kategori homepage berada di:

```text
public/assets/img/
```

Contoh:

```text
sosis.png
nuggets.png
kentang.png
ayam.png
bakso.png
frozen-food.png
meat.png
burger.png
sayurbuah.png
```

## Catatan Development

- Jangan hapus file di `public/assets/` karena dipakai frontend.
- Jangan ubah pagination menjadi render semua produk jika katalog sudah 100+ item.
- Untuk mengganti lokasi maps, edit iframe di:

```text
resources/views/pages/contact.blade.php
```

- Untuk mengubah warna dan tampilan frontend, edit:

```text
public/assets/css/style.css
```

## Lisensi Template

Frontend menggunakan template Foody2 dari HTML Codex/ThemeWagon. Perhatikan ketentuan lisensi template jika website dipublikasikan.
