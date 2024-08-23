<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="bg-white p-6 rounded-lg shadow-md max-w-lg mx-auto">
            <!-- Validation Errors -->
            <x-validation-errors class="mb-4" />

            <!-- Reset Password Form -->
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <!-- Hidden Token Field -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Field -->
                <div class="mb-4">
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                </div>

                <!-- Password Field -->
                <div class="mb-4">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" type="password" name="password" required autocomplete="new-password" />
                </div>

                <!-- Confirm Password Field -->
                <div class="mb-4">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-input id="password_confirmation" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-end mt-6">
                    <x-button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
                        {{ __('Reset Password') }}
                    </x-button>
                </div>
            </form>
        </div>

    </x-authentication-card>
</x-guest-layout>
