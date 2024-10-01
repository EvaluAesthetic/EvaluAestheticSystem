<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class TwoFactorController extends Controller
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
    public function showVerifyForm()
    {
        return view('auth.two-factor-challenge');
    }
    /**
     * Handle 2FA code verification
     */
    public function verify(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|numeric',
        ]);

        $userId = Auth::id();
        $cachedCode = Cache::get('2fa_code_' . $userId);

        if ($cachedCode && $cachedCode == $request->input('verification_code')) {
            // Code is valid, remove it from the cache
            Cache::forget('2fa_code_' . $userId);

            // Redirect to the intended page after successful login
            return redirect()->intended('/dashboard');
        }

        return redirect()->route('2fa.verify')->withErrors(['verification_code' => 'The verification code is invalid.']);
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
