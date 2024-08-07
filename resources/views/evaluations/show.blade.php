<x-app-layot>
    <div class="container mx-auto p-4">
        <h1 class="text-xl font-bold mb-4">Evaluation Summary</h1>
        <div class="bg-white shadow-md rounded p-4">
            <h2 class="text-lg font-semibold">Client Form Details</h2>
            <p><strong>Client ID:</strong> {{ $evaluation->clientForm->client_id }}</p>
            <p><strong>User ID:</strong> {{ $evaluation->clientForm->user_id }}</p>
            <p><strong>Details:</strong> {{ $evaluation->clientForm->details }}</p>

            @if($evaluation->clientForm->video_path)
                <video controls>
                    <source src="{{ Storage::url($evaluation->clientForm->video_path) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            @endif

            <h2 class="text-lg font-semibold mt-4">Evaluation Details</h2>
            <p><strong>Status:</strong> {{ $evaluation->status }}</p>
            <p><strong>Approved At:</strong> {{ $evaluation->approved_at }}</p>
            <p><strong>Professional ID:</strong> {{ $evaluation->professional_id }}</p>
            <p><strong>Clinic ID:</strong> {{ $evaluation->clinic_id }}</p>

            <h2 class="text-lg font-semibold mt-4">Plan</h2>
            <p><strong>Description:</strong> {{ $evaluation->plan->description }}</p>
            <p><strong>Plan:</strong> {{ $evaluation->plan->plan }}</p>

            <button onclick="copyToClipboard()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4">
                Copy to Clipboard
            </button>
        </div>
    </div>

    <script>
        function copyToClipboard() {
            let evaluationDetails = `Client ID: {{ $evaluation->clientForm->client_id }}\nUser ID: {{ $evaluation->clientForm->user_id }}\nDetails: {{ $evaluation->clientForm->details }}\n\nStatus: {{ $evaluation->status }}\nApproved At: {{ $evaluation->approved_at }}\nProfessional ID: {{ $evaluation->professional_id }}\nClinic ID: {{ $evaluation->clinic_id }}\n\nDescription: {{ $evaluation->plan->description }}\nPlan: {{ $evaluation->plan->plan }}`;
            navigator.clipboard.writeText(evaluationDetails).then(function() {
                alert('Evaluation details copied to clipboard.');
            }, function(err) {
                console.error('Could not copy text: ', err);
            });
        }
    </script>
</x-app-layot>
