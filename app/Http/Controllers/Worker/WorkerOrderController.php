<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WorkerOrderController extends Controller
{
    /**
     * Tarif per meter persegi
     */
    public const RATE_PER_SQUARE_METER = 15000;

    /**
     * Simpan laporan pengerjaan harian baru dari tim lapangan (PRD Flow 1).
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'cleaning_date' => ['required', 'date'],
            'location' => ['required', 'string', 'max:500'],
            'carpet_length' => ['required', 'numeric', 'min:0.5', 'max:100'],
            'carpet_width' => ['required', 'numeric', 'min:0.5', 'max:50'],
            'job_status' => ['required', 'string', 'in:DALAM_PERJALANAN,SEDANG_MENCUCI,SELESAI'],
            'customer_id' => ['nullable', 'exists:users,id'],
        ], [
            'cleaning_date.required' => 'Tanggal pengerjaan wajib diisi.',
            'location.required' => 'Lokasi cuci karpet wajib diisi.',
            'carpet_length.required' => 'Panjang karpet wajib diisi.',
            'carpet_width.required' => 'Lebar karpet wajib diisi.',
            'job_status.required' => 'Status pengerjaan wajib dipilih.',
            'job_status.in' => 'Status pengerjaan tidak valid.',
        ]);

        $area = $validated['carpet_length'] * $validated['carpet_width'];
        $totalPrice = round($area * self::RATE_PER_SQUARE_METER);

        $order = Order::create([
            'customer_id' => $validated['customer_id'] ?? null,
            'worker_id' => $request->user()->id,
            'cleaning_date' => $validated['cleaning_date'],
            'location' => $validated['location'],
            'carpet_length' => $validated['carpet_length'],
            'carpet_width' => $validated['carpet_width'],
            'total_price' => $totalPrice,
            'payment_status' => 'PENDING',
            'job_status' => $validated['job_status'],
        ]);

        return redirect()->route('worker.dashboard')
            ->with('status', 'Laporan pengerjaan di ' . $order->location . ' berhasil ditambahkan.');
    }

    /**
     * Perbarui status pengerjaan pesanan oleh tim lapangan.
     */
    public function updateStatus(Request $request, Order $order): RedirectResponse
    {
        // Pastikan pesanan ditugaskan ke worker yang sedang login
        if ($order->worker_id !== $request->user()->id) {
            abort(403, 'Anda tidak ditugaskan pada pesanan ini.');
        }

        $validated = $request->validate([
            'job_status' => ['required', 'string', 'in:MENUNGGU,DALAM_PERJALANAN,SEDANG_MENCUCI,SELESAI'],
        ], [
            'job_status.required' => 'Pilih status pengerjaan baru.',
            'job_status.in' => 'Status pengerjaan tidak valid.',
        ]);

        $statusLabels = [
            'MENUNGGU' => 'Menunggu',
            'DALAM_PERJALANAN' => 'Dalam Perjalanan',
            'SEDANG_MENCUCI' => 'Sedang Mencuci',
            'SELESAI' => 'Selesai',
        ];

        $order->update([
            'job_status' => $validated['job_status'],
        ]);

        $label = $statusLabels[$validated['job_status']] ?? $validated['job_status'];

        return redirect()->route('worker.dashboard')
            ->with('status', 'Status pesanan #' . $order->id . ' berhasil diubah menjadi: "' . $label . '".');
    }
}
