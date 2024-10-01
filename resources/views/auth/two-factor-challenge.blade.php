<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="bg-white p-6 rounded-lg shadow-md max-w-lg mx-auto">
            <!-- Instructions for Two-Factor Verification -->
            <div class="mb-4 text-sm text-gray-600">
                {{ __('Indtast venligst bekræftelseskoden, der er sendt til din telefon, for at fuldføre loginprocessen.') }}
            </div>

            <!-- Validation Errors -->
            <x-validation-errors class="mb-4" />

            <!-- Two-Factor Verification Form -->
            <form method="POST" action="{{ route('2fa.verify.post') }}">
                @csrf

                <!-- Verification Code Input Field -->
                <div class="mb-4">
                    <x-label for="verification_code" value="{{ __('Bekræftelses kode') }}" />
                    <x-input id="verification_code" class="block mt-1 w-full rounded-md focus:outline-none focus:ring-2 focus:ring-orange-200 focus:border-transparent"
                             type="text" name="verification_code" required autofocus />
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-end mt-4">
                    <x-button class="border hover:border-orange-200 font-bold py-2 px-4 rounded-md">
                        {{ __('Bekræft') }}
                    </x-button>
                </div>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>
