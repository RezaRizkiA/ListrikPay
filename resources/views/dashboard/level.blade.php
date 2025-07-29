@extends('dashboard.layout')

@section('dashboard-content')
<div class="container mx-auto px-4 py-8 font-sans antialiased box-border">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-4xl font-extrabold text-white">Level Management</h2>
        <a href=""
            class="px-5 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg font-semibold shadow-md transition">
            + Tambah Level
        </a>
    </div>

    <div class="overflow-x-auto rounded-2xl ring-1 ring-gray-700 box-border">
        <table class="min-w-full text-sm text-left text-gray-300 box-border">
            <thead class="bg-gray-800">
                <tr>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">No</th>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Kode Level</th>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Nama Level</th>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Dibuat Pada</th>
                    <th class="sticky top-0 px-6 py-3 text-center uppercase font-semibold text-gray-400">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @forelse($levels as $i => $level)
                <tr class="bg-gray-900 hover:bg-gray-800 transition-colors">
                    <td class="px-6 py-4">{{ $i + 1 }}</td>
                    <td class="px-6 py-4 font-mono text-cyan-300">{{ $level->id }}</td>
                    <td class="px-6 py-4 font-medium text-white">{{ $level->nama_level }}</td>
                    <td class="px-6 py-4">{{ $level->created_at->translatedFormat('d F Y') }}</td>
                    <td class="px-6 py-4 text-center space-x-2">
                        <a href=""
                            class="px-3 py-1 bg-yellow-600 hover:bg-yellow-700 text-white text-xs font-semibold rounded-lg transition">
                            Edit
                        </a>
                        <form action="" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="px-3 py-1 bg-rose-600 hover:bg-rose-700 text-white text-xs font-semibold rounded-lg transition"
                                onclick="return confirm('Hapus level ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-12 text-center text-gray-500 italic">
                        Belum ada data level.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
