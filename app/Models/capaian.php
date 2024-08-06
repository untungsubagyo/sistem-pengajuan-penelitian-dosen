<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class capaian extends Model
{
    use HasFactory;
    protected $fillable = ["id_proposal","tahun","jenis_capaian","indikator"];
}
