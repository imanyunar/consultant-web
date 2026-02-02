<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    /**
     * Menampilkan daftar semua pendaftar (Untuk Admin/Konsultan)
     */
    public function index()
    {
        $consultations = Consultation::latest()->get();
        return view('consultations.index', compact('consultations'));
    }

    /**
     * Menampilkan form pendaftaran untuk UMKM
     */
    public function create()
    {
        return view('consultations.create');
    }

    /**
     * Menyimpan data pendaftaran ke database
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validatedData = $request->validate([
            'nama_umkm'     => 'required|string|max:255',
            'bidang_usaha'  => 'required|string|max:255',
            'nomor_wa'      => 'required|string|max:15',
            'keluhan_utama' => 'required|string',
        ]);

        // 2. Simpan ke Tabel Consultations
        Consultation::create($validatedData);

        // 3. Redirect kembali dengan pesan sukses
        return redirect()->route('consultations.create')
                         ->with('success', 'Pendaftaran Anda berhasil dikirim! Tim PLUT akan segera menghubungi Anda.');
    }

    /**
     * Menampilkan detail pendaftaran tertentu
     */
    public function show(Consultation $consultation)
    {
        return view('consultations.show', compact('consultation'));
    }

    /**
     * Menampilkan form edit (Biasanya untuk Admin mengubah status)
     */
    public function edit(Consultation $consultation)
    {
        return view('consultations.edit', compact('consultation'));
    }

    /**
     * Memperbarui data (Contoh: Update status dari 'pending' ke 'diproses')
     */
    public function update(Request $request, Consultation $consultation)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,selesai',
        ]);

        $consultation->update($request->only('status'));

        return redirect()->route('consultations.index')
                         ->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

    /**
     * Menghapus data pendaftaran
     */
    public function destroy(Consultation $consultation)
    {
        $consultation->delete();

        return redirect()->route('consultations.index')
                         ->with('success', 'Data pendaftaran berhasil dihapus.');
    }
}