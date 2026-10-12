<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminOrderController extends Controller
{
    /**
     * Alokasikan petugas lapangan ke pesanan (Assign Worker).
     */
    public function assignWorker(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'worker_id' => ['required', 'exists:users,id'],
        ], [
            'worker_id.required' => 'Pilih petugas lapangan yang akan ditugaskan.',
            'worker_id.exists' => 'Petugas lapangan tidak valid.',
        ]);

        $worker = User::where('id', $validated['worker_id'])
            ->where('role', 'WORKER')
            ->firstOrFail();

        $order->update([
            'worker_id' => $worker->id,
        ]);

        return redirect()->route('admin.dashboard')
            ->with('status', 'Pesanan #' . $order->id . ' berhasil ditugaskan ke petugas "' . $worker->name . '".');
    }

    /**
     * Ekspor data laporan pesanan & pengerjaan ke format file CSV / Excel (PRD Flow 2).
     */
    public function export(Request $request): StreamedResponse
    {
        $ordersQuery = Order::with(['customer', 'worker'])->latest();

        // Terapkan filter yang sama dengan tabel dashboard
        if ($request->filled('search')) {
            $search = $request->search;
            $ordersQuery->where(function ($q) use ($search) {
                $q->where('location', 'like', "%{$search}%")
                    ->orWhereHas('customer', fn($c) => $c->where('name', 'like', "%{$search}%"))
                    ->orWhereHas('worker', fn($w) => $w->where('name', 'like', "%{$search}%"));
            });
        }

        if ($request->filled('job_status') && $request->job_status !== 'ALL') {
            $ordersQuery->where('job_status', $request->job_status);
        }

        if ($request->filled('payment_status') && $request->payment_status !== 'ALL') {
            $ordersQuery->where('payment_status', $request->payment_status);
        }

        $orders = $ordersQuery->get();

        $filename = 'laporan-medina-clean-' . date('Y-m-d_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        return response()->stream(function () use ($orders) {
            $handle = fopen('php://output', 'w');

            // Tulis UTF-8 BOM agar Excel di Windows membaca karakter Bahasa Indonesia dengan benar
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));

            // Baris Judul Kolom
            fputcsv($handle, [
                'ID Pesanan',
                'Tanggal Pengerjaan',
                'Nama Pemesan/Pelanggan',
                'Kontak/Telepon',
                'Lokasi Pengerjaan',
                'Panjang (m)',
                'Lebar (m)',
                'Luas Karpet (m2)',
                'Total Biaya (Rp)',
                'Status Pengerjaan',
                'Metode Pembayaran',
                'Status Pembayaran',
                'Petugas Lapangan',
                'Waktu Input Data',
            ]);

            foreach ($orders as $order) {
                $area = $order->carpet_length * $order->carpet_width;

                fputcsv($handle, [
                    '#' . $order->id,
                    $order->cleaning_date->format('Y-m-d'),
                    $order->customer->name ?? 'Pemesan Lapangan / Walk-in',
                    $order->customer->phone ?? $order->customer->email ?? '-',
                    $order->location,
                    $order->carpet_length,
                    $order->carpet_width,
                    number_format($area, 2),
                    $order->total_price,
                    $order->job_status,
                    $order->payment_method ?? '-',
                    $order->payment_status,
                    $order->worker->name ?? 'Belum Ditugaskan',
                    $order->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($handle);
        }, 200, $headers);
    }
}
