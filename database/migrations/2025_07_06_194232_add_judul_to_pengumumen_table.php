<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
{
    Schema::table('pengumumen', function (Blueprint $table) {
        $table->string('judul')->nullable()->after('id'); // Anda bisa sesuaikan posisi 'after' sesuai kebutuhan
    });
}

public function down()
{
    Schema::table('pengumumen', function (Blueprint $table) {
        $table->dropColumn('judul');
    });
}
};
