<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Consultations Card -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm">Konsultasi Anda</p>
                            <p class="text-2xl font-bold text-gray-900">0</p>
                        </div>
                    </div>
                </div>

                <!-- Profile Card -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm">Nama Anda</p>
                            <p class="text-lg font-bold text-gray-900">{{ Auth::user()->name }}</p>
                        </div>
                    </div>
                </div>

                <!-- Email Card -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm">Email Anda</p>
                            <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Welcome Section -->
            <div class="bg-white overflow-hidden rounded-2xl shadow-sm border border-gray-100 p-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Selamat datang, {{ Auth::user()->name }}!</h3>
                <p class="text-gray-600 mb-6">
                    Anda sudah terdaftar di sistem konsultasi PLUT Digital. Kelola konsultasi bisnis Anda dan dapatkan pendampingan profesional dari para ahli kami.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('consultations.create') }}" class="bg-indigo-600 text-white text-center px-6 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition">
                        + Buat Konsultasi Baru
                    </a>
                    <a href="{{ route('consultations.index') }}" class="border border-indigo-600 text-indigo-600 text-center px-6 py-3 rounded-lg font-semibold hover:bg-indigo-50 transition">
                        Lihat Riwayat Konsultasi
                    </a>
                    <a href="{{ route('profile.edit') }}" class="border border-gray-300 text-gray-700 text-center px-6 py-3 rounded-lg font-semibold hover:bg-gray-50 transition">
                        Edit Profil
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
