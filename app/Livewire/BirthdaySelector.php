<?php

namespace App\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class BirthdaySelector extends Component
{
    public $year;
    public $month;
    public $day;
    public $daysInMonth = [];


    public function updateDaysInMonth()
    {
        if ($this->year && $this->month) {
            // Calculate the number of days in the selected month and year using Carbon
            $this->daysInMonth = range(1, Carbon::createFromDate($this->year, $this->month)->daysInMonth);
        } else {
            $this->daysInMonth = [];
        }
    }

    public function render()
    {
        return view('livewire.birthday-selector');
    }
}
