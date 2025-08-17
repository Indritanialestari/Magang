<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon; // Import Carbon class

class Pegawai extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'gender',
        'nomor_induk',
        'jabatan',
        'bagian',
        'unit_kerja',
        'pendidikan',
        'klasifikasi',
        'keluarga_status',
        'keluarga_anak',
        'tanggal_masuk',
        'golongan',
        'gaji',
        'status',
        'status_kenaikan',
        'jenis_hukuman',
        'alasan_hukuman',
        'masa_kerja',
    ];
    
    // Tambahkan casting untuk kolom tanggal
    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_masuk' => 'date', // Menambahkan casting untuk 'tanggal_masuk'
    ];

    /**
     * Mendefinisikan relasi one-to-many dengan RiwayatJabatan.
     * Ini akan memetakan "riwayat_jabatans" yang dipanggil di controller.
     */
    public function riwayatJabatans()
    {
        return $this->hasMany(RiwayatJabatan::class, 'pegawai_id');
    }

    /**
     * Mendefinisikan relasi one-to-many dengan RiwayatStatusKepegawaian.
     * Ini akan memetakan "riwayat_status_kepegawaians" yang dipanggil di controller.
     */
    public function riwayatStatusKepegawaians()
    {
        return $this->hasMany(RiwayatStatusKepegawaian::class, 'pegawai_id');
    }

    /**
     * Mendefinisikan relasi one-to-many dengan RiwayatDiklat.
     * Ini akan memetakan "riwayat_diklats" yang dipanggil di controller.
     */
    public function riwayatDiklats()
    {
        return $this->hasMany(RiwayatDiklat::class, 'pegawai_id');
    }

    /**
     * Metode helper untuk mendapatkan nama relasi yang digunakan di syncRiwayat.
     * Harus ditambahkan ke setiap model Riwayat.
     *
     * @return string
     */
    public static function getModelName()
    {
        $className = (new \ReflectionClass(self::class))->getShortName();
        return lcfirst(\Str::plural($className));
    }
}
