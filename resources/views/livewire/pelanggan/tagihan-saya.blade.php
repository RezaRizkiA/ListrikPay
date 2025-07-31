
<div>
    <h2 class="text-4xl font-extrabold text-white mb-6">Tagihan Saya</h2>

    <div class="overflow-x-auto rounded-2xl ring-1 ring-gray-700">
        <table class="min-w-full text-sm text-left text-gray-300">
            <thead class="bg-gray-800">
                <tr>
                    <th class="px-6 py-3 uppercase font-semibold">Bulan / Tahun</th>
                    <th class="px-6 py-3 uppercase font-semibold">Total Penggunaan</th>
                    <th class="px-6 py-3 uppercase font-semibold">Status</th>
                    <th class="px-6 py-3 text-center uppercase font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @forelse($tagihans as $tagihan)
                <tr class="bg-gray-900 hover:bg-gray-800">
                    <td class="px-6 py-4 font-semibold">{{ $tagihan->bulan }} {{ $tagihan->tahun }}</td>
                    <td class="px-6 py-4">{{ number_format($tagihan->jumlah_meter) }} kWh</td>
                    <td class="px-6 py-4">
                        @if($tagihan->status == 'Lunas')
                        <span
                            class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-200 rounded-full">Lunas</span>
                        @else
                        <span class="px-2 py-1 text-xs font-semibold text-yellow-800 bg-yellow-200 rounded-full">Belum
                            Lunas</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($tagihan->status != 'Lunas')
                        <button
                            class="px-3 py-1 bg-green-600 hover:bg-green-700 text-white text-xs font-semibold rounded-lg">Bayar</button>
                        @else
                        <button
                            class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-lg">Lihat
                            Detail</button>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-12 text-center text-gray-500 italic">Anda belum memiliki tagihan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $tagihans->links() }}
    </div>
</div>

