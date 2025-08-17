<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatDiklat extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model ini.
     * @var string
     */
    protected $table = 'riwayat_diklats';

    /**
     * Atribut yang boleh diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pegawai_id',
        'nama_materi',
        'tempat',
        'tanggal_mulai',      // <-- Diubah dari 'waktu'
        'tanggal_berakhir',   // <-- Ditambahkan
        'penyelenggara',
    ];

    /**
     * Memberitahu Laravel untuk memperlakukan kolom ini sebagai objek tanggal.
     */
    protected $casts = [
        'tanggal_mulai' => 'date',     // <-- Diubah dari 'waktu'
        'tanggal_berakhir' => 'date',  // <-- Ditambahkan
    ];

    /**
     * Relasi many-to-one: Riwayat diklat ini dimiliki oleh satu pegawai.
     */
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
