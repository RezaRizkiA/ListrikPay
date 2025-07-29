@extends('dashboard.layout')

@section('dashboard-content')
<div class="container mx-auto px-4 py-8 font-sans antialiased box-border">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-4xl font-extrabold text-white">Data Tagihan</h2>
    </div>

    <div class="overflow-x-auto rounded-2xl ring-1 ring-gray-700 box-border">
        <table class="min-w-full text-sm text-left text-gray-300 box-border">
            <thead class="bg-gray-800">
                <tr>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">No</th>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">ID Tagihan</th>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Pelanggan</th>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Bulan / Tahun</th>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Jumlah Meter</th>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Status</th>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Tanggal Dibuat</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @forelse($tagihans as $i => $tagihan)
                <tr class="bg-gray-900 hover:bg-gray-800 transition-colors">
                    <td class="px-6 py-4">{{ $i + 1 }}</td>
                    <td class="px-6 py-4 font-mono text-cyan-300">{{ $tagihan->id }}</td>
                    <td class="px-6 py-4 font-medium text-white">
                        {{ $tagihan->pelanggan->nama_pelanggan ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ bulanIndo($tagihan->bulan) }}/{{ $tagihan->tahun }}
                    </td>
                    <td class="px-6 py-4">
                        {{ number_format($tagihan->jumlah_meter) }} kWh
                    </td>
                    <td class="px-6 py-4">
                        <span
                            class="px-2 py-1 rounded-full text-xs font-semibold {{ $tagihan->status === 'Lunas' ? 'bg-emerald-500 text-white' : 'bg-rose-500 text-white' }}">
                            {{ $tagihan->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        {{ $tagihan->created_at->translatedFormat('d F Y') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="py-12 text-center text-gray-500 italic">
                        Belum ada data tagihan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection