<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Konsultasi UMKM - PLUT Digital</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans bg-gray-50">

    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-indigo-600">PLUT<span class="text-gray-800">Digital</span></span>
                </div>
                <div class="flex space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-indigo-600 font-medium">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 font-medium">Masuk</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">Daftar Akun</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <header class="bg-white py-20 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 mb-10 md:mb-0">
                <h1 class="text-5xl font-extrabold text-gray-900 leading-tight mb-6">
                    Naik Kelas dengan <br><span class="text-indigo-600">Konsultasi Bisnis</span> Tepat Sasaran.
                </h1>
                <p class="text-lg text-gray-600 mb-8">
                    Dapatkan pendampingan gratis dari konsultan ahli PLUT untuk legalitas usaha, strategi pemasaran, hingga akses pembiayaan UMKM Anda.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('consultations.create') }}" class="bg-indigo-600 text-white text-center px-8 py-4 rounded-xl font-bold text-lg hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition">
                        Daftar Konsultasi Sekarang
                    </a>
                    <a href="#fitur" class="border border-gray-300 text-gray-700 text-center px-8 py-4 rounded-xl font-bold text-lg hover:bg-gray-50 transition">
                        Pelajari Layanan
                    </a>
                </div>
            </div>
            <div class="md:w-1/2 flex justify-center">
                <div class="w-full h-80 bg-indigo-100 rounded-3xl flex items-center justify-center border-2 border-dashed border-indigo-300">
                    <span class="text-indigo-500 font-medium">[Ilustrasi UMKM Maju]</span>
                </div>
            </div>
        </div>
    </header>

    <section id="fitur" class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900">Layanan Pendampingan PLUT</h2>
            <p class="text-gray-600 mt-4">Kami hadir untuk menyelesaikan hambatan bisnis Anda.</p>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-6">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Legalitas & NIB</h3>
                <p class="text-gray-600 text-sm">Bantuan pembuatan Nomor Induk Berusaha (NIB) dan sertifikasi halal secara gratis.</p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-6">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Pemasaran Digital</h3>
                <p class="text-gray-600 text-sm">Optimasi sosial media, marketplace, dan pembuatan konten kreatif untuk produk UMKM.</p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-6">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Akses Pembiayaan</h3>
                <p class="text-gray-600 text-sm">Konsultasi laporan keuangan untuk mempermudah pengajuan Kredit Usaha Rakyat (KUR).</p>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="bg-gradient-to-r from-indigo-50 to-blue-50 rounded-3xl p-12 border border-indigo-100">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Siap Mengembangkan Bisnis Anda?</h3>
                <p class="text-gray-600 mb-8 max-w-2xl mx-auto">Jadilah bagian dari ribuan UMKM yang telah berkembang melalui konsultasi gratis PLUT Digital. Daftar sekarang dan dapatkan pendampingan dari konsultan ahli kami.</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('consultations.create') }}" class="bg-indigo-600 text-white px-10 py-4 rounded-xl font-bold text-lg hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition">
                                Mulai Konsultasi Gratis
                            </a>
                        @else
                            <a href="{{ route('consultations.create') }}" class="bg-indigo-600 text-white px-10 py-4 rounded-xl font-bold text-lg hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition">
                                Daftar Konsultasi Gratis
                            </a>
                            <a href="{{ route('register') }}" class="border-2 border-indigo-600 text-indigo-600 px-10 py-4 rounded-xl font-bold text-lg hover:bg-indigo-50 transition">
                                Buat Akun Baru
                            </a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-white border-t border-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} PLUT Digital - Konsultasi UMKM. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>