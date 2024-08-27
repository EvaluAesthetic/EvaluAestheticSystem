<div>
    <!-- Year Dropdown -->
    <div class="mt-4">
        <x-label for="year" value="{{ __('Year') }}" />
        <select wire:model="year" wire:change="updateDaysInMonth" id="year" name="year" class="block mt-1 w-full" required>
            <option value="" disabled selected>{{ __('Year') }}</option>
            @for ($i = now()->year; $i >= 1900; $i--)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>

    <!-- Month Dropdown -->
    <div class="mt-4 w-1/3">
        <x-label for="month" value="{{ __('Month') }}" />
        <select wire:model="month" wire:change="updateDaysInMonth" id="month" name="month" class="block mt-1 w-full" required>
            <option value="" disabled selected>{{ __('Month') }}</option>
            @foreach (range(1, 12) as $month)
                <option value="{{ $month }}">{{ \Carbon\Carbon::create()->month($month)->format('F') }}</option>
            @endforeach
        </select>
    </div>

    <!-- Day Dropdown -->
    <div class="mt-4 w-1/3">
        <x-label for="day" value="{{ __('Day') }}" />
        <select wire:model="day" id="day" name="day" class="block mt-1 w-full" required>
            <option value="" disabled selected>{{ __('Day') }}</option>
            @foreach ($daysInMonth as $dayOption)
                <option value="{{ $dayOption }}">{{ $dayOption }}</option>
            @endforeach
        </select>
    </div>
</div>
