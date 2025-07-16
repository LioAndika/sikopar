// database/migrations/YYYY_MM_DD_HHMMSS_make_user_id_nullable_in_pengumumen_table.php

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengumumen', function (Blueprint $table) {
            // Ubah kolom 'user_id' menjadi nullable
            // Pastikan Anda sudah menginstal 'doctrine/dbal': composer require doctrine/dbal
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('pengumumen', function (Blueprint $table) {
            // Ubah kembali kolom 'user_id' menjadi not nullable saat rollback
            // CATATAN: Ini akan gagal jika ada baris dengan nilai NULL saat rollback!
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
        });
    }
};