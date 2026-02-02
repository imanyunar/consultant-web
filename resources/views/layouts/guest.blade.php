<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-50">
        <div class="min-h-screen flex flex-col">
            <!-- Navigation -->
            <nav class="bg-white shadow-sm border-b border-gray-100">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16 items-center">
                        <div class="flex items-center">
                            <a href="/" class="text-2xl font-bold text-indigo-600">PLUT<span class="text-gray-800">Digital</span></a>
                        </div>
                        <div class="flex space-x-4">
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 font-medium">Masuk</a>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col sm:justify-center items-center px-4 sm:px-6 lg:px-8 py-12">
                <div class="w-full sm:max-w-md">
                    {{ $slot }}
                </div>
            </div>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-100 py-8 mt-12">
                <div class="max-w-7xl mx-auto px-4 text-center">
                    <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} PLUT Digital - Konsultasi UMKM. All rights reserved.</p>
                </div>
            </footer>
        </div>
    </body>
</html>
