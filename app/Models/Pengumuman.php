<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumumen';

   // app/Models/Pengumuman.php

// app/Models/Pengumuman.php

protected $fillable = [
    'judul',
    'content',
    'user_id',       // <-- PASTIKAN INI ADA DI FILLABLE
    'tanggal_kolekte',
    'jumlah_kolekte',
];
public function user() // <--- METODE INI YANG HARUS ADA!
    {
        // Relasi 'belongsTo' menunjukkan bahwa satu Pengumuman dimiliki oleh satu User.
        return $this->belongsTo(User::class);
    }
}