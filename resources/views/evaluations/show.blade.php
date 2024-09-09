<x-app-layout>
    <div class="max-w-6xl mx-auto px-4">
        <h1 class="text-2xl font-semibold text-black my-6 text-left mx-2">Tidligere evalueringer</h1>

        @if($evaluations->isEmpty())
            <p class="text-gray-700 text-center">Ingen tidligere evaluationer.</p>
        @else
            <ul class="space-y-4">
                @foreach($evaluations as $evaluation)
                    <li class="p-4 bg-white shadow-sm rounded-lg hover:border hover:border-orange-200 cursor-pointer transition-colors">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center w-full space-x-6">
                                <div class="w-1/4 text-lg text-gray-900">
                                    <span class="font-semibold">Navn:</span> <span class="font-normal">{{ $evaluation->clientForm->client->user->name }}</span>
                                </div>
                                <div class="w-1/4 text-lg text-gray-900">
                                    <span class="font-semibold">Fødsels dato:</span> <span class="font-normal">{{ $evaluation->clientForm->client->user->formatBirthday() }}</span>
                                </div>
                                <div class="w-1/4 text-lg text-gray-900">
                                    <span class="font-semibold">Mail:</span> <span class="font-normal">{{ $evaluation->clientForm->client->user->email }}</span>
                                </div>
                                <div class="w-1/4 text-lg text-gray-900">
                                    <span class="font-semibold">Telefon:</span> <span class="font-normal">{{ $evaluation->clientForm->client->user->phone }}</span>
                                </div>
                                <div class="w-1/4 text-lg text-gray-900">
                                    <span class="font-semibold">Status:</span> @if($evaluation->status == 1)<span class="font-normal border border-green-500">Godkendt</span>@elseif($evaluation->status == 2) <span class="font-normal border border-red-500">Afvist</span> @endif
                                </div>
                            </div>
                            <div class="text-black hover:text-blue-700 font-semibold whitespace-nowrap">Se oplysninger</div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

</x-app-layout>
