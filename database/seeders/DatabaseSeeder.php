<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use App\Models\WorkerProfile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@medinaclean.com'],
            [
                'name' => 'Admin Medina',
                'phone' => '081234567890',
                'role' => 'ADMIN',
                'password' => Hash::make('password'),
            ]
        );

        // 2. Akun Tim Lapang (Worker)
        $worker = User::firstOrCreate(
            ['email' => 'worker@medinaclean.com'],
            [
                'name' => 'Budi Santoso (Tim Lapang)',
                'phone' => '081298765432',
                'role' => 'WORKER',
                'password' => Hash::make('password'),
            ]
        );

        WorkerProfile::firstOrCreate(
            ['user_id' => $worker->id],
            [
                'address' => 'Jl. Sudirman No. 45, Pekanbaru',
                'ktp_photo_url' => 'ktp/default.jpg',
            ]
        );

        // 3. Akun Pembeli (Customer)
        $customer = User::firstOrCreate(
            ['email' => 'customer@medinaclean.com'],
            [
                'name' => 'Ahmad Fauzi (Pelanggan)',
                'phone' => '085712345678',
                'role' => 'CUSTOMER',
                'password' => Hash::make('password'),
            ]
        );

        // 4. Contoh Data Pesanan Cuci Karpet
        if (Order::count() === 0) {
            Order::create([
                'customer_id' => $customer->id,
                'worker_id' => $worker->id,
                'cleaning_date' => now()->toDateString(),
                'location' => 'Masjid Raya An-Nur, Jl. Hangtuah, Pekanbaru',
                'carpet_length' => 12.0,
                'carpet_width' => 6.0,
                'total_price' => 720000,
                'payment_method' => 'Transfer Bank BCA',
                'payment_status' => 'PAID',
                'job_status' => 'SEDANG_MENCUCI',
            ]);

            Order::create([
                'customer_id' => $customer->id,
                'worker_id' => null,
                'cleaning_date' => now()->addDay()->toDateString(),
                'location' => 'Kantor PT Mandiri Sejahtera, Jl. Arifin Achmad No. 10',
                'carpet_length' => 8.0,
                'carpet_width' => 4.0,
                'total_price' => 320000,
                'payment_method' => 'Transfer Bank Mandiri',
                'payment_status' => 'PENDING',
                'job_status' => 'MENUNGGU',
            ]);
        }
    }
}
