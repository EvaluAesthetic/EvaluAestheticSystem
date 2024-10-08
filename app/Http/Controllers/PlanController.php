<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
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
    public function show(Evaluation $evaluation, Plan $plan = null)
    {
        if (is_null($plan)) {
            $plan = $evaluation->plans()->latest()->first();
        }

        if (!$plan) {
            return view('plans.no-plan', compact('evaluation'))->with('error', 'No plans available for this evaluation.');
        }

        return view('plans.show', compact('evaluation', 'plan'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan $plan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        //
    }
}
