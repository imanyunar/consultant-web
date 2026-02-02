<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi manual oleh user
    protected $fillable = [
        'nama_umkm', 
        'bidang_usaha', 
        'nomor_wa', 
        'keluhan_utama', 
        'status'
    ];
}