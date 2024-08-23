<x-app-layout>
    <div class="max-w-6xl mx-auto px-4 py-6">
        <h1 class="text-3xl font-semibold text-black mb-6">Evaluation and Plan Details</h1>

        <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
            <h2 class="text-xl font-semibold mb-4">Client Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p><strong>Navn:</strong> {{ $evaluation->clientForm->client->user->name }}</p>
                    <p><strong>Mail:</strong> {{ $evaluation->clientForm->client->user->email }}</p>
                    <p><strong>Telefon:</strong> {{ $evaluation->clientForm->client->user->phone }}</p>
                </div>
                <div>
                    <p><strong>Clinic:</strong> {{ $evaluation->clientForm->client->clinic->name }}</p>
                    <p><strong>Evaluated By:</strong> {{ $evaluation->professional->user->name }}</p>
                    <p><strong>Evaluation Date:</strong> {{ $evaluation->approved_at->format('d M, Y') }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm mb-6">
            <h2 class="text-xl font-semibold mb-4">Plan Details</h2>
            <p><strong>Description:</strong> {{ $plan->description }}</p>
            <p><strong>Plan:</strong></p>
            <div class="bg-gray-100 p-4 rounded-md mb-4">
                <pre class="whitespace-pre-wrap">{{ $plan->plan }}</pre>
            </div>
        </div>

        <button id="copyButton" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600 transition-colors">
            Copy Plan to Clipboard
        </button>
    </div>

    <!-- JavaScript to Copy Content -->
    <script>
        document.getElementById('copyButton').addEventListener('click', function() {
            let content = `
            Navn: {{ $evaluation->clientForm->client->user->name }}\n
            Mail: {{ $evaluation->clientForm->client->user->email }}\n
            Telefon: {{ $evaluation->clientForm->client->user->phone }}\n\n
            Clinic: {{ $evaluation->clientForm->client->clinic->name }}\n
            Evaluated By: {{ $evaluation->professional->user->name }}\n
            Evaluation Date: {{ $evaluation->approved_at->format('d M, Y') }}\n\n
            Description: {{ $plan->description }}\n
            Plan:\n{{ $plan->plan }}\n
        `;

            navigator.clipboard.writeText(content).then(function() {
                alert('Plan content copied to clipboard!');
            }).catch(function(error) {
                alert('Failed to copy content: ' + error);
            });
        });
    </script>
</x-app-layout>
