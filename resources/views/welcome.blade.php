<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Medina Clean — Jasa Cuci Karpet Masjid, Kantor & Rumah Profesional</title>

        <!-- Google Fonts: Poppins & Nunito -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#F9FAFB] text-gray-700 min-h-screen flex flex-col justify-between selection:bg-sky-100 selection:text-[#1484b3]">
        <!-- Sticky Header -->
        <header class="bg-white/95 backdrop-blur-md border-b border-gray-200 sticky top-0 z-50 transition-all">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-3.5 sm:py-4">
                    <a href="/" class="flex items-center">
                        <x-application-logo />
                    </a>

                    <!-- Desktop Nav Links -->
                    <div class="hidden md:flex items-center gap-6 text-sm font-medium text-gray-600">
                        <a href="#layanan" class="hover:text-medina transition">Layanan</a>
                        <a href="#kenapa-kami" class="hover:text-medina transition">Keunggulan</a>
                        <a href="#alat" class="hover:text-medina transition">Alat & Standar</a>
                        <a href="#kalkulator" class="hover:text-medina transition">Simulasi Biaya</a>
                        <a href="#faq" class="hover:text-medina transition">FAQ</a>
                    </div>

                    <nav class="flex items-center gap-2.5 sm:gap-3">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-4 py-2 bg-medina hover:bg-[#3baad3] text-white text-xs sm:text-sm font-semibold rounded-lg shadow-sm transition">
                                Buka Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-3 py-2 text-xs sm:text-sm font-medium text-gray-700 hover:text-medina transition">
                                Masuk
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center px-3.5 sm:px-4 py-2 bg-medina hover:bg-[#3baad3] text-white text-xs sm:text-sm font-semibold rounded-lg shadow-sm transition">
                                    Pesan Jadwal
                                </a>
                            @endif
                        @endauth
                    </nav>
                </div>
            </div>
        </header>

        <main class="flex-grow">
            <!-- Hero with Live Cost Estimator & Quick Presets -->
            <section class="relative bg-gradient-to-b from-white via-sky-50/20 to-[#F9FAFB] border-b border-gray-200 py-12 sm:py-20 overflow-hidden">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-center">
                        <!-- Left: Value Proposition & Trust Signals -->
                        <div class="lg:col-span-7">
                            <div class="inline-flex items-center gap-2 bg-sky-50 border border-sky-200 text-[#1484b3] text-xs font-semibold px-3 py-1.5 rounded-full shadow-2xs">
                                <span class="flex h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                <span>Layanan Cuci Karpet Panggilan &bull; Jabodetabek</span>
                            </div>

                            <h1 class="text-3xl sm:text-4xl lg:text-[42px] font-bold text-gray-900 mt-4 leading-tight tracking-tight">
                                Karpet Bersih Higienis, Wangi & Bebas Tungau Langsung di Lokasi Anda.
                            </h1>

                            <p class="mt-4 text-base sm:text-lg text-gray-600 leading-relaxed max-w-xl">
                                Solusi profesional untuk karpet masjid, ruang kerja kantor, dan permadani rumah. Menggunakan teknologi ekstraksi air bertekanan dan deterjen pH netral aman untuk sujud, anak, serta hewan peliharaan.
                            </p>

                            <!-- CTAs -->
                            <div class="mt-8 flex flex-wrap gap-3 items-center">
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="px-6 py-3 bg-medina hover:bg-[#3baad3] text-white text-sm font-semibold rounded-xl shadow-sm transition inline-flex items-center gap-2">
                                        Lihat Status Pesanan
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                @else
                                    <a href="{{ route('register') }}" class="px-6 py-3 bg-medina hover:bg-[#3baad3] text-white text-sm font-semibold rounded-xl shadow-sm transition inline-flex items-center gap-2">
                                        Pesan Jadwal Cuci
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </a>
                                    <a href="https://wa.me/6281234567890?text=Halo%20Medina%20Clean%2C%20saya%20mau%20konsultasi%20cuci%20karpet" target="_blank" rel="noopener noreferrer" class="px-5 py-3 bg-white border border-gray-300 hover:border-gray-400 text-gray-700 text-sm font-medium rounded-xl transition inline-flex items-center gap-2">
                                        <svg class="w-4 h-4 text-emerald-600" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0012.04 2zm5.79 14.07c-.24.67-1.39 1.29-1.93 1.37-.51.08-1.16.11-3.69-.94-2.88-1.2-4.73-4.14-4.87-4.33-.14-.19-1.17-1.55-1.17-2.96 0-1.41.74-2.1 1-2.38.27-.27.59-.34.79-.34.2 0 .4 0 .58.01.19.01.44-.07.69.52.26.61.88 2.14.96 2.3.08.16.13.35.03.55-.1.2-.15.33-.3.51-.15.18-.32.4-.46.54-.15.15-.31.32-.13.63.18.31.79 1.3 1.7 2.11 1.17 1.04 2.16 1.37 2.47 1.52.31.15.49.13.67-.08.19-.21.79-.92 1-1.23.21-.31.42-.26.71-.15.29.11 1.83.86 2.14 1.02.31.16.52.24.6.37.08.13.08.77-.16 1.44z"/>
                                        </svg>
                                        Konsultasi WhatsApp
                                    </a>
                                @endauth
                            </div>

                            <!-- Trust Badges List -->
                            <div class="mt-8 pt-6 border-t border-gray-200/80 grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs text-gray-600">
                                <div class="flex items-center gap-2">
                                    <div class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <span class="font-medium">100% Teknisi Tetap</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <span class="font-medium">Kering 2–4 Jam di Tempat</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <span class="font-medium">Garansi Cuci Ulang</span>
                                </div>
                            </div>
                        </div>

                        <!-- Right: Interactive Estimator Tool with Quick Dimension Presets -->
                        <div id="kalkulator" class="lg:col-span-5" x-data="{
                            length: 6,
                            width: 3,
                            rate: 15000,
                            selectedPreset: 'masjid1',
                            setPreset(pLength, pWidth, presetKey) {
                                this.length = pLength;
                                this.width = pWidth;
                                this.selectedPreset = presetKey;
                            },
                            get area() { return (this.length * this.width).toFixed(1); },
                            get total() { return Math.round(this.area * this.rate); },
                            formatIdr(val) { return new Intl.NumberFormat('id-ID').format(val); }
                        }">
                            <div class="bg-white border border-gray-200/90 rounded-2xl p-6 sm:p-7 shadow-md relative">
                                <div class="flex items-center justify-between pb-4 border-b border-gray-100">
                                    <div>
                                        <h2 class="font-bold text-gray-900 text-base flex items-center gap-1.5">
                                            Kalkulator Estimasi Biaya
                                        </h2>
                                        <p class="text-xs text-gray-500 mt-0.5">Tarif transparan Rp 15.000 / m²</p>
                                    </div>
                                    <span class="text-xs bg-sky-50 text-[#1484b3] border border-sky-100 px-2.5 py-1 rounded-md font-semibold">
                                        Live Hitung
                                    </span>
                                </div>

                                <!-- Quick Presets Chips -->
                                <div class="mt-4">
                                    <label class="block text-[11px] font-semibold text-gray-500 uppercase tracking-wider mb-2">
                                        Pilihan Cepat Ukuran Umum:
                                    </label>
                                    <div class="flex flex-wrap gap-1.5">
                                        <button type="button" @click="setPreset(6, 1.2, 'masjid1')"
                                            :class="selectedPreset === 'masjid1' ? 'bg-[#4CBBE4] text-white border-transparent' : 'bg-gray-50 text-gray-700 border-gray-200 hover:bg-gray-100'"
                                            class="text-xs px-2.5 py-1 rounded-md border font-medium transition cursor-pointer">
                                            1 Shaf Masjid (1.2×6m)
                                        </button>
                                        <button type="button" @click="setPreset(12, 1.2, 'masjid2')"
                                            :class="selectedPreset === 'masjid2' ? 'bg-[#4CBBE4] text-white border-transparent' : 'bg-gray-50 text-gray-700 border-gray-200 hover:bg-gray-100'"
                                            class="text-xs px-2.5 py-1 rounded-md border font-medium transition cursor-pointer">
                                            2 Shaf Masjid (1.2×12m)
                                        </button>
                                        <button type="button" @click="setPreset(3, 2, 'rumah1')"
                                            :class="selectedPreset === 'rumah1' ? 'bg-[#4CBBE4] text-white border-transparent' : 'bg-gray-50 text-gray-700 border-gray-200 hover:bg-gray-100'"
                                            class="text-xs px-2.5 py-1 rounded-md border font-medium transition cursor-pointer">
                                            Karpet Rumah (2×3m)
                                        </button>
                                        <button type="button" @click="setPreset(4, 3, 'ruangtamu')"
                                            :class="selectedPreset === 'ruangtamu' ? 'bg-[#4CBBE4] text-white border-transparent' : 'bg-gray-50 text-gray-700 border-gray-200 hover:bg-gray-100'"
                                            class="text-xs px-2.5 py-1 rounded-md border font-medium transition cursor-pointer">
                                            Ruang Tamu (3×4m)
                                        </button>
                                        <button type="button" @click="setPreset(8, 5, 'kantor')"
                                            :class="selectedPreset === 'kantor' ? 'bg-[#4CBBE4] text-white border-transparent' : 'bg-gray-50 text-gray-700 border-gray-200 hover:bg-gray-100'"
                                            class="text-xs px-2.5 py-1 rounded-md border font-medium transition cursor-pointer">
                                            Aula Kantor (5×8m)
                                        </button>
                                    </div>
                                </div>

                                <div class="mt-4 space-y-3.5">
                                    <div>
                                        <div class="flex justify-between text-xs font-semibold text-gray-700 mb-1">
                                            <span>Panjang Karpet</span>
                                            <span class="font-bold text-[#1484b3]" x-text="length + ' meter'"></span>
                                        </div>
                                        <input type="range" min="1" max="30" step="0.2" x-model.number="length" @input="selectedPreset = ''" class="w-full accent-[#4CBBE4] cursor-pointer">
                                    </div>

                                    <div>
                                        <div class="flex justify-between text-xs font-semibold text-gray-700 mb-1">
                                            <span>Lebar Karpet</span>
                                            <span class="font-bold text-[#1484b3]" x-text="width + ' meter'"></span>
                                        </div>
                                        <input type="range" min="1" max="10" step="0.1" x-model.number="width" @input="selectedPreset = ''" class="w-full accent-[#4CBBE4] cursor-pointer">
                                    </div>

                                    <div class="bg-sky-50/70 rounded-xl p-4 border border-sky-100 space-y-2 mt-3">
                                        <div class="flex justify-between text-xs text-gray-600">
                                            <span>Total Estimasi Luas:</span>
                                            <span class="font-semibold text-gray-900" x-text="area + ' m²'"></span>
                                        </div>
                                        <div class="flex justify-between items-baseline pt-2 border-t border-sky-200/60">
                                            <div>
                                                <span class="text-xs font-semibold text-gray-700 block">Estimasi Biaya:</span>
                                                <span class="text-[10px] text-gray-500">*Diverifikasi ulang teknisi saat tiba</span>
                                            </div>
                                            <span class="text-2xl font-bold text-gray-900">
                                                Rp <span x-text="formatIdr(total)"></span>
                                            </span>
                                        </div>
                                    </div>

                                    @auth
                                        <a href="{{ route('customer.dashboard') }}" class="block w-full text-center py-3 bg-medina hover:bg-[#3baad3] text-white font-semibold text-sm rounded-xl shadow-sm transition">
                                            Pesan dengan Ukuran Ini
                                        </a>
                                    @else
                                        <a href="{{ route('register') }}" class="block w-full text-center py-3 bg-medina hover:bg-[#3baad3] text-white font-semibold text-sm rounded-xl shadow-sm transition">
                                            Lanjut ke Form Pemesanan
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Trust Counters / Highlight Ribbon -->
            <section class="border-b border-gray-200 bg-white py-6">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                        <div class="p-2">
                            <div class="text-2xl sm:text-3xl font-extrabold text-gray-900">4.9 / 5.0</div>
                            <div class="text-xs text-gray-500 mt-1 font-medium">Tingkat Kepuasan Klien</div>
                        </div>
                        <div class="p-2 border-l border-gray-100">
                            <div class="text-2xl sm:text-3xl font-extrabold text-[#1484b3]">100%</div>
                            <div class="text-xs text-gray-500 mt-1 font-medium">Teknisi Internal Terlatih</div>
                        </div>
                        <div class="p-2 border-l border-gray-100">
                            <div class="text-2xl sm:text-3xl font-extrabold text-gray-900">2–4 Jam</div>
                            <div class="text-xs text-gray-500 mt-1 font-medium">Kering Cepat Tanpa Jemur</div>
                        </div>
                        <div class="p-2 border-l border-gray-100">
                            <div class="text-2xl sm:text-3xl font-extrabold text-emerald-600">Garansi</div>
                            <div class="text-xs text-gray-500 mt-1 font-medium">Cuci Ulang Jika Masih Bau</div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Problem vs Solution Section (Inspirasi Gaia Home Hygiene ATM) -->
            <section id="kenapa-kami" class="py-16 sm:py-20 bg-[#F9FAFB]">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center max-w-2xl mx-auto">
                        <span class="text-xs font-bold text-[#1484b3] uppercase tracking-wider bg-sky-50 px-3 py-1 rounded-full border border-sky-200">
                            Fakta Kebersihan Karpet
                        </span>
                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mt-3">
                            Mengapa Vakum Biasa Saja Tidak Cukup?
                        </h2>
                        <p class="text-sm text-gray-600 mt-2.5 leading-relaxed">
                            Penyedot debu rumahan hanya mengangkat kotoran di permukaan teratas. Partikel debu mikro, tungau, dan residu tumpahan cairan terperangkap di dasar rajutan.
                        </p>
                    </div>

                    <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch">
                        <!-- Problem Card -->
                        <div class="bg-white rounded-2xl p-6 sm:p-8 border border-red-100 shadow-sm relative overflow-hidden flex flex-col justify-between">
                            <div class="absolute top-0 right-0 w-24 h-24 bg-red-50 rounded-bl-full pointer-events-none -mr-4 -mt-4"></div>
                            <div>
                                <div class="inline-flex items-center gap-2 text-xs font-bold text-red-600 uppercase tracking-wider">
                                    <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                    Risiko Jika Hanya Disedot Vakum Kering Biasa
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mt-3">
                                    Tungau & Kotoran Mengendap di Dasar Serat
                                </h3>
                                <ul class="mt-4 space-y-3 text-sm text-gray-600">
                                    <li class="flex items-start gap-3">
                                        <span class="text-red-500 font-bold shrink-0 mt-0.5">&#10005;</span>
                                        <span><strong>Tungau & Alergen:</strong> Menyebabkan bersin, gatal kulit, dan rasa tidak nyaman saat hidung menyentuh karpet waktu sujud.</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="text-red-500 font-bold shrink-0 mt-0.5">&#10005;</span>
                                        <span><strong>Bau Apek Lembap:</strong> Kelembapan udara AC mengunci sisa tumpahan minuman atau keringat di lapisan bawah spons.</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="text-red-500 font-bold shrink-0 mt-0.5">&#10005;</span>
                                        <span><strong>Warna Kusam & Serat Keras:</strong> Partikel debu tajam menggesek rajutan, membuat warna cepat pudar dan tekstur menjadi kasar.</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="mt-6 pt-4 border-t border-gray-100 text-xs text-red-600 font-medium">
                                *Vakum kering rumahan hanya mengangkat maksimal 30–40% kotoran dasar.
                            </div>
                        </div>

                        <!-- Solution Card -->
                        <div class="bg-white rounded-2xl p-6 sm:p-8 border border-sky-200 shadow-sm relative overflow-hidden flex flex-col justify-between">
                            <div class="absolute top-0 right-0 w-24 h-24 bg-sky-50 rounded-bl-full pointer-events-none -mr-4 -mt-4"></div>
                            <div>
                                <div class="inline-flex items-center gap-2 text-xs font-bold text-[#1484b3] uppercase tracking-wider">
                                    <span class="w-2 h-2 rounded-full bg-[#4CBBE4]"></span>
                                    Standar Deep Extraction Medina Clean
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mt-3">
                                    Pembersihan Menyeluruh & Ekstraksi Tuntas
                                </h3>
                                <ul class="mt-4 space-y-3 text-sm text-gray-600">
                                    <li class="flex items-start gap-3">
                                        <span class="text-emerald-500 font-bold shrink-0 mt-0.5">&#10003;</span>
                                        <span><strong>Mesin Polisher 175 RPM:</strong> Mengangkat noda membandel dan melembutkan serat karpet tanpa mengikis rajutan shaf.</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="text-emerald-500 font-bold shrink-0 mt-0.5">&#10003;</span>
                                        <span><strong>Twin Motor Extractor 2000W:</strong> Menyedot 85–90% air kotor hingga ke pori terdalam, mencegah jamur dan bau apek.</span>
                                    </li>
                                    <li class="flex items-start gap-3">
                                        <span class="text-emerald-500 font-bold shrink-0 mt-0.5">&#10003;</span>
                                        <span><strong>Shampo pH Netral & Disinfektan:</strong> Formula khusus tanpa deterjen keras atau residu lengket, aman bagi anak & jamaah.</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="mt-6 pt-4 border-t border-gray-100 text-xs text-emerald-600 font-semibold flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Hasil bersih mendalam, higienis, dan cepat kering 2–4 jam di lokasi.
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Real Services Breakdown -->
            <section id="layanan" class="py-16 sm:py-20 bg-white border-t border-b border-gray-200">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="max-w-2xl">
                        <span class="text-xs font-bold text-[#1484b3] uppercase tracking-wider bg-sky-50 px-3 py-1 rounded-full border border-sky-200">
                            Pilihan Layanan
                        </span>
                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mt-3">
                            Layanan Spesialis Cuci Karpet
                        </h2>
                        <p class="text-sm text-gray-600 mt-2">
                            Peralatan dan metode kami disesuaikan dengan jenis bahan, ketebalan, serta jadwal operasional tempat Anda.
                        </p>
                    </div>

                    <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Service 1: Masjid -->
                        <div class="bg-[#F9FAFB] rounded-2xl p-6 border border-gray-200 shadow-sm flex flex-col justify-between hover:border-[#4CBBE4] transition">
                            <div>
                                <div class="w-10 h-10 rounded-xl bg-sky-100 text-[#1484b3] flex items-center justify-center font-bold">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                </div>
                                <span class="text-xs font-bold text-[#1484b3] uppercase tracking-wider block mt-4">Tempat Ibadah</span>
                                <h3 class="text-lg font-bold text-gray-900 mt-1">Karpet Masjid & Musholla</h3>
                                <p class="text-sm text-gray-600 mt-2.5 leading-relaxed">
                                    Pencucian karpet roll panjang atau sambungan shaf langsung di dalam masjid. Tersedia jadwal malam (ba'da Isya) agar karpet kering sempurna sebelum waktu Subuh atau shalat Jumat.
                                </p>
                            </div>
                            <div class="mt-6 pt-4 border-t border-gray-200 text-xs text-gray-500 space-y-1">
                                <div class="font-medium text-gray-700">Cocok untuk:</div>
                                <div>Karpet turki, karpet tebal 10–14 mm, sajadah imam</div>
                            </div>
                        </div>

                        <!-- Service 2: Kantor -->
                        <div class="bg-[#F9FAFB] rounded-2xl p-6 border border-gray-200 shadow-sm flex flex-col justify-between hover:border-[#4CBBE4] transition">
                            <div>
                                <div class="w-10 h-10 rounded-xl bg-sky-100 text-[#1484b3] flex items-center justify-center font-bold">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </div>
                                <span class="text-xs font-bold text-[#1484b3] uppercase tracking-wider block mt-4">Perkantoran</span>
                                <h3 class="text-lg font-bold text-gray-900 mt-1">Karpet Kantor & Ruang Rapat</h3>
                                <p class="text-sm text-gray-600 mt-2.5 leading-relaxed">
                                    Pembersihan karpet tile dan wall-to-wall untuk mengangkat noda kopi, noda tinta, serta bau apek ruang ber-AC tanpa merusak lem karpet. Pengerjaan akhir pekan tanpa mengganggu jam kerja.
                                </p>
                            </div>
                            <div class="mt-6 pt-4 border-t border-gray-200 text-xs text-gray-500 space-y-1">
                                <div class="font-medium text-gray-700">Cocok untuk:</div>
                                <div>Karpet tile perkantoran, aula pertemuan, ballroom</div>
                            </div>
                        </div>

                        <!-- Service 3: Residensial -->
                        <div class="bg-[#F9FAFB] rounded-2xl p-6 border border-gray-200 shadow-sm flex flex-col justify-between hover:border-[#4CBBE4] transition">
                            <div>
                                <div class="w-10 h-10 rounded-xl bg-sky-100 text-[#1484b3] flex items-center justify-center font-bold">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                </div>
                                <span class="text-xs font-bold text-[#1484b3] uppercase tracking-wider block mt-4">Residensial</span>
                                <h3 class="text-lg font-bold text-gray-900 mt-1">Karpet Rumah & Permadani</h3>
                                <p class="text-sm text-gray-600 mt-2.5 leading-relaxed">
                                    Pencucian higienis untuk karpet ruang keluarga dan kamar anak. Mengangkat bulu hewan peliharaan, tungau, dan remah makanan dengan sampo lembut ramah kulit.
                                </p>
                            </div>
                            <div class="mt-6 pt-4 border-t border-gray-200 text-xs text-gray-500 space-y-1">
                                <div class="font-medium text-gray-700">Cocok untuk:</div>
                                <div>Permadani wol, karpet bulu sintetis, rasfur, karpet bermain</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Bagian: Transparansi Spesifikasi Alat & Bahan Pembersih -->
            <section id="alat" class="bg-white py-16 sm:py-20">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="max-w-2xl">
                        <span class="inline-block text-xs font-semibold uppercase tracking-wider text-[#1484b3] bg-sky-50 px-3 py-1 rounded-full border border-sky-200">
                            Standar Peralatan & Higienitas
                        </span>
                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mt-3">
                            Transparansi Alat Industri & Bahan Pembersih
                        </h2>
                        <p class="text-sm text-gray-600 mt-2 leading-relaxed">
                            Kami tidak mencuci secara asal basah. Setiap pengerjaan lapangan menggunakan peralatan berstandar industri dan formula kimia ramah serat agar karpet tetap awet dan higienis.
                        </p>
                    </div>

                    <div class="mt-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Alat 1: Single Disc Scrubber -->
                        <div class="bg-[#F9FAFB] border border-gray-200 rounded-xl p-5 shadow-sm flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between pb-3 border-b border-gray-200">
                                    <span class="text-[11px] font-bold uppercase tracking-wider text-gray-500">Mesin Utama</span>
                                    <span class="text-[11px] font-semibold text-[#1484b3] bg-sky-50 px-2 py-0.5 rounded border border-sky-200">175 RPM</span>
                                </div>
                                <h3 class="font-bold text-gray-900 text-base mt-3">Single-Disc Scrubber</h3>
                                <p class="text-xs text-gray-600 mt-2 leading-relaxed">
                                    Mesin sikat putar dengan pad bulu halus (*soft bristle*) untuk mengurai debu dan noda membandel hingga ke dasar rajutan tanpa merusak serat karpet.
                                </p>
                            </div>
                            <div class="mt-4 pt-3 border-t border-gray-200 text-xs text-gray-600 space-y-1">
                                <div class="flex items-center gap-1.5 text-gray-700 font-medium">
                                    <svg class="w-3.5 h-3.5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>Putaran konstan merata</span>
                                </div>
                                <div class="flex items-center gap-1.5 text-gray-700 font-medium">
                                    <svg class="w-3.5 h-3.5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>Tidak mengikis benang shaf</span>
                                </div>
                            </div>
                        </div>

                        <!-- Alat 2: Wet & Dry Extractor -->
                        <div class="bg-[#F9FAFB] border border-gray-200 rounded-xl p-5 shadow-sm flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between pb-3 border-b border-gray-200">
                                    <span class="text-[11px] font-bold uppercase tracking-wider text-gray-500">Ekstraksi Air</span>
                                    <span class="text-[11px] font-semibold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">2000W Twin Motor</span>
                                </div>
                                <h3 class="font-bold text-gray-900 text-base mt-3">Vacuum Extractor</h3>
                                <p class="text-xs text-gray-600 mt-2 leading-relaxed">
                                    Vakum ekstraksi bertekanan tinggi untuk menyedot air kotor dan sisa busa hingga 85–90% tuntas, mencegah timbulnya bau apek dan jamur.
                                </p>
                            </div>
                            <div class="mt-4 pt-3 border-t border-gray-200 text-xs text-gray-600 space-y-1">
                                <div class="flex items-center gap-1.5 text-gray-700 font-medium">
                                    <svg class="w-3.5 h-3.5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>Daya sedot air mendalam</span>
                                </div>
                                <div class="flex items-center gap-1.5 text-gray-700 font-medium">
                                    <svg class="w-3.5 h-3.5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>Kering lebih cepat di tempat</span>
                                </div>
                            </div>
                        </div>

                        <!-- Bahan 3: Shampo Karpet pH Netral -->
                        <div class="bg-[#F9FAFB] border border-gray-200 rounded-xl p-5 shadow-sm flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between pb-3 border-b border-gray-200">
                                    <span class="text-[11px] font-bold uppercase tracking-wider text-gray-500">Formula Pembersih</span>
                                    <span class="text-[11px] font-semibold text-sky-700 bg-sky-50 px-2 py-0.5 rounded border border-sky-200">pH Netral 7.0</span>
                                </div>
                                <h3 class="font-bold text-gray-900 text-base mt-3">Low-Foam Shampoo</h3>
                                <p class="text-xs text-gray-600 mt-2 leading-relaxed">
                                    Deterjen karpet khusus busa rendah yang mengikat minyak dan noda tanpa meninggalkan residu lengket pemicu penumpukan debu baru.
                                </p>
                            </div>
                            <div class="mt-4 pt-3 border-t border-gray-200 text-xs text-gray-600 space-y-1">
                                <div class="flex items-center gap-1.5 text-gray-700 font-medium">
                                    <svg class="w-3.5 h-3.5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>Aman saat sujud (non-iritasi)</span>
                                </div>
                                <div class="flex items-center gap-1.5 text-gray-700 font-medium">
                                    <svg class="w-3.5 h-3.5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>Bebas bahan pemutih klorin</span>
                                </div>
                            </div>
                        </div>

                        <!-- Bahan 4: Parfum & Antibakteri -->
                        <div class="bg-[#F9FAFB] border border-gray-200 rounded-xl p-5 shadow-sm flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between pb-3 border-b border-gray-200">
                                    <span class="text-[11px] font-bold uppercase tracking-wider text-gray-500">Finishing Higienis</span>
                                    <span class="text-[11px] font-semibold text-purple-700 bg-purple-50 px-2 py-0.5 rounded border border-purple-200">Non-Alkohol</span>
                                </div>
                                <h3 class="font-bold text-gray-900 text-base mt-3">Parfum Antibakteri</h3>
                                <p class="text-xs text-gray-600 mt-2 leading-relaxed">
                                    Pewangi aroma khas tempat ibadah/hotel dengan formula disinfektan untuk membasmi kuman, tungau, serta bau apek ruang AC.
                                </p>
                            </div>
                            <div class="mt-4 pt-3 border-t border-gray-200 text-xs text-gray-600 space-y-1">
                                <div class="flex items-center gap-1.5 text-gray-700 font-medium">
                                    <svg class="w-3.5 h-3.5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>Wangi segar dan tahan lama</span>
                                </div>
                                <div class="flex items-center gap-1.5 text-gray-700 font-medium">
                                    <svg class="w-3.5 h-3.5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <span>Cepat kering tanpa noda air</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Callout Info Kebutuhan Listrik & Air -->
                    <div class="mt-8 bg-sky-50 border border-sky-200 rounded-xl p-4 sm:p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-medina text-white flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-sm">Persyaratan Lapangan yang Praktis</h4>
                                <p class="text-xs text-gray-600 mt-0.5">
                                    Tim kami membawa seluruh mesin dan kabel rol panjang. Di lokasi, kami hanya memerlukan akses keran air bersih dan daya listrik mulai dari 900–1300 Watt.
                                </p>
                            </div>
                        </div>
                        <div class="shrink-0">
                            <a href="#kalkulator" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 hover:border-gray-400 text-gray-800 text-xs font-semibold rounded-lg shadow-sm transition">
                                Hitung Estimasi Biaya &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- How It Works (Concrete 4-Step Process) -->
            <section class="border-t border-gray-200 bg-[#F9FAFB] py-16 sm:py-20">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center max-w-xl mx-auto">
                        <span class="text-xs font-bold text-[#1484b3] uppercase tracking-wider bg-sky-50 px-3 py-1 rounded-full border border-sky-200">
                            Alur Pengerjaan
                        </span>
                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mt-3">
                            Bagaimana Proses Pemesanannya?
                        </h2>
                        <p class="text-sm text-gray-600 mt-2">
                            Alur mudah dan transparan dari awal pemesanan hingga karpet kembali wangi.
                        </p>
                    </div>

                    <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="p-6 border border-gray-200 rounded-2xl bg-white shadow-xs">
                            <span class="w-8 h-8 rounded-lg bg-medina text-white font-bold text-sm flex items-center justify-center">1</span>
                            <h4 class="font-bold text-gray-900 text-base mt-4">Pesan & Tentukan Jadwal</h4>
                            <p class="text-xs text-gray-600 mt-2 leading-relaxed">
                                Masukkan alamat lokasi, tanggal, serta estimasi panjang & lebar karpet melalui sistem atau WhatsApp.
                            </p>
                        </div>

                        <div class="p-6 border border-gray-200 rounded-2xl bg-white shadow-xs">
                            <span class="w-8 h-8 rounded-lg bg-gray-800 text-white font-bold text-sm flex items-center justify-center">2</span>
                            <h4 class="font-bold text-gray-900 text-base mt-4">Tim Berangkat ke Lokasi</h4>
                            <p class="text-xs text-gray-600 mt-2 leading-relaxed">
                                Petugas internal kami berangkat lengkap membawa mesin polisher, vacuum extractor, dan deterjen.
                            </p>
                        </div>

                        <div class="p-6 border border-gray-200 rounded-2xl bg-white shadow-xs">
                            <span class="w-8 h-8 rounded-lg bg-gray-800 text-white font-bold text-sm flex items-center justify-center">3</span>
                            <h4 class="font-bold text-gray-900 text-base mt-4">Pencucian di Lokasi</h4>
                            <p class="text-xs text-gray-600 mt-2 leading-relaxed">
                                Karpet disikat rata, air kotor diekstraksi 90% tuntas, dan disemprotkan pewangi antibakteri tahan lama.
                            </p>
                        </div>

                        <div class="p-6 border border-gray-200 rounded-2xl bg-white shadow-xs">
                            <span class="w-8 h-8 rounded-lg bg-emerald-600 text-white font-bold text-sm flex items-center justify-center">4</span>
                            <h4 class="font-bold text-gray-900 text-base mt-4">Pemeriksaan & Selesai</h4>
                            <p class="text-xs text-gray-600 mt-2 leading-relaxed">
                                Anda mengecek langsung hasilnya bersama teknisi. Pembayaran mudah via transfer bank atau QRIS.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Testimoni Pelanggan / Grounded Social Proof (ATM Gaia) -->
            <section id="testimoni" class="py-16 sm:py-20 bg-white border-t border-gray-200">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center max-w-xl mx-auto">
                        <span class="text-xs font-bold text-[#1484b3] uppercase tracking-wider bg-sky-50 px-3 py-1 rounded-full border border-sky-200">
                            Ulasan Nyata
                        </span>
                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mt-3">
                            Dipercaya Masjid, Kantor & Rumah
                        </h2>
                        <p class="text-sm text-gray-600 mt-2">
                            Pengalaman nyata pelanggan yang menggunakan jasa cuci karpet panggilan Medina Clean.
                        </p>
                    </div>

                    <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Review 1 -->
                        <div class="bg-[#F9FAFB] rounded-2xl p-6 border border-gray-200 shadow-sm flex flex-col justify-between">
                            <div>
                                <div class="flex items-center gap-1 text-amber-400">
                                    <span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span>
                                </div>
                                <p class="text-xs sm:text-sm text-gray-700 mt-4 leading-relaxed italic">
                                    "Alhamdulillah 16 shaf karpet masjid kami selesai dicuci dalam waktu 4 jam. Wanginya lembut khas kasturi, tidak bikin pusing, dan jamaah sangat nyaman saat sujud shalat Jumat. Sangat amanah."
                                </p>
                            </div>
                            <div class="mt-6 pt-4 border-t border-gray-200 flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-medina text-white font-bold text-xs flex items-center justify-center">
                                    RF
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-gray-900">H. Ridwan Fauzi</div>
                                    <div class="text-[11px] text-gray-500">Ketua DKM Masjid Baiturrahman, Jaksel</div>
                                </div>
                            </div>
                        </div>

                        <!-- Review 2 -->
                        <div class="bg-[#F9FAFB] rounded-2xl p-6 border border-gray-200 shadow-sm flex flex-col justify-between">
                            <div>
                                <div class="flex items-center gap-1 text-amber-400">
                                    <span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span>
                                </div>
                                <p class="text-xs sm:text-sm text-gray-700 mt-4 leading-relaxed italic">
                                    "Karpet ruang rapat kantor yang tadinya berbau apek AC dan bernoda kopi sekarang kembali segar dan bersih. Dikerjakan hari Sabtu jadi Senin pagi kantor sudah siap pakai tanpa bau basah."
                                </p>
                            </div>
                            <div class="mt-6 pt-4 border-t border-gray-200 flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-medina text-white font-bold text-xs flex items-center justify-center">
                                    NL
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-gray-900">Nadia Larasati</div>
                                    <div class="text-[11px] text-gray-500">Facility & GA Manager, Sudirman</div>
                                </div>
                            </div>
                        </div>

                        <!-- Review 3 -->
                        <div class="bg-[#F9FAFB] rounded-2xl p-6 border border-gray-200 shadow-sm flex flex-col justify-between">
                            <div>
                                <div class="flex items-center gap-1 text-amber-400">
                                    <span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span>
                                </div>
                                <p class="text-xs sm:text-sm text-gray-700 mt-4 leading-relaxed italic">
                                    "Punya balita dan kucing di rumah bikin karpet ruang TV gampang kotor. Medina Clean bersihinnya teliti banget sampai air hisapannya cokelat pekat. Hasilnya wangi, cepat kering, dan anak aman main di lantai."
                                </p>
                            </div>
                            <div class="mt-6 pt-4 border-t border-gray-200 flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-medina text-white font-bold text-xs flex items-center justify-center">
                                    AP
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-gray-900">Amanda Putri</div>
                                    <div class="text-[11px] text-gray-500">Ibu Rumah Tangga, Bintaro Sektor 9</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Interactive FAQ Accordion (Alpine.js) -->
            <section id="faq" class="py-16 sm:py-20 bg-[#F9FAFB] border-t border-gray-200" x-data="{ active: null }">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center max-w-xl mx-auto">
                        <span class="text-xs font-bold text-[#1484b3] uppercase tracking-wider bg-sky-50 px-3 py-1 rounded-full border border-sky-200">
                            Pertanyaan Umum
                        </span>
                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mt-3">
                            Frequently Asked Questions (FAQ)
                        </h2>
                        <p class="text-sm text-gray-600 mt-2">
                            Semua hal yang perlu Anda ketahui sebelum memesan layanan cuci karpet kami.
                        </p>
                    </div>

                    <div class="mt-10 space-y-3">
                        <!-- FAQ 1 -->
                        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden transition shadow-2xs">
                            <button type="button" @click="active = (active === 1 ? null : 1)" class="w-full px-5 py-4 text-left flex justify-between items-center gap-4 text-gray-900 font-semibold text-sm hover:text-medina transition cursor-pointer">
                                <span>Berapa lama proses pengeringan karpet setelah dicuci?</span>
                                <svg class="w-4 h-4 text-gray-500 shrink-0 transform transition-transform duration-200" :class="{ 'rotate-180': active === 1 }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div x-show="active === 1" x-collapse x-cloak class="px-5 pb-4 text-xs sm:text-sm text-gray-600 border-t border-gray-100 pt-3 leading-relaxed">
                                Karpet rata-rata kering dalam waktu <strong>2 hingga 4 jam</strong> di dalam ruangan. Mesin vacuum extractor berkekuatan 2000W kami telah menyedot 85–90% kadar air, sehingga karpet hanya dalam kondisi sedikit lembap (*damp*). Cukup bantu nyalakan pendingin ruangan (AC) atau kipas angin agar sirkulasi udara mempercepat pengeringan total tanpa perlu dijemur di luar.
                            </div>
                        </div>

                        <!-- FAQ 2 -->
                        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden transition shadow-2xs">
                            <button type="button" @click="active = (active === 2 ? null : 2)" class="w-full px-5 py-4 text-left flex justify-between items-center gap-4 text-gray-900 font-semibold text-sm hover:text-medina transition cursor-pointer">
                                <span>Apakah karpet perlu digulung dan dibawa ke workshop?</span>
                                <svg class="w-4 h-4 text-gray-500 shrink-0 transform transition-transform duration-200" :class="{ 'rotate-180': active === 2 }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div x-show="active === 2" x-collapse x-cloak class="px-5 pb-4 text-xs sm:text-sm text-gray-600 border-t border-gray-100 pt-3 leading-relaxed">
                                Tidak perlu! Seluruh proses pencucian dilakukan secara langsung di tempat Anda (<em>on-site</em>). Anda tidak perlu repot menggulung, memindahkan perabotan berat, atau khawatir karpet tertukar/hilang dalam perjalanan.
                            </div>
                        </div>

                        <!-- FAQ 3 -->
                        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden transition shadow-2xs">
                            <button type="button" @click="active = (active === 3 ? null : 3)" class="w-full px-5 py-4 text-left flex justify-between items-center gap-4 text-gray-900 font-semibold text-sm hover:text-medina transition cursor-pointer">
                                <span>Apa saja yang perlu disiapkan oleh pihak pengurus atau tuan rumah?</span>
                                <svg class="w-4 h-4 text-gray-500 shrink-0 transform transition-transform duration-200" :class="{ 'rotate-180': active === 3 }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div x-show="active === 3" x-collapse x-cloak class="px-5 pb-4 text-xs sm:text-sm text-gray-600 border-t border-gray-100 pt-3 leading-relaxed">
                                Anda hanya perlu menyediakan akses sumber air bersih (keran air terdekat) dan stopkontak listrik berdaya minimal 900–1300 Watt. Tim kami membawa seluruh perlengkapan sendiri: kabel rol panjang hingga 20 meter, selang, ember, mesin pembersih, dan deterjen khusus.
                            </div>
                        </div>

                        <!-- FAQ 4 -->
                        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden transition shadow-2xs">
                            <button type="button" @click="active = (active === 4 ? null : 4)" class="w-full px-5 py-4 text-left flex justify-between items-center gap-4 text-gray-900 font-semibold text-sm hover:text-medina transition cursor-pointer">
                                <span>Apakah ada garansi jika karpet masih berbau atau ada noda tertinggal?</span>
                                <svg class="w-4 h-4 text-gray-500 shrink-0 transform transition-transform duration-200" :class="{ 'rotate-180': active === 4 }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div x-show="active === 4" x-collapse x-cloak class="px-5 pb-4 text-xs sm:text-sm text-gray-600 border-t border-gray-100 pt-3 leading-relaxed">
                                Ya! Medina Clean memberikan <strong>Garansi Cuci Ulang 100% Gratis</strong> dalam waktu 2×24 jam setelah pengerjaan jika karpet menimbulkan bau apek atau ada bagian yang belum bersih sesuai standar. Kepuasan dan kenyamanan Anda adalah prioritas utama kami.
                            </div>
                        </div>

                        <!-- FAQ 5 -->
                        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden transition shadow-2xs">
                            <button type="button" @click="active = (active === 5 ? null : 5)" class="w-full px-5 py-4 text-left flex justify-between items-center gap-4 text-gray-900 font-semibold text-sm hover:text-medina transition cursor-pointer">
                                <span>Kapan pembayaran dilakukan dan metode apa saja yang tersedia?</span>
                                <svg class="w-4 h-4 text-gray-500 shrink-0 transform transition-transform duration-200" :class="{ 'rotate-180': active === 5 }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div x-show="active === 5" x-collapse x-cloak class="px-5 pb-4 text-xs sm:text-sm text-gray-600 border-t border-gray-100 pt-3 leading-relaxed">
                                Pembayaran dilakukan <strong>setelah proses pencucian selesai</strong> dan Anda telah mengecek hasil pekerjaan bersama teknisi kami. Kami menerima pembayaran non-tunai yang praktis melalui Transfer Bank (BCA, Mandiri, BSI) maupun QRIS.
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Bottom CTA Banner (Warm & Engaging) -->
            <section class="py-14 sm:py-18 bg-white">
                <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="bg-gradient-to-br from-[#4CBBE4] to-[#158ab6] rounded-3xl p-8 sm:p-12 text-white shadow-lg relative overflow-hidden">
                        <div class="max-w-2xl relative z-10">
                            <span class="text-xs font-bold uppercase tracking-wider bg-white/20 px-3 py-1 rounded-full text-white inline-block">
                                Jadwal Cepat & Fleksibel
                            </span>
                            <h2 class="text-2xl sm:text-4xl font-bold mt-4 leading-tight">
                                Siap Menikmati Karpet Bersih, Harum, dan Nyaman Kembali?
                            </h2>
                            <p class="mt-3 text-sm sm:text-base text-white/90 leading-relaxed">
                                Konsultasikan luas karpet dan waktu pengerjaan yang paling cocok untuk Anda. Tim Medina Clean siap datang langsung ke tempat Anda.
                            </p>
                            <div class="mt-8 flex flex-wrap gap-3">
                                @auth
                                    <a href="{{ route('customer.dashboard') }}" class="px-6 py-3 bg-white text-gray-900 hover:bg-gray-100 text-sm font-bold rounded-xl shadow-sm transition">
                                        Pesan Jadwal di Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('register') }}" class="px-6 py-3 bg-white text-gray-900 hover:bg-gray-100 text-sm font-bold rounded-xl shadow-sm transition">
                                        Daftar & Pesan Sekarang
                                    </a>
                                    <a href="https://wa.me/6281234567890?text=Halo%20Medina%20Clean%2C%20saya%20mau%20konsultasi%20cuci%20karpet" target="_blank" rel="noopener noreferrer" class="px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-bold rounded-xl shadow-sm transition inline-flex items-center gap-2">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0012.04 2zm5.79 14.07c-.24.67-1.39 1.29-1.93 1.37-.51.08-1.16.11-3.69-.94-2.88-1.2-4.73-4.14-4.87-4.33-.14-.19-1.17-1.55-1.17-2.96 0-1.41.74-2.1 1-2.38.27-.27.59-.34.79-.34.2 0 .4 0 .58.01.19.01.44-.07.69.52.26.61.88 2.14.96 2.3.08.16.13.35.03.55-.1.2-.15.33-.3.51-.15.18-.32.4-.46.54-.15.15-.31.32-.13.63.18.31.79 1.3 1.7 2.11 1.17 1.04 2.16 1.37 2.47 1.52.31.15.49.13.67-.08.19-.21.79-.92 1-1.23.21-.31.42-.26.71-.15.29.11 1.83.86 2.14 1.02.31.16.52.24.6.37.08.13.08.77-.16 1.44z"/>
                                        </svg>
                                        Chat WhatsApp CS
                                    </a>
                                @endauth
                            </div>
                        </div>

                        <!-- Abstract pattern decoration -->
                        <div class="absolute -bottom-12 -right-12 w-64 h-64 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
                    </div>
                </div>
            </section>
        </main>

        <!-- Comprehensive Footer -->
        <footer class="bg-gray-900 text-gray-300 border-t border-gray-800 pt-12 pb-8">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 pb-10 border-b border-gray-800">
                    <!-- Brand info -->
                    <div>
                        <div class="flex items-center gap-2">
                            <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-medina shadow-sm text-white">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 18V9a3 3 0 0 1 6 0v9" />
                                    <path d="M10 18V9a3 3 0 0 1 6 0v9" />
                                    <path d="M16 18h4a2 2 0 0 0 2-2v-5" />
                                    <circle cx="10" cy="19" r="1" fill="currentColor" />
                                    <circle cx="16" cy="19" r="1" fill="currentColor" />
                                    <path d="M3 19h18" />
                                </svg>
                            </div>
                            <div class="flex flex-col leading-tight">
                                <span class="text-xl font-bold tracking-tight text-white">Medina <span class="text-medina">Clean</span></span>
                                <span class="text-[10px] font-medium text-gray-400 uppercase tracking-widest">Jasa Cuci Karpet</span>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400 mt-4 leading-relaxed">
                            Layanan profesional jasa cuci karpet panggilan di tempat untuk masjid, perkantoran, dan rumah tangga wilayah Jabodetabek.
                        </p>
                        <div class="mt-4 text-xs text-emerald-400 flex items-center gap-1.5 font-medium">
                            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                            Buka Setiap Hari: 07.00 – 21.00 WIB
                        </div>
                    </div>

                    <!-- Services -->
                    <div>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-white">Layanan Cuci</h4>
                        <ul class="mt-4 space-y-2 text-xs text-gray-400">
                            <li><a href="#layanan" class="hover:text-medina transition">Cuci Karpet Masjid & Musholla</a></li>
                            <li><a href="#layanan" class="hover:text-medina transition">Cuci Karpet Kantor & Tile</a></li>
                            <li><a href="#layanan" class="hover:text-medina transition">Cuci Permadani Rumah Tangga</a></li>
                            <li><a href="#layanan" class="hover:text-medina transition">Ekstraksi Tungau & Alergen</a></li>
                            <li><a href="#layanan" class="hover:text-medina transition">Treatment Bau Apek Lembap</a></li>
                        </ul>
                    </div>

                    <!-- Area Layanan -->
                    <div>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-white">Area Layanan</h4>
                        <ul class="mt-4 space-y-1.5 text-xs text-gray-400">
                            <li>Jakarta Selatan, Timur, Barat, Pusat, Utara</li>
                            <li>Tangerang Kota & Tangerang Selatan</li>
                            <li>Depok & Sawangan</li>
                            <li>Kota & Kabupaten Bekasi</li>
                            <li>Bogor Kota & Sekitarnya</li>
                        </ul>
                    </div>

                    <!-- Hubungi Kami -->
                    <div>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-white">Hubungi Kami</h4>
                        <div class="mt-4 space-y-2.5 text-xs text-gray-400">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0012.04 2zm5.79 14.07c-.24.67-1.39 1.29-1.93 1.37-.51.08-1.16.11-3.69-.94-2.88-1.2-4.73-4.14-4.87-4.33-.14-.19-1.17-1.55-1.17-2.96 0-1.41.74-2.1 1-2.38.27-.27.59-.34.79-.34.2 0 .4 0 .58.01.19.01.44-.07.69.52.26.61.88 2.14.96 2.3.08.16.13.35.03.55-.1.2-.15.33-.3.51-.15.18-.32.4-.46.54-.15.15-.31.32-.13.63.18.31.79 1.3 1.7 2.11 1.17 1.04 2.16 1.37 2.47 1.52.31.15.49.13.67-.08.19-.21.79-.92 1-1.23.21-.31.42-.26.71-.15.29.11 1.83.86 2.14 1.02.31.16.52.24.6.37.08.13.08.77-.16 1.44z"/></svg>
                                <span>WhatsApp: +62 812-3456-7890</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-sky-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                <span>Email: cs@medinaclean.com</span>
                            </div>
                            <div class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-gray-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span>Workshop & Pool: Jakarta Selatan & Tangerang</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-gray-500 gap-4">
                    <p>&copy; {{ date('Y') }} Medina Clean. Seluruh hak cipta dilindungi undang-undang.</p>
                    <p class="flex items-center gap-4">
                        <span>Pembersihan Higienis Berstandar Industri</span>
                    </p>
                </div>
            </div>
        </footer>

        <!-- Floating WhatsApp Consultation Button (ATM Gaia) -->
        <aside aria-label="Kontak Cepat WhatsApp" class="fixed bottom-6 right-6 z-40 group">
            <a href="https://wa.me/6281234567890?text=Halo%20Medina%20Clean%2C%20saya%20mau%20konsultasi%20cuci%20karpet" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2.5 bg-[#25D366] hover:bg-[#20bd5a] text-white px-4 py-3 rounded-full shadow-lg transition-transform transform hover:scale-105" title="Konsultasi via WhatsApp">
                <svg class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.816 9.816 0 0012.04 2zm5.79 14.07c-.24.67-1.39 1.29-1.93 1.37-.51.08-1.16.11-3.69-.94-2.88-1.2-4.73-4.14-4.87-4.33-.14-.19-1.17-1.55-1.17-2.96 0-1.41.74-2.1 1-2.38.27-.27.59-.34.79-.34.2 0 .4 0 .58.01.19.01.44-.07.69.52.26.61.88 2.14.96 2.3.08.16.13.35.03.55-.1.2-.15.33-.3.51-.15.18-.32.4-.46.54-.15.15-.31.32-.13.63.18.31.79 1.3 1.7 2.11 1.17 1.04 2.16 1.37 2.47 1.52.31.15.49.13.67-.08.19-.21.79-.92 1-1.23.21-.31.42-.26.71-.15.29.11 1.83.86 2.14 1.02.31.16.52.24.6.37.08.13.08.77-.16 1.44z"/>
                </svg>
                <span class="text-xs font-bold hidden sm:inline-block pr-1">Konsultasi WhatsApp</span>
            </a>
        </aside>
    </body>
</html>
