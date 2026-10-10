<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login_when_accessing_dashboards(): void
    {
        $this->get('/admin/dashboard')->assertRedirect('/login');
        $this->get('/worker/dashboard')->assertRedirect('/login');
        $this->get('/customer/dashboard')->assertRedirect('/login');
        $this->get('/dashboard')->assertRedirect('/login');
    }

    public function test_admin_can_access_admin_dashboard_and_is_redirected_from_generic_dashboard(): void
    {
        $admin = User::factory()->create(['role' => 'ADMIN']);

        $this->actingAs($admin)
            ->get('/dashboard')
            ->assertRedirect(route('admin.dashboard'));

        $this->actingAs($admin)
            ->get('/admin/dashboard')
            ->assertOk();

        // Admin accessing worker dashboard gets 403
        $this->actingAs($admin)
            ->get('/worker/dashboard')
            ->assertForbidden();
    }

    public function test_worker_can_access_worker_dashboard_and_is_redirected_from_generic_dashboard(): void
    {
        $worker = User::factory()->create(['role' => 'WORKER']);

        $this->actingAs($worker)
            ->get('/dashboard')
            ->assertRedirect(route('worker.dashboard'));

        $this->actingAs($worker)
            ->get('/worker/dashboard')
            ->assertOk();

        // Worker accessing admin dashboard gets 403
        $this->actingAs($worker)
            ->get('/admin/dashboard')
            ->assertForbidden();
    }

    public function test_customer_can_access_customer_dashboard_and_is_forbidden_from_admin_and_worker(): void
    {
        $customer = User::factory()->create(['role' => 'CUSTOMER']);

        $this->actingAs($customer)
            ->get('/dashboard')
            ->assertRedirect(route('customer.dashboard'));

        $this->actingAs($customer)
            ->get('/customer/dashboard')
            ->assertOk();

        // Customer accessing admin dashboard gets 403
        $this->actingAs($customer)
            ->get('/admin/dashboard')
            ->assertForbidden();

        // Customer accessing worker dashboard gets 403
        $this->actingAs($customer)
            ->get('/worker/dashboard')
            ->assertForbidden();
    }
}
