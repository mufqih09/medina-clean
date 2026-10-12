<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Customer\CustomerDashboardController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Worker\WorkerDashboardController;
use App\Http\Controllers\Worker\WorkerOrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Generic dashboard route that redirects to the role-specific dashboard
Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }

    if ($user->isWorker()) {
        return redirect()->route('worker.dashboard');
    }

    return redirect()->route('customer.dashboard');
})->middleware(['auth'])->name('dashboard');

// Admin Routes (Role: ADMIN)
Route::middleware(['auth', 'role:ADMIN'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
});

// Worker Routes (Role: WORKER)
Route::middleware(['auth', 'role:WORKER'])->prefix('worker')->name('worker.')->group(function () {
    Route::get('/dashboard', [WorkerDashboardController::class, 'index'])->name('dashboard');
    Route::post('/orders', [WorkerOrderController::class, 'store'])->name('orders.store');
    Route::patch('/orders/{order}/status', [WorkerOrderController::class, 'updateStatus'])->name('orders.update-status');
});

// Customer Routes (Role: CUSTOMER)
Route::middleware(['auth', 'role:CUSTOMER'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('dashboard');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::post('/orders/{order}/pay', [OrderController::class, 'pay'])->name('orders.pay');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
});

// Profile Management (Accessible by all authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
