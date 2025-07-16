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
            // Ubah kolom status_bendahara_paroki menjadi nullable
            // Pastikan kolom ini sudah ada sebelum mencoba mengubahnya
            if (Schema::hasColumn('laporan_kolektes', 'status_bendahara_paroki')) {
                $table->string('status_bendahara_paroki')->nullable()->change();
            }

            // Ubah kolom status_romo_paroki menjadi nullable
            // Pastikan kolom ini sudah ada sebelum mencoba mengubahnya
            if (Schema::hasColumn('laporan_kolektes', 'status_romo_paroki')) {
                $table->string('status_romo_paroki')->nullable()->change();
            }
        });
    }

    /**
     * Balikkan migrasi.
     */
    public function down(): void
    {
        Schema::table('laporan_kolektes', function (Blueprint $table) {
            // Saat rollback, kembalikan kolom menjadi NOT NULL (jika aslinya begitu)
            // Ini akan mengharuskan nilai default jika ada baris yang null
            if (Schema::hasColumn('laporan_kolektes', 'status_bendahara_paroki')) {
                // Perhatian: Jika ada data NULL di kolom ini, rollback akan gagal.
                // Anda mungkin perlu mengatur nilai default sementara sebelum rollback.
                $table->string('status_bendahara_paroki')->default('pending')->change();
            }
            if (Schema::hasColumn('laporan_kolektes', 'status_romo_paroki')) {
                // Perhatian: Sama seperti di atas.
                $table->string('status_romo_paroki')->default('pending')->change();
            }
        });
    }
};
