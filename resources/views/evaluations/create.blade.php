<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-xl font-bold mb-4">Evaluate Client Form</h1>
        <div class="bg-white shadow-md rounded p-4">
            <h2 class="text-lg font-semibold">Client Form Details</h2>
            <p><strong>Clinic ID:</strong> {{ $clientForm->client_id }}</p>
            <p><strong>User:</strong> {{ $clientForm->user->name }}</p>


            @if($clientForm->video_path)
                <video controls>
                    <source src="{{ Storage::url($clientForm->video_path) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            @endif

            <form action="{{ route('client_form.evaluate.store', $clientForm->id) }}" method="POST" class="mt-4">
                @csrf
                <div class="mb-4">
                    <label for="status" class="block text-gray-700">Status</label>
                    <input type="number" name="status" id="status" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700">Description</label>
                    <textarea name="description" id="description" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                </div>
                <div class="mb-4">
                    <label for="plan" class="block text-gray-700">Plan</label>
                    <textarea name="plan" id="plan" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Submit Evaluation
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
