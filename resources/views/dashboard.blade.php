<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-xl sm:text-2xl text-gray-800 leading-tight">
                    Dashboard
                </h2>
                <p class="text-xs sm:text-sm text-gray-500 mt-0.5">Portal pengelolaan layanan Medina Clean</p>
            </div>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md text-xs font-medium bg-sky-50 text-[#1484b3] border border-sky-200">
                <span class="w-2 h-2 rounded-full bg-medina"></span>
                Sistem Aktif
            </span>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <!-- Welcome Info Card (Clean, grounded, no fuzzy gradient slop) -->
            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Selamat datang, {{ Auth::user()->name }}</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Akun Anda terdaftar dengan peran <b class="text-gray-900">{{ Auth::user()->role }}</b>. Silakan gunakan menu yang tersedia untuk mengelola layanan.
                    </p>
                </div>
                <div class="shrink-0">
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-medina hover:bg-[#3baad3] text-white text-xs font-semibold rounded-lg shadow-sm transition">
                            Ke Panel Admin &rarr;
                        </a>
                    @elseif(Auth::user()->isWorker())
                        <a href="{{ route('worker.dashboard') }}" class="px-4 py-2 bg-medina hover:bg-[#3baad3] text-white text-xs font-semibold rounded-lg shadow-sm transition">
                            Ke Tugas Lapangan &rarr;
                        </a>
                    @else
                        <a href="{{ route('customer.dashboard') }}" class="px-4 py-2 bg-medina hover:bg-[#3baad3] text-white text-xs font-semibold rounded-lg shadow-sm transition">
                            Lihat Pesanan Saya &rarr;
                        </a>
                    @endif
                </div>
            </div>

            <!-- Operational Status Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm">
                    <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Menunggu Jadwal</span>
                    <p class="text-2xl font-bold text-gray-900 mt-2">0</p>
                    <span class="inline-block mt-2 text-xs font-semibold text-orange-700 bg-orange-50 border border-orange-200 px-2 py-0.5 rounded">
                        Status: Menunggu
                    </span>
                </div>

                <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm">
                    <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Sedang Dikerjakan</span>
                    <p class="text-2xl font-bold text-gray-900 mt-2">0</p>
                    <span class="inline-block mt-2 text-xs font-semibold text-blue-700 bg-blue-50 border border-blue-200 px-2 py-0.5 rounded">
                        Status: Proses / Cuci
                    </span>
                </div>

                <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm">
                    <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Cucian Selesai</span>
                    <p class="text-2xl font-bold text-gray-900 mt-2">0</p>
                    <span class="inline-block mt-2 text-xs font-semibold text-emerald-700 bg-emerald-50 border border-emerald-200 px-2 py-0.5 rounded">
                        Status: Selesai
                    </span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
