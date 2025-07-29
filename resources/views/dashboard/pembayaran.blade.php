@extends('dashboard.layout')

@section('dashboard-content')
<div class="container mx-auto px-4 py-8 font-sans antialiased box-border">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-4xl font-extrabold text-white">Data Pembayaran</h2>
    </div>

    <div class="overflow-x-auto rounded-2xl ring-1 ring-gray-700 box-border">
        <table class="min-w-full text-sm text-left text-gray-300 box-border">
            <thead class="bg-gray-800">
                <tr>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">No</th>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">ID Bayar</th>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Pelanggan</th>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Bulan Bayar</th>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Tanggal Bayar</th>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Biaya Admin</th>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Total Bayar</th>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Operator</th>
                    <th class="sticky top-0 px-6 py-3 text-center uppercase font-semibold text-gray-400">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @forelse($pembayarans as $i => $pembayaran)
                <tr class="bg-gray-900 hover:bg-gray-800 transition-colors">
                    <td class="px-6 py-4">{{ $i + 1 }}</td>

                    <td class="px-6 py-4 font-mono text-cyan-300">{{ $pembayaran->id }}</td>

                    <td class="px-6 py-4 font-semibold text-white">
                        {{ $pembayaran->pelanggan->nama_pelanggan ?? '-' }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $pembayaran->bulan_bayar }} {{ $pembayaran->tagihan->tahun }}
                    </td>

                    <td class="px-6 py-4">
                        {{ \Carbon\Carbon::parse($pembayaran->tanggal_pembayaran)->translatedFormat('d F Y') }}
                    </td>

                    <td class="px-6 py-4">
                        Rp{{ number_format($pembayaran->biaya_admin, 0, ',', '.') }}
                    </td>

                    <td class="px-6 py-4">
                        Rp{{ number_format($pembayaran->total_bayar, 0, ',', '.') }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $pembayaran->user->name ?? $pembayaran->user->username ?? '-' }}
                    </td>

                    <td class="px-6 py-4 text-center">
                        {{-- Contoh tombol aksi: Detail --}}
                        <button
                            class="px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-lg transition"
                            wire:click="$emit('showPembayaranDetail', {{ $pembayaran->id }})">
                            Detail
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="py-12 text-center text-gray-500 italic">
                        Belum ada data pembayaran.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection