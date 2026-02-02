<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Riwayat Konsultasi Anda
            </h2>
            <a href="{{ route('consultations.create') }}" class="bg-indigo-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-indigo-700 transition">
                + Konsultasi Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center gap-3">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if ($consultations->count() > 0)
                <div class="space-y-4">
                    @foreach ($consultations as $consultation)
                        <div class="bg-white rounded-2xl border border-gray-100 hover:shadow-md transition p-6">
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-3">
                                        <h3 class="text-lg font-bold text-gray-900">{{ $consultation->nama_umkm }}</h3>
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                            @if ($consultation->status == 'pending')
                                                bg-yellow-100 text-yellow-800
                                            @elseif ($consultation->status == 'diproses')
                                                bg-blue-100 text-blue-800
                                            @else
                                                bg-green-100 text-green-800
                                            @endif
                                        ">
                                            {{ ucfirst($consultation->status) }}
                                        </span>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4 text-sm">
                                        <div>
                                            <p class="text-gray-600">Bidang Usaha</p>
                                            <p class="font-semibold text-gray-900">{{ $consultation->bidang_usaha }}</p>
                                        </div>
                                        <div>
                                            <p class="text-gray-600">No. WhatsApp</p>
                                            <p class="font-semibold text-gray-900">{{ $consultation->nomor_wa }}</p>
                                        </div>
                                        <div>
                                            <p class="text-gray-600">Tanggal Pendaftaran</p>
                                            <p class="font-semibold text-gray-900">{{ $consultation->created_at->format('d M Y') }}</p>
                                        </div>
                                    </div>

                                    <div>
                                        <p class="text-gray-600 text-sm mb-2">Topik Konsultasi</p>
                                        <p class="text-gray-700 text-sm line-clamp-2">{{ $consultation->keluhan_utama }}</p>
                                    </div>
                                </div>

                                <div class="flex flex-col gap-3">
                                    <a href="{{ route('consultations.show', $consultation->id) }}" class="inline-flex items-center justify-center px-4 py-3 bg-indigo-100 text-indigo-700 rounded-lg font-semibold hover:bg-indigo-200 transition gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        Lihat Detail
                                    </a>
                                    <a href="{{ route('consultations.edit', $consultation->id) }}" class="inline-flex items-center justify-center px-4 py-3 border border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('consultations.destroy', $consultation->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full px-4 py-3 border border-red-300 text-red-700 rounded-lg font-semibold hover:bg-red-50 transition flex items-center justify-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $consultations->links() }}
                </div>
            @else
                <div class="bg-white rounded-2xl border border-gray-100 p-12 text-center">
                    <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Belum ada konsultasi</h3>
                    <p class="text-gray-600 mb-6">Mulai pendaftaran konsultasi pertama Anda sekarang untuk mendapatkan pendampingan dari konsultan ahli PLUT.</p>
                    <a href="{{ route('consultations.create') }}" class="inline-block bg-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-700 transition">
                        Daftar Konsultasi Sekarang
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
