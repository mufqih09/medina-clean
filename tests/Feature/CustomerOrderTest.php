<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerOrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_create_new_order_with_calculated_price(): void
    {
        $customer = User::factory()->create([
            'role' => 'CUSTOMER',
        ]);

        $response = $this->actingAs($customer)->post(route('customer.orders.store'), [
            'cleaning_date' => now()->addDays(2)->format('Y-m-d'),
            'location' => 'Masjid Raya Al-Muhajirin, Blok C No 5',
            'carpet_length' => 10,
            'carpet_width' => 2,
        ]);

        $response->assertRedirect(route('customer.dashboard'));
        $response->assertSessionHas('status');

        $this->assertDatabaseHas('orders', [
            'customer_id' => $customer->id,
            'location' => 'Masjid Raya Al-Muhajirin, Blok C No 5',
            'carpet_length' => 10,
            'carpet_width' => 2,
            'total_price' => 300000.00, // 10 * 2 * 15000 = 300,000
            'payment_status' => 'PENDING',
            'job_status' => 'MENUNGGU',
        ]);
    }

    public function test_order_creation_fails_with_invalid_data(): void
    {
        $customer = User::factory()->create([
            'role' => 'CUSTOMER',
        ]);

        $response = $this->actingAs($customer)->post(route('customer.orders.store'), [
            'cleaning_date' => now()->subDay()->format('Y-m-d'), // past date
            'location' => '',
            'carpet_length' => 0.1, // under min 0.5
            'carpet_width' => -1,
        ]);

        $response->assertSessionHasErrors(['cleaning_date', 'location', 'carpet_length', 'carpet_width']);
        $this->assertEquals(0, Order::count());
    }

    public function test_customer_can_confirm_payment(): void
    {
        $customer = User::factory()->create([
            'role' => 'CUSTOMER',
        ]);

        $order = Order::create([
            'customer_id' => $customer->id,
            'cleaning_date' => now()->addDay()->format('Y-m-d'),
            'location' => 'Gedung Pertemuan Graha Kencana',
            'carpet_length' => 5,
            'carpet_width' => 4,
            'total_price' => 300000,
            'payment_status' => 'PENDING',
            'job_status' => 'MENUNGGU',
        ]);

        $response = $this->actingAs($customer)->post(route('customer.orders.pay', $order), [
            'payment_method' => 'BCA',
        ]);

        $response->assertRedirect(route('customer.dashboard'));
        $response->assertSessionHas('status');

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'payment_method' => 'BCA',
            'payment_status' => 'PAID',
        ]);
    }

    public function test_customer_cannot_confirm_payment_for_another_customers_order(): void
    {
        $customer1 = User::factory()->create(['role' => 'CUSTOMER']);
        $customer2 = User::factory()->create(['role' => 'CUSTOMER']);

        $order = Order::create([
            'customer_id' => $customer1->id,
            'cleaning_date' => now()->addDay()->format('Y-m-d'),
            'location' => 'Jl. Anggrek No. 1',
            'carpet_length' => 4,
            'carpet_width' => 2,
            'total_price' => 120000,
            'payment_status' => 'PENDING',
            'job_status' => 'MENUNGGU',
        ]);

        $response = $this->actingAs($customer2)->post(route('customer.orders.pay', $order), [
            'payment_method' => 'BCA',
        ]);

        $response->assertStatus(403);
    }

    public function test_customer_can_cancel_pending_order(): void
    {
        $customer = User::factory()->create(['role' => 'CUSTOMER']);

        $order = Order::create([
            'customer_id' => $customer->id,
            'cleaning_date' => now()->addDays(3)->format('Y-m-d'),
            'location' => 'Rumah Tinggal No. 8',
            'carpet_length' => 3,
            'carpet_width' => 2,
            'total_price' => 90000,
            'payment_status' => 'PENDING',
            'job_status' => 'MENUNGGU',
        ]);

        $response = $this->actingAs($customer)->delete(route('customer.orders.destroy', $order));

        $response->assertRedirect(route('customer.dashboard'));
        $this->assertDatabaseMissing('orders', ['id' => $order->id]);
    }

    public function test_customer_cannot_cancel_paid_or_in_progress_order(): void
    {
        $customer = User::factory()->create(['role' => 'CUSTOMER']);

        $paidOrder = Order::create([
            'customer_id' => $customer->id,
            'cleaning_date' => now()->addDays(2)->format('Y-m-d'),
            'location' => 'Masjid Al-Barkah',
            'carpet_length' => 6,
            'carpet_width' => 4,
            'total_price' => 360000,
            'payment_status' => 'PAID',
            'job_status' => 'MENUNGGU',
        ]);

        $response = $this->actingAs($customer)->delete(route('customer.orders.destroy', $paidOrder));

        $response->assertSessionHas('error');
        $this->assertDatabaseHas('orders', ['id' => $paidOrder->id]);
    }
}
