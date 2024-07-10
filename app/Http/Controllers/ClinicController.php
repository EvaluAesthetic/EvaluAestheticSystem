<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ClinicController extends Controller
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
    public function show(Clinic $clinic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clinic $clinic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Clinic $clinic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clinic $clinic)
    {
        //
    }

    public function generateRegistrationLink(Request $request, $role_id)
    {
        $token = Str::uuid();
        $clinicId = $request->input('clinic_id');

        $user = User::create([
            'registration_token' => $token,
            'name' => 'Temporary Name',
            'email' => 'temporary' . $token . '@example.com',
            'phone' => '0000000000',
            'password' => Hash::make(Str::random(10)), // Temporary password
        ]);

        // Log the token and role for now
        $url = route('registration', ['token' => $token, 'role_id' => $role_id, 'clinic_id' => $clinicId]);
        Log::info("Registration link for role ID {$role_id}: " . $url);

        return redirect()->back()->with('status', 'Registration link generated and logged.')->with('link', $url);
    }
}
