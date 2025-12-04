## Sistem Informasi Pengaduan Layanan Masyarakat – NOISE
Sistem Informasi Pengaduan ini dirancang untuk mempermudah masyarakat dalam menyampaikan keluhan/aspirasi serta mempercepat tindak lanjut oleh admin. Aplikasi menyediakan fitur login, pengaduan, riwayat, chat real-time, serta dashboard monitoring.

## Fitur User

- Login & Logout
- Membuat Pengaduan Baru
- Mengedit Pengaduan (sebelum diproses admin)
- Melihat Status Pengaduan (Pending, Diproses, Selesai)
- Melihat Riwayat Pengaduan
- Chat dengan Admin untuk tindak lanjut pengaduan

## Fitur Admin

- Login & Logout
- Mengelola Pengaduan
- Membaca Detail Pengaduan
- Chat dengan User untuk klarifikasi atau tindak lanjut
- Dashboard Admin
- Cetak Laporan Pengaduan (PDF/Print)

## Teknologi yang digunakan

- Laravel 12
- PHP 8+
- MySQL
- Blade Template

## Instalasi & Setup
1. Pull repository
   - git clone (link repository)
   - git pull
2. Install Dependencies
   - composer install
3. Copy Environment File
   - cp .env.example .env
4. Generate App Key
   - php artisan key:generate
5. Konfigurasi Database di file .env
   - DB_DATABASE=(nama database)
   - DB_USERNAME=root
   - DB_PASSWORD=
6. Migrasi Database
   - php artisan migrate
7. Jalankan Server
   - php artisan serve
