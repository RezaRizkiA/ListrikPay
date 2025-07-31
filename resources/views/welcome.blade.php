@extends('layouts.guest')

@section('content')
<section class="bg-white dark:bg-gray-900 py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12">
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
