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

            <!-- Order Action Banner -->
            <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h3 class="text-base font-bold text-gray-900">Ingin Menjadwalkan Cuci Karpet?</h3>
                    <p class="text-xs text-gray-600 mt-1">
                        Pesan layanan cuci karpet panggilan untuk masjid, kantor, atau rumah Anda.
                    </p>
                </div>
                <div class="shrink-0">
                    <button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-order-modal')" class="w-full sm:w-auto px-4 py-2.5 bg-medina hover:bg-[#3baad3] text-white font-semibold text-xs rounded-lg shadow-sm transition cursor-pointer">
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
                                <span>{{ $order->carpet_length }} m &times; {{ $order->carpet_width }} m ({{ number_format($order->carpet_length * $order->carpet_width, 1) }} m²)</span>
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
                            <div class="space-y-0.5">
                                <span class="text-gray-500">Status Bayar: 
                                    <b class="{{ $order->payment_status === 'PAID' ? 'text-emerald-700' : 'text-orange-600' }}">
                                        {{ $order->payment_status === 'PAID' ? 'Lunas' : 'Menunggu Pembayaran' }}
                                    </b>
                                </span>
                                @if($order->payment_status === 'PAID' && $order->payment_method)
                                    <div class="text-[11px] text-gray-400">Metode: {{ $order->payment_method }}</div>
                                @endif
                            </div>

                            <div class="flex items-center gap-2">
                                @if($order->payment_status !== 'PAID')
                                    <button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'pay-order-{{ $order->id }}')" class="px-3 py-1.5 bg-medina text-white rounded-md font-semibold hover:bg-[#3baad3] transition cursor-pointer">
                                        Instruksi Bayar
                                    </button>
                                @endif

                                @if($order->job_status === 'MENUNGGU' && $order->payment_status !== 'PAID')
                                    <form method="POST" action="{{ route('customer.orders.destroy', $order) }}" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan #{{ $order->id }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2.5 py-1.5 text-gray-400 hover:text-red-600 text-xs font-medium transition cursor-pointer">
                                            Batal
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Modal Pembayaran Order #{{ $order->id }} -->
                    <x-modal name="pay-order-{{ $order->id }}" focusable maxWidth="md">
                        <form method="POST" action="{{ route('customer.orders.pay', $order) }}" class="p-6 space-y-4">
                            @csrf
                            <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                                <div>
                                    <h3 class="text-base font-bold text-gray-900">Instruksi Pembayaran</h3>
                                    <p class="text-xs text-gray-500 mt-0.5">Pesanan #{{ $order->id }} &bull; Jadwal: {{ $order->cleaning_date->format('d/m/Y') }}</p>
                                </div>
                                <button type="button" x-on:click="$dispatch('close')" class="text-gray-400 hover:text-gray-600 text-lg leading-none cursor-pointer">&times;</button>
                            </div>

                            <div class="bg-sky-50 border border-sky-200 rounded-xl p-4 text-center">
                                <span class="text-xs text-gray-600 font-medium">Total yang Harus Dibayar:</span>
                                <div class="text-2xl font-bold text-[#1484b3] mt-1">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </div>
                                <p class="text-[11px] text-gray-500 mt-1">Mohon transfer sesuai nominal pas untuk kemudahan verifikasi.</p>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-2">Pilih Rekening Tujuan Transfer:</label>
                                <div class="space-y-2">
                                    <label class="flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:border-medina cursor-pointer has-[:checked]:border-medina has-[:checked]:bg-sky-50/50">
                                        <div class="flex items-center gap-2.5">
                                            <input type="radio" name="payment_method" value="BCA" checked class="text-medina focus:ring-medina">
                                            <div>
                                                <div class="text-xs font-bold text-gray-900">Bank Central Asia (BCA)</div>
                                                <div class="text-xs text-gray-500 font-mono">123-456-7890</div>
                                            </div>
                                        </div>
                                        <span class="text-xs text-gray-500 font-medium">a.n Medina Clean</span>
                                    </label>

                                    <label class="flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:border-medina cursor-pointer has-[:checked]:border-medina has-[:checked]:bg-sky-50/50">
                                        <div class="flex items-center gap-2.5">
                                            <input type="radio" name="payment_method" value="MANDIRI" class="text-medina focus:ring-medina">
                                            <div>
                                                <div class="text-xs font-bold text-gray-900">Bank Mandiri</div>
                                                <div class="text-xs text-gray-500 font-mono">137-00-123456-7</div>
                                            </div>
                                        </div>
                                        <span class="text-xs text-gray-500 font-medium">a.n Medina Clean</span>
                                    </label>

                                    <label class="flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:border-medina cursor-pointer has-[:checked]:border-medina has-[:checked]:bg-sky-50/50">
                                        <div class="flex items-center gap-2.5">
                                            <input type="radio" name="payment_method" value="BSI" class="text-medina focus:ring-medina">
                                            <div>
                                                <div class="text-xs font-bold text-gray-900">Bank Syariah Indonesia (BSI)</div>
                                                <div class="text-xs text-gray-500 font-mono">712-345-6789</div>
                                            </div>
                                        </div>
                                        <span class="text-xs text-gray-500 font-medium">a.n Medina Clean</span>
                                    </label>

                                    <label class="flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:border-medina cursor-pointer has-[:checked]:border-medina has-[:checked]:bg-sky-50/50">
                                        <div class="flex items-center gap-2.5">
                                            <input type="radio" name="payment_method" value="QRIS" class="text-medina focus:ring-medina">
                                            <div>
                                                <div class="text-xs font-bold text-gray-900">QRIS (Semua E-Wallet)</div>
                                                <div class="text-xs text-gray-500">GoPay, OVO, ShopeePay, DANA</div>
                                            </div>
                                        </div>
                                        <span class="text-xs text-emerald-600 font-medium">Instan</span>
                                    </label>
                                </div>
                            </div>

                            <div class="pt-2 flex items-center justify-end gap-2 border-t border-gray-100">
                                <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2 text-xs font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition cursor-pointer">
                                    Tutup
                                </button>
                                <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold rounded-lg shadow-sm transition cursor-pointer">
                                    Saya Sudah Bayar
                                </button>
                            </div>
                        </form>
                    </x-modal>
                @empty
                    <div class="bg-white rounded-xl p-8 border border-gray-200 text-center">
                        <p class="text-sm font-semibold text-gray-700">Belum ada riwayat pesanan.</p>
                        <p class="text-xs text-gray-500 mt-1">Gunakan tombol "Pesan Jasa Cuci" di atas untuk membuat pesanan pertama Anda.</p>
                        <div class="mt-4">
                            <button type="button" x-data="" x-on:click.prevent="$dispatch('open-modal', 'create-order-modal')" class="px-4 py-2 bg-medina hover:bg-[#3baad3] text-white font-semibold text-xs rounded-lg shadow-sm transition cursor-pointer">
                                Buat Pesanan Baru
                            </button>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Modal Form Pemesanan Cuci Karpet -->
    <x-modal name="create-order-modal" focusable maxWidth="lg">
        <form method="POST" action="{{ route('customer.orders.store') }}" class="p-6 space-y-4" x-data="{
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
                    <h3 class="text-base font-bold text-gray-900">Pesan Jasa Cuci Karpet</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Isi detail jadwal, lokasi, dan estimasi dimensi karpet</p>
                </div>
                <button type="button" x-on:click="$dispatch('close')" class="text-gray-400 hover:text-gray-600 text-lg leading-none cursor-pointer">&times;</button>
            </div>

            <div>
                <label for="cleaning_date" class="block text-xs font-semibold text-gray-700">Tanggal Rencana Pengerjaan</label>
                <input type="date" id="cleaning_date" name="cleaning_date" min="{{ date('Y-m-d') }}" value="{{ old('cleaning_date', date('Y-m-d')) }}" required class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-medina focus:ring-medina">
            </div>

            <div>
                <label for="location" class="block text-xs font-semibold text-gray-700">Alamat Lengkap Lokasi Cuci</label>
                <textarea id="location" name="location" rows="2" placeholder="Nama masjid/kantor/perumahan, blok, nomor jalan..." required class="mt-1 block w-full rounded-lg border-gray-300 text-sm focus:border-medina focus:ring-medina">{{ old('location') }}</textarea>
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

            <!-- Ringkasan Luas & Estimasi Biaya -->
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-3.5 space-y-1.5 text-xs">
                <div class="flex justify-between text-gray-600">
                    <span>Total Luas Karpet:</span>
                    <span class="font-bold text-gray-900" x-text="area + ' m²'"></span>
                </div>
                <div class="flex justify-between text-gray-600">
                    <span>Tarif Cuci Karpet:</span>
                    <span class="text-gray-700">Rp 15.000 / m²</span>
                </div>
                <div class="flex justify-between items-baseline pt-2 border-t border-gray-200 font-bold text-gray-900">
                    <span>Estimasi Biaya:</span>
                    <span class="text-base text-[#1484b3]">Rp <span x-text="formatIdr(total)"></span></span>
                </div>
            </div>

            <div class="pt-2 flex items-center justify-end gap-2 border-t border-gray-100">
                <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2 text-xs font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition cursor-pointer">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2.5 bg-medina hover:bg-[#3baad3] text-white text-xs font-semibold rounded-lg shadow-sm transition cursor-pointer">
                    Konfirmasi Pesanan
                </button>
            </div>
        </form>
    </x-modal>
</x-app-layout>
