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

    // Initialize component
    public function mount()
    {
        $this->daysInMonth = range(1, 31); // Default to 31 days initially
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'year' || $propertyName === 'month') {
            $this->updateDaysInMonth();
        }

        // Validate the selected day when the month or year changes
        if ($this->day && !in_array($this->day, $this->daysInMonth)) {
            $this->day = 1; // Reset the day if it's no longer valid
        }
    }

    public function updateDaysInMonth()
    {
        // Ensure both year and month are set before calculating days
        if ($this->year && $this->month) {
            // Calculate the number of days in the selected month and year using Carbon
            $this->daysInMonth = range(1, Carbon::createFromDate($this->year, $this->month, 1)->daysInMonth);

            // If the current selected day is invalid, reset it
            if ($this->day && !in_array($this->day, $this->daysInMonth)) {
                $this->day = null; // Reset the day if it's no longer valid
            }
        } else {
            $this->daysInMonth = []; // Reset days if year or month is not selected
            $this->day = null; // Reset the day
        }
    }

    public function render()
    {
        return view('livewire.birthday-selector');
    }
}
