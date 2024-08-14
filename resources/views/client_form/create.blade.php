<x-app-layout>
    <body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-4">Create Client Form</h2>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('client_form.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">

                    <label class="block text-gray-700" for="treatment_wishes">Ønsker til behandling</label>
                    <textarea id="treatment_wishes" name="treatment_wishes" rows="4" cols="50"></textarea>
                </div>

                <div class="mb-4">
                    <label for="has_history" class="block text-gray-700">Has History</label>
                    <input type="hidden" name="has_history" value="0">
                    <input type="checkbox" id="has_history" name="has_history" value="1" class="mr-2 leading-tight" @if(old('has_history')) checked @endif onchange="toggleVisibility('history_div')">
                </div>
                <div class="mb-4 @if(!old('has_history')) hidden @endif" id="history_div">
                    <label for="history" class="block text-gray-700">History</label>
                    <textarea id="history" name="history" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('history') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="has_disease" class="block text-gray-700">Has Disease</label>
                    <input type="hidden" name="has_disease" value="0">
                    <input type="checkbox" id="has_disease" name="has_disease" value="1" class="mr-2 leading-tight" @if(old('has_disease')) checked @endif onchange="toggleVisibility('disease_div')">
                </div>
                <div class="mb-4 @if(!old('has_disease')) hidden @endif" id="disease_div">
                    <label for="disease" class="block text-gray-700">Disease</label>
                    <textarea id="disease" name="disease" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('disease') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="has_allergy" class="block text-gray-700">Has Allergy</label>
                    <input type="hidden" name="has_allergy" value="0">
                    <input type="checkbox" id="has_allergy" name="has_allergy" value="1" class="mr-2 leading-tight" @if(old('has_allergy')) checked @endif onchange="toggleVisibility('allergy_div')">
                </div>
                <div class="mb-4 @if(!old('has_allergy')) hidden @endif" id="allergy_div">
                    <label for="allergy" class="block text-gray-700">Allergy</label>
                    <textarea id="allergy" name="allergy" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('allergy') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="had_previous_treatments" class="block text-gray-700">Had Previous Treatments</label>
                    <input type="hidden" name="had_previous_treatments" value="0">
                    <input type="checkbox" id="had_previous_treatments" name="had_previous_treatments" value="1" class="mr-2 leading-tight" @if(old('had_previous_treatments')) checked @endif onchange="toggleVisibility('previous_treatments_div')">
                </div>
                <div class="mb-4 @if(!old('had_previous_treatments')) hidden @endif" id="previous_treatments_div">
                    <label for="previous_treatments" class="block text-gray-700">Previous Treatments</label>
                    <textarea id="previous_treatments" name="previous_treatments" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('previous_treatments') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="has_medication" class="block text-gray-700">Has Medication</label>
                    <input type="hidden" name="has_medication" value="0">
                    <input type="checkbox" id="has_medication" name="has_medication" value="1" class="mr-2 leading-tight" @if(old('has_medication')) checked @endif onchange="toggleVisibility('medication_div')">
                </div>
                <div class="mb-4 @if(!old('has_medication')) hidden @endif" id="medication_div">
                    <label for="medication" class="block text-gray-700">Medication</label>
                    <textarea id="medication" name="medication" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('medication') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="occupation" class="block text-gray-700">Occupation</label>
                    <input type="text" id="occupation" name="occupation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required value="{{ old('occupation') }}">
                </div>

                <div class="mb-4">
                    <label for="video" class="block text-gray-700">Video Upload</label>
                    <input type="file" name="video" id="video" required>
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleVisibility(divId) {
            var div = document.getElementById(divId);
            div.classList.toggle('hidden');
        }
    </script>
    </body>
</x-app-layout>
