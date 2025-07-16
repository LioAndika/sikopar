<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stasi extends Model
{
    use HasFactory;

    protected $table = 'stasi'; // Pastikan baris ini ada dan tidak dikomentari

    protected $fillable = [
        'nama',   // Sesuaikan jika Anda mengubah nama kolom di DB menjadi 'name'
        'alamat'
    ];

    public function laporanKolektes()
    {
        return $this->hasMany(LaporanKolekte::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}