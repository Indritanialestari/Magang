<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->date('tanggal_lahir');
            $table->string('gender');

            // Kolom-kolom yang sudah ada
            $table->string('nomor_induk');
            $table->string('jabatan');
            $table->string('bagian');
            $table->string('unit_kerja');
            $table->string('pendidikan');
            $table->string('klasifikasi');
            $table->string('keluarga_status');
            $table->string('keluarga_anak');
            $table->date('tanggal_masuk');
            $table->integer('masa_kerja');
            $table->string('golongan');
            $table->string('gaji');
            $table->string('status');

            // --- KOLOM BARU YANG DITAMBAHKAN ---
            $table->decimal('kenaikan_gaji', 10, 2)->nullable();
            $table->string('status_kenaikan')->default('Diproses');
            $table->string('jenis_hukuman')->nullable();
            $table->text('alasan_hukuman')->nullable();
            // ------------------------------------

            $table->timestamps();
        });
    }

    /**
     * Kembalikan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};

