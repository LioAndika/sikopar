<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'tanggal_kolekte',
        'jumlah_kolekte',
    ];

    // Meng-cast tanggal_kolekte ke objek Carbon secara otomatis
    protected $casts = [
        'tanggal_kolekte' => 'date',
    ];
}