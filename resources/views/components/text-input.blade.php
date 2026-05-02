@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-[var(--sage-green)]/20 border-[var(--sage-green)] focus:ring-[var(--forest-green)] focus:border-[var(--forest-green)] rounded-2xl shadow-sm py-2.5 transition-all']) }}>
