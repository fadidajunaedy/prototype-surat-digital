<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Warga;
use App\Notifications\UserRegistered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use App\Mail\MyTestEmail;

class UserController extends Controller
{   
    function masukPage () {
        return view('authentication.masuk');
    }

    function daftarPage () {
        return view('authentication.daftar');
    }

    function register (Request $request) {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect('daftar')
                        ->withErrors($validator)
                        ->withInput();
        }

        $user = User::create([
            'nama' => $request['nama'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role' => 'warga',
        ]);

        $warga = Warga::create([
            'user_id' => $user->id,
            'nama' => $user->nama,
            'email' => $user->email,
        ]);

        event(new Registered($user));
        auth()->login($user);
        return redirect()->route('verification.notice')->with('success', 'Email Verifikasi telah dikirim ke akun email Anda, mohon lakukan verifikasi');
        // return redirect('masuk')->with('success', 'Registration successful! Please check your email to verify your account.');
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $warga = Warga::where('user_id', $user->id)->first();

            if (!$warga) {
                $warga = Warga::create([
                    'user_id' => $user->id,
                    'nama' => $user->nama,
                    'email' => $user->email,
                ]);
            }

            switch ($user->role) {
                case 'admin':
                    return redirect()->intended('admin/dashboard');
                case 'rw':
                    return redirect()->intended('rw/dashboard');
                case 'rt':
                    return redirect()->intended('rt/dashboard');
                default:
                    return redirect()->intended('/');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/masuk')->with('success', 'Berhasil Keluar');
    }

    public function testMail() {
        Mail::to('fadidajunaedy24@gmail.com')->send(new MyTestEmail);
        return '<h1>Success</h1>';
    }

}
