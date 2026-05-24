@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-[10px] font-black uppercase tracking-widest text-red-600 space-y-1 mt-2 ml-1 flex flex-col gap-1']) }}>
        @foreach ((array) $messages as $message)
            <li class="flex items-center gap-1.5 animate-fade-in">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                <span>{{ $message }}</span>
            </li>
        @endforeach
    </ul>
@endif
