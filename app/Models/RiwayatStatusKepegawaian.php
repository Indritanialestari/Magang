<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatStatusKepegawaian extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model ini.
     * @var string
     */
    protected $table = 'riwayat_status_kepegawaians';

    /**
     * Atribut yang boleh diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pegawai_id',
        'status_kepegawaian',
        'tanggal',
        'keterangan',
    ];

    /**
     * ==================================================================
     * PERBAIKAN: Menambahkan properti $casts
     * ==================================================================
     * Baris ini memberitahu Laravel untuk selalu memperlakukan
     * kolom 'tanggal' sebagai objek tanggal.
     */
    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Relasi many-to-one: Riwayat status ini dimiliki oleh satu pegawai.
     */
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
