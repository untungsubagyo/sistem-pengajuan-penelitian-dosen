<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class capaian extends Model
{
    use HasFactory;
    protected $fillable = ["id_proposal", "tahun", "jenis_capaian", "indikator"];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Proposal::class);
    }
}
