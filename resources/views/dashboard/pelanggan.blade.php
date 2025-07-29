@extends('dashboard.layout')

@section('dashboard-content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-4xl font-extrabold text-white">Data Pelanggan</h2>
            <button x-data @click="$dispatch('showCreatePelanggan')"
                class="px-5 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg font-semibold shadow-md transition">
                + Tambah Pelanggan
            </button>
        </div>

        <div class="overflow-x-auto rounded-2xl ring-1 ring-gray-700">
            <table class="min-w-full text-sm text-left text-gray-300">
                <thead class="bg-gray-800">
                    <tr>
                        <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">No</th>
                        <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Nomor KWH</th>
                        <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Nama Pelanggan</th>
                        <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Alamat</th>
                        <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">User</th>
                        <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Tarif / Daya</th>
                        <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Tagihan Terakhir</th>
                        <th class="sticky top-0 px-6 py-3 text-center uppercase font-semibold text-gray-400">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @forelse($pelanggans as $i => $pelanggan)
                        @php
                            $last = $pelanggan->tagihans
                                ->sortByDesc(fn($t) => $t->tahun . str_pad($t->bulan, 2, '0', STR_PAD_LEFT))
                                ->first();
                        @endphp
                        <tr class="bg-gray-900 hover:bg-gray-800 transition-colors">
                            <td class="px-6 py-4">{{ $i + 1 }}</td>

                            <td class="px-6 py-4 font-mono text-cyan-300 hover:text-cyan-200 transition">
                                {{ $pelanggan->nomor_kwh }}
                            </td>

                            <td class="px-6 py-4 font-semibold text-white">{{ $pelanggan->nama_pelanggan }}</td>

                            <td class="px-6 py-4">{{ $pelanggan->alamat }}</td>

                            <td class="px-6 py-4">
                                <div class="text-cyan-400 font-semibold">{{ $pelanggan->user?->username ?? '-' }}</div>
                                <div class="text-xs text-gray-500">{{ $pelanggan->user?->email }}</div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="text-white font-semibold">{{ $pelanggan->tarif?->daya ?? '-' }} VA</div>
                                <div class="text-xs text-yellow-400">
                                    Rp{{ number_format($pelanggan->tarif?->tarifperkwh ?? 0) }}/kWh
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                @if ($last)
                                    <div class="text-green-300 font-semibold">
                                        {{ bulanIndo($last->bulan) }}/{{ $last->tahun }}</div>
                                    <div class="text-xs text-gray-500">
                                        Meter: {{ $last->jumlah_meter }},
                                        Status:
                                        <span
                                            class="{{ $last->status === 'Lunas' ? 'text-emerald-400' : 'text-rose-400' }}">
                                            {{ ucfirst($last->status) }}
                                        </span>
                                    </div>
                                @else
                                    <div class="italic text-gray-500">Belum ada</div>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-center">
                                <button x-data @click="$dispatch('showDetailPelanggan',{id:{{ $pelanggan->id }}})"
                                    class="inline-block px-4 py-2 text-xs font-bold rounded-lg bg-gradient-to-br from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white shadow-md transition-transform transform hover:scale-105">
                                    Detail
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-12 text-center text-gray-500 italic">
                                Tidak ada data pelanggan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @livewire('pelanggan-detail')
    </div>
@endsection
