<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h2 class="font-bold text-xl sm:text-2xl text-gray-900 leading-tight">
                    Panel Admin & Manajer
                </h2>
                <p class="text-xs sm:text-sm text-gray-500 mt-0.5">Pantau alokasi tim lapangan, status pekerjaan, dan rekapitulasi data</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center px-2.5 py-1 rounded text-xs font-medium bg-gray-100 text-gray-700 border border-gray-300">
                    Role: Administrator
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <!-- Top Metric Cards -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Pesanan</p>
                    <h3 class="text-2xl sm:text-3xl font-bold text-gray-900 mt-2">{{ $totalOrders }}</h3>
                    <p class="text-xs text-gray-400 mt-1">Keseluruhan pesanan</p>
                </div>

                <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Menunggu Tim</p>
                    <h3 class="text-2xl sm:text-3xl font-bold text-orange-600 mt-2">{{ $pendingOrders }}</h3>
                    <span class="inline-block mt-1 text-xs font-medium px-2 py-0.5 rounded bg-orange-50 text-orange-700 border border-orange-200">
                        Belum Ditugaskan
                    </span>
                </div>

                <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Dalam Pengerjaan</p>
                    <h3 class="text-2xl sm:text-3xl font-bold text-blue-600 mt-2">{{ $inProgressOrders }}</h3>
                    <span class="inline-block mt-1 text-xs font-medium px-2 py-0.5 rounded bg-blue-50 text-blue-700 border border-blue-200">
                        Proses Lapangan
                    </span>
                </div>

                <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm">
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Pekerjaan Selesai</p>
                    <h3 class="text-2xl sm:text-3xl font-bold text-emerald-600 mt-2">{{ $completedOrders }}</h3>
                    <span class="inline-block mt-1 text-xs font-medium px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 border border-emerald-200">
                        Selesai Cuci
                    </span>
                </div>
            </div>

            <!-- Action Toolbar (PRD Flow 2) -->
            <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex flex-wrap items-center gap-2.5">
                    <button type="button" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-medina hover:bg-[#3baad3] text-white text-xs font-semibold rounded-lg shadow-sm transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Tambah Tim Lapang
                    </button>
                    <button type="button" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-white border border-gray-300 hover:border-gray-400 text-gray-700 text-xs font-semibold rounded-lg transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        Ekspor Laporan (.xls)
                    </button>
                </div>
                <div class="text-xs text-gray-500">
                    Petugas Terdaftar: <span class="font-bold text-gray-800">{{ $totalWorkers }} Orang</span> &bull; Pelanggan: <span class="font-bold text-gray-800">{{ $totalCustomers }} Akun</span>
                </div>
            </div>

            <!-- Data Table (Desktop-Optimized) -->
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <div>
                        <h4 class="font-bold text-gray-900 text-base">Laporan Pekerjaan Terkini</h4>
                        <p class="text-xs text-gray-500 mt-0.5">Daftar pesanan aktif dan alokasi tim lapangan</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs sm:text-sm text-gray-600">
                        <thead class="bg-gray-50 text-xs uppercase text-gray-500 font-semibold border-b border-gray-200">
                            <tr>
                                <th class="px-5 py-3">No. & Tanggal</th>
                                <th class="px-5 py-3">Pelanggan</th>
                                <th class="px-5 py-3">Lokasi</th>
                                <th class="px-5 py-3">Ukuran (P &times; L)</th>
                                <th class="px-5 py-3">Petugas</th>
                                <th class="px-5 py-3">Status Pekerjaan</th>
                                <th class="px-5 py-3">Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($recentOrders as $order)
                                <tr class="hover:bg-gray-50/70 transition">
                                    <td class="px-5 py-3.5 font-medium text-gray-900">
                                        #{{ $order->id }}
                                        <div class="text-xs text-gray-400">{{ $order->cleaning_date->format('d/m/Y') }}</div>
                                    </td>
                                    <td class="px-5 py-3.5">
                                        <div class="font-semibold text-gray-900">{{ $order->customer->name ?? '-' }}</div>
                                        <div class="text-xs text-gray-400">{{ $order->customer->phone ?? $order->customer->email ?? '' }}</div>
                                    </td>
                                    <td class="px-5 py-3.5 max-w-xs truncate text-gray-700">{{ $order->location }}</td>
                                    <td class="px-5 py-3.5 text-gray-800">{{ $order->carpet_length }} &times; {{ $order->carpet_width }} m</td>
                                    <td class="px-5 py-3.5">
                                        <span class="font-medium {{ $order->worker ? 'text-gray-900' : 'text-gray-400 italic' }}">
                                            {{ $order->worker->name ?? 'Belum ada' }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-3.5">
                                        @if($order->job_status === 'MENUNGGU')
                                            <span class="px-2 py-0.5 rounded text-xs font-semibold bg-orange-50 text-orange-700 border border-orange-200">Menunggu</span>
                                        @elseif($order->job_status === 'DALAM_PERJALANAN')
                                            <span class="px-2 py-0.5 rounded text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">Dalam Perjalanan</span>
                                        @elseif($order->job_status === 'SEDANG_MENCUCI')
                                            <span class="px-2 py-0.5 rounded text-xs font-semibold bg-sky-50 text-[#1484b3] border border-sky-200">Sedang Mencuci</span>
                                        @else
                                            <span class="px-2 py-0.5 rounded text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">Selesai</span>
                                        @endif
                                    </td>
                                    <td class="px-5 py-3.5">
                                        <span class="text-xs font-semibold px-2 py-0.5 rounded {{ $order->payment_status === 'PAID' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-yellow-50 text-yellow-700 border border-yellow-200' }}">
                                            {{ $order->payment_status === 'PAID' ? 'Lunas' : 'Belum Lunas' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-5 py-10 text-center text-gray-400">
                                        Belum ada data laporan pesanan aktif.
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
