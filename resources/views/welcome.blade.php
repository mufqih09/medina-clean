<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Medina Clean - Layanan Cuci Karpet Profesional</title>

        <!-- Google Fonts: Poppins & Nunito -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#F9FAFB] text-gray-700 min-h-screen flex flex-col justify-between">
        <!-- Header / Navigation -->
        <header class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <div class="flex items-center">
                        <x-application-logo />
                    </div>

                    <nav class="flex items-center gap-3">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="inline-flex items-center px-5 py-2.5 bg-medina hover:bg-[#3baad3] text-white font-semibold text-sm rounded-full shadow-sm transition">
                                Buka Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-semibold text-gray-700 hover:text-medina transition">
                                Masuk
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="inline-flex items-center px-5 py-2.5 bg-medina hover:bg-[#3baad3] text-white font-semibold text-sm rounded-full shadow-sm transition">
                                    Daftar Sekarang
                                </a>
                            @endif
                        @endauth
                    </nav>
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <main class="flex-grow">
            <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-sky-100 text-[#1484b3] text-xs font-semibold uppercase tracking-wider mb-6">
                            <span class="w-2 h-2 rounded-full bg-medina"></span>
                            Layanan Cuci Karpet Terbaik
                        </div>
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 tracking-tight leading-tight">
                            Karpet Bersih, Wangi & <span class="text-medina">Bebas Tungau</span>
                        </h1>
                        <p class="mt-6 text-lg text-gray-600 leading-relaxed max-w-xl">
                            Medina Clean menghadirkan solusi cuci karpet profesional untuk masjid, kantor, dan rumah Anda dengan teknologi pembersihan intensif dan tim lapangan terpercaya.
                        </p>
                        <div class="mt-8 flex flex-wrap gap-4 items-center">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="px-7 py-3.5 bg-medina hover:bg-[#3baad3] text-white font-semibold text-base rounded-full shadow-md hover:shadow-lg transition">
                                    Lihat Pesanan Saya
                                </a>
                            @else
                                <a href="{{ route('register') }}" class="px-7 py-3.5 bg-medina hover:bg-[#3baad3] text-white font-semibold text-base rounded-full shadow-md hover:shadow-lg transition">
                                    Pesan Jasa Cuci Sekarang
                                </a>
                                <a href="{{ route('login') }}" class="px-6 py-3.5 bg-white border border-gray-300 hover:border-medina text-gray-700 hover:text-medina font-semibold text-base rounded-full shadow-sm transition">
                                    Sudah Punya Akun
                                </a>
                            @endauth
                        </div>

                        <!-- Highlights -->
                        <div class="mt-12 pt-8 border-t border-gray-200/80 grid grid-cols-3 gap-6">
                            <div>
                                <h4 class="text-2xl font-bold text-gray-900">100%</h4>
                                <p class="text-xs text-gray-500 mt-1">Higienis & Wangi Tahan Lama</p>
                            </div>
                            <div>
                                <h4 class="text-2xl font-bold text-gray-900">Cepat</h4>
                                <p class="text-xs text-gray-500 mt-1">Penanganan Tim Terjadwal</p>
                            </div>
                            <div>
                                <h4 class="text-2xl font-bold text-gray-900">Transparan</h4>
                                <p class="text-xs text-gray-500 mt-1">Pantau Progres Real-Time</p>
                            </div>
                        </div>
                    </div>

                    <!-- Visual Card Showcase -->
                    <div class="relative">
                        <div class="bg-gradient-to-tr from-sky-100 to-white rounded-3xl p-8 border border-sky-200/60 shadow-lg relative overflow-hidden">
                            <div class="space-y-4">
                                <!-- Card Status Demo -->
                                <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex items-center justify-between">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-xl bg-sky-100 text-medina flex items-center justify-center font-bold">
                                            01
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900">Pemesanan Online Praktis</h4>
                                            <p class="text-xs text-gray-500">Cukup masukkan ukuran & lokasi karpet</p>
                                        </div>
                                    </div>
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">Mudah</span>
                                </div>

                                <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex items-center justify-between">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center font-bold">
                                            02
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900">Pelacakan Tim Lapangan</h4>
                                            <p class="text-xs text-gray-500">Ketahui status perjalanan & pencucian</p>
                                        </div>
                                    </div>
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">Real-Time</span>
                                </div>

                                <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex items-center justify-between">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold">
                                            03
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900">Hasil Bersih Maksimal</h4>
                                            <p class="text-xs text-gray-500">Laporan pekerjaan rapi dan transparan</p>
                                        </div>
                                    </div>
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">Terjamin</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-100 py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center">
                    <x-application-logo />
                </div>
                <p class="text-xs text-gray-500 text-center">
                    &copy; {{ date('Y') }} Medina Clean. Platform Jasa Cuci Karpet Berbasis Web. Seluruh hak cipta dilindungi.
                </p>
            </div>
        </footer>
    </body>
</html>
