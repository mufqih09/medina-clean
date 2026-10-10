# Product Requirements Document (PRD)

## 1. Project Overview
- **Project Name:** Medina Clean
- **Platform:** Web App
- **Elevator Pitch:** Platform jasa cuci karpet berbasis web untuk menawarkan berbagai harga jasa dan fasilitas dari jasa, serta bisa untuk memesan jasa cuci karpet.
- **Current Status:** Ideation

## 2. Target Audience & User Personas
1. **[Role 1 - Tim Lapang]:** Membutuhkan antarmuka sederhana untuk input data harian dari ponsel.
2. **[Role 2 - Admin/Manajer]:** Membutuhkan dashboard desktop untuk melihat analitik, KPI, dan mengekspor laporan.
3. **[Role 3 - Pembeli Jasa]:** Membutuhkan antarmuka sederhana untuk pesan, dan lihat progress dan hasil.

## 3. Core Objectives & Success Metrics
- **Business Goal:** Mengurangi pekerjaan manual untuk informasi pemesanan jasa cuci.
- **Tracking & Analytics:** Integrasikan Google Analytics untuk melacak user retention, Meta Pixel pada halaman landing page untuk tracking konversi, Google Maps untuk melacak keberadaan tim lapang apakah sudah sampai lokasi untuk melakukan cuci karpet.

## 4. User Flows (Alur Pengguna)

**Flow 1: [Input Data Harian - Tim Lapang]**
1. User login dengan email dan password.
2. Sistem mengarahkan User ke halaman 'Dashboard Tim Lapang'.
3. User menekan tombol 'Tambah Laporan'.
4. Muncul form modal dengan field: Tanggal, Lokasi, Panjang Karpet (meter), Lebar Karpet (meter), Status cuci karpet (dalam perjalanan, sedang mencuci, selesai mencuci).
5. User menekan 'Simpan'.
6. Sistem menampilkan notifikasi sukses (toast) dan memperbarui tabel data.

**Flow 2: [Dashboard Admin/Manajer]**
1. User login dengan email dan password.
2. Sistem mengarahkan User ke halaman 'Dashboard Admin/Manajer'.
3. User menekan tombol 'Tim Lapang'.
4. Muncul form modal dengan field: Nama, Alamat, Email, No Telp, upload foto KTP.
5. User menekan 'Simpan'.
6. Sistem menampilkan notifikasi sukses (toast) dan memperbarui tabel data.
7. User menekan tombol 'Lihat Laporan'.
8. Muncul Dashboard informasi data: Nama Tim Lapang, Tanggal, Lokasi, Panjang Karpet (meter), Lebar Karpet (meter), Status cuci karpet (dalam perjalanan, sedang mencuci, selesai mencuci), Sudah berapa lokasi yang dikerjakan.
9. User bisa search dan filter data.
10. User menekan 'download.xls'.
11. Sistem mendownload data yang dipilih dan difilter.

**Flow 3: [Dashboard Akun Pembeli]**
1. User login dengan email dan password.
2. Sistem mengarahkan User ke halaman 'Dashboard Akun Pembeli'.
3. User menekan tombol 'Beli Jasa'.
4. Muncul form modal dengan field: Nama, No Telp, Email, Tanggal Cuci Karpet, Lokasi Cuci Karpet, Panjang Karpet (meter), Lebar Karpet (meter).
5. User menekan 'Beli'.
6. Sistem menampilkan nominal yang harus dibayar dan pilihan metode pembayaran.
7. User menekan "Bayar".
8. Sistem menampilkan notifikasi informasi nomor rekening dan jumlah yang harus dibayar dan memperbarui tabel data.
9. Jika sudah dibayar, user menekan "Sudah bayar".
10. Sistem menampilkan notifikasi pembayaran berhasil dan memperbarui tabel data.

## 5. MVP Features (Minimum Viable Product)

**P0 (Must Have - Fase 1):**
- Autentikasi (Login/Logout) dengan pemisahan Role (Admin, Tim Lapang, Pembeli).
- Operasi CRUD (Create, Read, Update, Delete) untuk data laporan dan pemesanan.
- Dashboard analitik sederhana (grafik bar).

**P1 (Nice to Have - Fase Selanjutnya):**
- Notifikasi email otomatis.
- Fitur ekspor data ke Excel (sudah masuk di Flow 2, bisa mulai disiapkan di MVP jika memungkinkan).
- Dark mode.

## 6. Technical Constraints & Out of Scope
- **Out of Scope:** Aplikasi ini belum membutuhkan fitur live chat atau integrasi WhatsApp (ditangani oleh divisi/sistem terpisah).
- **Constraint:** Aplikasi harus responsif dan ringan karena mungkin diakses di area dengan koneksi internet lambat (terutama untuk Tim Lapang).
- **Language/Localization:** Gunakan Bahasa Indonesia untuk seluruh antarmuka (UI).