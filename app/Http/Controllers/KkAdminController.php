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

class KkAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        if(strlen($keyword)){
            $data = Kk::where('nomor_kk', 'like', "%$keyword%")->
            orwhere('nama_kepala', 'like', "%$keyword%")->paginate(10);
        } else { 
            $data = Kk::orderBy('created_at', 'asc')->paginate(10); 
        }
        return view('admin.kk.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nomor_kk' => ['required', 'string', 'max:16', 'unique:kks'],
            'nama_kepala' => ['required', 'string', 'max:255'],
        ], [
            'required' => 'Kolom :attribute harus diisi.'
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Kk::create([
            'nomor_kk' => $request->nomor_kk,
            'nama_kepala' => $request->nama_kepala,
        ]);

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
        $data = Kk::where('id', $id)->first();
        return view('admin.kk.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_kepala' => ['required', 'string', 'max:255'],
        ], [
            'required' => 'Kolom :attribute harus diisi.'
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [
            'nama_kepala'=>$request->nama_kepala,
        ];

        Kk::where('id', $id)->update($data);
        return redirect()->back()->with('success', 'Berhasil update data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Kk::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Berhasil delete data!');
    }
}
