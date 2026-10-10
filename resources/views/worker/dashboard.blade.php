<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-lg sm:text-xl text-gray-900 leading-tight">
                    Tugas Lapangan
                </h2>
                <p class="text-xs text-gray-500 mt-0.5">Daftar lokasi cuci karpet yang perlu dikerjakan</p>
            </div>
            <span class="inline-flex items-center px-2.5 py-1 rounded text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                Petugas Lapangan
            </span>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 space-y-4">
            <!-- Worker Status Card (Grounded, solid border, high readability) -->
            <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="text-xs font-medium text-gray-500">Nama Petugas:</span>
                        <h3 class="text-lg font-bold text-gray-900">{{ $worker->name }}</h3>
                        <p class="text-xs text-gray-500 mt-0.5">{{ $worker->phone ?? 'Nomor telepon belum diatur' }}</p>
                    </div>
                    <div class="text-right">
                        <span class="inline-block text-xs font-semibold px-2 py-0.5 rounded bg-emerald-50 text-emerald-700 border border-emerald-200">
                            Siap Bertugas
                        </span>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-t border-gray-100 grid grid-cols-2 gap-3 text-center">
                    <div class="bg-gray-50 rounded-lg p-2.5 border border-gray-200">
                        <span class="text-xs text-gray-500">Sedang Dikerjakan</span>
                        <p class="text-xl font-bold text-gray-900 mt-0.5">{{ $activeJobsCount }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-2.5 border border-gray-200">
                        <span class="text-xs text-gray-500">Selesai Hari Ini</span>
                        <p class="text-xl font-bold text-emerald-700 mt-0.5">{{ $completedJobsCount }}</p>
                    </div>
                </div>
            </div>

            <!-- Action Button: Tambah Laporan Harian (PRD Flow 1) -->
            <div>
                <button type="button" class="w-full py-3 bg-medina hover:bg-[#3baad3] text-white font-semibold text-sm rounded-lg shadow-sm flex items-center justify-center gap-2 transition cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    + Input Laporan Pengerjaan
                </button>
            </div>

            <!-- List Assigned Orders -->
            <div class="space-y-3">
                <div class="flex items-center justify-between pt-1">
                    <h4 class="font-bold text-gray-900 text-sm">Daftar Penugasan Cucian</h4>
                    <span class="text-xs text-gray-500">{{ $assignedOrders->count() }} Lokasi</span>
                </div>

                @forelse($assignedOrders as $order)
                    <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm space-y-3">
                        <div class="flex items-start justify-between">
                            <div>
                                <span class="text-xs font-semibold text-gray-500">No. #{{ $order->id }} &bull; Tanggal: {{ $order->cleaning_date->format('d/m/Y') }}</span>
                                <h5 class="font-bold text-gray-900 text-base mt-0.5">{{ $order->customer->name ?? 'Pelanggan' }}</h5>
                            </div>
                            @if($order->job_status === 'MENUNGGU')
                                <span class="px-2 py-0.5 rounded text-xs font-semibold bg-orange-50 text-orange-700 border border-orange-200">Menunggu</span>
                            @elseif($order->job_status === 'DALAM_PERJALANAN')
                                <span class="px-2 py-0.5 rounded text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-200">Dalam Perjalanan</span>
                            @elseif($order->job_status === 'SEDANG_MENCUCI')
                                <span class="px-2 py-0.5 rounded text-xs font-semibold bg-sky-50 text-[#1484b3] border border-sky-200">Sedang Mencuci</span>
                            @else
                                <span class="px-2 py-0.5 rounded text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">Selesai</span>
                            @endif
                        </div>

                        <div class="bg-gray-50 rounded-lg p-3 text-xs space-y-1.5 border border-gray-200 text-gray-700">
                            <div class="flex items-start gap-2">
                                <span class="font-medium text-gray-500 w-16 shrink-0">Alamat:</span>
                                <span class="font-semibold text-gray-900">{{ $order->location }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="font-medium text-gray-500 w-16 shrink-0">Ukuran:</span>
                                <span>{{ $order->carpet_length }} meter &times; {{ $order->carpet_width }} meter</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="font-medium text-gray-500 w-16 shrink-0">Kontak:</span>
                                <span>{{ $order->customer->phone ?? $order->customer->email ?? '-' }}</span>
                            </div>
                        </div>

                        <div class="pt-1 flex items-center gap-2">
                            <button type="button" class="flex-1 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-xs font-semibold rounded-md border border-gray-200 transition">
                                Ubah Status Pengerjaan
                            </button>
                            <a href="https://maps.google.com/?q={{ urlencode($order->location) }}" target="_blank" class="px-3.5 py-2 bg-white border border-gray-300 hover:border-gray-400 text-gray-700 text-xs font-medium rounded-md transition">
                                Buka Google Maps &rarr;
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-xl p-8 border border-gray-200 text-center">
                        <p class="text-sm font-semibold text-gray-700">Belum ada tugas cuci yang dialokasikan.</p>
                        <p class="text-xs text-gray-500 mt-1">Admin akan menugaskan lokasi pekerjaan melalui dashboard pusat.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
