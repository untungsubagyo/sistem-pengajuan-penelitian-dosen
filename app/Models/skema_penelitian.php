<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class skema_penelitian extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_skema',
        'sumber_dana',
        'durasi',
        'satuan_durasi',
        'total_biaya',
        'bobot_rumusan_masalah',
        'bobot_luaran',
        'bobot_metode',
        'bobot_tinjauan_pustaka',
        'bobot_kelayakan',
    ];
}
