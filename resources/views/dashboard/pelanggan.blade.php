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

    {{-- Di sini Anda bisa menambahkan form pencarian jika diperlukan di masa depan --}}

    <div class="overflow-x-auto rounded-2xl ring-1 ring-gray-700">
        <table class="min-w-full text-sm text-left text-gray-300">
            <thead class="bg-gray-800">
                <tr>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">No</th>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Nomor KWH</th>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Nama Pelanggan</th>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">User Terhubung</th>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Tarif / Daya</th>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Tagihan Terakhir</th>
                    <th class="sticky top-0 px-6 py-3 text-center uppercase font-semibold text-gray-400">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @forelse($pelanggans as $pelanggan)
                <tr class="bg-gray-900 hover:bg-gray-800 transition-colors">
                    {{-- DIUBAH: Penomoran agar sesuai dengan pagination --}}
                    <td class="px-6 py-4">{{ $loop->iteration + $pelanggans->firstItem() - 1 }}</td>

                    <td class="px-6 py-4 font-mono text-cyan-300">{{ $pelanggan->nomor_kwh }}</td>
                    <td class="px-6 py-4 font-semibold text-white">{{ $pelanggan->nama_pelanggan }}</td>

                    <td class="px-6 py-4">
                        <div class="flex flex-wrap gap-1">
                            @forelse($pelanggan->users as $user)
                            <span class="px-2 py-1 text-xs font-semibold bg-slate-700 text-slate-300 rounded-full">
                                {{ $user->name }}
                            </span>
                            @empty
                            <span class="text-xs text-slate-500 italic">-</span>
                            @endforelse
                        </div>
                    </td>

                    <td class="px-6 py-4">
                        <div class="text-white font-semibold">{{ $pelanggan->tarif?->daya ?? '-' }} VA</div>
                        <div class="text-xs text-yellow-400">
                            Rp{{ number_format($pelanggan->tarif?->tarifperkwh ?? 0) }}/kWh
                        </div>
                    </td>

                    <td class="px-6 py-4">
                        @if ($pelanggan->tagihan_terakhir)
                        <div class="text-green-300 font-semibold">
                            {{ $pelanggan->tagihan_terakhir->bulan }}/{{ $pelanggan->tagihan_terakhir->tahun }}
                        </div>
                        <div class="text-xs text-gray-500">
                            Status:
                            <span
                                class="{{ $pelanggan->tagihan_terakhir->status === 'Lunas' ? 'text-emerald-400' : 'text-rose-400' }}">
                                {{ $pelanggan->tagihan_terakhir->status }}
                            </span>
                        </div>
                        @else
                        <div class="italic text-gray-500">Belum ada</div>
                        @endif
                    </td>

                    <td class="px-6 py-4 text-center">
                        <button x-data @click="$dispatch('showDetailPelanggan',{id:{{ $pelanggan->id }}})"
                            class="inline-block px-4 py-2 text-xs font-bold rounded-lg bg-blue-600 hover:bg-blue-700 text-white shadow-md transition">
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

    {{-- Link untuk pagination dari Controller --}}
    <div class="mt-6">
        {{ $pelanggans->links() }}
    </div>

    {{-- Komponen Livewire untuk mengelola semua modal --}}
    @livewire('pelanggan-detail', key('modal-pelanggan'))
</div>
@endsection
