<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama',
        'nik',
        'email',
        'nomor_telepon',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'kewarganegaraan',
        'agama',
        'pendidikan_terakhir',
        'status',
        'kelurahan',
        'kecamatan',
        'rt',
        'rw',
        'nomor_rumah',
        'foto_profil'
    ];
}
