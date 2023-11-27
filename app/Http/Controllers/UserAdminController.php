<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Warga;
use App\Models\Kk;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class UserAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        if (strlen($keyword)) {
            $data = User::where('nama', 'like', "%$keyword%")->
            orwhere('email', 'like', "%$keyword%")->paginate(10);
        } else { 
            $data = User::orderBy('created_at', 'asc')->paginate(10); 
        }
        return view('admin.user.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = User::create([
            'nama' => $request['nama'],
            'email' => $request['email'],
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make($request['password']),
            'role' => 'warga',
        ]);

        $warga = Warga::create([
            'user_id' => $user->id,
            'nama' => $user->nama,
            'email' => $user->email,
        ]);

        return redirect()->back()->with('success', 'Berhasil created User');
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
        $data = User::where('id', $id)->first();
        return view('admin.user.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ], [
            'required' => 'Kolom :attribute harus diisi.'
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::where('id', $id)->first();
        if(!Hash::check($request->password, $user->password)) {
            return back()->withErrors("Password saat ini tidak sesuai");
        }

        $data = [
            'nama' => $request->nama,
        ];

        User::where('id', $id)->update($data);
        Warga::where('user_id', $id)->update($data);
        return redirect()->back()->with('success', 'Berhasil update data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Berhasil delete data!');
    }
}
