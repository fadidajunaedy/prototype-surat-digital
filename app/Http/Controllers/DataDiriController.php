<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Warga;
use App\Models\Kk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class DataDiriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $data = Warga::where('user_id', $user_id)->first();
        return view('client.data-diri.index')->with('data', $data);
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'nomor_kk' => ['required', 'string', 'max:16', 'regex:/^[0-9]*$/'],
            'nik' => ['required', 'string', 'max:16', 'regex:/^[0-9]*$/'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'nomor_telepon' => ['string', 'max:15', 'regex:/^[0-9]*$/'],
            'tempat_lahir' => ['string'],
            'tanggal_lahir' => ['date'],
            'jenis_kelamin' => ['in:l,p'],
            'kewarganegaraan' => ['in:wni,wna'],
            'agama' => ['string'],
            'pendidikan_terakhir' => ['string'],
            'status' => ['string'],
            'nomor_rumah' => ['integer'],
            'foto_profil' => ['image'],
            'delete_foto_profil' => ['nullable', 'boolean'],
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'email' => 'Format email tidak valid.',
            'max' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
            'regex' => 'Kolom :attribute hanya boleh berisi angka.',
            'date' => 'Kolom :attribute harus berformat tanggal.',
            'in' => 'Kolom :attribute harus salah satu dari jenis berikut: :values',
            'image' => 'Kolom :attribute harus berupa gambar.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $kk = Kk::where('nomor_kk', $request->nomor_kk)->first();
        if (!$kk) {
            return redirect()->back()->withErrors("Nomor KK belum terdaftar")->withInput();
        }

        $data = [
            'nama' => $request->nama,
            'nomor_kk' => $request->nomor_kk,
            'nik' => $request->nik,
            'nomor_telepon' => $request->nomor_telepon,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'kewarganegaraan' => $request->kewarganegaraan,
            'agama' => $request->agama,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'status' => $request->status,
            'nomor_rumah' => $request->nomor_rumah,
        ];

        if($request->hasFile('foto_profil')) {
            $foto_profil = $request->file('foto_profil');
            $foto_extension = $foto_profil->extension();
            $foto_name = date('ymdhis').".".$foto_extension;
            $foto_profil->move(public_path('foto-profil'), $foto_name);

            $warga = Warga::find(Auth::id());
            if($warga && $warga->foto_profil) {    
                File::delete(public_path('foto-profile').'/'.$warga->foto_profil);
            }
            $data['foto_profil'] = $foto_name;

        } elseif ($request->input('delete_foto_profil')) {
            $warga = Warga::find(Auth::id());
            if ($warga && $warga->foto_profil) {
                File::delete(public_path('foto-profil').'/'.$warga->foto_profil);
                $data['foto_profil'] = null;
            }

        } else {
            unset($data['foto_profil']);
        }
        
        Warga::where('user_id', Auth::id())->update($data);
        
        return redirect()->back()->with('success', 'Berhasil update data diri!');
    }

    public function changePassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'old_password' => ['required', 'string', 'min:8'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        if(!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->withErrors("Password saat ini tidak sesuai");
        }
        User::where('id',auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        return back()->with("success", "Berhasil merubah password!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
