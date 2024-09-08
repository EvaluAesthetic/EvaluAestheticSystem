<?php

namespace App\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class ClientForm extends Component
{
    public $recentFormSubmitted = null;
    public $evaluation = null;

    public function mount(){
        $user = Auth::user();

        if($user && $user->clients){
            $clinicId = 1;
            $client = $user->clients->where('clinic_id', $clinicId)->first();
            if($client){
                $threeMonthsAgo = Carbon::now()->subMonths(3);
                $this->recentFormSubmitted = $client->forms()
                    ->where('created_at', '>=', $threeMonthsAgo)
                    ->first();
               $this->evaluation = $this->recentFormSubmitted->evaluation;
            }
        }
    }

    public function render()
    {
        return view('livewire.client-form');
    }
}
