<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Tarif dasar per meter persegi (Rp 15.000 / m²)
     */
    public const RATE_PER_SQUARE_METER = 15000;

    /**
     * Simpan pesanan cuci karpet baru dari pelanggan.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'cleaning_date' => ['required', 'date', 'after_or_equal:today'],
            'location' => ['required', 'string', 'max:500'],
            'carpet_length' => ['required', 'numeric', 'min:0.5', 'max:100'],
            'carpet_width' => ['required', 'numeric', 'min:0.5', 'max:50'],
        ], [
            'cleaning_date.required' => 'Tanggal pengerjaan wajib diisi.',
            'cleaning_date.after_or_equal' => 'Tanggal pengerjaan tidak boleh sebelum hari ini.',
            'location.required' => 'Alamat lokasi cuci karpet wajib diisi.',
            'carpet_length.required' => 'Panjang karpet wajib diisi.',
            'carpet_length.min' => 'Panjang karpet minimal 0.5 meter.',
            'carpet_width.required' => 'Lebar karpet wajib diisi.',
            'carpet_width.min' => 'Lebar karpet minimal 0.5 meter.',
        ]);

        $area = $validated['carpet_length'] * $validated['carpet_width'];
        $totalPrice = round($area * self::RATE_PER_SQUARE_METER);

        $order = Order::create([
            'customer_id' => $request->user()->id,
            'cleaning_date' => $validated['cleaning_date'],
            'location' => $validated['location'],
            'carpet_length' => $validated['carpet_length'],
            'carpet_width' => $validated['carpet_width'],
            'total_price' => $totalPrice,
            'payment_status' => 'PENDING',
            'job_status' => 'MENUNGGU',
        ]);

        return redirect()->route('customer.dashboard')
            ->with('status', 'Pesanan #' . $order->id . ' berhasil dibuat. Silakan lakukan pembayaran agar tim dapat segera dijadwalkan.');
    }

    /**
     * Konfirmasi pembayaran oleh pelanggan.
     */
    public function pay(Request $request, Order $order): RedirectResponse
    {
        // Pastikan pesanan milik customer yang sedang login
        if ($order->customer_id !== $request->user()->id) {
            abort(403, 'Anda tidak memiliki hak akses ke pesanan ini.');
        }

        $validated = $request->validate([
            'payment_method' => ['required', 'string', 'in:BCA,MANDIRI,BSI,QRIS'],
        ], [
            'payment_method.required' => 'Pilih salah satu metode pembayaran.',
            'payment_method.in' => 'Metode pembayaran tidak valid.',
        ]);

        $order->update([
            'payment_method' => $validated['payment_method'],
            'payment_status' => 'PAID',
        ]);

        return redirect()->route('customer.dashboard')
            ->with('status', 'Pembayaran pesanan #' . $order->id . ' berhasil dikonfirmasi via ' . $validated['payment_method'] . '. Tim kami akan segera menugaskan petugas.');
    }

    /**
     * Batalkan pesanan pelanggan (hanya jika masih menunggu dan belum dibayar).
     */
    public function destroy(Request $request, Order $order): RedirectResponse
    {
        if ($order->customer_id !== $request->user()->id) {
            abort(403, 'Anda tidak memiliki hak akses ke pesanan ini.');
        }

        if ($order->job_status !== 'MENUNGGU' || $order->payment_status === 'PAID') {
            return redirect()->route('customer.dashboard')
                ->with('error', 'Pesanan yang sudah dibayar atau sedang diproses tidak dapat dibatalkan.');
        }

        $orderId = $order->id;
        $order->delete();

        return redirect()->route('customer.dashboard')
            ->with('status', 'Pesanan #' . $orderId . ' berhasil dibatalkan.');
    }
}
