<?php

namespace App\Livewire;

use App\Models\ClientForm;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UnevaluatedClientForms extends Component
{
    public $unevaluatedClientForms = [];
    public $errorMessage = "No professional logged in";

    public $clinicId = null;


    public function mount()
    {
        if (Auth::user()->professional) {
            $this->clinicId = Auth::user()->professional->clinic_id;
            $this->unevaluatedClientForms = ClientForm::whereHas('client', function($query) {
                $query->where('clinic_id', $this->clinicId);
                })
                ->doesntHave('evaluation')
                ->orderBy('created_at', 'asc')
                ->get();
        } else {
            $this->errorMessage = 'You are not authorized to view this content.';
        }
    }
    public function render()
    {
        return view('livewire.unevaluated-client-forms');
    }
}
