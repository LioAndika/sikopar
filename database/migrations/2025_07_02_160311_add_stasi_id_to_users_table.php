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
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan stasi_id sebagai foreign key yang bisa null (jika ada user yang tidak terkait stasi, misal super admin)
            $table->unsignedBigInteger('stasi_id')->nullable()->after('role_id'); // Atau setelah kolom lain yang relevan

            // Tambahkan foreign key constraint
            $table->foreign('stasi_id')->references('id')->on('stasi')->onDelete('set null'); // Atau onDelete('cascade') jika stasi dihapus, user juga diupdate. 'set null' lebih aman.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['stasi_id']); // Hapus foreign key constraint dulu
            $table->dropColumn('stasi_id'); // Lalu hapus kolomnya
        });
    }
};