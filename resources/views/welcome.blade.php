{{-- @extends('layouts.guest')

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
@endsection --}}
@extends('layouts.guest')

@section('content')
<section x-data="{ showLogin: false, showRegister: false }"
    class="bg-white dark:bg-gray-900 py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12">

    {{-- tombol Login / Register --}}
    <div class="mb-8 space-x-4">
        <button @click="showLogin = true"
            class="px-4 py-2 bg-transparent border border-gray-800 text-gray-800 dark:border-gray-200 dark:text-gray-200 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition">
            Login
        </button>
        <button @click="showRegister = true"
            class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition font-semibold">
            Register
        </button>
    </div>

    {{-- hero --}}
    <h1
        class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
        Bayar <span class="text-yellow-600">Listrik</span> Cukup Sekali Klik!
    </h1>
    <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">
        Cari ID Pelanggan atau Nomor kWh untuk cek dan bayar tagihan listrik.
    </p>

    @livewire('cari-pelanggan')

    {{-- Modal Login --}}
    <div x-show="showLogin" x-cloak class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div @click.away="showLogin = false" class="bg-white dark:bg-gray-800 rounded-xl shadow-xl max-w-md w-full p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Login</h2>
                <button @click="showLogin = false" class="text-gray-500 hover:text-gray-800 dark:hover:text-gray-200">
                    ✕
                </button>
            </div>
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm text-gray-700 dark:text-gray-300">Email</label>
                    <input type="email" name="email" required autofocus
                        class="mt-1 w-full px-3 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-yellow-500" />
                </div>
                <div>
                    <label class="block text-sm text-gray-700 dark:text-gray-300">Password</label>
                    <input type="password" name="password" required
                        class="mt-1 w-full px-3 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-yellow-500" />
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember"
                        class="h-4 w-4 text-yellow-600 focus:ring-yellow-500 border-gray-300 rounded" />
                    <label for="remember" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">Remember
                        me</label>
                </div>
                <button type="submit"
                    class="w-full py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition font-semibold">
                    Masuk
                </button>
            </form>
        </div>
    </div>

    {{-- Modal Register --}}
    <div x-show="showRegister" x-cloak class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div @click.away="showRegister = false"
            class="bg-white dark:bg-gray-800 rounded-xl shadow-xl max-w-md w-full p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Register</h2>
                <button @click="showRegister = false"
                    class="text-gray-500 hover:text-gray-800 dark:hover:text-gray-200">
                    ✕
                </button>
            </div>
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm text-gray-700 dark:text-gray-300">Nama Pengguna</label>
                    <input type="text" name="username" required
                        class="mt-1 w-full px-3 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-yellow-500" />
                </div>
                <div>
                    <label class="block text-sm text-gray-700 dark:text-gray-300">Email</label>
                    <input type="email" name="email" required
                        class="mt-1 w-full px-3 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-yellow-500" />
                </div>
                <div>
                    <label class="block text-sm text-gray-700 dark:text-gray-300">Password</label>
                    <input type="password" name="password" required
                        class="mt-1 w-full px-3 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-yellow-500" />
                </div>
                <div>
                    <label class="block text-sm text-gray-700 dark:text-gray-300">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required
                        class="mt-1 w-full px-3 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-yellow-500" />
                </div>
                <button type="submit"
                    class="w-full py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition font-semibold">
                    Daftar
                </button>
            </form>
        </div>
    </div>
</section>
@endsection