# Database Schema & Architecture

**Project:** Medina Clean
**Type:** Relational Database (SQL)

## 1. Enums (Tipe Data Pilihan)
- `RoleEnum`: ADMIN, WORKER, CUSTOMER
- `PaymentStatusEnum`: PENDING, PAID, FAILED
- `JobStatusEnum`: MENUNGGU, DALAM_PERJALANAN, SEDANG_MENCUCI, SELESAI

---

## 2. Tables

### Table: Users
Menyimpan data autentikasi untuk semua jenis pengguna (Admin, Tim Lapang, Pembeli).

| Column Name | Data Type | Constraints | Description |
| :--- | :--- | :--- | :--- |
| `id` | UUID | Primary Key | ID unik pengguna |
| `email` | String | Unique, Not Null | Email untuk login |
| `password` | String | Not Null | Hashed password |
| `name` | String | Not Null | Nama lengkap pengguna |
| `phone` | String | Nullable | Nomor telepon / WhatsApp |
| `role` | RoleEnum | Default: CUSTOMER | Peran pengguna |
| `created_at` | Timestamp| Default: now() | Waktu akun dibuat |

### Table: Worker_Profiles
Menyimpan data spesifik untuk Tim Lapang (diisi oleh Admin).

| Column Name | Data Type | Constraints | Description |
| :--- | :--- | :--- | :--- |
| `id` | UUID | Primary Key | ID profil |
| `user_id` | UUID | Foreign Key (Users.id) | Relasi ke tabel Users |
| `address` | Text | Not Null | Alamat domisili Tim Lapang |
| `ktp_photo_url` | String | Not Null | Link URL/Path foto KTP |

### Table: Orders (Pesanan & Laporan Lapangan)
Tabel utama ini menghubungkan Pembeli (yang memesan) dan Tim Lapang (yang melaporkan status pekerjaan).

| Column Name | Data Type | Constraints | Description |
| :--- | :--- | :--- | :--- |
| `id` | UUID | Primary Key | ID Pesanan |
| `customer_id` | UUID | Foreign Key (Users.id) | ID Pembeli yang memesan |
| `worker_id` | UUID | Foreign Key (Users.id) | ID Tim Lapang yang ditugaskan (Nullable) |
| `cleaning_date` | Date | Not Null | Tanggal cuci karpet (diminta pembeli) |
| `location` | Text | Not Null | Alamat lokasi cuci karpet |
| `carpet_length` | Float | Not Null | Panjang karpet dalam meter |
| `carpet_width` | Float | Not Null | Lebar karpet dalam meter |
| `total_price` | Decimal | Not Null | Total harga yang harus dibayar |
| `payment_method`| String | Nullable | Metode pembayaran (Transfer, dll) |
| `payment_status`| PaymentStatusEnum| Default: PENDING | Status pembayaran |
| `job_status` | JobStatusEnum | Default: MENUNGGU | Status pengerjaan lapangan |
| `created_at` | Timestamp| Default: now() | Waktu pesanan dibuat |
| `updated_at` | Timestamp| - | Waktu data terakhir diubah |

---

## 3. Relationships (Relasi Antar Tabel)
1. **Users (1) to Worker_Profiles (1):** Satu user (jika role-nya WORKER) memiliki satu profil tambahan berisi KTP dan alamat.
2. **Users (1) to Orders (Many) [as Customer]:** Satu pembeli dapat melakukan banyak pesanan.
3. **Users (1) to Orders (Many) [as Worker]:** Satu tim lapang dapat menangani banyak pesanan/pekerjaan.