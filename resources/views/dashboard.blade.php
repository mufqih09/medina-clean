<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
                <p class="text-sm text-gray-500 mt-0.5">Selamat datang di portal layanan Medina Clean</p>
            </div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-sky-100 text-[#1484b3]">
                <span class="w-2 h-2 rounded-full bg-medina animate-pulse"></span>
                Sistem Aktif
            </span>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-medina to-[#26a8d6] rounded-2xl p-6 sm:p-8 text-white shadow-md relative overflow-hidden">
                <div class="relative z-10 max-w-xl">
                    <h3 class="text-2xl font-bold">Halo, {{ Auth::user()->name }}! 👋</h3>
                    <p class="mt-2 text-sky-100 text-sm sm:text-base leading-relaxed">
                        Selamat datang kembali di sistem pengelolaan Medina Clean. Anda dapat memantau pesanan, melihat status pengerjaan, dan mengelola layanan cuci karpet dengan mudah.
                    </p>
                </div>
                <div class="absolute right-0 bottom-0 translate-x-8 translate-y-8 opacity-15 pointer-events-none">
                    <svg class="w-64 h-64" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M4 18V9a3 3 0 0 1 6 0v9" />
                        <path d="M10 18V9a3 3 0 0 1 6 0v9" />
                        <path d="M16 18h4a2 2 0 0 0 2-2v-5" />
                    </svg>
                </div>
            </div>

            <!-- Summary Status Cards (sesuai status di design.md) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <!-- Status Menunggu -->
                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Menunggu Pengerjaan</p>
                        <h4 class="text-2xl font-bold text-gray-800 mt-1">0</h4>
                        <span class="inline-block mt-2 text-xs font-medium px-2.5 py-0.5 rounded-full bg-orange-100 text-orange-600">
                            Status: Menunggu
                        </span>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-orange-50 flex items-center justify-center text-orange-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

                <!-- Status Proses / Perjalanan -->
                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Sedang Dikerjakan</p>
                        <h4 class="text-2xl font-bold text-gray-800 mt-1">0</h4>
                        <span class="inline-block mt-2 text-xs font-medium px-2.5 py-0.5 rounded-full bg-blue-100 text-blue-600">
                            Status: Proses / Perjalanan
                        </span>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                </div>

                <!-- Status Selesai -->
                <div class="bg-white rounded-2xl p-5 border border-gray-100 shadow-sm flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Cucian Selesai</p>
                        <h4 class="text-2xl font-bold text-gray-800 mt-1">0</h4>
                        <span class="inline-block mt-2 text-xs font-medium px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-600">
                            Status: Selesai
                        </span>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Placeholder Content Card -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="flex items-center justify-between border-b border-gray-100 pb-4 mb-4">
                    <h4 class="font-bold text-gray-800 text-lg">Aktivitas Terkini</h4>
                    <span class="text-xs text-gray-400">Pembaruan Real-time</span>
                </div>
                <div class="text-center py-10">
                    <div class="w-16 h-16 mx-auto mb-3 rounded-full bg-sky-50 flex items-center justify-center text-medina">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <p class="text-gray-700 font-semibold">Belum Ada Aktivitas Pesanan</p>
                    <p class="text-sm text-gray-400 mt-1 max-w-sm mx-auto">
                        Infrastruktur sistem Medina Clean telah siap. Silakan lanjutkan ke tahap konfigurasi database dan alur pengguna.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
