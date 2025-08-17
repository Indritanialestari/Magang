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
            Schema::create('riwayat_jabatans', function (Blueprint $table) {
                $table->id();
                $table->foreignId('pegawai_id')->constrained('pegawais')->onDelete('cascade');
                $table->string('status_kepegawaian')->nullable();
                $table->date('tgl_mulai')->nullable();
                $table->string('nomor_sk')->nullable();
                $table->timestamps();
            });
        }

        /**
         * Balikkan migrasi.
         */
        public function down(): void
        {
            Schema::dropIfExists('riwayat_jabatans');
        }
    };
    