<x-app-layout>
            {{-- View for Professionals & Clinic Admins  --}}
    @if(Auth::user()->professional && Auth::user()->professional->clinic_id != null && Auth::user()->roles->contains('id', 2) || Auth::user()->roles->contains('id', 3))
        <livewire:unevaluated-client-forms />

        {{-- View for Clients  --}}
    @elseif(Auth::user()->roles->contains('id', 4))
{{--    <div class="py-12">--}}
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
{{--            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">--}}
{{--                <div class="mt-6">--}}
{{--                    <a href="{{ route('client_form.create') }}" class="inline-flex justify-center items-center text-center w-full px-4 py-2 bg-white border-black border rounded-md font-semibold text-xs uppercase tracking-widest">--}}
{{--                        Indsend klient undersøgelse--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
        <livewire:client-form />
    @endif
</x-app-layout>
