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
            // Menambahkan kolom status_romo_paroki setelah catatan_revisi_bendahara_paroki
            // Default 'pending' karena ini adalah status awal saat laporan diteruskan ke romo
            // Tambahkan if (!Schema::hasColumn(...)) check
            if (!Schema::hasColumn('laporan_kolektes', 'status_romo_paroki')) {
                $table->string('status_romo_paroki')->default('pending')->after('catatan_revisi_bendahara_paroki');
            }

            // Menambahkan kolom catatan_revisi_romo_paroki, bisa null
            // Tambahkan if (!Schema::hasColumn(...)) check
            if (!Schema::hasColumn('laporan_kolektes', 'catatan_revisi_romo_paroki')) {
                $table->text('catatan_revisi_romo_paroki')->nullable()->after('status_romo_paroki');
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
            // Tambahkan if (Schema::hasColumn(...)) check untuk keamanan
            if (Schema::hasColumn('laporan_kolektes', 'status_romo_paroki')) {
                $table->dropColumn('status_romo_paroki');
            }
            if (Schema::hasColumn('laporan_kolektes', 'catatan_revisi_romo_paroki')) {
                $table->dropColumn('catatan_revisi_romo_paroki');
            }
        });
    }
};