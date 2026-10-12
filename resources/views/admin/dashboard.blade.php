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
            <!-- Flash Status Notifications -->
            @if(session('status'))
                <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-xs text-emerald-800 flex items-start gap-3">
                    <svg class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <div class="flex-1 font-medium">{{ session('status') }}</div>
                </div>
            @endif

            @if(session('error'))
                <div class="p-4 bg-red-50 border border-red-200 rounded-xl text-xs text-red-800 flex items-start gap-3">
                    <svg class="w-4 h-4 text-red-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    <div class="flex-1 font-medium">{{ session('error') }}</div>
                </div>
            @endif

            @if($errors->any())
                <div class="p-4 bg-red-50 border border-red-200 rounded-xl text-xs text-red-800 space-y-1">
                    <div class="font-bold">Terjadi kendala pada isian formulir:</div>
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

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
                    <button type="button" @click="$dispatch('open-modal', 'create-worker-modal')" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-medina hover:bg-[#3baad3] text-white text-xs font-semibold rounded-lg shadow-sm transition cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Tambah Tim Lapang
                    </button>
                    <a href="{{ route('admin.orders.export', request()->query()) }}" class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-white border border-gray-300 hover:border-gray-400 text-gray-700 text-xs font-semibold rounded-lg transition cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        Ekspor Laporan (.xls/.csv)
                    </a>
                </div>
                <div class="text-xs text-gray-500">
                    Petugas Terdaftar: <span class="font-bold text-gray-800">{{ $totalWorkers }} Orang</span> &bull; Pelanggan: <span class="font-bold text-gray-800">{{ $totalCustomers }} Akun</span>
                </div>
            </div>

            <!-- Search & Filter Bar -->
            <div class="bg-white rounded-xl p-4 border border-gray-200 shadow-sm">
                <form method="GET" action="{{ route('admin.dashboard') }}" class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-center">
                    <div class="sm:col-span-5">
                        <label for="search" class="sr-only">Cari Data</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </div>
                            <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Cari alamat, nama pemesan, atau petugas..." class="pl-9 block w-full rounded-lg border-gray-300 text-xs sm:text-sm focus:border-medina focus:ring-medina">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <select name="job_status" class="block w-full rounded-lg border-gray-300 text-xs sm:text-sm focus:border-medina focus:ring-medina">
                            <option value="ALL">-- Semua Status Pengerjaan --</option>
                            <option value="MENUNGGU" {{ request('job_status') === 'MENUNGGU' ? 'selected' : '' }}>Menunggu Jadwal</option>
                            <option value="DALAM_PERJALANAN" {{ request('job_status') === 'DALAM_PERJALANAN' ? 'selected' : '' }}>Dalam Perjalanan</option>
                            <option value="SEDANG_MENCUCI" {{ request('job_status') === 'SEDANG_MENCUCI' ? 'selected' : '' }}>Sedang Mencuci</option>
                            <option value="SELESAI" {{ request('job_status') === 'SELESAI' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>

                    <div class="sm:col-span-2">
                        <select name="payment_status" class="block w-full rounded-lg border-gray-300 text-xs sm:text-sm focus:border-medina focus:ring-medina">
                            <option value="ALL">-- Semua Pembayaran --</option>
                            <option value="PENDING" {{ request('payment_status') === 'PENDING' ? 'selected' : '' }}>Belum Lunas</option>
                            <option value="PAID" {{ request('payment_status') === 'PAID' ? 'selected' : '' }}>Lunas</option>
                        </select>
                    </div>

                    <div class="sm:col-span-2 flex items-center gap-2">
                        <button type="submit" class="flex-1 py-2 px-3 bg-gray-800 hover:bg-gray-900 text-white font-semibold text-xs rounded-lg transition cursor-pointer">
                            Filter
                        </button>
                        @if(request()->hasAny(['search', 'job_status', 'payment_status']))
                            <a href="{{ route('admin.dashboard') }}" class="py-2 px-2.5 text-xs text-gray-500 hover:text-gray-800 bg-gray-100 hover:bg-gray-200 rounded-lg transition" title="Reset Filter">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Data Table (Desktop-Optimized) -->
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <div>
                        <h4 class="font-bold text-gray-900 text-base">Laporan Pekerjaan Terkini</h4>
                        <p class="text-xs text-gray-500 mt-0.5">Daftar pesanan aktif, alokasi tim lapangan, dan verifikasi</p>
                    </div>
                    <span class="text-xs text-gray-500 font-medium">Total: {{ $orders->total() }} Pesanan</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs sm:text-sm text-gray-600">
                        <thead class="bg-gray-50 text-xs uppercase text-gray-500 font-semibold border-b border-gray-200">
                            <tr>
                                <th class="px-5 py-3">No. & Tanggal</th>
                                <th class="px-5 py-3">Pelanggan</th>
                                <th class="px-5 py-3">Lokasi</th>
                                <th class="px-5 py-3">Ukuran (P &times; L)</th>
                                <th class="px-5 py-3">Petugas Lapangan</th>
                                <th class="px-5 py-3">Status Pekerjaan</th>
                                <th class="px-5 py-3">Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($orders as $order)
                                <tr class="hover:bg-gray-50/70 transition">
                                    <td class="px-5 py-3.5 font-medium text-gray-900">
                                        #{{ $order->id }}
                                        <div class="text-xs text-gray-400">{{ $order->cleaning_date->format('d/m/Y') }}</div>
                                    </td>
                                    <td class="px-5 py-3.5">
                                        <div class="font-semibold text-gray-900">{{ $order->customer->name ?? 'Pemesan Lapangan / Walk-in' }}</div>
                                        <div class="text-xs text-gray-400">{{ $order->customer->phone ?? $order->customer->email ?? '-' }}</div>
                                    </td>
                                    <td class="px-5 py-3.5 max-w-xs truncate text-gray-700" title="{{ $order->location }}">{{ $order->location }}</td>
                                    <td class="px-5 py-3.5 text-gray-800">
                                        {{ $order->carpet_length }} &times; {{ $order->carpet_width }} m
                                        <div class="text-xs text-gray-400">({{ number_format($order->carpet_length * $order->carpet_width, 1) }} m²)</div>
                                    </td>
                                    <td class="px-5 py-3.5">
                                        @if($order->worker)
                                            <div class="font-medium text-gray-900">{{ $order->worker->name }}</div>
                                            <button type="button" @click="$dispatch('open-modal', 'assign-worker-{{ $order->id }}')" class="text-[11px] text-[#1484b3] hover:underline cursor-pointer">
                                                Ganti Petugas
                                            </button>
                                        @else
                                            <button type="button" @click="$dispatch('open-modal', 'assign-worker-{{ $order->id }}')" class="px-2.5 py-1 bg-sky-50 text-[#1484b3] hover:bg-sky-100 border border-sky-200 rounded text-xs font-semibold transition cursor-pointer">
                                                + Tugaskan Tim
                                            </button>
                                        @endif
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
                                        <div class="text-[11px] text-gray-500 mt-0.5">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                                    </td>
                                </tr>

                                <!-- Modal Penugasan Petugas Lapangan #{{ $order->id }} -->
                                <x-modal name="assign-worker-{{ $order->id }}" focusable maxWidth="md">
                                    <form method="POST" action="{{ route('admin.orders.assign', $order) }}" class="p-6 space-y-4">
                                        @csrf
                                        @method('PATCH')
                                        <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                                            <div>
                                                <h3 class="text-base font-bold text-gray-900">Alokasikan Tim Lapangan</h3>
                                                <p class="text-xs text-gray-500 mt-0.5">Pesanan #{{ $order->id }} &bull; {{ $order->location }}</p>
                                            </div>
                                            <button type="button" x-on:click="$dispatch('close')" class="text-gray-400 hover:text-gray-600 text-lg leading-none cursor-pointer">&times;</button>
                                        </div>

                                        <div>
                                            <label for="worker_id_{{ $order->id }}" class="block text-xs font-semibold text-gray-700 mb-1">Pilih Petugas yang Ditugaskan</label>
                                            <select id="worker_id_{{ $order->id }}" name="worker_id" required class="block w-full rounded-lg border-gray-300 text-sm focus:border-medina focus:ring-medina">
                                                <option value="">-- Pilih Petugas Lapangan --</option>
                                                @foreach($workers as $worker)
                                                    <option value="{{ $worker->id }}" {{ $order->worker_id === $worker->id ? 'selected' : '' }}>
                                                        {{ $worker->name }} ({{ $worker->phone ?? $worker->email }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="pt-2 flex items-center justify-end gap-2 border-t border-gray-100">
                                            <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2 text-xs font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition cursor-pointer">
                                                Batal
                                            </button>
                                            <button type="submit" class="px-4 py-2 bg-medina hover:bg-[#3baad3] text-white text-xs font-semibold rounded-lg shadow-sm transition cursor-pointer">
                                                Simpan Penugasan
                                            </button>
                                        </div>
                                    </form>
                                </x-modal>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-5 py-10 text-center text-gray-400">
                                        Tidak ada data pesanan yang sesuai dengan kriteria filter.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($orders->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $orders->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Form Tambah Tim Lapang (PRD Flow 2) -->
    <x-modal name="create-worker-modal" focusable maxWidth="lg">
        <form method="POST" action="{{ route('admin.workers.store') }}" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf
            <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                <div>
                    <h3 class="text-base font-bold text-gray-900">Pendaftaran Tim Lapangan Baru</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Input data diri, nomor kontak, domisili, dan foto identitas KTP</p>
                </div>
                <button type="button" x-on:click="$dispatch('close')" class="text-gray-400 hover:text-gray-600 text-lg leading-none cursor-pointer">&times;</button>
            </div>

            <div>
                <label for="worker_name" class="block text-xs font-semibold text-gray-700">Nama Lengkap Petugas</label>
                <input type="text" id="worker_name" name="name" value="{{ old('name') }}" required placeholder="Contoh: Ahmad Fauzi" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-medina focus:ring-medina">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label for="worker_email" class="block text-xs font-semibold text-gray-700">Alamat Email (Untuk Login)</label>
                    <input type="email" id="worker_email" name="email" value="{{ old('email') }}" required placeholder="petugas@medinaclean.com" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-medina focus:ring-medina">
                </div>
                <div>
                    <label for="worker_phone" class="block text-xs font-semibold text-gray-700">Nomor Telepon / WhatsApp</label>
                    <input type="text" id="worker_phone" name="phone" value="{{ old('phone') }}" required placeholder="081234567890" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-medina focus:ring-medina">
                </div>
            </div>

            <div>
                <label for="worker_address" class="block text-xs font-semibold text-gray-700">Alamat Domisili Petugas</label>
                <textarea id="worker_address" name="address" rows="2" required placeholder="Alamat tinggal lengkap petugas..." class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-medina focus:ring-medina">{{ old('address') }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label for="worker_password" class="block text-xs font-semibold text-gray-700">Kata Sandi Akun (Min. 8 Karakter)</label>
                    <input type="password" id="worker_password" name="password" required placeholder="Minimal 8 karakter" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-medina focus:ring-medina">
                </div>
                <div>
                    <label for="worker_ktp" class="block text-xs font-semibold text-gray-700">Upload Foto KTP (JPG, PNG, max 2MB)</label>
                    <input type="file" id="worker_ktp" name="ktp_photo" accept="image/*" required class="mt-1 block w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-sky-50 file:text-[#1484b3] hover:file:bg-sky-100 cursor-pointer">
                </div>
            </div>

            <div class="pt-2 flex items-center justify-end gap-2 border-t border-gray-100">
                <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2 text-xs font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition cursor-pointer">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2.5 bg-medina hover:bg-[#3baad3] text-white text-xs font-semibold rounded-lg shadow-sm transition cursor-pointer">
                    Daftarkan Petugas Lapangan
                </button>
            </div>
        </form>
    </x-modal>
</x-app-layout>
