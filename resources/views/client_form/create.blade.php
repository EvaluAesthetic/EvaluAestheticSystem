<x-app-layout>
    <body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="container mx-auto p-4 max-w-lg">
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Indsend klient oplysninger</h2>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
            <form method="POST" action="{{ route('client_form.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2" for="treatment_wishes">Ønsker til behandling</label>
                    <textarea id="treatment_wishes" name="treatment_wishes" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:ring-0 focus:border-orange-200">{{ old('treatment_wishes') }}</textarea>
                </div>
                @error('treatment_wishes')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                <div class="mb-3">
                    <label for="has_history" class="block text-gray-700 font-semibold">Fejler du noget?</label>
                    <input type="hidden" name="has_history" value="0">
                    <input type="checkbox" id="has_history" name="has_history" value="1" class="mr-2 leading-tight focus:ring-white rounded-sm text-black" @if(old('has_history')) checked @endif onchange="toggleVisibility('history_div')">
                </div>

                <div class="mb-6 @if(!old('has_history')) hidden @endif" id="history_div">
                    <label for="history" class="block text-gray-700 font-semibold mb-2">Historik:</label>
                    <textarea id="history" name="history" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:shadow-outline focus:ring-0 focus:border-orange-200">{{ old('history') }}</textarea>
                </div>
                @error('has_history')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                <div class="mb-3">
                    <label for="has_disease" class="block text-gray-700 font-semibold">Har du en sygdom?</label>
                    <input type="hidden" name="has_disease" value="0">
                    <input type="checkbox" id="has_disease" name="has_disease" value="1" class="mr-2 leading-tight focus:ring-white rounded-sm text-black" @if(old('has_disease')) checked @endif onchange="toggleVisibility('disease_div')">
                </div>
                <div class="mb-4 @if(!old('has_disease')) hidden @endif" id="disease_div">
                    <label for="disease" class="block text-gray-700 font-semibold mb-2">Sygdom:</label>
                    <textarea id="disease" name="disease" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:shadow-outline focus:ring-0 focus:border-orange-200">{{ old('disease') }}</textarea>
                </div>
                @error('has_disease')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                <div class="mb-3">
                    <label for="has_allergy" class="block text-gray-700 font-semibold">Har du allergi?</label>
                    <input type="hidden" name="has_allergy" value="0">
                    <input type="checkbox" id="has_allergy" name="has_allergy" value="1" class="mr-2 leading-tight focus:ring-white rounded-sm text-black" @if(old('has_allergy')) checked @endif onchange="toggleVisibility('allergy_div')">
                </div>
                <div class="mb-4 @if(!old('has_allergy')) hidden @endif" id="allergy_div">
                    <label for="allergy" class="block text-gray-700 font-semibold mb-2">Allergier:</label>
                    <textarea id="allergy" name="allergy" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:shadow-outline focus:ring-0 focus:border-orange-200">{{ old('allergy') }}</textarea>
                </div>
                @error('has_allergy')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                <div class="mb-3">
                    <label for="had_previous_treatments" class="block text-gray-700 font-semibold">Har du tidligere fået foretaget kosmetisk behandling? </label>
                    <input type="hidden" name="had_previous_treatments" value="0">
                    <input type="checkbox" id="had_previous_treatments" name="had_previous_treatments" value="1" class="mr-2 leading-tight focus:ring-white rounded-sm text-black" @if(old('had_previous_treatments')) checked @endif onchange="toggleVisibility('previous_treatments_div')">
                </div>
                <div class="mb-4 @if(!old('had_previous_treatments')) hidden @endif" id="previous_treatments_div">
                    <label for="previous_treatments" class="block text-gray-700 font-semibold mb-2">Tidligere behandlinger:</label>
                    <textarea id="previous_treatments" name="previous_treatments" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:shadow-outline focus:ring-0 focus:border-orange-200">{{ old('previous_treatments') }}</textarea>
                </div>
                @error('had_previous_treatments')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                <div class="mb-3">
                    <label for="has_medication" class="block text-gray-700 font-semibold">Tager du noget medicin til dagligt?</label>
                    <input type="hidden" name="has_medication" value="0">
                    <input type="checkbox" id="has_medication" name="has_medication" value="1" class="mr-2 leading-tight focus:ring-white rounded-sm text-black" @if(old('has_medication')) checked @endif onchange="toggleVisibility('medication_div')">
                </div>
                <div class="mb-4 @if(!old('has_medication')) hidden @endif" id="medication_div">
                    <label for="medication" class="block text-gray-700 font-semibold mb-2">Medicin?</label>
                    <textarea id="medication" name="medication" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:shadow-outline focus:ring-0 focus:border-orange-200">{{ old('medication') }}</textarea>
                </div>
                @error('has_medication')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                <div class="mb-6">
                    <label for="occupation" class="block text-gray-700 font-semibold mb-2">Hvad er din beskæftigelse?</label>
                    <input type="text" id="occupation" name="occupation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:shadow-outline focus:ring-0 focus:border-orange-200" required value="{{ old('occupation') }}">
                </div>
                @error('occupation')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                <div class="mb-6">
                    <label for="video" class="block text-gray-700 font-semibold">Upload video</label>
                    <p class="italic">Upload en video af dig selv hvor du beskriver......</p>
                    <input type="file" name="video" id="video" required class="focus:ring-blue-500 focus:border-blue-500">
                </div>
                @error('video')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                <div class="flex items-center justify-center">
                    <button type="submit" class="bg-black hover:bg-gray-700 text-white font-bold py-2 px-6 rounded-md shadow-lg focus:outline-none focus:shadow-outline">
                        Indsend
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
