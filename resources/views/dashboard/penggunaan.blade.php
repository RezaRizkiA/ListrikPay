@extends('dashboard.layout')

@section('dashboard-content')
<div class="container mx-auto px-4 py-8 font-sans antialiased box-border">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-4xl font-extrabold text-white">Data Penggunaan Listrik</h2>
        <button x-data @click="$dispatch('showCreatePenggunaan')"
            class="px-5 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg font-semibold shadow-md transition">
            + Tambah Penggunaan
        </button>
    </div>

    <div class="overflow-x-auto rounded-2xl ring-1 ring-gray-700 box-border">
        <table class="min-w-full text-sm text-left text-gray-300 box-border">
            <thead class="bg-gray-800">
                <tr>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">No</th>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">ID</th>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Pelanggan</th>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Bulan/Tahun</th>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Meter Awal</th>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Meter Akhir</th>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Konsumsi (kWh)</th>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Dibuat</th>
                    <th class="sticky top-0 px-6 py-3 text-center uppercase font-semibold text-gray-400">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @forelse($penggunaans as $i => $usage)
                @php
                $consumption = $usage->meter_akhir - $usage->meter_awal;
                @endphp
                <tr class="bg-gray-900 hover:bg-gray-800 transition-colors">
                    <td class="px-6 py-4">{{ $i + 1 }}</td>
                    <td class="px-6 py-4 font-mono text-cyan-300">{{ $usage->id }}</td>
                    <td class="px-6 py-4 font-semibold text-white">
                        {{ $usage->pelanggan->nama_pelanggan ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ Str::title($usage->bulan) }} {{ $usage->tahun }}
                    </td>
                    <td class="px-6 py-4">{{ number_format($usage->meter_awal) }}</td>
                    <td class="px-6 py-4">{{ number_format($usage->meter_akhir) }}</td>
                    <td class="px-6 py-4 font-semibold">
                        {{ number_format($consumption) }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $usage->created_at->translatedFormat('d F Y, H:i') }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <button x-data @click="$dispatch('showEditPenggunaan',{id:{{ $usage->id }}})"
                            class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-lg transition mr-2">
                            Edit
                        </button>
                        <button x-data @click="$dispatch('showDeletePenggunaan',{id:{{ $usage->id }}})"
                            class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-xs font-semibold rounded-lg transition">
                            Hapus
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="py-12 text-center text-gray-500 italic">
                        Belum ada data penggunaan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Livewire modals --}}
    {{-- @livewire('penggunaan-detail') --}}
</div>
@endsection
