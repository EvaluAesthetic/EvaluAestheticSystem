<?php

namespace App\Http\Controllers;

use App\Models\ClientForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ClientFormController extends Controller
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
        return view('client_form.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::debug('Store method called');
        $validator = Validator::make($request->all(), [
            'treatment_wishes' => 'required',
            'has_history' => 'required|boolean',
            'history' => 'nullable|string',
            'disease' => 'nullable|string',
            'has_disease' => 'required|boolean',
            'allergy' => 'nullable|string',
            'has_allergy' => 'required|boolean',
            'previous_treatments' => 'nullable|string',
            'had_previous_treatments' => 'required|boolean',
            'medication' => 'nullable|string',
            'has_medication' => 'required|boolean',
            'occupation' => 'required|string|max:255',
            'video' => 'required|file|mimes:mp4,mov,ogg,qt|max:20000',
        ]);
        if ($validator->fails()) {
            Log::error('Validation Errors', $validator->errors()->toArray());
            return redirect()->back()->withErrors($validator)->withInput();
        }
        Log::debug('ClientForm Request Data', $request->all());
        $videoPath = $request->file('video')->store('videos', 'public');

        try {
            ClientForm::create([
                'client_id' => Auth::user()->clients->first()->id,
                'has_history' => $request->has_history,
                'history' => $request->history,
                'disease' => $request->disease,
                'has_disease' => $request->has_disease,
                'allergy' => $request->allergy,
                'has_allergy' => $request->has_allergy,
                'previous_treatments' => $request->previous_treatments,
                'had_previous_treatments' => $request->had_previous_treatments,
                'medication' => $request->medication,
                'has_medication' => $request->has_medication,
                'occupation' => $request->occupation,
                'video_path' => $videoPath,
            ]);
            return redirect()->route('dashboard')->with('success', 'Client form created successfully.');
        } catch (\Exception $e) {
            // Log any errors
            Log::error('ClientForm Creation Error', ['error' => $e->getMessage()]);
            return redirect()->route('dashboard')->with('error', 'There was an error creating the client form.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ClientForm $clientForm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClientForm $clientForm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClientForm $clientForm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClientForm $clientForm)
    {
        //
    }

}
