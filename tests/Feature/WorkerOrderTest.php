<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WorkerOrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_worker_can_view_dashboard_with_assigned_jobs(): void
    {
        $worker = User::factory()->create(['role' => 'WORKER']);
        $order = Order::create([
            'worker_id' => $worker->id,
            'cleaning_date' => now()->format('Y-m-d'),
            'location' => 'Masjid Raya Bintaro',
            'carpet_length' => 12,
            'carpet_width' => 3,
            'total_price' => 540000,
            'job_status' => 'DALAM_PERJALANAN',
            'payment_status' => 'PAID',
        ]);

        $response = $this->actingAs($worker)->get(route('worker.dashboard'));

        $response->assertOk();
        $response->assertSee('Masjid Raya Bintaro');
        $response->assertSee('Dalam Perjalanan');
    }

    public function test_worker_can_update_job_status(): void
    {
        $worker = User::factory()->create(['role' => 'WORKER']);
        $order = Order::create([
            'worker_id' => $worker->id,
            'cleaning_date' => now()->format('Y-m-d'),
            'location' => 'Masjid Nurul Falah',
            'carpet_length' => 8,
            'carpet_width' => 2,
            'total_price' => 240000,
            'job_status' => 'MENUNGGU',
            'payment_status' => 'PAID',
        ]);

        $response = $this->actingAs($worker)->patch(route('worker.orders.update-status', $order), [
            'job_status' => 'SEDANG_MENCUCI',
        ]);

        $response->assertRedirect(route('worker.dashboard'));
        $response->assertSessionHas('status');

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'job_status' => 'SEDANG_MENCUCI',
        ]);
    }

    public function test_worker_cannot_update_job_status_of_another_worker(): void
    {
        $worker1 = User::factory()->create(['role' => 'WORKER']);
        $worker2 = User::factory()->create(['role' => 'WORKER']);

        $order = Order::create([
            'worker_id' => $worker1->id,
            'cleaning_date' => now()->format('Y-m-d'),
            'location' => 'Kantor PT Aman Sentosa',
            'carpet_length' => 10,
            'carpet_width' => 4,
            'total_price' => 600000,
            'job_status' => 'MENUNGGU',
            'payment_status' => 'PENDING',
        ]);

        $response = $this->actingAs($worker2)->patch(route('worker.orders.update-status', $order), [
            'job_status' => 'SEDANG_MENCUCI',
        ]);

        $response->assertStatus(403);
    }

    public function test_worker_can_create_new_daily_field_report(): void
    {
        $worker = User::factory()->create(['role' => 'WORKER']);
        $customer = User::factory()->create(['role' => 'CUSTOMER']);

        $response = $this->actingAs($worker)->post(route('worker.orders.store'), [
            'cleaning_date' => now()->format('Y-m-d'),
            'location' => 'Masjid Baiturrahman, Sektor 9',
            'carpet_length' => 15,
            'carpet_width' => 2,
            'job_status' => 'SEDANG_MENCUCI',
            'customer_id' => $customer->id,
        ]);

        $response->assertRedirect(route('worker.dashboard'));
        $response->assertSessionHas('status');

        $this->assertDatabaseHas('orders', [
            'worker_id' => $worker->id,
            'customer_id' => $customer->id,
            'location' => 'Masjid Baiturrahman, Sektor 9',
            'carpet_length' => 15,
            'carpet_width' => 2,
            'total_price' => 450000.00, // 15 * 2 * 15000 = 450,000
            'job_status' => 'SEDANG_MENCUCI',
        ]);
    }

    public function test_worker_can_create_field_report_without_registered_customer(): void
    {
        $worker = User::factory()->create(['role' => 'WORKER']);

        $response = $this->actingAs($worker)->post(route('worker.orders.store'), [
            'cleaning_date' => now()->format('Y-m-d'),
            'location' => 'Musholla Al-Ittihad RW 04',
            'carpet_length' => 5,
            'carpet_width' => 2,
            'job_status' => 'SELESAI',
            'customer_id' => null,
        ]);

        $response->assertRedirect(route('worker.dashboard'));

        $this->assertDatabaseHas('orders', [
            'worker_id' => $worker->id,
            'customer_id' => null,
            'location' => 'Musholla Al-Ittihad RW 04',
            'total_price' => 150000.00,
            'job_status' => 'SELESAI',
        ]);
    }
}
