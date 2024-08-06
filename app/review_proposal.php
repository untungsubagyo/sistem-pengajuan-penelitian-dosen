<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class review_proposal extends Model
{
    use HasFactory;
    protected $fillable = [
    'review_data', 'file', 'catatan', 'skor_rumusan_masalah', 'skor_luaran', 'skor_metode', 'skor_tinjauan_pustaka', 'skor_kelayakan', 'status'
    ];
}