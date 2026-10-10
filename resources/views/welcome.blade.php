<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Medina Clean — Jasa Cuci Karpet Masjid, Kantor & Rumah</title>

        <!-- Google Fonts: Poppins & Nunito -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#F9FAFB] text-gray-700 min-h-screen flex flex-col justify-between selection:bg-sky-100 selection:text-[#1484b3]">
        <!-- Header -->
        <header class="bg-white border-b border-gray-200 sticky top-0 z-50">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-18">
                    <a href="/" class="flex items-center">
                        <x-application-logo />
                    </a>

                    <nav class="flex items-center gap-3">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-4 py-2 bg-medina hover:bg-[#3baad3] text-white text-sm font-semibold rounded-lg shadow-sm transition">
                                Buka Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-medina transition">
                                Masuk
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-medina hover:bg-[#3baad3] text-white text-sm font-semibold rounded-lg shadow-sm transition">
                                    Daftar Akun
                                </a>
                            @endif
                        @endauth
                    </nav>
                </div>
            </div>
        </header>

        <main class="flex-grow">
            <!-- Hero with Live Cost Estimator -->
            <section class="border-b border-gray-200 bg-white py-14 sm:py-20">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                        <!-- Left: Value Proposition -->
                        <div class="lg:col-span-7">
                            <span class="inline-block text-xs font-semibold uppercase tracking-wider text-[#1484b3] bg-sky-50 px-3 py-1 rounded-md border border-sky-200">
                                Layanan Cuci Karpet Panggilan
                            </span>
                            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 mt-4 leading-tight">
                                Cuci karpet bersih, wangi, dan bebas debu di tempat Anda.
                            </h1>
                            <p class="mt-4 text-base sm:text-lg text-gray-600 leading-relaxed max-w-xl">
                                Medina Clean melayani pencucian karpet masjid, ruang kantor, dan permadani rumah. Tim kami datang membawa peralatan ekstraksi air dan deterjen khusus serat karpet.
                            </p>

                            <div class="mt-8 flex flex-wrap gap-3 items-center">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="px-5 py-3 bg-medina hover:bg-[#3baad3] text-white text-sm font-semibold rounded-lg shadow-sm transition">
                                        Lihat Status Pesanan
                                    </a>
                                @else
                                    <a href="{{ route('register') }}" class="px-5 py-3 bg-medina hover:bg-[#3baad3] text-white text-sm font-semibold rounded-lg shadow-sm transition">
                                        Pesan Jadwal Cuci
                                    </a>
                                    <a href="#kalkulator" class="px-4 py-3 bg-white border border-gray-300 hover:border-gray-400 text-gray-700 text-sm font-medium rounded-lg transition">
                                        Cek Estimasi Biaya &darr;
                                    </a>
                                @endauth
                            </div>

                            <div class="mt-10 pt-6 border-t border-gray-100 flex flex-wrap gap-6 text-xs text-gray-500">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                    <span>Peralatan ekstraksi debu & air</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                    <span>Deterjen ramah serat & cepat kering</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                    <span>Laporan progres real-time</span>
                                </div>
                            </div>
                        </div>

                        <!-- Right: Interactive Estimator Tool (Real Utility, Not Slop) -->
                        <div id="kalkulator" class="lg:col-span-5" x-data="{
                            length: 6,
                            width: 3,
                            rate: 15000,
                            get area() { return (this.length * this.width).toFixed(1); },
                            get total() { return Math.round(this.area * this.rate); },
                            formatIdr(val) { return new Intl.NumberFormat('id-ID').format(val); }
                        }">
                            <div class="bg-gray-50 border border-gray-200 rounded-2xl p-6 sm:p-7 shadow-sm">
                                <div class="flex items-center justify-between pb-4 border-b border-gray-200">
                                    <div>
                                        <h2 class="font-bold text-gray-900 text-base">Kalkulator Biaya Cuci</h2>
                                        <p class="text-xs text-gray-500 mt-0.5">Estimasi tarif Rp 15.000 / m²</p>
                                    </div>
                                    <span class="text-xs bg-white border border-gray-200 text-gray-600 px-2.5 py-1 rounded-md font-medium">
                                        Simulasi
                                    </span>
                                </div>

                                <div class="mt-5 space-y-4">
                                    <div>
                                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                            Panjang Karpet (Meter)
                                        </label>
                                        <div class="mt-1.5 flex items-center gap-3">
                                            <input type="range" min="1" max="30" step="0.5" x-model.number="length" class="w-full accent-[#4CBBE4] cursor-pointer">
                                            <span class="w-16 text-right font-bold text-gray-900 text-sm" x-text="length + ' m'"></span>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                            Lebar Karpet (Meter)
                                        </label>
                                        <div class="mt-1.5 flex items-center gap-3">
                                            <input type="range" min="1" max="10" step="0.5" x-model.number="width" class="w-full accent-[#4CBBE4] cursor-pointer">
                                            <span class="w-16 text-right font-bold text-gray-900 text-sm" x-text="width + ' m'"></span>
                                        </div>
                                    </div>

                                    <div class="bg-white rounded-xl p-4 border border-gray-200 space-y-2 mt-4">
                                        <div class="flex justify-between text-xs text-gray-500">
                                            <span>Total Luas Karpet:</span>
                                            <span class="font-semibold text-gray-800" x-text="area + ' m²'"></span>
                                        </div>
                                        <div class="flex justify-between items-baseline pt-2 border-t border-gray-100">
                                            <span class="text-xs font-semibold text-gray-700">Estimasi Biaya:</span>
                                            <span class="text-xl font-bold text-gray-900">
                                                Rp <span x-text="formatIdr(total)"></span>
                                            </span>
                                        </div>
                                    </div>

                                    @auth
                                        <a href="{{ route('customer.dashboard') }}" class="block w-full text-center py-3 bg-medina hover:bg-[#3baad3] text-white font-semibold text-sm rounded-lg shadow-sm transition">
                                            Pesan dengan Ukuran Ini
                                        </a>
                                    @else
                                        <a href="{{ route('register') }}" class="block w-full text-center py-3 bg-medina hover:bg-[#3baad3] text-white font-semibold text-sm rounded-lg shadow-sm transition">
                                            Lanjut ke Form Pemesanan
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Real Services Breakdown -->
            <section class="py-14 sm:py-18">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="max-w-xl">
                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">
                            Jenis Layanan Cuci Karpet
                        </h2>
                        <p class="text-sm text-gray-600 mt-2">
                            Peralatan dan metode kami disesuaikan dengan jenis bahan serta ketebalan karpet.
                        </p>
                    </div>

                    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Service 1 -->
                        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm flex flex-col justify-between">
                            <div>
                                <span class="text-xs font-bold text-[#1484b3] uppercase tracking-wider">Tempat Ibadah</span>
                                <h3 class="text-lg font-bold text-gray-900 mt-2">Karpet Masjid & Musholla</h3>
                                <p class="text-sm text-gray-600 mt-2 leading-relaxed">
                                    Pencucian karpet roll panjang atau sambungan shaf. Dikerjakan langsung di dalam masjid dengan mesin polisher & vacuum wet berkekuatan tinggi agar jamaah tetap nyaman.
                                </p>
                            </div>
                            <div class="mt-6 pt-4 border-t border-gray-100 text-xs text-gray-500 font-medium">
                                Cocok untuk: Karpet turki, karpet tebal 10–14 mm
                            </div>
                        </div>

                        <!-- Service 2 -->
                        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm flex flex-col justify-between">
                            <div>
                                <span class="text-xs font-bold text-[#1484b3] uppercase tracking-wider">Perkantoran</span>
                                <h3 class="text-lg font-bold text-gray-900 mt-2">Karpet Kantor & Ruang Rapat</h3>
                                <p class="text-sm text-gray-600 mt-2 leading-relaxed">
                                    Pembersihan karpet tile dan wall-to-wall untuk menghilangkan noda kopi, noda tinta, serta bau apek ruang ber-AC tanpa merusak lem karpet.
                                </p>
                            </div>
                            <div class="mt-6 pt-4 border-t border-gray-100 text-xs text-gray-500 font-medium">
                                Cocok untuk: Karpet tile, aula serbaguna, ballroom
                            </div>
                        </div>

                        <!-- Service 3 -->
                        <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm flex flex-col justify-between">
                            <div>
                                <span class="text-xs font-bold text-[#1484b3] uppercase tracking-wider">Residensial</span>
                                <h3 class="text-lg font-bold text-gray-900 mt-2">Karpet Rumah & Permadani</h3>
                                <p class="text-sm text-gray-600 mt-2 leading-relaxed">
                                    Pencucian higienis untuk karpet ruang keluarga dan kamar. Menghilangkan bulu hewan peliharaan, debu halus, dan tungau dengan sampo lembut.
                                </p>
                            </div>
                            <div class="mt-6 pt-4 border-t border-gray-100 text-xs text-gray-500 font-medium">
                                Cocok untuk: Permadani wol, sintetis, karpet bulu rasfur
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- How It Works (Concrete 4-Step Process) -->
            <section class="border-t border-gray-200 bg-white py-14 sm:py-18">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="max-w-xl">
                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">
                            Bagaimana Proses Pemesanannya?
                        </h2>
                        <p class="text-sm text-gray-600 mt-2">
                            Alur sederhana dari pesanan dibuat hingga karpet kembali bersih.
                        </p>
                    </div>

                    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="p-5 border border-gray-200 rounded-xl bg-gray-50/50">
                            <span class="w-7 h-7 rounded-md bg-medina text-white font-bold text-xs flex items-center justify-center">1</span>
                            <h4 class="font-bold text-gray-900 text-base mt-3">Pesan Jadwal</h4>
                            <p class="text-xs text-gray-600 mt-1.5 leading-relaxed">
                                Masukkan alamat lokasi, tanggal, serta estimasi panjang & lebar karpet.
                            </p>
                        </div>

                        <div class="p-5 border border-gray-200 rounded-xl bg-gray-50/50">
                            <span class="w-7 h-7 rounded-md bg-gray-800 text-white font-bold text-xs flex items-center justify-center">2</span>
                            <h4 class="font-bold text-gray-900 text-base mt-3">Tim Berangkat</h4>
                            <p class="text-xs text-gray-600 mt-1.5 leading-relaxed">
                                Petugas lapangan dikonfirmasi dan status perjalanan terlacak di akun Anda.
                            </p>
                        </div>

                        <div class="p-5 border border-gray-200 rounded-xl bg-gray-50/50">
                            <span class="w-7 h-7 rounded-md bg-gray-800 text-white font-bold text-xs flex items-center justify-center">3</span>
                            <h4 class="font-bold text-gray-900 text-base mt-3">Pencucian di Lokasi</h4>
                            <p class="text-xs text-gray-600 mt-1.5 leading-relaxed">
                                Karpet disikat, diekstraksi air kotornya, dan diberikan parfum antibakteri.
                            </p>
                        </div>

                        <div class="p-5 border border-gray-200 rounded-xl bg-gray-50/50">
                            <span class="w-7 h-7 rounded-md bg-emerald-600 text-white font-bold text-xs flex items-center justify-center">4</span>
                            <h4 class="font-bold text-gray-900 text-base mt-3">Selesai & Laporan</h4>
                            <p class="text-xs text-gray-600 mt-1.5 leading-relaxed">
                                Pekerjaan diverifikasi dan Anda dapat melakukan pembayaran via transfer bank.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-50 border-t border-gray-200 py-8">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center">
                    <x-application-logo />
                </div>
                <p class="text-xs text-gray-500">
                    &copy; {{ date('Y') }} Medina Clean. Layanan Jasa Cuci Karpet Profesional.
                </p>
            </div>
        </footer>
    </body>
</html>
