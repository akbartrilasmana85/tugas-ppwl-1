# CampusInfo - Laravel 12 Architecture Explorer

## Setup

```bash
composer create-project laravel/laravel:^12.0 campusinfo
cd campusinfo
# salin folder app/, routes/, resources/, php-native/, README.md dari paket ini, timpa yang ada
composer dump-autoload
php artisan view:clear
php artisan serve
```

Buka `http://127.0.0.1:8000`, `/program-studi`, `/kontak`, `/architecture`.

## Verifikasi route

```bash
php artisan route:list
php artisan route:list --name=architecture
```

Named routes yang dipakai: `beranda`, `program-studi`, `kontak`, `architecture.dashboard`, `architecture.lifecycle`, `architecture.environment` (total 6, minimal 4 tercapai).

## Controller

Ada 4 controller: `HomeController`, `ProgramStudiController`, `ContactController`, `ArchitectureController`. Data dikirim dari controller ke Blade lewat argumen kedua `view()`.

Buat ulang controller dengan artisan (opsional):

```bash
php artisan make:controller HomeController
php artisan make:controller ProgramStudiController
php artisan make:controller ContactController
php artisan make:controller ArchitectureController
```

## Command Composer dan Artisan yang dipakai

| Command | Fungsi |
|---|---|
| `composer create-project laravel/laravel:^12.0 campusinfo` | Membuat project Laravel 12 baru |
| `composer dump-autoload` | Regenerate autoload setelah tambah class |
| `php artisan serve` | Jalankan dev server |
| `php artisan route:list` | Tampilkan semua route beserta nama dan controller |
| `php artisan view:clear` | Hapus cache view Blade |
| `php artisan config:clear` | Hapus cache konfigurasi |

## Fungsi 8 folder/file utama

| Folder | Fungsi |
|---|---|
| `app/` | Controller, model, provider, middleware |
| `bootstrap/` | Membuat instance aplikasi (`app.php`) dan file cache |
| `config/` | Konfigurasi aplikasi, database, session |
| `database/` | Migration, seeder, factory |
| `public/` | Entry point `index.php`, aset publik |
| `resources/` | View Blade, CSS, JS |
| `routes/` | `web.php`, `api.php`, `console.php` |
| `storage/` | Log, cache file, upload |

## Analisis satu request: GET /program-studi

Berikut alur satu request dari browser sampai response, dengan contoh `GET /program-studi`.

1. **Browser.** Pengguna membuka `http://127.0.0.1:8000/program-studi`. Browser mengirim HTTP GET ke server, lengkap dengan header seperti `Host`, `Accept`, dan cookie kalau ada.

2. **Web server.** `php artisan serve` (atau Apache/Nginx saat produksi) menerima request dan meneruskannya ke `public/index.php`. Hanya file di folder `public/` yang bisa diakses langsung dari luar.

3. **public/index.php.** File ini memuat autoloader Composer (`vendor/autoload.php`), lalu mengambil instance aplikasi dari `bootstrap/app.php`.

4. **bootstrap/app.php.** Di sini aplikasi dibuat. Laravel membaca `.env` dan `config/`, lalu mendaftarkan file route (`routes/web.php`), middleware, dan exception handler.

5. **HTTP Kernel dan middleware.** Request dibungkus menjadi objek `Request`. Middleware group `web` berjalan sebelum route dicocokkan, termasuk untuk mengelola cookie dan session. Verifikasi CSRF hanya berlaku untuk method POST/PUT/DELETE, jadi GET ini tidak kena pengecekan itu.

6. **Router.** Laravel mencocokkan URI `/program-studi` dengan `routes/web.php`. Route yang cocok adalah `program-studi`, yang diarahkan ke `ProgramStudiController@index`. Pemetaan ini bisa dicek dengan `php artisan route:list`.

7. **Controller.** Method `index()` di `ProgramStudiController` dijalankan. Laravel membuat instance controller lewat service container. Controller menyiapkan array `$programs` lalu memanggil `view('programs', [...])` dan mengirim data itu ke view.

8. **Blade view.** `resources/views/programs.blade.php` di-compile menjadi PHP dan disimpan di `storage/framework/views/`. View ini memakai `@extends('layouts.app')` untuk mengambil kerangka halaman, lalu mengisi bagian `@section('konten')`. Perulangan `@foreach` membuat baris tabel, dan `{{ }}` otomatis meng-escape output.

9. **Response.** Hasil view dibungkus menjadi objek `Response` dengan status `200` dan `Content-Type: text/html`. Kernel mengirim response itu ke web server, lalu ke browser. Browser merender HTML menjadi tabel program studi.

Dibandingkan PHP native, tidak ada langkah 3 sampai 8 di sana. `php-native/index.php` langsung dieksekusi, membaca `$_GET['page']`, lalu `echo` HTML. Tidak ada middleware, container, atau pemisahan view. Itu sebabnya request di Laravel lebih panjang, tapi tiap bagiannya punya tanggung jawab yang jelas.

Diagram visual HTML/CSS ada di halaman `/architecture/request-lifecycle`.

## Environment yang aman

Halaman `/architecture/environment` menampilkan nama app, environment, status debug, versi Laravel dan PHP, timezone, dan locale. `APP_KEY` dan kredensial database sengaja tidak ditampilkan.

## Analisis: Laravel vs PHP Native

| Aspek | PHP Native (`php-native/index.php`) | Laravel 12 |
|---|---|---|
| Routing | `switch` pada `$_GET['page']` | `routes/web.php`, named routes, `route()` |
| Data | Array hardcode di satu file | Array dari controller, dikirim ke Blade |
| Tampilan | `echo` HTML dicampur logic | View Blade terpisah, layout `@extends`, `@yield` |
| Keamanan output | Harus manual `htmlspecialchars` | `{{ }}` escape otomatis |
| Konfigurasi | Hardcode | `config/` dan `.env` |
| Skalabilitas | Makin banyak halaman makin berantakan | Struktur folder dan konvensi jelas |

## MVC: di mana terlihat dan di mana Laravel melampaui

**Terlihat:**
- **Model**: belum ada, karena data masih array di controller. Ini sengaja, sesuai tugas (database belum wajib).
- **View**: `resources/views/*.blade.php`, terpisah dari logic.
- **Controller**: `app/Http/Controllers/*.php`, menerima request dan memilih view.

**Laravel melampaui MVC:**
- Middleware dan HTTP Kernel: pipeline sebelum controller dijalankan.
- Service Container: dependency injection otomatis.
- Routing dengan named routes dan `route:list`.
- Blade layout, escaping, dan Artisan CLI.

Catatan: pada praktiknya Laravel lebih tepat disebut MVC-plus (ada pipeline middleware dan container di luar pola MVC murni).

## Catatan

Project ini dibuat dengan `composer create-project laravel/laravel:^12.0 campusinfo`, lalu dijalankan dengan `php artisan serve`. Route sudah diverifikasi dengan `php artisan route:list`, dan semua halaman sudah dicek di browser.

Versi PHP native dijalankan terpisah dengan:

```bash
php -S localhost:8001 -t php-native
```

Lalu buka `http://localhost:8001/?page=program-studi`.