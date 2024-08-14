<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex justify-center items-center text-center w-full px-4 py-2 bg-white border-black border rounded-md font-semibold text-xs uppercase tracking-widest']) }}>
    {{ $slot }}
</button>
