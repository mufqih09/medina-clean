<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use App\Models\WorkerProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_dashboard_with_all_orders(): void
    {
        $admin = User::factory()->create(['role' => 'ADMIN']);
        $order = Order::create([
            'cleaning_date' => now()->format('Y-m-d'),
            'location' => 'Masjid Cut Meutia, Menteng',
            'carpet_length' => 20,
            'carpet_width' => 3,
            'total_price' => 900000,
            'job_status' => 'MENUNGGU',
            'payment_status' => 'PENDING',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));

        $response->assertOk();
        $response->assertSee('Masjid Cut Meutia, Menteng');
        $response->assertSee('Panel Admin');
    }

    public function test_admin_can_filter_and_search_orders(): void
    {
        $admin = User::factory()->create(['role' => 'ADMIN']);
        
        $order1 = Order::create([
            'cleaning_date' => now()->format('Y-m-d'),
            'location' => 'Masjid Istiqlal, Jakarta Pusat',
            'carpet_length' => 50,
            'carpet_width' => 4,
            'total_price' => 3000000,
            'job_status' => 'DALAM_PERJALANAN',
            'payment_status' => 'PAID',
        ]);

        $order2 = Order::create([
            'cleaning_date' => now()->format('Y-m-d'),
            'location' => 'Kantor PT Sumber Makmur, Sudirman',
            'carpet_length' => 10,
            'carpet_width' => 2,
            'total_price' => 300000,
            'job_status' => 'MENUNGGU',
            'payment_status' => 'PENDING',
        ]);

        // Search by location
        $response = $this->actingAs($admin)->get(route('admin.dashboard', ['search' => 'Istiqlal']));
        $response->assertSee('Masjid Istiqlal');
        $response->assertDontSee('Kantor PT Sumber Makmur');

        // Filter by job_status
        $responseStatus = $this->actingAs($admin)->get(route('admin.dashboard', ['job_status' => 'MENUNGGU']));
        $responseStatus->assertSee('Kantor PT Sumber Makmur');
        $responseStatus->assertDontSee('Masjid Istiqlal');
    }

    public function test_admin_can_assign_worker_to_order(): void
    {
        $admin = User::factory()->create(['role' => 'ADMIN']);
        $worker = User::factory()->create(['role' => 'WORKER', 'name' => 'Budi Santoso']);

        $order = Order::create([
            'cleaning_date' => now()->format('Y-m-d'),
            'location' => 'Masjid Sunda Kelapa',
            'carpet_length' => 10,
            'carpet_width' => 2,
            'total_price' => 300000,
            'job_status' => 'MENUNGGU',
            'payment_status' => 'PAID',
        ]);

        $response = $this->actingAs($admin)->patch(route('admin.orders.assign', $order), [
            'worker_id' => $worker->id,
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $response->assertSessionHas('status');

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'worker_id' => $worker->id,
        ]);
    }

    public function test_admin_can_register_new_field_worker_with_ktp(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create(['role' => 'ADMIN']);

        $file = UploadedFile::fake()->image('ktp_ahmad.jpg');

        $response = $this->actingAs($admin)->post(route('admin.workers.store'), [
            'name' => 'Ahmad Fauzi',
            'email' => 'ahmad.fauzi@medinaclean.com',
            'phone' => '081234567890',
            'address' => 'Jl. Kebon Jeruk No. 15, Jakarta Barat',
            'password' => 'password123',
            'ktp_photo' => $file,
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $response->assertSessionHas('status');

        $this->assertDatabaseHas('users', [
            'name' => 'Ahmad Fauzi',
            'email' => 'ahmad.fauzi@medinaclean.com',
            'role' => 'WORKER',
        ]);

        $worker = User::where('email', 'ahmad.fauzi@medinaclean.com')->first();
        $this->assertNotNull($worker);

        $this->assertDatabaseHas('worker_profiles', [
            'user_id' => $worker->id,
            'address' => 'Jl. Kebon Jeruk No. 15, Jakarta Barat',
        ]);

        Storage::disk('public')->assertExists('ktp_photos/' . $file->hashName());
    }

    public function test_admin_can_export_orders_to_csv(): void
    {
        $admin = User::factory()->create(['role' => 'ADMIN']);

        Order::create([
            'cleaning_date' => now()->format('Y-m-d'),
            'location' => 'Masjid Al-Azhar, Kebayoran Baru',
            'carpet_length' => 15,
            'carpet_width' => 2,
            'total_price' => 450000,
            'job_status' => 'SELESAI',
            'payment_status' => 'PAID',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.orders.export'));

        $response->assertOk();
        $response->assertHeader('Content-Type', 'text/csv; charset=UTF-8');
        $this->assertStringContainsString('laporan-medina-clean', $response->headers->get('Content-Disposition'));
        
        $content = $response->streamedContent();
        $this->assertStringContainsString('"ID Pesanan","Tanggal Pengerjaan","Nama Pemesan/Pelanggan"', $content);
        $this->assertStringContainsString('Masjid Al-Azhar, Kebayoran Baru', $content);
        $this->assertStringContainsString('450000', $content);
    }
}
