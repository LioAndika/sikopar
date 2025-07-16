// database/migrations/YYYY_MM_DD_HHMMSS_make_content_nullable_in_pengumumen_table.php

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengumumen', function (Blueprint $table) {
            // Ubah kolom 'content' menjadi nullable
            $table->string('content')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('pengumumen', function (Blueprint $table) {
            // Ubah kembali kolom 'content' menjadi not nullable saat rollback
            // Catatan: Ini akan gagal jika ada baris dengan nilai NULL saat rollback!
            $table->string('content')->nullable(false)->change();
        });
    }
};