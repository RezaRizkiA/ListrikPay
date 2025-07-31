<div>
    <h1 class="text-3xl font-bold text-white mb-6">Dashboard Anda</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- Kolom Kiri: Tagihan Saat Ini --}}
        <div class="lg:col-span-2">
            <div class="bg-slate-800 p-6 rounded-2xl shadow-lg">
                <h2 class="text-xl font-semibold text-white mb-4">Tagihan Saat Ini</h2>
                @if($tagihanTerbaru)
                <div class="space-y-4 text-slate-300">
                    <p>Anda memiliki tagihan yang perlu dibayar untuk periode <span class="font-bold text-yellow-400">{{
                            $tagihanTerbaru->bulan }} {{ $tagihanTerbaru->tahun }}</span>.</p>
                    <div class="border-t border-slate-700 pt-4 mt-4">
                        <p class="text-lg">Total Penggunaan: <span class="font-bold text-white">{{
                                number_format($tagihanTerbaru->jumlah_meter) }} kWh</span></p>
                        {{-- Anda bisa tambahkan detail biaya di sini --}}
                    </div>
                    <button
                        class="w-full mt-4 px-5 py-3 bg-green-500 hover:bg-green-600 text-white rounded-lg font-semibold shadow-md transition">
                        Bayar Tagihan Sekarang
                    </button>
                </div>
                @else
                <div class="text-center py-8">
                    <svg class="w-16 h-16 mx-auto text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2l4-4M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z" />
                    </svg>
                    <p class="mt-4 text-lg text-slate-300">Tidak ada tagihan yang perlu dibayar. Terima kasih!</p>
                </div>
                @endif
            </div>
        </div>

        {{-- Kolom Kanan: Ringkasan --}}
        <div class="space-y-6">
            <div class="bg-slate-800 p-6 rounded-2xl shadow-lg">
                <h3 class="text-lg font-semibold text-white mb-2">Total Tunggakan</h3>
                <p class="text-3xl font-bold text-red-500">{{ number_format($totalTunggakan) }} kWh</p>
            </div>
            <div class="bg-slate-800 p-6 rounded-2xl shadow-lg">
                <h3 class="text-lg font-semibold text-white mb-4">5 Riwayat Pembayaran Terakhir</h3>
                <ul class="space-y-3">
                    @forelse($riwayatPembayaran as $bayar)
                    <li class="flex justify-between items-center text-sm">
                        <span class="text-slate-400">
                            {{ $bayar->tagihan->bulan ?? 'N/A' }} {{ $bayar->tagihan->tahun ?? '' }}
                        </span>
                        <span class="font-semibold text-white">Rp{{ number_format($bayar->total_bayar) }}</span>
                    </li>
                    @empty
                    <li class="text-slate-500 text-center text-sm">Belum ada riwayat.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
