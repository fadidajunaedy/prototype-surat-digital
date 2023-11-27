<?php

namespace App\Observers;

use App\Models\Pengajuan;

class PengajuanObserver
{
    /**
     * Handle the Pengajuan "created" event.
     */
    public function created(Pengajuan $pengajuan): void
    {
        if ($pengajuan->status_rt == 'accepted' && $pengajuan->status_rw == 'accepted') {
            $pengajuan->keterangan = 'accepted';
        } elseif ($pengajuan->status_rt == 'declined' && $pengajuan->status_rw == 'declined') {
            $pengajuan->keterangan = 'declined';
        } elseif ($pengajuan->status_rt == 'declined' || $pengajuan->status_rw == 'declined') {
            $pengajuan->keterangan = 'declined';
        } else {
            $pengajuan->keterangan = 'pending';
        }
        $pengajuan->save();
    }

    /**
     * Handle the Pengajuan "updated" event.
     */
    public function updated(Pengajuan $pengajuan): void
    {
        if ($pengajuan->status_rt == 'accepted' && $pengajuan->status_rw == 'accepted') {
            $pengajuan->keterangan = 'accepted';
        } elseif ($pengajuan->status_rt == 'declined' && $pengajuan->status_rw == 'declined') {
            $pengajuan->keterangan = 'declined';
        } else {
            $pengajuan->keterangan = 'pending';
        }
        $pengajuan->save();
    }

    /**
     * Handle the Pengajuan "deleted" event.
     */
    public function deleted(Pengajuan $pengajuan): void
    {
        //
    }

    /**
     * Handle the Pengajuan "restored" event.
     */
    public function restored(Pengajuan $pengajuan): void
    {
        //
    }

    /**
     * Handle the Pengajuan "force deleted" event.
     */
    public function forceDeleted(Pengajuan $pengajuan): void
    {
        //
    }
}
