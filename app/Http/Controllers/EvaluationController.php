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
        $user = Auth::user();
        $id = $user->professional->clinic_id;
        $evaluations = Evaluation::where('clinic_id', $id)->get();
        return view('evaluations.show', compact('evaluations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $clientForm = ClientForm::findOrFail($id);
        $request->validate([
            'status' => 'required|integer',
            'description' => 'nullable|string',
            'plan' => 'nullable|string',
        ]);

        $evaluation = Evaluation::updateOrCreate(
            [
            'client_form_id' => $clientForm->id,
            'clinic_id' => $clientForm->client->clinic_id,
            'professional_id' => Auth::user()->professional->id,
            ],
            [
                'status' => $request->input('status'),
                'approved_at' => $request->input('status') == 1 ? now() : null,
            ]);

        if ($request->input('status') == 1 && $request->input('plan')) {
            $plan = Plan::create([
                'evaluation_id' => $evaluation->id,
                'description' => $request->input('description'),
                'plan' => $request->input('plan'),
            ]);
        }
        $evaluation->load(['plans', 'clientForm', 'clientForm.client', 'clientForm.client.user', 'clientForm.client.clinic', 'professional.user']);
        return redirect()->route('evaluation.plan.show', ['evaluation' => $evaluation, 'plan' => $plan])->with('success', 'Evaluation approved and plan ready for review.');

    }

    /**
     * Display the specified resource.
     */
    public function show(ClientForm $client_form)
    {

        $clientForm = $client_form->load('client.user');

        $evaluation = Evaluation::where('client_form_id', $clientForm->id)
            ->with('plans')
            ->first();

        return view('evaluations.evaluate', compact('clientForm', 'evaluation'));
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
