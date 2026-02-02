<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi manual oleh user
    protected $fillable = [
        'user_id',
        'nama_umkm', 
        'bidang_usaha', 
        'nomor_wa', 
        'keluhan_utama', 
        'status'
    ];

    /**
     * Relationship: Konsultasi milik seorang user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}