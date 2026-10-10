<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-lg sm:text-xl text-gray-900 leading-tight">
                    Pesanan Saya
                </h2>
                <p class="text-xs text-gray-500 mt-0.5">Daftar riwayat dan status pemesanan cuci karpet</p>
            </div>
            <span class="inline-flex items-center px-2.5 py-1 rounded text-xs font-semibold bg-sky-50 text-[#1484b3] border border-sky-200">
                Akun Pelanggan
            </span>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 space-y-4">
            <!-- Order Action Banner (Grounded card with clear purpose) -->
            <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h3 class="text-base font-bold text-gray-900">Ingin Menjadwalkan Cuci Karpet?</h3>
                    <p class="text-xs text-gray-600 mt-1">
                        Pesan layanan cuci karpet panggilan untuk masjid, kantor, atau rumah Anda.
                    </p>
                </div>
                <div class="shrink-0">
                    <button type="button" class="w-full sm:w-auto px-4 py-2.5 bg-medina hover:bg-[#3baad3] text-white font-semibold text-xs rounded-lg shadow-sm transition cursor-pointer">
                        + Pesan Jasa Cuci
                    </button>
                </div>
            </div>

            <!-- Stats Bar -->
            <div class="grid grid-cols-3 gap-3 text-center">
                <div class="bg-white rounded-xl p-3 border border-gray-200 shadow-sm">
                    <span class="text-xs text-gray-500">Menunggu</span>
                    <p class="text-xl font-bold text-orange-600 mt-0.5">{{ $pendingCount }}</p>
                </div>
                <div class="bg-white rounded-xl p-3 border border-gray-200 shadow-sm">
                    <span class="text-xs text-gray-500">Dicuci</span>
                    <p class="text-xl font-bold text-blue-600 mt-0.5">{{ $inProgressCount }}</p>
                </div>
                <div class="bg-white rounded-xl p-3 border border-gray-200 shadow-sm">
                    <span class="text-xs text-gray-500">Selesai</span>
                    <p class="text-xl font-bold text-emerald-600 mt-0.5">{{ $completedCount }}</p>
                </div>
            </div>

            <!-- List Pesanan Customer -->
            <div class="space-y-3">
                <div class="flex items-center justify-between pt-1">
                    <h4 class="font-bold text-gray-900 text-sm">Riwayat Pemesanan</h4>
                    <span class="text-xs text-gray-500">{{ $myOrders->count() }} Pesanan</span>
                </div>

                @forelse($myOrders as $order)
                    <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm space-y-3">
                        <div class="flex items-start justify-between">
                            <div>
                                <span class="text-xs font-semibold text-gray-500">No. #{{ $order->id }} &bull; Jadwal: {{ $order->cleaning_date->format('d/m/Y') }}</span>
                                <h5 class="font-bold text-gray-900 text-base mt-0.5">Cuci Karpet</h5>
                            </div>
                            @if($order->job_status === 'MENUNGGU')
                                <span class="px-2 py-0.5 rounded text-xs font-semibold bg-orange-50 text-orange-700 border border-orange-200">Menunggu Jadwal</span>
                            @elseif($order->job_status === 'DALAM_PERJALANAN')
                                <span class="px-2 py-0.5 rounded text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">Tim Dalam Perjalanan</span>
                            @elseif($order->job_status === 'SEDANG_MENCUCI')
                                <span class="px-2 py-0.5 rounded text-xs font-semibold bg-sky-50 text-[#1484b3] border border-sky-200">Sedang Dicuci</span>
                            @else
                                <span class="px-2 py-0.5 rounded text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">Selesai Dicuci</span>
                            @endif
                        </div>

                        <div class="bg-gray-50 rounded-lg p-3 text-xs space-y-1.5 border border-gray-200 text-gray-700">
                            <div class="flex items-start gap-2">
                                <span class="font-medium text-gray-500 w-16 shrink-0">Lokasi:</span>
                                <span class="font-semibold text-gray-900">{{ $order->location }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="font-medium text-gray-500 w-16 shrink-0">Ukuran:</span>
                                <span>{{ $order->carpet_length }} meter &times; {{ $order->carpet_width }} meter</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="font-medium text-gray-500 w-16 shrink-0">Petugas:</span>
                                <span>{{ $order->worker->name ?? 'Akan ditentukan admin' }}</span>
                            </div>
                            <div class="flex items-center justify-between pt-2 border-t border-gray-200 font-medium">
                                <span class="text-gray-600">Total Biaya:</span>
                                <span class="font-bold text-gray-900 text-sm">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between text-xs pt-1">
                            <span class="text-gray-500">Status Bayar: 
                                <b class="{{ $order->payment_status === 'PAID' ? 'text-emerald-700' : 'text-orange-600' }}">
                                    {{ $order->payment_status === 'PAID' ? 'Lunas' : 'Menunggu Pembayaran' }}
                                </b>
                            </span>
                            @if($order->payment_status !== 'PAID')
                                <button type="button" class="px-3 py-1.5 bg-medina text-white rounded-md font-semibold hover:bg-[#3baad3] transition">
                                    Instruksi Bayar
                                </button>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-xl p-8 border border-gray-200 text-center">
                        <p class="text-sm font-semibold text-gray-700">Belum ada riwayat pesanan.</p>
                        <p class="text-xs text-gray-500 mt-1">Gunakan tombol "Pesan Jasa Cuci" di atas untuk membuat pesanan pertama Anda.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
