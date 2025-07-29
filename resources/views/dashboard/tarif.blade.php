@extends('dashboard.layout')

@section('dashboard-content')
<div class="container mx-auto px-4 py-8 font-sans antialiased box-border">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-4xl font-extrabold text-white">Data Tarif Listrik</h2>
    </div>

    <div class="overflow-x-auto rounded-2xl ring-1 ring-gray-700 box-border">
        <table class="min-w-full text-sm text-left text-gray-300 box-border">
            <thead class="bg-gray-800">
                <tr>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">No</th>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Kode Tarif</th>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Daya (VA)</th>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Tarif/kWh</th>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Tanggal Dibuat</th>
                    <th class="sticky top-0 px-6 py-3 text-center uppercase font-semibold text-gray-400">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @forelse($tarifs as $i => $tarif)
                <tr class="bg-gray-900 hover:bg-gray-800 transition-colors">
                    <td class="px-6 py-4">{{ $i + 1 }}</td>
                    <td class="px-6 py-4 font-mono text-cyan-300">{{ $tarif->kode_tarif }}</td>
                    <td class="px-6 py-4">{{ number_format($tarif->daya) }}</td>
                    <td class="px-6 py-4">
                        Rp{{ number_format($tarif->tarifperkwh, 0, ',', '.') }}/kWh
                    </td>
                    <td class="px-6 py-4">
                        {{ $tarif->created_at->translatedFormat('d F Y') }}
                    </td>
                    <td class="px-6 py-4 text-center space-x-2">
                        <button
                            class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-lg transition">
                            Edit
                        </button>
                        <button
                            class="px-3 py-1 bg-rose-600 hover:bg-rose-700 text-white text-xs font-semibold rounded-lg transition">
                            Hapus
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-12 text-center text-gray-500 italic">
                        Belum ada data tarif.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection