<x-app-layout>
    <div class="max-w-6xl mx-auto px-4">
        <h1 class="text-2xl font-semibold text-black my-6 text-left mx-2">Evaluation and Plan Details</h1>

        <div class="space-y-4">
            <div class="p-4 bg-white shadow-sm rounded-lg border border-orange-200 transition-colors">
                <h2 class="text-xl font-semibold mb-4">Klient Form Informationer</h2>

                <!-- Flexbox container for client information -->
                <div class="grid grid-cols-3 gap-y-4 text-lg text-gray-900 mb-6">
                    <div><span class="font-semibold">Navn:</span> <span class="font-normal">{{ $evaluation->clientForm->client->user->name }}</span></div>
                    <div><span class="font-semibold">Mail:</span> <span class="font-normal">{{ $evaluation->clientForm->client->user->email }}</span></div>
                    <div><span class="font-semibold">Telefon:</span> <span class="font-normal">{{ $evaluation->clientForm->client->user->phone }}</span></div>
                    <div><span class="font-semibold">Clinic:</span> <span class="font-normal">{{ $evaluation->clientForm->client->clinic->name }}</span></div>
                    <div><span class="font-semibold">Evaluated By:</span> <span class="font-normal">{{ $evaluation->professional->user->name }}</span></div>
                    <div><span class="font-semibold">Evaluation Date:</span> <span class="font-normal">{{ $evaluation->approved_at->format('d M, Y, H:i') }}</span></div>
                </div>

                <!-- Adjusted grid for medical and other details -->
                <div class="grid grid-cols-3 gap-y-4 text-lg text-gray-900">
                    <div><span class="font-semibold">Historik:</span> <span class="font-normal">{{ $evaluation->clientForm->has_history ? $evaluation->clientForm->history : 'Ingen' }}</span></div>
                    <div><span class="font-semibold">Sygdomme:</span> <span class="font-normal">{{ $evaluation->clientForm->is_pregnant_or_breastfeeding ? $evaluation->clientForm->pregnancy_details : 'Ingen' }}</span></div>
                    <div><span class="font-semibold">Allergier:</span> <span class="font-normal">{{ $evaluation->clientForm->has_allergy ? $evaluation->clientForm->allergy : 'Ingen' }}</span></div>
                    <div><span class="font-semibold">Tidligere indgreb:</span> <span class="font-normal">{{ $evaluation->clientForm->had_previous_treatments ? $evaluation->clientForm->previous_treatments : 'Ingen' }}</span></div>
                    <div><span class="font-semibold">Medicin:</span> <span class="font-normal">{{ $evaluation->clientForm->has_medication ? $evaluation->clientForm->medication : 'Ingen' }}</span></div>
                    <div><span class="font-semibold">Beskæftigelse:</span> <span class="font-normal">{{ $evaluation->clientForm->occupation }}</span></div>
                </div>
            </div>

            <div class="p-4 bg-white shadow-sm rounded-lg border border-orange-200 transition-colors">
                <h2 class="text-xl font-semibold mb-4">Plan Details</h2>
                <div class="text-lg text-gray-900 mb-2">
                    <span class="font-semibold">Description:</span> <span class="font-normal">{{ $plan->description }}</span>
                </div>
                <div class="text-lg text-gray-900 mb-2">
                    <span class="font-semibold">Plan:</span>
                </div>
                <div class="bg-gray-100 p-4 rounded-md mb-4">
                    <pre class="whitespace-pre-wrap text-lg font-normal">{{ $plan->plan }}</pre>
                </div>
            </div>
        </div>

        <button id="copyButton" class="mt-4 bg-black hover:bg-gray-700 text-white font-bold py-2 px-6 rounded-md shadow-lg focus:outline-none focus:shadow-outline">
            Copy All Details to Clipboard
        </button>
    </div>

    <!-- JavaScript to Copy Content -->
    <script>
        document.getElementById('copyButton').addEventListener('click', function() {
            let content = `
            Evaluation and Plan Details:

            Klient Form Informationer:
            Navn: {{ $evaluation->clientForm->client->user->name }}
            Mail: {{ $evaluation->clientForm->client->user->email }}
            Telefon: {{ $evaluation->clientForm->client->user->phone }}

            Clinic: {{ $evaluation->clientForm->client->clinic->name }}
            Evaluated By: {{ $evaluation->professional->user->name }}
            Evaluation Date: {{ $evaluation->approved_at->format('d M, Y, H:i') }}

            Historik: {{ $evaluation->clientForm->has_history ? $evaluation->clientForm->history : 'Ingen' }}
            Graviditet eller amning: {{ $evaluation->clientForm->is_pregnant_or_breastfeeding ? $evaluation->clientForm->pregnancy_details : 'Ingen' }}
            Allergier: {{ $evaluation->clientForm->has_allergy ? $evaluation->clientForm->allergy : 'Ingen' }}
            Tidligere indgreb: {{ $evaluation->clientForm->had_previous_treatments ? $evaluation->clientForm->previous_treatments : 'Ingen' }}
            Medicin: {{ $evaluation->clientForm->has_medication ? $evaluation->clientForm->medication : 'Ingen' }}
            Beskæftigelse: {{ $evaluation->clientForm->occupation }}

            Plan Details:
            Description: {{ $plan->description }}
            Plan: {{ $plan->plan }}
            `.replace(/^\s+/gm, '');

            navigator.clipboard.writeText(content.trim()).then(function() {
                alert('All details copied to clipboard!');
            }).catch(function(error) {
                alert('Failed to copy content: ' + error);
            });
        });
    </script>
</x-app-layout>
