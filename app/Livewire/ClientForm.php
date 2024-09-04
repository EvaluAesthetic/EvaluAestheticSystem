<?php

namespace App\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithFileUploads;

class ClientForm extends Component
{
    use WithFileUploads;

    public $formData = [];

    public $video;

    public $recentFormSubmitted = false;


    public function mount(){
        $user = Auth::user();

        if($user && $user->client){
            $threeMonthsAgo = Carbon::now()->subMonths(3);
            $this->recentFormSubmitted = $user->client->forms()
                ->where('created_at', '>=', $threeMonthsAgo)
                ->exist();
        }
    }

    public function submit(){
        $validatedData = $this->validate([
            'formData.treatment_wishes' => 'required|string',
            'formData.has_history' => 'boolean',
            'formData.history' => 'nullable|string',
            'formData.has_disease' => 'boolean',
            'formData.disease' => 'nullable|string',
            'formData.has_allergy' => 'boolean',
            'formData.allergy' => 'nullable|string',
            'formData.had_previous_treatments' => 'boolean',
            'formData.previous_treatments' => 'nullable|string',
            'formData.has_medication' => 'boolean',
            'formData.medication' => 'nullable|string',
            'formData.occupation' => 'required|string|max:255',
            'video' => 'required|file|mimes:mp4,mov,ogg,qt|max:20000',
        ]);

        if ($this->video) {
            $videoPath = $this->video->store('videos', 'public'); // Save the file to the 'videos' directory in the 'public' disk
            $this->formData['video_path'] = $videoPath;
        }

        try{
            $this->formData['client_id'] = Auth::user()->client->id;

            $response = Http::post(route('client_form.store'), $this->formData);

            if($response->successful()){
                $this->recentFormSubmitted = true;
                session()->flash('success', 'Form submitted successfully');
            }else{
                session()->flash('error', 'There was an error submitting the form');
            }

        }catch (\Exception $e){
            session()->flash('error', 'There was an error creating your form: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.client-form');
    }
}
