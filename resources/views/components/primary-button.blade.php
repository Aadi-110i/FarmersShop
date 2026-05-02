<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-6 py-3 bg-[var(--forest-green)] border border-transparent rounded-full font-bold text-sm text-white uppercase tracking-widest hover:bg-[var(--earth-brown)] focus:outline-none focus:ring-2 focus:ring-[var(--forest-green)] focus:ring-offset-2 transition ease-in-out duration-150 shadow-md hover:shadow-lg']) }}>
    {{ $slot }}
</button>
