<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultationController extends Controller
{
    /**
     * Constructor - middleware untuk memastikan user sudah login
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['create', 'store']);
    }

    /**
     * Menampilkan daftar konsultasi user yang login
     */
    public function index()
    {
        $consultations = Auth::user()->consultations()->latest()->paginate(10);
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
            'bidang_usaha'  => 'required|string|in:Kuliner,Fashion,Kriya,Jasa,Lainnya',
            'nomor_wa'      => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'keluhan_utama' => 'required|string|min:10',
        ], [
            'nama_umkm.required' => 'Nama UMKM harus diisi',
            'bidang_usaha.required' => 'Bidang usaha harus dipilih',
            'bidang_usaha.in' => 'Bidang usaha tidak valid',
            'nomor_wa.required' => 'Nomor WhatsApp harus diisi',
            'nomor_wa.regex' => 'Nomor WhatsApp tidak valid',
            'nomor_wa.min' => 'Nomor WhatsApp minimal 10 digit',
            'keluhan_utama.required' => 'Topik konsultasi harus diisi',
            'keluhan_utama.min' => 'Topik konsultasi minimal 10 karakter',
        ]);

        // 2. Tambahkan user_id jika user sudah login
        if (Auth::check()) {
            $validatedData['user_id'] = Auth::id();
            $redirectRoute = 'consultations.index';
        } else {
            $redirectRoute = 'consultations.create';
        }

        // 3. Simpan ke Tabel Consultations
        $consultation = Consultation::create($validatedData);

        // 4. Redirect dengan pesan sukses
        return redirect()->route($redirectRoute)
                         ->with('success', 'Pendaftaran Anda berhasil dikirim! Tim PLUT akan segera menghubungi Anda melalui WhatsApp.');
    }

    /**
     * Menampilkan detail pendaftaran tertentu
     */
    public function show(Consultation $consultation)
    {
        // Validasi: user hanya bisa melihat konsultasi miliknya sendiri
        if ($consultation->user_id && $consultation->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke konsultasi ini.');
        }

        return view('consultations.show', compact('consultation'));
    }

    /**
     * Menampilkan form edit
     */
    public function edit(Consultation $consultation)
    {
        // Validasi: user hanya bisa edit konsultasi miliknya sendiri
        if ($consultation->user_id && $consultation->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit konsultasi ini.');
        }

        return view('consultations.edit', compact('consultation'));
    }

    /**
     * Memperbarui data konsultasi
     */
    public function update(Request $request, Consultation $consultation)
    {
        // Validasi: user hanya bisa edit konsultasi miliknya sendiri
        if ($consultation->user_id && $consultation->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk memperbarui konsultasi ini.');
        }

        $validatedData = $request->validate([
            'nama_umkm'     => 'required|string|max:255',
            'bidang_usaha'  => 'required|string|in:Kuliner,Fashion,Kriya,Jasa,Lainnya',
            'nomor_wa'      => 'required|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'keluhan_utama' => 'required|string|min:10',
        ]);

        $consultation->update($validatedData);

        return redirect()->route('consultations.show', $consultation->id)
                         ->with('success', 'Data konsultasi berhasil diperbarui.');
    }

    /**
     * Menghapus data pendaftaran
     */
    public function destroy(Consultation $consultation)
    {
        // Validasi: user hanya bisa hapus konsultasi miliknya sendiri
        if ($consultation->user_id && $consultation->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus konsultasi ini.');
        }

        $consultation->delete();

        return redirect()->route('consultations.index')
                         ->with('success', 'Data konsultasi berhasil dihapus.');
    }
}