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

    <div class="py-6 sm:py-8" x-data="">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 space-y-4">
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

            <!-- Worker Status Card -->
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
                <button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-report-modal')" class="w-full py-3 bg-medina hover:bg-[#3baad3] text-white font-semibold text-sm rounded-lg shadow-sm flex items-center justify-center gap-2 transition cursor-pointer">
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
                                <h5 class="font-bold text-gray-900 text-base mt-0.5">{{ $order->customer->name ?? 'Pelanggan Offline / Masjid' }}</h5>
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
                                <span>{{ $order->carpet_length }} m &times; {{ $order->carpet_width }} m ({{ number_format($order->carpet_length * $order->carpet_width, 1) }} m²)</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="font-medium text-gray-500 w-16 shrink-0">Kontak:</span>
                                <span>{{ $order->customer->phone ?? $order->customer->email ?? 'Hubungi pengurus lokasi' }}</span>
                            </div>
                        </div>

                        <div class="pt-1 flex items-center gap-2">
                            <button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'update-status-modal-{{ $order->id }}')" class="flex-1 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-xs font-semibold rounded-md border border-gray-200 transition cursor-pointer">
                                Ubah Status Pengerjaan
                            </button>
                            <a href="https://maps.google.com/?q={{ urlencode($order->location) }}" target="_blank" rel="noopener noreferrer" class="px-3.5 py-2 bg-white border border-gray-300 hover:border-gray-400 text-gray-700 text-xs font-medium rounded-md transition cursor-pointer">
                                Buka Google Maps &rarr;
                            </a>
                        </div>
                    </div>

                    <!-- Modal Ubah Status Pengerjaan #{{ $order->id }} -->
                    <x-modal name="update-status-modal-{{ $order->id }}" focusable maxWidth="md">
                        <form method="POST" action="{{ route('worker.orders.update-status', $order) }}" class="p-6 space-y-4">
                            @csrf
                            @method('PATCH')
                            <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                                <div>
                                    <h3 class="text-base font-bold text-gray-900">Ubah Status Pengerjaan</h3>
                                    <p class="text-xs text-gray-500 mt-0.5">Pesanan #{{ $order->id }} &bull; {{ $order->location }}</p>
                                </div>
                                <button type="button" x-on:click="$dispatch('close')" class="text-gray-400 hover:text-gray-600 text-lg leading-none cursor-pointer">&times;</button>
                            </div>

                            <div class="space-y-2">
                                <label class="flex items-center gap-3 p-3 border border-gray-200 rounded-lg hover:border-medina cursor-pointer has-[:checked]:border-medina has-[:checked]:bg-sky-50/50">
                                    <input type="radio" name="job_status" value="MENUNGGU" {{ $order->job_status === 'MENUNGGU' ? 'checked' : '' }} class="text-medina focus:ring-medina">
                                    <div>
                                        <div class="text-xs font-bold text-gray-900">Menunggu</div>
                                        <div class="text-xs text-gray-500">Jadwal belum dimulai / antrean pengerjaan</div>
                                    </div>
                                </label>

                                <label class="flex items-center gap-3 p-3 border border-gray-200 rounded-lg hover:border-medina cursor-pointer has-[:checked]:border-medina has-[:checked]:bg-sky-50/50">
                                    <input type="radio" name="job_status" value="DALAM_PERJALANAN" {{ $order->job_status === 'DALAM_PERJALANAN' ? 'checked' : '' }} class="text-medina focus:ring-medina">
                                    <div>
                                        <div class="text-xs font-bold text-blue-700">Dalam Perjalanan</div>
                                        <div class="text-xs text-gray-500">Tim sedang menuju ke lokasi pemesan</div>
                                    </div>
                                </label>

                                <label class="flex items-center gap-3 p-3 border border-gray-200 rounded-lg hover:border-medina cursor-pointer has-[:checked]:border-medina has-[:checked]:bg-sky-50/50">
                                    <input type="radio" name="job_status" value="SEDANG_MENCUCI" {{ $order->job_status === 'SEDANG_MENCUCI' ? 'checked' : '' }} class="text-medina focus:ring-medina">
                                    <div>
                                        <div class="text-xs font-bold text-[#1484b3]">Sedang Mencuci</div>
                                        <div class="text-xs text-gray-500">Proses pencucian karpet sedang berlangsung</div>
                                    </div>
                                </label>

                                <label class="flex items-center gap-3 p-3 border border-gray-200 rounded-lg hover:border-medina cursor-pointer has-[:checked]:border-medina has-[:checked]:bg-sky-50/50">
                                    <input type="radio" name="job_status" value="SELESAI" {{ $order->job_status === 'SELESAI' ? 'checked' : '' }} class="text-medina focus:ring-medina">
                                    <div>
                                        <div class="text-xs font-bold text-emerald-700">Selesai Mencuci</div>
                                        <div class="text-xs text-gray-500">Pekerjaan selesai dan karpet telah dibersihkan</div>
                                    </div>
                                </label>
                            </div>

                            <div class="pt-2 flex items-center justify-end gap-2 border-t border-gray-100">
                                <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2 text-xs font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition cursor-pointer">
                                    Batal
                                </button>
                                <button type="submit" class="px-4 py-2 bg-medina hover:bg-[#3baad3] text-white text-xs font-semibold rounded-lg shadow-sm transition cursor-pointer">
                                    Simpan Status
                                </button>
                            </div>
                        </form>
                    </x-modal>
                @empty
                    <div class="bg-white rounded-xl p-8 border border-gray-200 text-center">
                        <p class="text-sm font-semibold text-gray-700">Belum ada tugas cuci yang dialokasikan.</p>
                        <p class="text-xs text-gray-500 mt-1">Admin akan menugaskan lokasi pekerjaan melalui dashboard pusat, atau gunakan tombol di atas untuk input pengerjaan mandiri.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Modal Form Input Laporan Harian Tim Lapang (PRD Flow 1) -->
    <x-modal name="create-report-modal" focusable maxWidth="lg">
        <form method="POST" action="{{ route('worker.orders.store') }}" class="p-6 space-y-4" x-data="{
            length: 6,
            width: 3,
            rate: 15000,
            get area() { return (this.length * this.width).toFixed(1); },
            get total() { return Math.round(this.area * this.rate); },
            formatIdr(val) { return new Intl.NumberFormat('id-ID').format(val); }
        }">
            @csrf
            <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                <div>
                    <h3 class="text-base font-bold text-gray-900">Input Laporan Pengerjaan Harian</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Catat pengerjaan cuci karpet langsung dari lapangan</p>
                </div>
                <button type="button" x-on:click="$dispatch('close')" class="text-gray-400 hover:text-gray-600 text-lg leading-none cursor-pointer">&times;</button>
            </div>

            <div>
                <label for="cleaning_date" class="block text-xs font-semibold text-gray-700">Tanggal Pengerjaan</label>
                <input type="date" id="cleaning_date" name="cleaning_date" value="{{ date('Y-m-d') }}" required class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-medina focus:ring-medina">
            </div>

            <div>
                <label for="location" class="block text-xs font-semibold text-gray-700">Alamat / Lokasi Cuci Karpet</label>
                <textarea id="location" name="location" rows="2" placeholder="Nama masjid/kantor, detail jalan, RT/RW..." required class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-medina focus:ring-medina"></textarea>
            </div>

            <div>
                <label for="customer_id" class="block text-xs font-semibold text-gray-700">Pelanggan Pemesan (Opsional)</label>
                <select id="customer_id" name="customer_id" class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-medina focus:ring-medina">
                    <option value="">-- Pemesan Lapangan / Pengurus Masjid Langsung --</option>
                    @foreach($customers as $cust)
                        <option value="{{ $cust->id }}">{{ $cust->name }} ({{ $cust->phone ?? $cust->email }})</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label for="carpet_length" class="block text-xs font-semibold text-gray-700">Panjang (Meter)</label>
                    <input type="number" step="0.1" min="0.5" max="100" id="carpet_length" name="carpet_length" x-model.number="length" required class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-medina focus:ring-medina">
                </div>
                <div>
                    <label for="carpet_width" class="block text-xs font-semibold text-gray-700">Lebar (Meter)</label>
                    <input type="number" step="0.1" min="0.5" max="50" id="carpet_width" name="carpet_width" x-model.number="width" required class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-medina focus:ring-medina">
                </div>
            </div>

            <div>
                <label for="job_status" class="block text-xs font-semibold text-gray-700">Status Saat Ini</label>
                <select id="job_status" name="job_status" required class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-medina focus:ring-medina">
                    <option value="DALAM_PERJALANAN">Dalam Perjalanan ke Lokasi</option>
                    <option value="SEDANG_MENCUCI" selected>Sedang Mencuci di Lokasi</option>
                    <option value="SELESAI">Selesai Mencuci</option>
                </select>
            </div>

            <!-- Ringkasan Luas & Nilai Pekerjaan -->
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-3.5 space-y-1.5 text-xs">
                <div class="flex justify-between text-gray-600">
                    <span>Luas Karpet Terhitung:</span>
                    <span class="font-bold text-gray-900" x-text="area + ' m²'"></span>
                </div>
                <div class="flex justify-between text-gray-600">
                    <span>Tarif Standar:</span>
                    <span class="text-gray-700">Rp 15.000 / m²</span>
                </div>
                <div class="flex justify-between items-baseline pt-2 border-t border-gray-200 font-bold text-gray-900">
                    <span>Nilai Pekerjaan:</span>
                    <span class="text-base text-[#1484b3]">Rp <span x-text="formatIdr(total)"></span></span>
                </div>
            </div>

            <div class="pt-2 flex items-center justify-end gap-2 border-t border-gray-100">
                <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2 text-xs font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition cursor-pointer">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2.5 bg-medina hover:bg-[#3baad3] text-white text-xs font-semibold rounded-lg shadow-sm transition cursor-pointer">
                    Simpan Laporan
                </button>
            </div>
        </form>
    </x-modal>
</x-app-layout>
