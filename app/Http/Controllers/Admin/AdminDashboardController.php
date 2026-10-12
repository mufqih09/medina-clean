<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(Request $request): View
    {
        $totalWorkers = User::where('role', 'WORKER')->count();
        $totalCustomers = User::where('role', 'CUSTOMER')->count();
        $totalOrders = Order::count();
        $pendingOrders = Order::where('job_status', 'MENUNGGU')->count();
        $inProgressOrders = Order::whereIn('job_status', ['DALAM_PERJALANAN', 'SEDANG_MENCUCI'])->count();
        $completedOrders = Order::where('job_status', 'SELESAI')->count();

        $workers = User::where('role', 'WORKER')->orderBy('name')->get();

        $ordersQuery = Order::with(['customer', 'worker'])->latest();

        // Fitur Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $ordersQuery->where(function ($q) use ($search) {
                $q->where('location', 'like', "%{$search}%")
                    ->orWhereHas('customer', fn($c) => $c->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('worker', fn($w) => $w->where('name', 'like', "%{$search}%"));
            });
        }

        // Filter Status Pengerjaan
        if ($request->filled('job_status') && $request->job_status !== 'ALL') {
            $ordersQuery->where('job_status', $request->job_status);
        }

        // Filter Status Pembayaran
        if ($request->filled('payment_status') && $request->payment_status !== 'ALL') {
            $ordersQuery->where('payment_status', $request->payment_status);
        }

        $orders = $ordersQuery->paginate(10)->withQueryString();

        return view('admin.dashboard', compact(
            'totalWorkers',
            'totalCustomers',
            'totalOrders',
            'pendingOrders',
            'inProgressOrders',
            'completedOrders',
            'orders',
            'workers'
        ));
    }
}
