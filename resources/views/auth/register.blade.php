<x-guest-layout>
    <div class="bg-white rounded-2xl border border-gray-100 p-8">
        <div class="mb-8 text-center">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Buat Akun Baru</h2>
            <p class="text-gray-600 text-sm">Bergabunglah dengan ribuan UMKM yang telah mendapat manfaat konsultasi gratis</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-900 mb-2">
                    Nama Lengkap <span class="text-red-600">*</span>
                </label>
                <input id="name" name="name" type="text" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('name') border-red-500 @enderror" 
                    value="{{ old('name') }}" required autofocus autocomplete="name" />
                @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-900 mb-2">
                    Email <span class="text-red-600">*</span>
                </label>
                <input id="email" name="email" type="email" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('email') border-red-500 @enderror" 
                    value="{{ old('email') }}" required autocomplete="username" />
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-900 mb-2">
                    Password <span class="text-red-600">*</span>
                </label>
                <input id="password" name="password" type="password" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('password') border-red-500 @enderror" 
                    required autocomplete="new-password" />
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-xs text-gray-600">Minimal 8 karakter, kombinasi huruf, angka, dan simbol</p>
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-900 mb-2">
                    Konfirmasi Password <span class="text-red-600">*</span>
                </label>
                <input id="password_confirmation" name="password_confirmation" type="password" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('password_confirmation') border-red-500 @enderror" 
                    required autocomplete="new-password" />
                @error('password_confirmation')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg font-bold hover:bg-indigo-700 transition mt-6">
                Daftar Sekarang
            </button>
        </form>

        <!-- Login Link -->
        <div class="text-center mt-6 pt-6 border-t border-gray-100">
            <p class="text-gray-600 text-sm">Sudah punya akun? <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:text-indigo-700">Masuk di sini</a></p>
        </div>
    </div>
</x-guest-layout>
