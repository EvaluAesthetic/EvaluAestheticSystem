<div>
    <!-- Flex container to keep all dropdowns on the same line -->
    <div class="mt-4 flex space-x-4">
        <!-- Day Dropdown -->
        <div class="w-full">
            <x-label for="day" value="{{ __('Day') }}" />
            <select wire:model="day" id="day" name="day" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                <option value="" disabled selected>{{ __('Day') }}</option>
                @foreach ($daysInMonth as $dayOption)
                    <option value="{{ $dayOption }}">{{ $dayOption }}</option>
                @endforeach
            </select>
        </div>

        <!-- Month Dropdown -->
        <div class="w-full">
            <x-label for="month" value="{{ __('Month') }}" />
            <select wire:model="month" wire:change="updateDaysInMonth" id="month" name="month" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                <option value="" disabled selected>{{ __('Month') }}</option>
                @foreach (range(1, 12) as $month)
                    <option value="{{ $month }}">{{ \Carbon\Carbon::create()->month($month)->format('F') }}</option>
                @endforeach
            </select>
        </div>

        <!-- Year Dropdown -->
        <div class="w-full">
            <x-label for="year" value="{{ __('Year') }}" />
            <select wire:model="year" wire:change="updateDaysInMonth" id="year" name="year" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                <option value="" disabled selected>{{ __('Year') }}</option>
                @for ($i = now()->year; $i >= 1900; $i--)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
    </div>
</div>
