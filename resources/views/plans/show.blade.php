<x-app-layout>
    <div class="max-w-6xl mx-auto px-4">
        <h1 class="text-2xl font-semibold text-black my-6 text-left mx-2">Evaluation and Plan Details</h1>

        <div class="space-y-4">
            <div class="p-4 bg-white shadow-sm rounded-lg border border-orange-200 transition-colors">
                <h2 class="text-xl font-semibold mb-4">Client Information</h2>
                <div class="flex justify-between items-center">
                    <div class="flex items-center w-full space-x-6">
                        <div class="w-1/3 text-lg text-gray-900">
                            <span class="font-semibold">Navn:</span> <span class="font-normal">{{ $evaluation->clientForm->client->user->name }}</span>
                        </div>
                        <div class="w-1/3 text-lg text-gray-900">
                            <span class="font-semibold">Mail:</span> <span class="font-normal">{{ $evaluation->clientForm->client->user->email }}</span>
                        </div>
                        <div class="w-1/3 text-lg text-gray-900">
                            <span class="font-semibold">Telefon:</span> <span class="font-normal">{{ $evaluation->clientForm->client->user->phone }}</span>
                        </div>
                    </div>
                </div>
                <div class="mt-4 flex justify-between items-center">
                    <div class="flex items-center w-full space-x-6">
                        <div class="w-1/3 text-lg text-gray-900">
                            <span class="font-semibold">Clinic:</span> <span class="font-normal">{{ $evaluation->clientForm->client->clinic->name }}</span>
                        </div>
                        <div class="w-1/3 text-lg text-gray-900">
                            <span class="font-semibold">Evaluated By:</span> <span class="font-normal">{{ $evaluation->professional->user->name }}</span>
                        </div>
                        <div class="w-1/3 text-lg text-gray-900">
                            <span class="font-semibold">Evaluation Date:</span> <span class="font-normal">{{ $evaluation->approved_at->format('d M, Y, H:i') }}</span>
                        </div>
                    </div>
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
            Copy Plan to Clipboard
        </button>
    </div>

    <!-- JavaScript to Copy Content -->
    <script>
        document.getElementById('copyButton').addEventListener('click', function() {
            let content = `
            Navn: {{ $evaluation->clientForm->client->user->name }}
            Mail: {{ $evaluation->clientForm->client->user->email }}
            Telefon: {{ $evaluation->clientForm->client->user->phone }}

            Clinic: {{ $evaluation->clientForm->client->clinic->name }}
            Evaluated By: {{ $evaluation->professional->user->name }}
            Evaluation Date: {{ $evaluation->approved_at->format('d M, Y, H:i') }}

            Description: {{ $plan->description }}
            Plan:
            {{ $plan->plan }}
            `;

            navigator.clipboard.writeText(content).then(function() {
                alert('Plan content copied to clipboard!');
            }).catch(function(error) {
                alert('Failed to copy content: ' + error);
            });
        });
    </script>
</x-app-layout>
