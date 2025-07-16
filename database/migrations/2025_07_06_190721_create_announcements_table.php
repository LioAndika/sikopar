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
    Schema::create('announcements', function (Blueprint $table) {
        $table->id();
        $table->date('tanggal_kolekte');
        $table->decimal('jumlah_kolekte', 15, 2); // 15 total digit, 2 setelah desimal
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('announcements');
}
};
