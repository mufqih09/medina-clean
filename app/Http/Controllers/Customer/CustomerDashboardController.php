<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerDashboardController extends Controller
{
    public function index(Request $request): View
    {
        $customer = $request->user();

        $myOrders = Order::with('worker')
            ->where('customer_id', $customer->id)
            ->latest()
            ->get();

        $pendingCount = $myOrders->where('job_status', 'MENUNGGU')->count();
        $inProgressCount = $myOrders->whereIn('job_status', ['DALAM_PERJALANAN', 'SEDANG_MENCUCI'])->count();
        $completedCount = $myOrders->where('job_status', 'SELESAI')->count();

        return view('customer.dashboard', compact(
            'customer',
            'myOrders',
            'pendingCount',
            'inProgressCount',
            'completedCount'
        ));
    }
}
