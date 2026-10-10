# Design Guidelines & UI System

**Project:** Medina Clean
**Theme:** Clean, Trustworthy, Modern, Friendly

## 1. Color Palette (Warna Utama)

Berdasarkan logo Medina Clean, berikut adalah panduan warna yang harus digunakan (disesuaikan dengan Tailwind CSS):

*   **Primary Brand Color (Biru Medina):**
    *   Hex: `#4CBBE4` (Biru terang/Cyan)
    *   Tailwind Equiv: `bg-sky-400` atau `bg-[#4CBBE4]`
    *   *Penggunaan:* Tombol utama (Primary Button), header, ikon aktif, ring pada input form saat difokuskan.

*   **Secondary Brand Color (Abu-abu Medina):**
    *   Hex: `#8C8C8C` (Abu-abu medium)
    *   Tailwind Equiv: `text-gray-500` atau `bg-[#8C8C8C]`
    *   *Penggunaan:* Teks *tagline*, tombol sekunder (Cancel/Kembali), ikon pasif.

*   **Background Colors:**
    *   **App Background:** `#F9FAFB` (Tailwind `bg-gray-50`) - Agar card putih lebih menonjol.
    *   **Card/Container:** `#FFFFFF` (Tailwind `bg-white`) - Untuk latar belakang form dan tabel.

*   **Text Colors:**
    *   **Heading/Title:** `#1F2937` (Tailwind `text-gray-800`)
    *   **Body Text:** `#4B5563` (Tailwind `text-gray-600`)

*   **Status Colors (Penting untuk status cucian):**
    *   *Menunggu/Pending:* Kuning/Orange (`bg-orange-100 text-orange-600`)
    *   *Dalam Perjalanan/Proses:* Biru (`bg-blue-100 text-blue-600`)
    *   *Selesai/Sukses:* Hijau (`bg-emerald-100 text-emerald-600`)

## 2. Typography (Tipografi)

Logo menggunakan font sans-serif yang bersih dengan ujung yang membulat.
*   **Primary Font:** `Nunito` atau `Poppins` (Google Fonts).
*   *Alasan:* Memberikan kesan ramah, bersih, dan cocok dengan lengkungan ikon *vacuum/selang* pada logo Medina Clean.
*   *Hierarchy:*
    *   H1 (Judul Halaman): 24px (Mobile), 32px (Desktop), Font Weight: 700 (Bold).
    *   H2 (Sub-judul): 18px (Mobile), 24px (Desktop), Font Weight: 600 (SemiBold).
    *   Body (Teks biasa): 14px - 16px, Font Weight: 400 (Regular).

## 3. UI Components Style

Bentuk komponen harus mengikuti filosofi logo (melengkung/tidak kaku).

*   **Border Radius (Kelengkungan):** 
    *   Gunakan `rounded-xl` atau `rounded-2xl` untuk Card dan Modal form.
    *   Gunakan `rounded-full` atau `rounded-lg` untuk Tombol (Buttons).
    *   *Hindari* sudut tajam (`rounded-none`).

*   **Shadows (Bayangan):**
    *   Gunakan bayangan yang sangat lembut untuk memberikan kesan aplikasi modern dan ringan.
    *   Tailwind: `shadow-sm` untuk elemen kecil, `shadow-md` untuk Card utama.

*   **Buttons (Tombol):**
    *   *Primary Button:* Latar belakang Biru Medina (`bg-[#4CBBE4]`), teks putih (`text-white`), efek *hover* sedikit lebih gelap.
    *   *Secondary Button:* Latar belakang putih/transparan, border Abu-abu, teks Abu-abu.

## 4. Layout Guidelines

*   **Mobile-First (Khusus Dashboard Tim Lapang & Pembeli):**
    *   Navigasi menggunakan *Bottom Navigation Bar* (seperti aplikasi mobile pada umumnya) atau *Hamburger Menu*.
    *   Tampilan harus satu kolom (single column) agar mudah dibaca di layar HP.
    
*   **Desktop-Optimized (Khusus Dashboard Admin):**
    *   Gunakan *Sidebar Menu* di sebelah kiri untuk navigasi (Dashboard, Tim Lapang, Laporan).
    *   Gunakan tabel (Data Table) dengan fitur *horizontal scroll* jika kolom terlalu banyak.

## 5. Assets
*   **Logo:** Gunakan logo versi horizontal (Icon + Teks "Medina Clean") untuk Header/Navbar bagian kiri atas.
*   **Favicon:** Gunakan bagian Ikon (bentuk M/Selang vacuum) saja.