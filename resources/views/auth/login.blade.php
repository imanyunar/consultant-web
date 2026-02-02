<x-guest-layout>
    <div class="bg-white rounded-2xl border border-gray-100 p-8">
        <div class="mb-8 text-center">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Masuk Akun</h2>
            <p class="text-gray-600 text-sm">Kelola konsultasi bisnis Anda dengan mudah</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-900 mb-2">
                    Email <span class="text-red-600">*</span>
                </label>
                <input id="email" name="email" type="email" 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('email') border-red-500 @enderror" 
                    value="{{ old('email') }}" required autofocus autocomplete="username" />
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
                    required autocomplete="current-password" />
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <label for="remember_me" class="ms-2 text-sm text-gray-600">Ingat saya</label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg font-bold hover:bg-indigo-700 transition mt-6">
                Masuk
            </button>
        </form>

        <!-- Footer Links -->
        <div class="mt-6 pt-6 border-t border-gray-100 space-y-3">
            @if (Route::has('password.request'))
                <div class="text-center">
                    <a href="{{ route('password.request') }}" class="text-indigo-600 text-sm font-semibold hover:text-indigo-700">Lupa password?</a>
                </div>
            @endif
            
            <div class="text-center">
                <p class="text-gray-600 text-sm">Belum punya akun? <a href="{{ route('register') }}" class="text-indigo-600 font-semibold hover:text-indigo-700">Daftar di sini</a></p>
            </div>
        </div>
    </div>
</x-guest-layout>
