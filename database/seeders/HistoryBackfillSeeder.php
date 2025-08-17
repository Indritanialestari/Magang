<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pegawai;
use App\Models\PegawaiHistory;

class HistoryBackfillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Memulai proses mengisi histori untuk karyawan tetap yang sudah ada...');

        // Ambil semua data dari tabel karyawan tetap
        $pegawais = Pegawai::all();

        foreach ($pegawais as $pegawai) {
            // Cek dulu apakah data awal untuk pegawai ini sudah ada di histori
            // Ini untuk mencegah data duplikat jika script dijalankan lebih dari sekali
            $historyExists = PegawaiHistory::where('pegawai_id', $pegawai->id)
                                           ->where('event', 'dibuat')
                                           ->exists();

            if (!$historyExists) {
                // Jika belum ada, buat catatan histori baru
                PegawaiHistory::create([
                    'pegawai_id'      => $pegawai->id,
                    'nama'            => $pegawai->nama,
                    'nomor_induk'     => $pegawai->nomor_induk,
                    'jabatan'         => $pegawai->jabatan,
                    'bagian'          => $pegawai->bagian,
                    'unit_kerja'      => $pegawai->unit_kerja,
                    'klasifikasi'     => $pegawai->klasifikasi,
                    'tanggal_masuk'   => $pegawai->tanggal_masuk,
                    'tanggal_lahir'   => $pegawai->tanggal_lahir,
                    'event'           => 'dibuat',
                    'perubahan'       => null, // Tidak ada perubahan karena ini data awal
                    'created_at'      => $pegawai->created_at, // Gunakan tanggal data asli dibuat
                    'updated_at'      => $pegawai->updated_at,
                ]);
            }
        }

        $this->command->info('Proses mengisi histori selesai!');
    }
}