<div class="max-w-6xl mx-auto px-4">
    <h1 class="text-2xl font-semibold text-black my-6 text-left mx-2">Client Former klar til evaluering</h1>

    @if($unevaluatedClientForms->isEmpty())
        <p class="text-gray-700 text-center">Ingen klient former til evaluering.</p>
    @else
        <ul class="space-y-4">
            @foreach($unevaluatedClientForms as $form)
                <li class="p-4 bg-white shadow-sm rounded-lg hover:border hover:border-orange-200 cursor-pointer transition-colors" onclick="window.location='{{ route('client_form.evaluate', $form->id) }}'">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center w-full space-x-6">
                            <div class="w-1/3 text-lg text-gray-900">
                                <span class="font-semibold">Navn:</span> <span class="font-normal">{{ $form->client->user->name }}</span>
                            </div>
                            <div class="w-1/3 text-lg text-gray-900">
                                <span class="font-semibold">Mail:</span> <span class="font-normal">{{ $form->client->user->email }}</span>
                            </div>
                            <div class="w-1/3 text-lg text-gray-900">
                                <span class="font-semibold">Telefon:</span> <span class="font-normal">{{ $form->client->user->phone }}</span>
                            </div>
                        </div>
                        <div class="text-black hover:text-blue-700 font-semibold whitespace-nowrap">Se oplysninger</div>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>