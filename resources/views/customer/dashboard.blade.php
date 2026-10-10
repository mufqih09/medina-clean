<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-xl sm:text-2xl text-gray-800 leading-tight">
                    Pesanan Saya
                </h2>
                <p class="text-xs sm:text-sm text-gray-500 mt-0.5">Pantau status pengerjaan cuci karpet Anda</p>
            </div>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">
                Akun Pelanggan
            </span>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 space-y-5">
            <!-- Order Action Button (PRD Flow 3) -->
            <div class="bg-gradient-to-r from-medina to-[#26a8d6] rounded-2xl p-6 text-white shadow-md relative overflow-hidden">
                <h3 class="text-xl sm:text-2xl font-bold">Butuh Cuci Karpet Bersih?</h3>
                <p class="text-sky-100 text-xs sm:text-sm mt-1 leading-relaxed">
                    Pesan jasa cuci karpet dengan mudah. Tim profesional kami siap datang langsung ke lokasi Anda.
                </p>
                <div class="mt-4">
                    <button type="button" class="px-6 py-2.5 bg-white text-medina hover:bg-sky-50 font-bold text-sm rounded-full shadow-sm transition cursor-pointer">
                        + Pesan Jasa Cuci Sekarang
                    </button>
                </div>
            </div>

            <!-- Stats Bar -->
            <div class="grid grid-cols-3 gap-3 text-center">
                <div class="bg-white rounded-xl p-3 border border-gray-100 shadow-sm">
                    <span class="text-xs text-gray-400">Menunggu</span>
                    <p class="text-lg font-bold text-orange-500 mt-0.5">{{ $pendingCount }}</p>
                </div>
                <div class="bg-white rounded-xl p-3 border border-gray-100 shadow-sm">
                    <span class="text-xs text-gray-400">Dicuci</span>
                    <p class="text-lg font-bold text-blue-500 mt-0.5">{{ $inProgressCount }}</p>
                </div>
                <div class="bg-white rounded-xl p-3 border border-gray-100 shadow-sm">
                    <span class="text-xs text-gray-400">Selesai</span>
                    <p class="text-lg font-bold text-emerald-500 mt-0.5">{{ $completedCount }}</p>
                </div>
            </div>

            <!-- List Pesanan Customer -->
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <h4 class="font-bold text-gray-800 text-base">Riwayat Pesanan Anda</h4>
                    <span class="text-xs text-gray-400">{{ $myOrders->count() }} Pesanan</span>
                </div>

                @forelse($myOrders as $order)
                    <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm space-y-3">
                        <div class="flex items-start justify-between">
                            <div>
                                <span class="text-xs font-semibold text-gray-400">#{{ $order->id }} &bull; {{ $order->cleaning_date->format('d M Y') }}</span>
                                <h5 class="font-bold text-gray-900 text-base mt-0.5">Cuci Karpet</h5>
                            </div>
                            @if($order->job_status === 'MENUNGGU')
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-orange-100 text-orange-600">Menunggu Jadwal</span>
                            @elseif($order->job_status === 'DALAM_PERJALANAN')
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-600">Tim Dalam Perjalanan</span>
                            @elseif($order->job_status === 'SEDANG_MENCUCI')
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-sky-100 text-medina">Sedang Dicuci</span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-600">Selesai Dicuci</span>
                            @endif
                        </div>

                        <div class="bg-gray-50 rounded-xl p-3 text-xs space-y-1.5 text-gray-600">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-medina shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span>Lokasi: <b>{{ $order->location }}</b></span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-medina shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
                                <span>Ukuran: <b>{{ $order->carpet_length }} m &times; {{ $order->carpet_width }} m</b></span>
                            </div>
                            <div class="flex items-center justify-between pt-1 border-t border-gray-200/60 font-medium">
                                <span>Biaya Jasa:</span>
                                <span class="font-bold text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between text-xs pt-1">
                            <span class="text-gray-500">Status Bayar: 
                                <b class="{{ $order->payment_status === 'PAID' ? 'text-emerald-600' : 'text-orange-500' }}">{{ $order->payment_status }}</b>
                            </span>
                            @if($order->payment_status !== 'PAID')
                                <button type="button" class="px-3 py-1.5 bg-medina text-white rounded-lg font-semibold hover:bg-[#3baad3] transition">
                                    Bayar Sekarang
                                </button>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm text-center">
                        <div class="w-12 h-12 mx-auto rounded-full bg-sky-50 text-medina flex items-center justify-center mb-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        </div>
                        <h5 class="font-bold text-gray-800 text-sm">Belum Ada Pesanan</h5>
                        <p class="text-xs text-gray-400 mt-1">Anda belum memiliki riwayat pemesanan jasa cuci karpet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
