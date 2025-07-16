<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('laporan_kolektes', function (Blueprint $table) {
            // HAPUS BARIS INI KARENA KOLOM 'catatan_revisi' TIDAK ADA UNTUK DIGANTI NAMANYA
            // $table->renameColumn('catatan_revisi', 'catatan_revisi_ketua_stasi'); 
            
            // Tambahkan kolom baru untuk catatan revisi Bendahara Paroki
            // Pastikan Anda menempatkannya setelah kolom yang sudah ada.
            // Anda bisa menggunakan after('nama_kolom_sebelumnya') atau cukup menempatkannya.
            $table->text('catatan_revisi_bendahara_paroki')->nullable()->after('catatan_revisi_ketua_stasi');

            // Tambahkan kolom baru untuk catatan revisi Romo Paroki
            $table->text('catatan_revisi_romo_paroki')->nullable()->after('catatan_revisi_bendahara_paroki');
        });
    }

    public function down(): void
    {
        Schema::table('laporan_kolektes', function (Blueprint $table) {
            // Hapus kolom yang ditambahkan
            $table->dropColumn('catatan_revisi_bendahara_paroki');
            $table->dropColumn('catatan_revisi_romo_paroki');

            // HAPUS BARIS INI KARENA TIDAK ADA renameColumn yang perlu di-rollback
            // $table->renameColumn('catatan_revisi_ketua_stasi', 'catatan_revisi');
        });
    }
};