<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Konsultasi
            </h2>
            <a href="{{ route('consultations.show', $consultation->id) }}" class="text-indigo-600 hover:text-indigo-700 font-semibold">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl border border-gray-100 p-8">
                
                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-start gap-3">
                        <svg class="w-6 h-6 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        <div>
                            <p class="font-semibold">Berhasil!</p>
                            <p>{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl">
                        <p class="font-semibold mb-2">Terjadi kesalahan:</p>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Edit Data Konsultasi</h3>
                    <p class="text-gray-600">Perbarui informasi konsultasi Anda di bawah ini.</p>
                </div>

                <form action="{{ route('consultations.update', $consultation->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <!-- Nama UMKM -->
                    <div>
                        <label for="nama_umkm" class="block text-sm font-semibold text-gray-900 mb-2">
                            Nama UMKM / Usaha <span class="text-red-600">*</span>
                        </label>
                        <input id="nama_umkm" name="nama_umkm" type="text" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('nama_umkm') border-red-500 @enderror" 
                            value="{{ old('nama_umkm', $consultation->nama_umkm) }}" required />
                        @error('nama_umkm')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Bidang Usaha -->
                    <div>
                        <label for="bidang_usaha" class="block text-sm font-semibold text-gray-900 mb-2">
                            Bidang Usaha <span class="text-red-600">*</span>
                        </label>
                        <select id="bidang_usaha" name="bidang_usaha" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('bidang_usaha') border-red-500 @enderror" required>
                            <option value="">-- Pilih Bidang Usaha --</option>
                            <option value="Kuliner" {{ old('bidang_usaha', $consultation->bidang_usaha) == 'Kuliner' ? 'selected' : '' }}>🍽️ Kuliner</option>
                            <option value="Fashion" {{ old('bidang_usaha', $consultation->bidang_usaha) == 'Fashion' ? 'selected' : '' }}>👕 Fashion</option>
                            <option value="Kriya" {{ old('bidang_usaha', $consultation->bidang_usaha) == 'Kriya' ? 'selected' : '' }}>🎨 Kriya / Kerajinan</option>
                            <option value="Jasa" {{ old('bidang_usaha', $consultation->bidang_usaha) == 'Jasa' ? 'selected' : '' }}>💼 Jasa</option>
                            <option value="Lainnya" {{ old('bidang_usaha', $consultation->bidang_usaha) == 'Lainnya' ? 'selected' : '' }}>📌 Lainnya</option>
                        </select>
                        @error('bidang_usaha')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nomor WhatsApp -->
                    <div>
                        <label for="nomor_wa" class="block text-sm font-semibold text-gray-900 mb-2">
                            Nomor WhatsApp (Aktif) <span class="text-red-600">*</span>
                        </label>
                        <input id="nomor_wa" name="nomor_wa" type="text" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('nomor_wa') border-red-500 @enderror" 
                            value="{{ old('nomor_wa', $consultation->nomor_wa) }}" required />
                        <p class="mt-2 text-sm text-gray-600">
                            <svg class="w-4 h-4 inline mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2z" clip-rule="evenodd"/></svg>
                            Nomor ini akan digunakan untuk menghubungi Anda
                        </p>
                        @error('nomor_wa')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Topik Konsultasi -->
                    <div>
                        <label for="keluhan_utama" class="block text-sm font-semibold text-gray-900 mb-2">
                            Hal yang Ingin Dikonsultasikan <span class="text-red-600">*</span>
                        </label>
                        <textarea id="keluhan_utama" name="keluhan_utama" rows="5" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('keluhan_utama') border-red-500 @enderror" required>{{ old('keluhan_utama', $consultation->keluhan_utama) }}</textarea>
                        <p class="mt-2 text-sm text-gray-600">
                            <strong>Contoh topik:</strong> Bantuan pembuatan NIB, Sertifikasi Halal, Strategi Marketing Digital, Akses Pembiayaan KUR, dll.
                        </p>
                        @error('keluhan_utama')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6">
                        <button type="submit" class="flex-1 bg-indigo-600 text-white py-3 rounded-lg font-bold hover:bg-indigo-700 transition flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('consultations.show', $consultation->id) }}" class="flex-1 border border-gray-300 text-gray-700 py-3 rounded-lg font-bold hover:bg-gray-50 transition text-center">
                            Batal
                        </a>
                    </div>
                </form>

                <!-- Info Box -->
                <div class="mt-8 pt-8 border-t border-gray-100">
                    <div class="bg-blue-50 rounded-xl p-6 border border-blue-100">
                        <h4 class="font-bold text-gray-900 mb-2 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2z" clip-rule="evenodd"/></path></svg>
                            Catatan
                        </h4>
                        <p class="text-sm text-gray-700">Data yang telah diperbarui akan membantu kami memberikan konsultasi yang lebih sesuai dengan kebutuhan Anda. Perubahan akan langsung disimpan ketika Anda menekan tombol "Simpan Perubahan".</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
