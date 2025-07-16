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
        Schema::table('laporan_kolektes', function (Blueprint $table) {
            // Check if 'catatan_revisi' exists and 'catatan_revisi_ketua_stasi' does NOT exist.
            // If so, rename it. This handles the initial rename.
            if (Schema::hasColumn('laporan_kolektes', 'catatan_revisi') && !Schema::hasColumn('laporan_kolektes', 'catatan_revisi_ketua_stasi')) {
                $table->renameColumn('catatan_revisi', 'catatan_revisi_ketua_stasi');
            }
            // If 'catatan_revisi' doesn't exist but 'catatan_revisi_ketua_stasi' also doesn't exist,
            // it means neither the old nor the new column is there. This is a rare case for an 'add_column' migration,
            // but for robustness, if you are sure that a 'catatan_revisi_ketua_stasi' should exist from here on,
            // you might add:
            // else if (!Schema::hasColumn('laporan_kolektes', 'catatan_revisi_ketua_stasi')) {
            //     $table->text('catatan_revisi_ketua_stasi')->nullable();
            // }
            // For this specific error, we assume 'catatan_revisi_ketua_stasi' is already present or correctly handled.

            // Add new columns only if they don't already exist
            if (!Schema::hasColumn('laporan_kolektes', 'catatan_revisi_bendahara_paroki')) {
                // Position it after 'catatan_revisi_ketua_stasi'.
                // We must ensure 'catatan_revisi_ketua_stasi' is either renamed or already exists for 'after' to work.
                $table->text('catatan_revisi_bendahara_paroki')->nullable()->after('catatan_revisi_ketua_stasi');
            }

            if (!Schema::hasColumn('laporan_kolektes', 'catatan_revisi_romo_paroki')) {
                // Position it after 'catatan_revisi_bendahara_paroki'.
                $table->text('catatan_revisi_romo_paroki')->nullable()->after('catatan_revisi_bendahara_paroki');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('laporan_kolektes', function (Blueprint $table) {
            // Drop the newly added columns if they exist
            if (Schema::hasColumn('laporan_kolektes', 'catatan_revisi_romo_paroki')) {
                $table->dropColumn('catatan_revisi_romo_paroki');
            }
            if (Schema::hasColumn('laporan_kolektes', 'catatan_revisi_bendahara_paroki')) {
                $table->dropColumn('catatan_revisi_bendahara_paroki');
            }

            // Rename 'catatan_revisi_ketua_stasi' back to 'catatan_revisi' if it exists.
            // This assumes the original 'catatan_revisi' was meant to be the default.
            if (Schema::hasColumn('laporan_kolektes', 'catatan_revisi_ketua_stasi')) {
                // Make sure 'catatan_revisi' doesn't exist before renaming to it.
                // This is for safety, though unlikely if down() is called correctly.
                if (!Schema::hasColumn('laporan_kolektes', 'catatan_revisi')) {
                    $table->renameColumn('catatan_revisi_ketua_stasi', 'catatan_revisi');
                } else {
                    // If 'catatan_revisi' somehow exists and 'catatan_revisi_ketua_stasi' also exists,
                    // and we are trying to rename, it's an ambiguous state.
                    // For a clean rollback, we might just drop 'catatan_revisi_ketua_stasi'
                    // if we can't rename it back to the original due to a conflict.
                    $table->dropColumn('catatan_revisi_ketua_stasi');
                }
            }
        });
    }
};