<?php

namespace App\Http\Controllers;

use App\Models\ClientForm;
use App\Models\Evaluation;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
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
    public function create($id)
    {
        $clientForm = ClientForm::with('user')->findOrFail($id);
        return view('evaluations.create', compact('clientForm'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|integer',
            'description' => 'required|string',
            'plan' => 'required|string',
        ]);

        $evaluation = Evaluation::create([
            'client_form_id' => $id,
            'status' => $request->status,
            'approved_at' => now(),
            'professional_id' => Auth::user()->professional->id,
            'clinic_id' => Auth::user()->professional->clinic_id,
        ]);

        Plan::create([
            'evaluation_id' => $evaluation->id,
            'description' => $request->description,
            'plan' => $request->plan,
        ]);
        return redirect()->route('dashboard')->with('success', 'Evaluation submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $evaluation = Evaluation::with('plan', 'clientForm')->findOrFail($id);
        return view('evaluations.show', compact('evaluation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evaluation $evaluation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evaluation $evaluation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evaluation $evaluation)
    {
        //
    }
}
