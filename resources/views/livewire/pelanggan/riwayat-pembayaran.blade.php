<div>
    <h2 class="text-4xl font-extrabold text-white mb-6">Riwayat Pembayaran</h2>

    <div class="overflow-x-auto rounded-2xl ring-1 ring-gray-700">
        <table class="min-w-full text-sm text-left text-gray-300">
            <thead class="bg-gray-800">
                <tr>
                    <th class="px-6 py-3 uppercase font-semibold">Tgl. Bayar</th>
                    <th class="px-6 py-3 uppercase font-semibold">Periode Tagihan</th>
                    <th class="px-6 py-3 uppercase font-semibold">Total Bayar</th>
                    <th class="px-6 py-3 text-center uppercase font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @forelse($pembayarans as $pembayaran)
                <tr class="bg-gray-900 hover:bg-gray-800">
                    <td class="px-6 py-4 font-semibold">{{
                        \Carbon\Carbon::parse($pembayaran->tanggal_pembayaran)->translatedFormat('d F Y') }}</td>
                    <td class="px-6 py-4">{{ $pembayaran->tagihan->bulan ?? 'N/A' }} {{ $pembayaran->tagihan->tahun ??
                        '' }}</td>
                    <td class="px-6 py-4 font-semibold text-white">Rp{{ number_format($pembayaran->total_bayar) }}</td>
                    <td class="px-6 py-4 text-center">
                        <button
                            class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-lg">Lihat
                            Struk</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-12 text-center text-gray-500 italic">Anda belum memiliki riwayat
                        pembayaran.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $pembayarans->links() }}
    </div>
</div>
