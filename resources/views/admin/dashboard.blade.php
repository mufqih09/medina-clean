<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    Dashboard Admin & Manajer
                </h2>
                <p class="text-sm text-gray-500 mt-0.5">Kelola tim lapang, pantau laporan pekerjaan, dan analitik performa</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-sky-100 text-[#1484b3]">
                    Peran: Administrator
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Top Metric Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Pesanan</p>
                    <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $totalOrders }}</h3>
                    <p class="text-xs text-gray-500 mt-1">Keseluruhan pesanan masuk</p>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Menunggu Tim</p>
                    <h3 class="text-3xl font-bold text-orange-500 mt-2">{{ $pendingOrders }}</h3>
                    <span class="inline-block mt-1 text-xs font-medium px-2.5 py-0.5 rounded-full bg-orange-100 text-orange-600">
                        Status: Menunggu
                    </span>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Sedang Dikerjakan</p>
                    <h3 class="text-3xl font-bold text-blue-600 mt-2">{{ $inProgressOrders }}</h3>
                    <span class="inline-block mt-1 text-xs font-medium px-2.5 py-0.5 rounded-full bg-blue-100 text-blue-600">
                        Status: Dalam Proses
                    </span>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Selesai Dicuci</p>
                    <h3 class="text-3xl font-bold text-emerald-600 mt-2">{{ $completedOrders }}</h3>
                    <span class="inline-block mt-1 text-xs font-medium px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-600">
                        Status: Sukses
                    </span>
                </div>
            </div>

            <!-- Quick Action & Filter Bar (PRD Flow 2) -->
            <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <button type="button" class="inline-flex items-center gap-2 px-4 py-2.5 bg-medina hover:bg-[#3baad3] text-white text-sm font-semibold rounded-lg shadow-sm transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Tambah Tim Lapang
                    </button>
                    <button type="button" class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-300 hover:border-medina text-gray-700 hover:text-medina text-sm font-semibold rounded-lg shadow-sm transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        Download Laporan (.xls)
                    </button>
                </div>
                <div class="text-sm text-gray-500">
                    Total Tim Lapang: <span class="font-bold text-gray-800">{{ $totalWorkers }} Orang</span> | Pelanggan: <span class="font-bold text-gray-800">{{ $totalCustomers }}</span>
                </div>
            </div>

            <!-- Data Table (Desktop-Optimized) -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex items-center justify-between">
                    <div>
                        <h4 class="font-bold text-gray-800 text-lg">Daftar Laporan Pekerjaan Terkini</h4>
                        <p class="text-xs text-gray-400 mt-0.5">Memantau status dan alokasi cucian karpet pelanggan</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-600">
                        <thead class="bg-gray-50 text-xs uppercase text-gray-400 font-semibold border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-4">ID & Tanggal</th>
                                <th class="px-6 py-4">Pelanggan</th>
                                <th class="px-6 py-4">Lokasi</th>
                                <th class="px-6 py-4">Dimensi (m)</th>
                                <th class="px-6 py-4">Tim Lapang</th>
                                <th class="px-6 py-4">Status Pengerjaan</th>
                                <th class="px-6 py-4">Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($recentOrders as $order)
                                <tr class="hover:bg-gray-50/60 transition">
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        #{{ $order->id }}
                                        <div class="text-xs text-gray-400">{{ $order->cleaning_date->format('d M Y') }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-gray-800">{{ $order->customer->name ?? '-' }}</div>
                                        <div class="text-xs text-gray-400">{{ $order->customer->phone ?? $order->customer->email ?? '' }}</div>
                                    </td>
                                    <td class="px-6 py-4 max-w-xs truncate">{{ $order->location }}</td>
                                    <td class="px-6 py-4">{{ $order->carpet_length }} x {{ $order->carpet_width }} m</td>
                                    <td class="px-6 py-4">
                                        {{ $order->worker->name ?? 'Belum Ditugaskan' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($order->job_status === 'MENUNGGU')
                                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-orange-100 text-orange-600">Menunggu</span>
                                        @elseif(in_array($order->job_status, ['DALAM_PERJALANAN', 'SEDANG_MENCUCI']))
                                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-600">{{ str_replace('_', ' ', $order->job_status) }}</span>
                                        @else
                                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-600">Selesai</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-xs font-semibold {{ $order->payment_status === 'PAID' ? 'text-emerald-600' : 'text-orange-500' }}">
                                            {{ $order->payment_status }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                                        Belum ada pesanan aktif yang tercatat di sistem.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
