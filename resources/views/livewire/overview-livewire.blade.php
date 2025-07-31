<div>
    {{-- Header Sambutan --}}
    <h1 class="text-3xl font-bold text-white mb-2">Selamat Datang, {{ auth()->user()->name }}!</h1>
    <p class="text-lg text-gray-400 mb-8">Berikut adalah ringkasan aktivitas sistem Anda.</p>

    {{-- Grid untuk Kartu Statistik --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="bg-gray-800 p-6 rounded-2xl shadow-lg flex items-center space-x-4">
            <div class="bg-blue-500/20 p-3 rounded-full">
                <svg class="w-8 h-8 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <div>
                <p class="text-gray-400 text-sm font-medium">Total Pelanggan</p>
                <p class="text-3xl font-bold text-white">{{ $totalPelanggan }}</p>
            </div>
        </div>

        <div class="bg-gray-800 p-6 rounded-2xl shadow-lg flex items-center space-x-4">
            <div class="bg-green-500/20 p-3 rounded-full">
                <svg class="w-8 h-8 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01M12 6v-1m0-1V4m0 2.01V12m0 6v-1m0-1V18m0 2.01V20M12 21v-1m0-1V12m0-6.01V6M6 12a6 6 0 1112 0 6 6 0 01-12 0z" />
                </svg>
            </div>
            <div>
                <p class="text-gray-400 text-sm font-medium">Total Pendapatan</p>
                <p class="text-3xl font-bold text-white">Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="bg-gray-800 p-6 rounded-2xl shadow-lg flex items-center space-x-4">
            <div class="bg-yellow-500/20 p-3 rounded-full">
                <svg class="w-8 h-8 text-yellow-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-gray-400 text-sm font-medium">Tagihan Belum Lunas</p>
                <p class="text-3xl font-bold text-white">{{ $tagihanBelumLunas }}</p>
            </div>
        </div>

        <div class="bg-gray-800 p-6 rounded-2xl shadow-lg flex items-center space-x-4">
            <div class="bg-indigo-500/20 p-3 rounded-full">
                <svg class="w-8 h-8 text-indigo-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div>
                <p class="text-gray-400 text-sm font-medium">Total Data Penggunaan</p>
                <p class="text-3xl font-bold text-white">{{ $totalPenggunaan }}</p>
            </div>
        </div>

    </div>
</div>
