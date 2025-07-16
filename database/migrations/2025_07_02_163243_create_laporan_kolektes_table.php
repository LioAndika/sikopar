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
            Schema::create('laporan_kolektes', function (Blueprint $table) {
                $table->id();
                $table->date('tanggal_kolekte');
                $table->string('nama_pengirim'); // Nama Bendahara Stasi yang menginput
                $table->unsignedBigInteger('stasi_id'); // Foreign key ke tabel stasi
                $table->decimal('jumlah_kolekte', 10, 2); // Jumlah kolekte
                $table->string('status_ketua_stasi')->default('pending'); // pending, divalidasi, ditolak

                // Hapus .nullable()->change() karena ini Schema::create
                // Jika Anda ingin mereka default 'pending' dari awal, cukup definisikan seperti ini:
                // $table->string('status_bendahara_paroki')->default('pending');
                // $table->string('status_romo_paroki')->default('pending');
                // Namun, karena Anda menambahkannya di migrasi terpisah, biarkan ini tidak ada di sini
                // atau jika ini adalah migrasi yang membuat kolom ini, pastikan defaultnya benar.

                // Jika kolom ini akan ditambahkan di migrasi terpisah, jangan definisikan di sini.
                // Jika ini adalah migrasi yang membuat kolom ini, maka harusnya seperti ini:
                // $table->string('status_bendahara_paroki')->default('pending');
                // $table->string('status_romo_paroki')->default('pending');

                // Catatan: Jika 'catatan_revisi' ini adalah catatan ketua stasi, ganti namanya.
                // Jika ini adalah catatan umum yang kemudian diganti dengan catatan spesifik,
                // maka biarkan saja dan pastikan migrasi lain yang menambahkan kolom spesifik berjalan setelahnya.
                $table->text('catatan_revisi_ketua_stasi')->nullable(); // Mengganti nama agar lebih spesifik

                $table->unsignedBigInteger('created_by_user_id'); // Siapa yang membuat laporan (ID User Bendahara Stasi)

                $table->timestamps();

                // Foreign key constraints
                $table->foreign('stasi_id')->references('id')->on('stasi')->onDelete('cascade');
                $table->foreign('created_by_user_id')->references('id')->on('users')->onDelete('cascade');
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('laporan_kolektes');
        }
    };