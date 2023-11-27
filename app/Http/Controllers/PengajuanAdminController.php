<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Warga;
use App\Models\Kk;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PengajuanAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        if(strlen($keyword)){
            $data = Pengajuan::where('nomor_pengantar', 'like', "%$keyword%")->
            orwhere('keperluan', 'like', "%$keyword%")->paginate(10);
        } else { 
            $data = Pengajuan::orderBy('created_at', 'asc')->paginate(10); 
        }
        return view('admin.pengajuan.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Warga::orderBy('created_at', 'asc')->get(); 
        return view('admin.pengajuan.create')->with('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function generateNomorPengantar($id) {
        $rt = '005';
        $rw = '014'; 
        $bulan = date('m'); 
        $tahun = date('Y'); 

        $nomorPengantar = sprintf('%03d', $id) . '/' . 'RT.'. $rt . ' ' . 'RW.' . $rw . '/' . $bulan . '/' . $tahun;

        return $nomorPengantar;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'warga_id' => ['required', 'string'],
            'keperluan' => ['required', 'string'],
            'status_rt' => ['in:pending,accepted,declined'],
            'status_rw' => ['in:pending,accepted,declined'],
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'in' => 'Kolom :attribute harus salah satu dari jenis berikut: :values',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $keterangan = null;
        if ($request->status_rt == 'accepted' && $request->status_rw == 'accepted') {
            $keterangan = 'accepted';
        } elseif ($request->status_rt == 'declined' && $request->status_rw == 'declined') {
            $keterangan = 'declined';
        } elseif (($request->status_rt == 'declined' || $request->status_rw == 'declined') && ($request->status_rt == 'accepted' || $request->status_rw == 'accepted')) {
            $keterangan = 'declined';
        } elseif ($request->status_rt == 'pending' || $request->status_rw == 'pending') {
            $keterangan = 'pending';
        } else {
            $keterangan = 'pending';
        }

        $pengajuan = Pengajuan::create([
            'warga_id' => $request->warga_id,
            'keperluan' => $request->keperluan,
            'status_rt' => $request->status_rt,
            'status_rw' => $request->status_rw,
            'keterangan' => $keterangan
        ]);

        $addNomorPengantar = Pengajuan::where('id', $pengajuan->id)->update(['nomor_pengantar' => $this->generateNomorPengantar($pengajuan->id)]);

        return redirect()->back()->with('success', 'Berhasil create data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Pengajuan::where('id', $id)->first();
        return view('admin.pengajuan.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'keperluan' => ['required', 'string', 'max:255'],
            'status_rt' => ['in:pending,accepted,declined'],
            'status_rw' => ['in:pending,accepted,declined'],
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'in' => 'Kolom :attribute harus salah satu dari jenis berikut: :values',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $keterangan = null;
        if ($request->status_rt == 'accepted' && $request->status_rw == 'accepted') {
            $keterangan = 'accepted';
        } elseif ($request->status_rt == 'declined' && $request->status_rw == 'declined') {
            $keterangan = 'declined';
        } elseif (($request->status_rt == 'declined' || $request->status_rw == 'declined') && ($request->status_rt == 'accepted' || $request->status_rw == 'accepted')) {
            $keterangan = 'declined';
        } elseif ($request->status_rt == 'pending' || $request->status_rw == 'pending') {
            $keterangan = 'pending';
        } else {
            $keterangan = 'pending';
        }
        
        $data = [
            'keperluan'=>$request->keperluan,
            'status_rt'=>$request->status_rt,
            'status_rw'=>$request->status_rw,
            'keterangan'=>$keterangan
        ];

        Pengajuan::where('id', $id)->update($data);
        return redirect()->back()->with('success', 'Berhasil mengubah data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Pengajuan::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data!');
    }
}
