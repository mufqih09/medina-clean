# Architecture & Tech Stack Guidelines

**Project:** Medina Clean
**Paradigm:** Monolithic Web Application (Traditional Hosting)

## 1. Tech Stack (Teknologi yang Digunakan)

* **Framework Utama:** Laravel (PHP). Framework backend terpopuler yang sangat mudah dipahami oleh AI.
* **Database:** MySQL / MariaDB (Bawaan dari panel Hostinger).
* **Frontend / Styling:** Laravel Blade Templates + Tailwind CSS (dikompilasi menggunakan Vite).
* **Komponen UI:** Buat manual dengan kelas Tailwind sesuai panduan `Design.md`.
* **Autentikasi:** Laravel Breeze atau fitur Auth bawaan Laravel. Sangat tangguh untuk mengelola sesi login dan registrasi.
* **Storage:** Local Storage di server Hostinger (menggunakan *symlink* dari folder `storage` ke `public` untuk foto KTP).
* **ORM:** Eloquent ORM (Bawaan Laravel untuk komunikasi dengan database MySQL tanpa harus menulis query SQL panjang).

## 2. Folder Structure (Struktur Folder Proyek Laravel)

Aplikasi akan mengikuti standar arsitektur Model-View-Controller (MVC) bawaan Laravel:

```
medina-clean/
├── app/
│   ├── Http/
│   │   ├── Controllers/       # Logika bisnis (misal: OrderController, UserController)
│   │   └── Middleware/        # Cek hak akses (Role: Admin, Worker, Customer)
│   └── Models/                # Representasi tabel database (User, WorkerProfile, Order)
├── bootstrap/                 # File inisiasi framework
├── config/                    # Konfigurasi aplikasi (database, mail, dll)
├── database/
│   ├── migrations/            # Skrip pembuatan tabel MySQL berdasarkan Database_Schema.md
│   └── seeders/               # Data dummy awal (misal: akun Admin pertama)
├── public/                    # Folder yang dapat diakses publik (index.php, css, js, logo)
├── resources/
│   ├── css/                   # File Tailwind CSS utama
│   └── views/                 # File HTML/Tampilan antarmuka (.blade.php)
│       ├── auth/              # Halaman login/register
│       ├── admin/             # Dashboard Admin
│       ├── worker/            # Dashboard Tim Lapang
│       ├── customer/          # Dashboard Pembeli
│       └── layouts/           # Template dasar (header, sidebar, footer)
├── routes/
│   └── web.php                # Pengaturan URL/Routing aplikasi
├── .env                       # File rahasia untuk koneksi database MySQL Hostinger
└── composer.json              # Daftar dependency PHP
```

## 3. Data Fetching & Security Strategy

* **Keamanan Autentikasi:** Gunakan *Middleware* Laravel untuk membatasi akses URL. Contoh: Halaman `/admin/laporan` hanya bisa diakses oleh user yang memiliki `role = 'ADMIN'`.
* **Validasi Form:** Semua input form (terutama pemesanan jasa) wajib divalidasi di sisi *Controller* sebelum dimasukkan ke database MySQL untuk mencegah *SQL Injection*.
* **Manajemen State/Data:** Karena menggunakan arsitektur tradisional (Server-Side Rendering dengan Blade), halaman akan dimuat ulang (*reload*) atau bisa ditambahkan sedikit JavaScript murni/AJAX jika ingin efek dinamis (seperti pop-up notifikasi/Toast).

## 4. Deployment Strategy (Hostinger)

* **Platform:** Hostinger (cPanel atau hPanel).
* **Langkah Upload:** 
  1. *Upload* seluruh file kode (atau via Git) ke File Manager Hostinger.
  2. Buat database MySQL di control panel Hostinger.
  3. Sesuaikan kredensial di file `.env` (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).
  4. Jalankan perintah migrasi database untuk membuat tabel.