<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKolekte extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal_kolekte',
        'nama_pengirim',
        'stasi_id',
        'jumlah_kolekte',
        'status_ketua_stasi',
        'status_bendahara_paroki',
        'status_romo_paroki',
        'catatan_revisi_ketua_stasi', 
        'catatan_revisi_bendahara_paroki', 
        'catatan_revisi_romo_paroki',
        'created_by_user_id',
    ];

    protected $casts = [
        'tanggal_kolekte' => 'date',
        'jumlah_kolekte' => 'decimal:2',
    ];

    public function stasi()
    {
        return $this->belongsTo(Stasi::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }
}