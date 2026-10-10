<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $totalWorkers = User::where('role', 'WORKER')->count();
        $totalCustomers = User::where('role', 'CUSTOMER')->count();
        $totalOrders = Order::count();
        $pendingOrders = Order::where('job_status', 'MENUNGGU')->count();
        $inProgressOrders = Order::whereIn('job_status', ['DALAM_PERJALANAN', 'SEDANG_MENCUCI'])->count();
        $completedOrders = Order::where('job_status', 'SELESAI')->count();

        $recentOrders = Order::with(['customer', 'worker'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalWorkers',
            'totalCustomers',
            'totalOrders',
            'pendingOrders',
            'inProgressOrders',
            'completedOrders',
            'recentOrders'
        ));
    }
}
