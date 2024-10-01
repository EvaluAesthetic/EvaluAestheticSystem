<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <div class="mb-4 text-sm text-gray-600">
                {{ __('Før du fortsætter, vil du så bekræfte din e-mailadresse ved at klikke på linket, som vi lige har sendt til dig? Hvis du ikke har modtaget e-mailen, sender vi gerne en ny.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ __('Et nyt bekræftelseslink er blevet sendt til den e-mailadresse, du har angivet i dine profilindstillinger.') }}
                </div>
            @endif

            <div class="mt-4 flex items-center justify-between">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <div>
                        <x-button type="submit" class="border hover:border-orange-200 font-bold py-2 px-4 rounded-md">
                            {{ __('Genafsend bekræftelsesmail') }}
                        </x-button>
                    </div>
                </form>

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="p-1 text-gray-600 border border-black hover:border-orange-200 rounded-md">
                            {{ __('Log Ud') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </x-authentication-card>
</x-guest-layout>
