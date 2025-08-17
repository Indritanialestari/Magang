<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- INI YANG HILANG
use Illuminate\Database\Eloquent\Model;

class PegawaiHistory extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'perubahan' => 'array',
        'tanggal_masuk' => 'date',
        'tanggal_lahir' => 'date',
    ];
}