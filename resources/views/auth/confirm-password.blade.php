<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="bg-white p-6 rounded-lg shadow-md max-w-lg mx-auto">
            <!-- Instructions -->
            <div class="mb-4 text-sm text-gray-600">
                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
            </div>

            <!-- Validation Errors -->
            <x-validation-errors class="mb-4" />

            <!-- Password Confirmation Form -->
            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <!-- Password Input Field -->
                <div class="mb-4">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" type="password" name="password" required autocomplete="current-password" autofocus />
                </div>

                <!-- Confirm Button -->
                <div class="flex justify-end mt-6">
                    <x-button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
                        {{ __('Confirm') }}
                    </x-button>
                </div>
            </form>
        </div>

    </x-authentication-card>
</x-guest-layout>
