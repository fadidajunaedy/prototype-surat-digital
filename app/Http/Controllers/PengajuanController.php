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

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $warga = Warga::where('user_id', Auth::id())->first();

        if(strlen($keyword)){
            $data = Pengajuan::where('nomor_pengantar', 'like', "%$keyword%")->
            orwhere('keperluan', 'like', "%$keyword%")->paginate(10);
        } else { 
            $data = Pengajuan::where('warga_id', $warga->id)->orderBy('created_at', 'asc')->paginate(10); 
        }
        return view('client.pengajuan.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function generateNomorPengantar($id) {
        $rt = '005';
        $rw = '014'; 
        $bulan = date('m'); 
        $tahun = date('Y'); 
    
        $romawi = ['', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
    
        $bulanRomawi = $romawi[intval($bulan)];
    
        $nomorPengantar = sprintf('%03d', $id) . '/' . 'RT.'. $rt . ' ' . 'RW.' . $rw . '/' . $bulanRomawi . '/' . $tahun;
    
        return $nomorPengantar;
    }
    

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'keperluan' => ['required', 'string', 'max:255'],
        ], [
            'required' => 'Kolom :attribute harus diisi.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $warga = Warga::where('user_id', Auth::id())->first();
        if (!$warga) {
            return redirect()->back()->withErrors('ID Warga tidak ditemukan')->withInput();
        }

        $pengajuan = Pengajuan::create([
            'warga_id'=>$warga->id,
            'keperluan'=>$request->keperluan,
        ]);

        $addNomorPengantar = Pengajuan::where('id', $pengajuan->id)->update(['nomor_pengantar' => $this->generateNomorPengantar($pengajuan->id)]);

        return redirect()->back()->with('success', 'Berhasil melakukan pengajuan!');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
