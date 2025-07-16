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
            // Hapus kolom 'catatan_ketua_stasi' jika ada
            if (Schema::hasColumn('laporan_kolektes', 'catatan_ketua_stasi')) {
                $table->dropColumn('catatan_ketua_stasi');
            }

            // Pastikan kolom 'catatan_revisi_ketua_stasi' ada.
            // Jika belum ada, tambahkan. Berdasarkan konteks sebelumnya, seharusnya sudah ada.
            if (!Schema::hasColumn('laporan_kolektes', 'catatan_revisi_ketua_stasi')) {
                $table->text('catatan_revisi_ketua_stasi')->nullable();
                // Anda mungkin perlu menambahkan ->after('nama_kolom_sebelumnya') jika posisi penting
                // Contoh: ->after('status_ketua_stasi');
                // Namun, jika sudah ada, ini akan dilewati.
            }
        });
    }

    /**
     * Balikkan migrasi.
     */
    public function down(): void
    {
        Schema::table('laporan_kolektes', function (Blueprint $table) {
            // Saat rollback, tambahkan kembali 'catatan_ketua_stasi' jika diperlukan
            // (Sesuaikan tipe data dan properti default jika ini adalah kolom yang Anda hapus)
            if (!Schema::hasColumn('laporan_kolektes', 'catatan_ketua_stasi')) {
                $table->text('catatan_ketua_stasi')->nullable(); // Ganti dengan definisi asli kolom ini
            }

            // Hapus 'catatan_revisi_ketua_stasi' saat rollback
            if (Schema::hasColumn('laporan_kolektes', 'catatan_revisi_ketua_stasi')) {
                $table->dropColumn('catatan_revisi_ketua_stasi');
            }
        });
    }
};
