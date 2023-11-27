<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_pengantar',
        'warga_id',
        'keperluan',
        'status_rt',
        'status_rw',
        'keterangan',
    ];

    protected static function booted() {
        static::updated(function ($pengajuan) {
            if ($pengajuan->status_rt == 'accepted' && $pengajuan->status_rw == 'accepted') {
                $pengajuan->keterangan = 'accepted';
            } elseif ($pengajuan->status_rt == 'declined' || $pengajuan->status_rw == 'declined') {
                $pengajuan->keterangan = 'declined';
            } else {
                $pengajuan->keterangan = 'pending';
            }
            $pengajuan->save();
        });
    }

}
