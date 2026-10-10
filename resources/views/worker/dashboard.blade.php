<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-xl sm:text-2xl text-gray-800 leading-tight">
                    Dashboard Tim Lapang
                </h2>
                <p class="text-xs sm:text-sm text-gray-500 mt-0.5">Laporan & pengerjaan cuci karpet hari ini</p>
            </div>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                Tim Lapang
            </span>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 space-y-5">
            <!-- Mobile Summary Card -->
            <div class="bg-gradient-to-r from-medina to-[#26a8d6] rounded-2xl p-6 text-white shadow-md">
                <p class="text-xs text-sky-100 uppercase tracking-wider font-semibold">Petugas Lapangan</p>
                <h3 class="text-2xl font-bold mt-1">{{ $worker->name }}</h3>
                <div class="mt-4 pt-4 border-t border-white/20 grid grid-cols-2 gap-4">
                    <div>
                        <span class="text-xs text-sky-100">Sedang Dikerjakan</span>
                        <p class="text-2xl font-bold">{{ $activeJobsCount }} Lokasi</p>
                    </div>
                    <div>
                        <span class="text-xs text-sky-100">Selesai Hari Ini</span>
                        <p class="text-2xl font-bold">{{ $completedJobsCount }} Lokasi</p>
                    </div>
                </div>
            </div>

            <!-- Action Button: Tambah Laporan (PRD Flow 1) -->
            <div>
                <button type="button" class="w-full py-3.5 bg-medina hover:bg-[#3baad3] text-white font-bold text-sm rounded-xl shadow-sm flex items-center justify-center gap-2 transition cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    + Tambah Laporan Harian
                </button>
            </div>

            <!-- List Tugas / Order Tim Lapang (Mobile Single Column) -->
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <h4 class="font-bold text-gray-800 text-base">Daftar Tugas Anda</h4>
                    <span class="text-xs text-gray-400">Total: {{ $assignedOrders->count() }} Tugas</span>
                </div>

                @forelse($assignedOrders as $order)
                    <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm space-y-3">
                        <div class="flex items-start justify-between">
                            <div>
                                <span class="text-xs font-semibold text-gray-400">#{{ $order->id }} &bull; {{ $order->cleaning_date->format('d M Y') }}</span>
                                <h5 class="font-bold text-gray-900 text-base mt-0.5">{{ $order->customer->name ?? 'Pelanggan' }}</h5>
                            </div>
                            @if($order->job_status === 'MENUNGGU')
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-orange-100 text-orange-600">Menunggu</span>
                            @elseif($order->job_status === 'DALAM_PERJALANAN')
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-600">Dalam Perjalanan</span>
                            @elseif($order->job_status === 'SEDANG_MENCUCI')
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-sky-100 text-medina">Sedang Mencuci</span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-600">Selesai</span>
                            @endif
                        </div>

                        <div class="bg-gray-50 rounded-xl p-3 text-xs space-y-1.5 text-gray-600">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-medina shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span class="font-medium text-gray-800">{{ $order->location }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-medina shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
                                <span>Ukuran Karpet: <b>{{ $order->carpet_length }} m &times; {{ $order->carpet_width }} m</b></span>
                            </div>
                        </div>

                        <div class="pt-1 flex items-center gap-2">
                            <button type="button" class="flex-1 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold rounded-lg transition">
                                Update Status
                            </button>
                            <a href="https://maps.google.com/?q={{ urlencode($order->location) }}" target="_blank" class="px-3 py-2 bg-sky-50 text-medina text-xs font-semibold rounded-lg hover:bg-sky-100 transition">
                                Buka Peta
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm text-center">
                        <div class="w-12 h-12 mx-auto rounded-full bg-sky-50 text-medina flex items-center justify-center mb-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <h5 class="font-bold text-gray-800 text-sm">Tidak Ada Tugas Tertunda</h5>
                        <p class="text-xs text-gray-400 mt-1">Semua tugas cucian telah selesai atau belum ada penugasan baru.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
