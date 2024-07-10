<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
        {{-- View for Clinic Admins  --}}
    @if(Auth::user()->roles->contains('id', 2) && Auth::user()->professional && Auth::user()->professional->clinic_id != null)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <h1>Clinic content here</h1>
                    <div class="mt-6">
                        <form action="{{ route('clinic.generateLink', ['role_id' => 4]) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <x-label for="clinic_id" value="{{ __('Clinic ID') }}" />
                                <x-input id="clinic_id" class="block mt-1 w-full" type="text" name="clinic_id" required />
                            </div>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Generate Client Registration Link
                            </button>
                        </form>
                        <br>
                        <form action="{{ route('clinic.generateLink', ['role_id' => 3]) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <x-label for="clinic_id" value="{{ __('Clinic ID') }}" />
                                <x-input id="clinic_id" class="block mt-1 w-full" type="text" name="clinic_id" required />
                            </div>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Generate Professional Registration Link
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
            {{-- View for Professionals  --}}
    @elseif(Auth::user()->roles->contains('id', 3))
        <h1 class="text-white">Content for professionals</h1>

        {{-- View for Clients  --}}
    @elseif(Auth::user()->roles->contains('id', 4))
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <x-welcome />
                <div class="mt-6">
                    <a href="{{ route('client_form.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Create Client Form
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>
