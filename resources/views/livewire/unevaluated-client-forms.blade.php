<div>
    <h1 class="text-black">Unevaluated Client Forms</h1>

    @if($unevaluatedClientForms->isEmpty())
        <p class="text-black">No unevaluated client forms available.</p>
    @else
        <table class="min-w-full bg-white">
            <thead>
            <tr>
                <th class="px-4 py-2">Clinic ID</th>
                <th class="px-4 py-2">User ID</th>
                <th class="px-4 py-2">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($unevaluatedClientForms as $form)
                <tr>
                    <td class="border px-4 py-2">{{ $form->clinic_id }}</td>
                    <td class="border px-4 py-2">{{ $form->user_id }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('client_form.evaluate', $form->id)}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Evaluate
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
