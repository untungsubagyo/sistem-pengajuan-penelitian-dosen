<?php

namespace App;

use App\Models\proposal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class review_proposal extends Model
{
    use HasFactory;
    
    protected $table = 'review_proposals';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_user',
        'id_proposal',
        'reviwer_data',
        'file',
        'catatan',
        'skor_rumusan_masalah',
        'skor_luaran',
        'skor_metode',
        'skor_tinjauan_pustaka',
        'skor_kelayakan_umum',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function proposals()
    {
        return $this->belongsToMany(proposal::class, 'proposal_review', 'review_proposal_id', 'proposal_id');
    }
}