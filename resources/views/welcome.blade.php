@extends('layouts.guest')

@section('content')
<section class="bg-white dark:bg-gray-900 py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12">
    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
        @auth
        {{-- Tombol Dashboard untuk user yang sudah login --}}
        <a href="{{ route('dashboard.index') }}"
            class="inline-block px-5 py-2 text-sm font-semibold text-white bg-slate-800 rounded-lg shadow-md hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 focus:ring-offset-slate-900 transition-colors">
            Dashboard
        </a>
        @else
        {{-- Link Login (gaya sekunder) --}}
        <a href="{{ route('login') }}"
            class="px-5 py-2 text-sm font-semibold border-gray-500 border rounded-lg shadow-md text-slate-400 hover:text-white transition-colors">
            Log in
        </a>

        {{-- Tombol Register (gaya utama) --}}
        @if (Route::has('register'))
        <a href="{{ route('register') }}"
            class="ml-2 inline-block px-5 py-2 text-sm font-semibold text-white bg-slate-800 rounded-lg shadow-md hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 focus:ring-offset-slate-900 transition-colors">
            Register
        </a>
        @endif
        @endauth
    </div>
    <h1
        class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
        Bayar <span class="text-yellow-600">Listrik</span> Cukup Sekali Klik!
    </h1>
    <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">
        Cari ID Pelanggan atau Nomor kWh untuk cek dan bayar tagihan listrik.
    </p>
    @livewire('cari-pelanggan')
</section>
@endsection
