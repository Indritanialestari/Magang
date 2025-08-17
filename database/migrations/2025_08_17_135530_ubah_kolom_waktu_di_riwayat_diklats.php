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
    Schema::table('riwayat_diklats', function (Blueprint $table) {
        // Hapus kolom 'waktu' yang lama
        $table->dropColumn('waktu');

        // Tambahkan kolom baru setelah kolom 'tempat'
        $table->date('tanggal_mulai')->nullable()->after('tempat');
        $table->date('tanggal_berakhir')->nullable()->after('tanggal_mulai');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('riwayat_diklats', function (Blueprint $table) {
            //
        });
    }
};
