<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Detail Konsultasi
            </h2>
            <a href="{{ route('consultations.index') }}" class="text-indigo-600 hover:text-indigo-700 font-semibold">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl border border-gray-100 p-8">
                
                <!-- Status Header -->
                <div class="mb-8 pb-8 border-b border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-2xl font-bold text-gray-900">{{ $consultation->nama_umkm }}</h3>
                        <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold
                            @if ($consultation->status == 'pending')
                                bg-yellow-100 text-yellow-800
                            @elseif ($consultation->status == 'diproses')
                                bg-blue-100 text-blue-800
                            @else
                                bg-green-100 text-green-800
                            @endif
                        ">
                            @if ($consultation->status == 'pending')
                                ⏳ Menunggu
                            @elseif ($consultation->status == 'diproses')
                                ⚙️ Sedang Diproses
                            @else
                                ✅ Selesai
                            @endif
                        </span>
                    </div>
                    
                    <p class="text-gray-600">Pendaftaran {{ $consultation->created_at->format('d F Y \p\u\k\u\l H:i') }}</p>
                </div>

                <!-- Informasi Umkm -->
                <div class="mb-8">
                    <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-3">
                        <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-indigo-600" fill="currentColor" viewBox="0 0 20 20"><path d="M5.5 12a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.3A4.5 4.5 0 1113.5 12H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V12H5.5z"></path></svg>
                        </div>
                        Informasi Bisnis
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-gray-600 text-sm mb-1">Nama UMKM</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $consultation->nama_umkm }}</p>
                        </div>
                        
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-gray-600 text-sm mb-1">Bidang Usaha</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $consultation->bidang_usaha }}</p>
                        </div>
                        
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-gray-600 text-sm mb-1">Nomor WhatsApp</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $consultation->nomor_wa }}</p>
                        </div>
                        
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-gray-600 text-sm mb-1">Tanggal Pendaftaran</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $consultation->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Topik Konsultasi -->
                <div class="mb-8">
                    <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-3">
                        <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-indigo-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2z" clip-rule="evenodd"/></path></svg>
                        </div>
                        Topik Konsultasi
                    </h4>
                    
                    <div class="bg-indigo-50 border border-indigo-100 rounded-lg p-6">
                        <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $consultation->keluhan_utama }}</p>
                    </div>
                </div>

                <!-- Status Timeline -->
                <div class="mb-8">
                    <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-3">
                        <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-indigo-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/></path></svg>
                        </div>
                        Status Konsultasi
                    </h4>

                    <div class="space-y-4">
                        <div class="flex gap-4">
                            <div class="flex flex-col items-center">
                                <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></path></svg>
                                </div>
                                <div class="w-1 h-8 bg-gray-300 mt-2"></div>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Pendaftaran Diterima</p>
                                <p class="text-sm text-gray-600">{{ $consultation->created_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex flex-col items-center">
                                <div class="w-8 h-8 rounded-full 
                                    @if ($consultation->status == 'diproses' || $consultation->status == 'selesai')
                                        bg-green-100 flex items-center justify-center flex-shrink-0
                                    @else
                                        bg-gray-200 flex items-center justify-center flex-shrink-0
                                    @endif
                                ">
                                    @if ($consultation->status == 'diproses' || $consultation->status == 'selesai')
                                        <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></path></svg>
                                    @else
                                        <div class="w-2 h-2 bg-gray-400 rounded-full"></div>
                                    @endif
                                </div>
                                <div class="w-1 h-8 bg-gray-300 mt-2"></div>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Sedang Diproses</p>
                                <p class="text-sm text-gray-600">
                                    @if ($consultation->status == 'diproses' || $consultation->status == 'selesai')
                                        Tim PLUT sedang menghubungi Anda
                                    @else
                                        Menunggu...
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex flex-col items-center">
                                <div class="w-8 h-8 rounded-full 
                                    @if ($consultation->status == 'selesai')
                                        bg-green-100 flex items-center justify-center flex-shrink-0
                                    @else
                                        bg-gray-200 flex items-center justify-center flex-shrink-0
                                    @endif
                                ">
                                    @if ($consultation->status == 'selesai')
                                        <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></path></svg>
                                    @else
                                        <div class="w-2 h-2 bg-gray-400 rounded-full"></div>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Selesai</p>
                                <p class="text-sm text-gray-600">
                                    @if ($consultation->status == 'selesai')
                                        Konsultasi telah selesai
                                    @else
                                        Menunggu penyelesaian...
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-100">
                    <a href="{{ route('consultations.edit', $consultation->id) }}" class="flex-1 bg-indigo-600 text-white py-3 rounded-lg font-bold hover:bg-indigo-700 transition text-center flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        Edit Data
                    </a>

                    <form action="{{ route('consultations.destroy', $consultation->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full border border-red-300 text-red-700 py-3 rounded-lg font-bold hover:bg-red-50 transition">
                            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Hapus
                        </button>
                    </form>

                    <a href="{{ route('consultations.index') }}" class="flex-1 border border-gray-300 text-gray-700 py-3 rounded-lg font-bold hover:bg-gray-50 transition text-center">
                        Kembali
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
