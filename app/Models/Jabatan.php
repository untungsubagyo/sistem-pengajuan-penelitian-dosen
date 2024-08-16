<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    
    protected $table = 'proposals';
    protected $primaryKey = 'id';
    protected $fillabel = [
        'nama'
    ];
}
