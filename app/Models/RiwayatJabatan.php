<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatJabatan extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model ini.
     * @var string
     */
    protected $table = 'riwayat_jabatans';

    /**
     * Atribut yang boleh diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pegawai_id',
        'status_kepegawaian',
        'tgl_mulai',
        'nomor_sk',
    ];

    /**
     * ==================================================================
     * PERBAIKAN: Menambahkan properti $casts
     * ==================================================================
     * Baris ini memberitahu Laravel untuk selalu memperlakukan
     * kolom 'tgl_mulai' sebagai objek tanggal.
     */
    protected $casts = [
        'tgl_mulai' => 'date',
    ];

    /**
     * Relasi many-to-one: Riwayat jabatan ini dimiliki oleh satu pegawai.
     */
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
