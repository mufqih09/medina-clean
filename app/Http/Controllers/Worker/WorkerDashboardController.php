<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WorkerDashboardController extends Controller
{
    public function index(Request $request): View
    {
        $worker = $request->user();

        $assignedOrders = Order::with('customer')
            ->where('worker_id', $worker->id)
            ->latest()
            ->get();

        $activeJobsCount = $assignedOrders->whereIn('job_status', ['DALAM_PERJALANAN', 'SEDANG_MENCUCI'])->count();
        $completedJobsCount = $assignedOrders->where('job_status', 'SELESAI')->count();
        $customers = User::where('role', 'CUSTOMER')->orderBy('name')->get();

        return view('worker.dashboard', compact(
            'worker',
            'assignedOrders',
            'activeJobsCount',
            'completedJobsCount',
            'customers'
        ));
    }
}
