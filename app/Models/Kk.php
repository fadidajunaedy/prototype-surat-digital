<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kk extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nomor_kk',
        'nama_kepala',
    ];
}
