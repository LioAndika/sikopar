<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pengumumen', function (Blueprint $table) {
            // Tambahkan kolom 'tanggal_kolekte' jika belum ada
            if (!Schema::hasColumn('pengumumen', 'tanggal_kolekte')) {
                $table->date('tanggal_kolekte')->nullable()->after('content'); // Sesuaikan posisi jika perlu
            }
            // Tambahkan kolom 'jumlah_kolekte' jika belum ada
            if (!Schema::hasColumn('pengumumen', 'jumlah_kolekte')) {
                $table->decimal('jumlah_kolekte', 15, 2)->nullable()->after('tanggal_kolekte'); // Sesuaikan posisi jika perlu
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengumumen', function (Blueprint $table) {
            // Hapus kolom saat rollback jika ada
            if (Schema::hasColumn('pengumumen', 'tanggal_kolekte')) {
                $table->dropColumn('tanggal_kolekte');
            }
            if (Schema::hasColumn('pengumumen', 'jumlah_kolekte')) {
                $table->dropColumn('jumlah_kolekte');
            }
        });
    }

};
