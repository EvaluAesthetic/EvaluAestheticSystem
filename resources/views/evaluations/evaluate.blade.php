<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 mb-8 pb-8">
        <h1 class="text-2xl font-semibold text-black my-6 mx-2">Evaluer Klient</h1>

        <!-- Client Form Details -->
        <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
            <h2 class="text-lg font-semibold text-gray-700">Klient Oplysninger</h2>
            <div class="grid grid-cols-2 gap-x-6 gap-y-2">
                <p class="text-gray-900 text-base font-medium">{{ $clientForm->client->user->name }}</p>
                <p class="text-gray-900 text-base font-medium"><strong class="text-gray-600 font-extrabold">Beskæftigelse:</strong> {{ $clientForm->occupation }}</p>
                <p class="text-gray-900 text-base font-medium">{{ $clientForm->client->user->phone }}</p>
                <p class="text-gray-900 text-base font-medium"><strong class="text-gray-600 font-bold">Fødselsdato:</strong> {{ $clientForm->client->user->formatBirthday('string') }}</p>
                <p class="text-gray-900 text-base font-medium">{{ $clientForm->client->user->email }}</p>
            </div>

            <!-- Medical Information Section -->
            <div class="mt-6">
                <h2 class="text-lg font-semibold text-gray-700">Klient Detaljer</h2>
                <div class="space-y-2 my-2">
                    <p><strong class="font-medium text-gray-700">Ønsker til behandling:</strong> {{ $clientForm->treatment_wishes }}</p>
                    <p><strong class="font-medium text-gray-700">Historik:</strong>
                        @if(!$clientForm->has_history)
                            Ingen
                        @else
                            {{ $clientForm->history }}
                        @endif
                    </p>
                    <p><strong class="font-medium text-gray-700">Graviditet eller amning:</strong>
                        @if(!$clientForm->is_pregnant_or_breastfeeding)
                            Ingen
                        @else
                            {{ $clientForm->pregnancy_details }}
                        @endif
                    </p>
                    <p><strong class="font-medium text-gray-700">Allergier:</strong>
                        @if(!$clientForm->has_allergy)
                            Ingen
                        @else
                            {{ $clientForm->allergy }}
                        @endif
                    </p>
                    <p><strong class="font-medium text-gray-700">Tidligere indgreb:</strong>
                        @if(!$clientForm->had_previous_treatments)
                            Ingen
                        @else
                            {{ $clientForm->previous_treatments }}
                        @endif
                    </p>
                    <p><strong class="font-medium text-gray-700">Medicin:</strong>
                        @if(!$clientForm->has_medication)
                            Ingen
                        @else
                            {{ $clientForm->medication }}
                        @endif
                    </p>
                </div>
            </div>
            <div class="mt-6">
                <h2 class="text-lg font-semibold mb-3 text-gray-700">Video: </h2>
                    <video controls class="w-full rounded-lg shadow-md">
                        <source src="{{ $clientForm->getVideoURL() }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
            </div>
        </div>

        <!-- Evaluation Form -->
        <form action="{{ route('client_form.evaluate.store', $clientForm->id) }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Godkend klient</label>
                <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="1" {{ $evaluation && $evaluation->status == 1 ? 'selected' : '' }}>Godkend</option>
                    <option value="0" {{ $evaluation && $evaluation->status == 0 ? 'selected' : '' }}>Afvis</option>
                </select>
            </div>

            <!-- Plan Fields -->
            @if(!$evaluation || $evaluation->status == 1)
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Objektive fund</label>
                    <textarea id="description" name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description', $evaluation && $evaluation->plans->last() ? $evaluation->plans->last()->description : 'Normal trofik, symmetri og mimik. Dynamiske rynker i øvre og nedre ansigt.') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="plan" class="block text-sm font-medium text-gray-700">Plan</label>
                    <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description', $evaluation && $evaluation->plans->last() ? $evaluation->plans->last()->description : "Kosmetisk behandling for rynker/furer med Azzalure. \n\nRp. Azzalure(antal U, vurderes af behandler) i øvre og nedre ansigt") }}</textarea>
                </div>
            @endif

            <button type="submit" class="bg-gray-700 text-white font-bold py-2 px-4 rounded-lg hover:border hover:border-orange-200">
                Gem Evaluering og plan
            </button>
        </form>
    </div>
</x-app-layout>
