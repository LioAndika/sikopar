<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::table('laporan_kolektes', function (Blueprint $table) {
            // Menambahkan kolom status_bendahara_paroki setelah status_ketua_stasi
            // Default 'pending' karena ini adalah status awal saat laporan diteruskan ke bendahara
            // Pastikan kolom 'status_ketua_stasi' sudah ada di tabel ini
            if (!Schema::hasColumn('laporan_kolektes', 'status_bendahara_paroki')) {
                $table->string('status_bendahara_paroki')->default('pending')->after('status_ketua_stasi');
            }

            // Menambahkan kolom catatan_revisi_bendahara_paroki, bisa null
            // MENGHAPUS klausa ->after() untuk menghindari error "Column not found"
            if (!Schema::hasColumn('laporan_kolektes', 'catatan_revisi_bendahara_paroki')) {
                $table->text('catatan_revisi_bendahara_paroki')->nullable();
            }
        });
    }

    /**
     * Balikkan migrasi.
     */
    public function down(): void
    {
        Schema::table('laporan_kolektes', function (Blueprint $table) {
            // Menghapus kolom saat rollback
            if (Schema::hasColumn('laporan_kolektes', 'status_bendahara_paroki')) {
                $table->dropColumn('status_bendahara_paroki');
            }
            if (Schema::hasColumn('laporan_kolektes', 'catatan_revisi_bendahara_paroki')) {
                $table->dropColumn('catatan_revisi_bendahara_paroki');
            }
        });
    }
};
