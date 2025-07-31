@extends('dashboard.layout')

@section('dashboard-content')
<div class="container mx-auto px-4 py-8 font-sans antialiased box-border">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-4xl font-extrabold text-white">User Management</h2>
        <a href=""
            class="px-5 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg font-semibold shadow-md transition">
            + Tambah User
        </a>
    </div>

    <div class="overflow-x-auto rounded-2xl ring-1 ring-gray-700 box-border">
        <table class="min-w-full text-sm text-left text-gray-300 box-border">
            <thead class="bg-gray-800">
                <tr>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">No</th>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Username</th>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Email</th>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Level</th>
                    <th class="sticky top-0 px-6 py-3 uppercase font-semibold text-gray-400">Verifikasi</th>
                    <th class="sticky top-0 px-6 py-3 text-center uppercase font-semibold text-gray-400">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @forelse($allUsers as $i => $user)
                <tr class="bg-gray-900 hover:bg-gray-800 transition-colors">
                    <td class="px-6 py-4">{{ $i + 1 }}</td>
                    <td class="px-6 py-4 font-medium text-white">{{ $user->username }}</td>
                    <td class="px-6 py-4">{{ $user->email }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold bg-blue-600 text-white">
                            {{ $user->level->nama_level ?? '-' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        @if($user->email_verified_at)
                        <span class="text-emerald-400 font-semibold">Terverifikasi</span>
                        @else
                        <span class="text-rose-400 font-semibold">Belum</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center space-x-2">
                        <a href=""
                            class="px-3 py-1 bg-yellow-600 hover:bg-yellow-700 text-white text-xs font-semibold rounded-lg transition">
                            Edit
                        </a>
                        <form action="" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="px-3 py-1 bg-rose-600 hover:bg-rose-700 text-white text-xs font-semibold rounded-lg transition"
                                onclick="return confirm('Hapus user ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-12 text-center text-gray-500 italic">
                        Belum ada data user.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
