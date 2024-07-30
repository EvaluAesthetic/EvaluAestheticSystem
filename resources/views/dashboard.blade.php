<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
        {{-- View for Clinic Admins  --}}
    @if(Auth::user()->roles->contains('id', 2) && Auth::user()->professional && Auth::user()->professional->clinic_id != null)
        <div class="py-12">
            <h1 class="text-white">Clinic Admin View</h1>
        </div>
            {{-- View for Professionals  --}}
    @elseif(Auth::user()->roles->contains('id', 3) && Auth::user()->professional && Auth::user()->professional->clinic_id != null)
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
