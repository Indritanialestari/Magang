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
    Schema::create('pegawai_histories', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pegawai_id')->constrained('pegawais')->onDelete('cascade'); // Terhubung ke tabel pegawai

        // Snapshot data pada saat kejadian
        $table->string('nama');
        $table->string('nomor_induk')->nullable();
        $table->string('jabatan')->nullable();
        $table->string('bagian')->nullable();
        $table->string('unit_kerja')->nullable();
        $table->string('klasifikasi')->nullable();
        $table->date('tanggal_masuk')->nullable();
        $table->date('tanggal_lahir')->nullable(); // Kita butuh ini untuk hitung umur & pensiun

        // Kolom untuk mencatat perubahan
        $table->string('event'); // Contoh: 'dibuat', 'diperbarui'
        $table->json('perubahan')->nullable(); // Menyimpan detail perubahan (sebelum & sesudah)

        $table->timestamps(); // Ini akan menjadi 'tanggal_perhitungan'
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai_histories');
    }
};
