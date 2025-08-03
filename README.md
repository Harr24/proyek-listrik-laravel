Aplikasi Manajemen Listrik Pascabayar
Aplikasi web ini adalah sistem manajemen lengkap untuk layanan listrik pascabayar, dibangun menggunakan framework Laravel. Aplikasi ini dirancang untuk melayani dua peran utama: Admin sebagai pengelola sistem dan Pelanggan sebagai pengguna layanan.

Sistem ini mencakup seluruh alur kerja bisnis, mulai dari pendaftaran pelanggan oleh admin, input penggunaan meteran bulanan, pembuatan tagihan otomatis, hingga proses pembayaran online dengan konfirmasi bukti transfer.

✨ Fitur Utama
Aplikasi ini dibagi menjadi tiga area utama dengan fungsionalitas yang kaya.

1. Fitur Publik (Untuk Pengunjung)
   Homepage Profesional: Halaman depan yang modern dengan statistik pengguna dan bagian berita dinamis.

Daftar Harga Dinamis: Halaman yang menampilkan daftar harga tarif listrik (daya VA) yang datanya diambil langsung dari database dan dapat dikelola oleh admin.

Halaman Login: Halaman login yang bersih dan fungsional. Pendaftaran mandiri dinonaktifkan; pendaftaran pelanggan baru dilakukan oleh admin.

2. Fitur Pelanggan (Setelah Login)
   Dashboard Pelanggan: Halaman utama yang menampilkan ringkasan, riwayat tagihan, dan grafik visualisasi penggunaan listrik 12 bulan terakhir.

Riwayat Tagihan: Tabel yang rapi untuk melihat semua riwayat tagihan beserta statusnya (Belum Lunas, Menunggu Konfirmasi, Lunas).

Pembayaran Online: Pelanggan dapat membayar tagihan dengan melakukan transfer bank dan mengunggah bukti pembayaran langsung melalui aplikasi.

Cetak Struk: Pelanggan dapat melihat dan mencetak struk resmi untuk setiap pembayaran yang sudah lunas.

Pusat Bantuan (Sistem Tiket): Pelanggan dapat membuat tiket keluhan, mengirim pesan, dan melampirkan gambar untuk berkomunikasi dengan admin.

3. Fitur Admin (Setelah Login)
   Dashboard Admin Informatif: Menampilkan kartu rekapitulasi data penting secara real-time (Jumlah Pelanggan, Tagihan Belum Lunas, Pendapatan Bulan Ini).

Manajemen Data Master (CRUD):

Kelola Tarif: Menambah, mengubah, dan menghapus data tarif listrik (daya VA).

Kelola Pelanggan: Mendaftarkan pelanggan baru sekaligus membuatkan akun login untuk mereka. Semua data pelanggan dapat diubah dan dihapus.

Kelola Berita: Admin dapat membuat, mengedit, dan menghapus berita (lengkap dengan gambar) yang akan tampil di homepage.

Manajemen Penggunaan:

Daftar Tugas Cerdas: Halaman yang secara otomatis menampilkan daftar pelanggan yang belum diinput data penggunaannya untuk bulan berjalan, mempermudah pekerjaan admin.

Filter Canggih: Memfilter data penggunaan berdasarkan nama pelanggan, periode (bulan & tahun), dan status tagihan.

Manajemen Tagihan & Pembayaran:

Generate Tagihan Otomatis: Menghasilkan tagihan secara otomatis berdasarkan data penggunaan dengan satu klik.

Filter Lengkap: Memfilter data tagihan berdasarkan nama, periode, status, dan jenis daya (VA).

Konfirmasi Pembayaran: Halaman khusus untuk melihat pembayaran yang menunggu konfirmasi, melihat bukti transfer, dan menyetujui (melunaskan) atau menolak pembayaran.

Verifikasi Manual: Admin juga bisa memverifikasi pembayaran secara manual (untuk pembayaran tunai).

Manajemen Keluhan: Panel untuk melihat semua tiket keluhan dari pelanggan, membalas pesan, melampirkan gambar, dan mengubah status keluhan (Ditangani, Selesai).

Laporan Profesional:

Halaman laporan dengan filter berdasarkan periode (bulan & tahun) dan jenis daya.

Menampilkan rekapitulasi total pendapatan dan jumlah pelanggan.

Fitur Export ke Excel untuk mengunduh data laporan.

🚀 Teknologi yang Digunakan
Backend: PHP 8.1+, Laravel 10

Frontend: HTML5, CSS3, JavaScript, Bootstrap 5

Database: MySQL (via XAMPP)

Development Tools: Composer, Node.js (NPM), Git

🛠️ Langkah-langkah Instalasi
Berikut adalah cara untuk menjalankan proyek ini di lingkungan lokal Anda.

Prasyarat
XAMPP (dengan PHP 8.1 atau lebih baru)

Composer

Node.js dan NPM

Git

Instalasi
Clone repository ini:

git clone https://github.com/Harr24/proyek-listrik-laravel.git
cd proyek-listrik-laravel

Install dependensi PHP:

composer install

Install dependensi JavaScript:

npm install

Konfigurasi Lingkungan:

Salin file .env.example menjadi .env.

cp .env.example .env

Buat application key baru:

php artisan key:generate

Konfigurasi Database:

Buka file .env Anda.

Buat sebuah database baru di phpMyAdmin (misalnya db_listrik_laravel).

Sesuaikan konfigurasi database di file .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_listrik_laravel
DB_USERNAME=root
DB_PASSWORD=

Migrasi Database & Storage Link:

Jalankan migrasi untuk membuat semua tabel di database:

php artisan migrate

Buat symbolic link untuk storage agar file yang diunggah (bukti bayar, gambar berita) bisa diakses:

php artisan storage:link

Menjalankan Aplikasi:

Jalankan server pengembangan Laravel:

php artisan serve

Buka browser Anda dan kunjungi http://127.0.0.1:8000.

🔑 Akun Demo
Anda bisa menggunakan akun berikut untuk mencoba aplikasi:

Admin:

Email: admin@listrik.com

Password: password123

Pelanggan:

Anda bisa membuat akun pelanggan baru melalui panel admin di menu "Kelola Pelanggan" -> "+ Tambah Pelanggan Baru".

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   [Powerful dependency injection container](https://laravel.com/docs/container).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).
-   [Robust background job processing](https://laravel.com/docs/queues).
-   [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

-   **[Vehikl](https://vehikl.com/)**
-   **[Tighten Co.](https://tighten.co)**
-   **[WebReinvent](https://webreinvent.com/)**
-   **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
-   **[64 Robots](https://64robots.com)**
-   **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
-   **[Cyber-Duck](https://cyber-duck.co.uk)**
-   **[DevSquad](https://devsquad.com/hire-laravel-developers)**
-   **[Jump24](https://jump24.co.uk)**
-   **[Redberry](https://redberry.international/laravel/)**
-   **[Active Logic](https://activelogic.com)**
-   **[byte5](https://byte5.de)**
-   **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
