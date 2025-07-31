<x-app-layout>
    {{-- ====================================================== --}}
    {{-- SIDEBAR DINAMIS --}}
    {{-- ====================================================== --}}
    <aside id="drawer-navigation"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-16 transition-transform -translate-x-full md:translate-x-0 bg-slate-900 border-r border-slate-800">
        <div class="flex flex-col h-full overflow-y-auto px-3 py-4 bg-slate-900">

            {{-- Navigasi Sidebar --}}
            <nav class="flex-1">
                <ul class="space-y-2">
                    {{-- Grup Menu Utama --}}
                    <li>
                        <span class="px-3 text-xs font-semibold tracking-wider text-slate-500 uppercase">Menu
                            Utama</span>
                        <ul class="mt-2 space-y-1">
                            <x-sidebar-link href="{{ route('dashboard.index') }}"
                                :active="request()->routeIs('dashboard.index*')">
                                <x-slot name="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M10.5 6a7.5 7.5 0 100 15 7.5 7.5 0 000-15z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
                                    </svg>
                                </x-slot>
                                Dashboard
                            </x-sidebar-link>
                        </ul>
                    </li>

                    {{-- Kondisional Berdasarkan Role --}}
                    @if(auth()->user()->id_level != 3)
                    {{-- Menu untuk Admin & Operator --}}
                    <li class="pt-4">
                        <span
                            class="px-3 text-xs font-semibold tracking-wider text-slate-500 uppercase">Manajemen</span>
                        <ul class="mt-2 space-y-1">
                            <x-sidebar-link href="{{ route('dashboard.penggunaan') }}"
                                :active="request()->routeIs('dashboard.penggunaan*')">
                                <x-slot name="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.4 2.245 4.5 4.5 0 008.4-2.245c0-.399-.078-.78-.22-1.128zm0 0a15.998 15.998 0 003.388-1.62m-5.043-.025a15.998 15.998 0 011.622-3.385m5.043.025a15.998 15.998 0 001.622-3.385m3.388 1.62a15.998 15.998 0 01-5.044-3.385m-5.043 3.385a15.998 15.998 0 005.044 3.385m-3.388-1.62a15.998 15.998 0 01-1.622 3.385" />
                                    </svg>
                                </x-slot>
                                Penggunaan
                            </x-sidebar-link>
                            <x-sidebar-link href="{{ route('dashboard.tagihan') }}"
                                :active="request()->routeIs('dashboard.tagihan*')">
                                <x-slot name="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                                    </svg>
                                </x-slot>
                                Tagihan
                            </x-sidebar-link>
                            <x-sidebar-link href="{{ route('dashboard.pembayaran') }}"
                                :active="request()->routeIs('dashboard.pembayaran*')">
                                <x-slot name="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </x-slot>
                                Pembayaran
                            </x-sidebar-link>
                            <x-sidebar-link href="{{ route('dashboard.pelanggan') }}"
                                :active="request()->routeIs('dashboard.pelanggan*')">
                                <x-slot name="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-4.67c.12-.241.251-.477.383-.702a3 3 0 014.29-2.056l6.373 3.585a2.25 2.25 0 010 3.847l-6.373 3.585a3 3 0 01-4.29-2.056a6.375 6.375 0 01-1.18-4.67z" />
                                    </svg>
                                </x-slot>
                                Data Pelanggan
                            </x-sidebar-link>
                            <x-sidebar-link href="{{ route('dashboard.tarif') }}"
                                :active="request()->routeIs('dashboard.tarif*')">
                                <x-slot name="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-12v.75m0 3v.75m0 3v.75m0 3V18m-3-12v.75m0 3v.75m0 3v.75m0 3V18m9-12l-3 3m0 0l-3-3m3 3v12m6.75-12l-3 3m0 0l-3-3m3 3v12" />
                                    </svg>
                                </x-slot>
                                Tarif Listrik
                            </x-sidebar-link>
                            <li
                                x-data="{ open: {{ request()->routeIs('dashboard.user*') || request()->routeIs('dashboard.level*') ? 'true' : 'false' }} }">
                                <button @click="open = !open"
                                    class="flex items-center w-full px-3 py-2.5 text-sm font-medium text-left text-slate-400 rounded-lg hover:bg-slate-800 hover:text-white transition-colors duration-200">
                                    <span class="w-6 h-6"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg></span>
                                    <span class="ml-3 flex-1">User Management</span>
                                    <svg :class="{ 'rotate-90': open }" class="w-4 h-4 ml-2 transition-transform"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                                <ul x-show="open" x-collapse class="mt-1 space-y-1 pl-9">
                                    <li><a href="{{ route('dashboard.level') }}"
                                            class="block px-3 py-2 text-sm rounded-lg {{ request()->routeIs('dashboard.level*') ? 'text-white' : 'text-slate-400' }} hover:bg-slate-800 hover:text-white">Levels</a>
                                    </li>
                                    <li><a href="{{ route('dashboard.user') }}"
                                            class="block px-3 py-2 text-sm rounded-lg {{ request()->routeIs('dashboard.user*') ? 'text-white' : 'text-slate-400' }} hover:bg-slate-800 hover:text-white">Users</a>
                                    </li>
                                </ul>
                            </li>
                            <x-sidebar-link href="{{ route('dashboard.laporan') }}"
                                :active="request()->routeIs('dashboard.laporan*')">
                                <x-slot name="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                                    </svg>
                                </x-slot>
                                Laporan
                            </x-sidebar-link>
                        </ul>
                    </li>
                    @else
                    {{-- Menu untuk Pelanggan --}}
                    <li class="pt-4">
                        <span class="px-3 text-xs font-semibold tracking-wider text-slate-500 uppercase">Akun
                            Saya</span>
                        <ul class="mt-2 space-y-1">
                            <x-sidebar-link href="{{ route('dashboard.tagihan.saya') }}"
                                :active="request()->routeIs('dashboard.tagihan.saya*')">
                                <x-slot name="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                                    </svg>
                                </x-slot>
                                Tagihan Saya
                            </x-sidebar-link>
                            <x-sidebar-link href="{{ route('dashboard.pembayaran.riwayat') }}"
                                :active="request()->routeIs('dashboard.pembayaran.riwayat*')">
                                <x-slot name="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                    </svg>
                                </x-slot>
                                Riwayat Pembayaran
                            </x-sidebar-link>
                        </ul>
                    </li>
                    @endif
                </ul>
            </nav>

            {{-- Bagian User Profile (Bawah) --}}
            <div class="mt-auto">
                <div class="p-3 bg-slate-800/50 rounded-lg">
                    <div class="flex items-center">
                        <div
                            class="flex items-center justify-center h-10 w-10 rounded-full bg-slate-700 text-slate-300 font-bold text-sm">
                            <span>{{ auth()->user()->initials }}</span>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-semibold text-white">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-slate-400">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="mt-3">
                        @csrf
                        <button type="submit"
                            class="w-full flex items-center justify-center px-3 py-2 text-sm font-medium text-slate-400 rounded-lg hover:bg-red-600/20 hover:text-red-400 transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </aside>

    {{-- ====================================================== --}}
    {{-- KONTEN UTAMA HALAMAN --}}
    {{-- ====================================================== --}}
    <main class="md:ml-64 pt-16 h-screen">
        <div class="px-4 md:px-6 py-6 bg-slate-950 h-full overflow-y-auto">
            @yield('dashboard-content')
        </div>
    </main>

</x-app-layout>