{{-- resources/views/components/sidebar-link.blade.php --}}
@props(['active' => false, 'href' => '#'])

@php
// Logika untuk menentukan class mana yang akan digunakan
$classes = ($active ?? false)
// Class untuk link yang sedang aktif
? 'flex items-center px-3 py-2.5 text-sm font-semibold bg-slate-950 text-white rounded-lg shadow-sm'
// Class untuk link normal
: 'flex items-center px-3 py-2.5 text-sm font-medium text-slate-400 rounded-lg hover:bg-slate-800 hover:text-white
transition-colors duration-200';
@endphp

<li>
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{-- Slot untuk ikon --}}
        <span class="w-6 h-6">
            {{ $icon }}
        </span>
        {{-- Slot untuk teks --}}
        <span class="ml-3">{{ $slot }}</span>
    </a>
</li>
