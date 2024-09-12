<?php

namespace App\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class ClientForm extends Component
{
    public $user;
    public $recentFormSubmitted = null;
    public $evaluation = null;
    public $selectedClinicId;
    public $clinics;
    public $showDropdown = false;

    public function mount()
    {
        $this->user = auth()->user();

        if ($this->user && $this->user->clients) {
            // Fetch all clinics where the user is registered
            $this->clinics = $this->user->clients->pluck('clinic_id', 'clinic.name');

            // Determine if we need to show the dropdown
            if ($this->clinics->count() > 1) {
                $this->showDropdown = true; // Show dropdown if more than one clinic
            } else {
                // Automatically select the only clinic if there's just one
                $this->selectedClinicId = $this->clinics->values()->first();
                $this->fetchClientData();
            }
        }
    }

    public function updatedSelectedClinicId()
    {
        // Reset the form and evaluation data when a new clinic is selected
        $this->fetchClientData();
    }

    public function fetchClientData()
    {
        $this->recentFormSubmitted = null;
        $this->evaluation = null;
        if ($this->selectedClinicId) {
            $client = $this->user->clients->where('clinic_id', $this->selectedClinicId)->first();
            if ($client) {
                $threeMonthsAgo = Carbon::now()->subMonths(3);
                $this->recentFormSubmitted = $client->forms()
                    ->where('created_at', '>=', $threeMonthsAgo)
                    ->first();

                if ($this->recentFormSubmitted) {
                    $this->evaluation = $this->recentFormSubmitted->evaluation;
                }
            }
        }
    }
    public function render()
    {
        return view('livewire.client-form', [
            'clinics' => $this->clinics,
        ]);
    }
}
