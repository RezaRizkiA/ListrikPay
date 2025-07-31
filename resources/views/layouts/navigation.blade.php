<nav class="bg-slate-900 border-b border-slate-800 px-4 py-2.5 fixed left-0 right-0 top-0 z-50">
    <div class="flex flex-wrap justify-between items-center">
        <div class="flex justify-start items-center">
            {{-- Tombol Hamburger untuk Mobile --}}
            <button data-drawer-target="drawer-navigation" data-drawer-toggle="drawer-navigation"
                aria-controls="drawer-navigation"
                class="p-2 mr-2 text-slate-400 rounded-lg cursor-pointer md:hidden hover:text-white hover:bg-slate-800 focus:bg-slate-800 focus:ring-2 focus:ring-slate-700">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Toggle sidebar</span>
            </button>

            {{-- Logo di Top Bar --}}
            <a href="{{ route('welcome') }}" class="flex items-center justify-between mr-4">
                <svg class="w-8 h-8 mr-3 text-sky-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                </svg>
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">KAMINARI</span>
            </a>
        </div>
        <div class="flex items-center lg:order-2 space-x-2">
            {{-- Dropdown Profil Pengguna dengan AlpineJS --}}
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" type="button"
                    class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-slate-600">
                    <span class="sr-only">Open user menu</span>
                    <div
                        class="flex items-center justify-center h-8 w-8 rounded-full bg-slate-700 text-slate-300 font-bold text-xs">
                        <span>{{ auth()->user()->initials }}</span>
                    </div>
                </button>
                <div x-show="open" @click.outside="open = false" x-transition
                    class="absolute right-0 z-50 my-4 w-56 text-base list-none bg-slate-800 rounded-lg shadow-lg border border-slate-700 divide-y divide-slate-700">
                    <div class="py-3 px-4">
                        <span class="block text-sm font-semibold text-white">{{ auth()->user()->name }}</span>
                        <span class="block text-sm text-slate-400 truncate">{{ auth()->user()->email }}</span>
                    </div>
                    <ul class="py-1 text-slate-300">
                        <li><a href="{{ route('profile.edit') }}"
                                class="block py-2 px-4 text-sm hover:bg-slate-700">Pengaturan Akun</a></li>
                    </ul>
                    <ul class="py-1 text-slate-300">
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left block py-2 px-4 text-sm hover:bg-slate-700">Sign
                                    out</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>