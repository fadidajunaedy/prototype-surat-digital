<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show () {
        return view('authentication.verification.index');
    }

    public function verify(EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('verification.confirm')->with('verified', 'Verifikasi Email Berhasil');
    }

    public function confirm () {
        return view('authentication.verification.confirm');
    }

    public function resend (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('success-resend', 'Email Verifikasi berhasil dikirim');
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
