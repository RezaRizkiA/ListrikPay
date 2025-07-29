<div>
    {{-- Modal Create --}}
    @if ($showCreateModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
        <div class="relative w-full max-w-md bg-gray-800 text-gray-100 rounded-2xl shadow-2xl overflow-hidden">
            {{-- Header --}}
            <div class="px-6 py-4 bg-green-600">
                <h3 class="text-lg font-semibold">Tambah Pelanggan</h3>
                <button wire:click="closeModal"
                    class="absolute top-3 right-3 text-2xl text-white hover:text-red-500 focus:outline-none transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Body --}}
            <div class="px-6 py-6 space-y-4">
                <div class="grid grid-cols-1 gap-4">
                    {{-- Nama --}}
                    <div class="relative">
                        <input type="text" wire:model.defer="new_nama" id="nama"
                            class="peer block w-full px-3 pt-5 pb-2 bg-gray-900 rounded-lg border border-gray-700 focus:border-green-500 focus:outline-none"
                            placeholder=" " />
                        <label for="nama"
                            class="absolute left-3 top-2 text-xs text-gray-400 peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm peer-placeholder-shown:text-gray-500 transition-all">
                            Nama
                        </label>
                        @error('new_nama')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Nomor KWH --}}
                    <div class="relative">
                        <input type="text" wire:model.defer="new_nomor_kwh" id="nomor_kwh"
                            class="peer block w-full px-3 pt-5 pb-2 bg-gray-900 rounded-lg border border-gray-700 focus:border-green-500 focus:outline-none"
                            placeholder=" " />
                        <label for="nomor_kwh"
                            class="absolute left-3 top-2 text-xs text-gray-400 peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm peer-placeholder-shown:text-gray-500 transition-all">
                            Nomor KWH
                        </label>
                        @error('new_nomor_kwh')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Alamat --}}
                    <div class="relative">
                        <input type="text" wire:model.defer="new_alamat" id="alamat"
                            class="peer block w-full px-3 pt-5 pb-2 bg-gray-900 rounded-lg border border-gray-700 focus:border-green-500 focus:outline-none"
                            placeholder=" " />
                        <label for="alamat"
                            class="absolute left-3 top-2 text-xs text-gray-400 peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm peer-placeholder-shown:text-gray-500 transition-all">
                            Alamat
                        </label>
                        @error('new_alamat')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- User & Tarif side by side on larger screens --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        {{-- User --}}
                        <div class="relative">
                            <select wire:model.defer="new_id_user" id="user"
                                class="peer block w-full px-3 pt-4 pb-2 bg-gray-900 rounded-lg border border-gray-700 focus:border-green-500 focus:outline-none appearance-none">
                                <option value="" disabled selected hidden></option>
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->username }}</option>
                                @endforeach
                            </select>
                            <label for="user"
                                class="absolute left-3 top-2 text-xs text-gray-400 peer-placeholder-shown:top-4 peer-placeholder-shown:text-sm peer-placeholder-shown:text-gray-500 transition-all">
                                User
                            </label>
                            @error('new_id_user')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        {{-- Tarif --}}
                        <div class="relative">
                            <select wire:model.defer="new_id_tarif" id="tarif"
                                class="peer block w-full px-3 pt-4 pb-2 bg-gray-900 rounded-lg border border-gray-700 focus:border-green-500 focus:outline-none appearance-none">
                                {{-- <span>{{ $new_id_tarif }}</span> --}}
                                <option value="" disabled selected hidden></option>
                                @foreach ($tarifs as $tarif)
                                <option value="{{ $tarif->id }}">
                                    {{ $tarif->daya }} VA (Rp{{ number_format($tarif->tarifperkwh) }}/kWh)
                                </option>
                                @endforeach
                            </select>
                            <label for="tarif"
                                class="absolute left-3 top-2 text-xs text-gray-400 peer-placeholder-shown:top-4 peer-placeholder-shown:text-sm peer-placeholder-shown:text-gray-500 transition-all">
                                Tarif
                            </label>
                            @error('new_id_tarif')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <div class="px-6 py-4 bg-gray-700 flex justify-end gap-3">
                <button wire:click="closeModal" class="px-4 py-2 bg-gray-600 hover:bg-gray-500 rounded-lg transition">
                    Batal
                </button>
                <button wire:click="saveCreate"
                    class="px-4 py-2 bg-green-500 hover:bg-green-600 rounded-lg font-semibold transition">
                    Simpan
                </button>
            </div>
        </div>
    </div>
    @endif

    @if ($showDetailModal && $pelanggan)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm transition-all">
        <div
            class="bg-white dark:bg-gray-900 p-8 rounded-2xl shadow-2xl w-full max-w-xl relative border border-gray-200 dark:border-gray-700">
            <!-- Close Button -->
            <button wire:click="closeModal"
                class="absolute top-3 right-3 text-2xl text-gray-400 hover:text-red-500 focus:outline-none transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Title -->
            <div class="flex items-center gap-3 mb-6">
                <div class="bg-blue-100 dark:bg-blue-800 p-2 rounded-full">
                    <svg class="h-6 w-6 text-blue-500 dark:text-blue-300" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2
                                a1 1 0 001 1h14a1 1 0 001-1v-2c0-2.66-5.33-4-8-4z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Detail Pelanggan</h2>
            </div>

            <!-- Info Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-3 mb-5">
                <div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">Nomor KWH</div>
                    <div class="font-semibold text-gray-800 dark:text-gray-200 tracking-wide">
                        {{ $pelanggan->nomor_kwh }}
                    </div>
                </div>
                <div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">Nama</div>
                    <div class="font-semibold text-gray-800 dark:text-gray-200">{{ $pelanggan->nama_pelanggan }}
                    </div>
                </div>
                <div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">Alamat</div>
                    <div class="text-gray-700 dark:text-gray-300">{{ $pelanggan->alamat }}</div>
                </div>
                <div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">User</div>
                    <div class="font-semibold text-cyan-600 dark:text-cyan-300">
                        {{ $pelanggan->user->username ?? '-' }}
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <div class="text-xs text-gray-500 dark:text-gray-400">Tarif / Daya</div>
                    <div class="flex items-center gap-2">
                        <span class="text-gray-800 dark:text-gray-200 font-semibold">
                            {{ $pelanggan->tarif->daya ?? '-' }} VA
                        </span>
                        <span
                            class="bg-yellow-100 dark:bg-yellow-800 text-yellow-700 dark:text-yellow-200 text-xs px-2 py-1 rounded-full">
                            Rp{{ number_format($pelanggan->tarif->tarifperkwh ?? 0) }}/kWh
                        </span>
                    </div>
                </div>
            </div>

            <hr class="my-4 border-gray-200 dark:border-gray-700">

            <!-- Tagihan Section -->
            <div class="mt-6">
                <h3 class="flex items-center gap-2 text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3">
                    <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 17l4 4 4-4m-4-5v9" />
                    </svg>
                    Riwayat Tagihan
                </h3>

                @if ($pelanggan->tagihans->isNotEmpty())
                <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                        <thead class="bg-gray-50 dark:bg-gray-800">
                            <tr>
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Periode</th>
                                <th
                                    class="px-4 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Meter (kWh)</th>
                                <th
                                    class="px-4 py-2 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($pelanggan->tagihans->sortByDesc(fn($t) => $t->tahun . str_pad($t->bulan, 2, '0',
                            STR_PAD_LEFT)) as $tagihan)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                    {{ bulanIndo($tagihan->bulan) }}/{{ $tagihan->tahun }}
                                </td>
                                <td
                                    class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                    {{ $tagihan->jumlah_meter }}
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-center">
                                    @if ($tagihan->status === 'Lunas')
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700 dark:bg-emerald-800 dark:text-emerald-200">
                                        Lunas
                                    </span>
                                    @else
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-rose-100 text-rose-700 dark:bg-rose-800 dark:text-rose-200">
                                        Belum Lunas
                                    </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-center text-sm text-gray-400 italic py-4">Belum ada tagihan.</p>
                @endif
            </div>

            <div class="flex justify-end gap-3 mt-8">
                <button wire:click="openEditModal"
                    class="inline-flex items-center px-4 py-2 rounded-lg bg-yellow-500 hover:bg-yellow-600 text-white font-semibold transition">
                    <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.232 5.232l3.536 3.536m-2.036-1.5a2.121 2.121 0 113 3l-8.485 8.485a4 4 0 01-1.414.879l-4.242 1.415 1.415-4.243a4 4 0 01.879-1.414l8.485-8.485z" />
                    </svg>
                    Edit
                </button>
                <button wire:click="openDeleteModal"
                    class="inline-flex items-center px-4 py-2 rounded-lg bg-red-500 hover:bg-red-700 text-white font-semibold transition">
                    <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4a2 2 0 012 2v2H7V5a2 2 0 012-2zm7 4H4" />
                    </svg>
                    Hapus
                </button>
            </div>

        </div>
    </div>
    @endif

    {{-- Modal Edit --}}
    @if ($showEditModal && $pelanggan)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
        <div class="relative w-full max-w-md bg-gray-900 text-gray-100 rounded-2xl shadow-xl overflow-hidden">

            {{-- HEADER --}}
            <div class="px-6 py-3 bg-yellow-600 flex items-center justify-between">
                <h3 class="text-lg font-semibold uppercase tracking-wide">Edit Pelanggan</h3>
                <button wire:click="closeModal" class="text-gray-100 hover:text-gray-200 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- BODY --}}
            <div class="px-6 py-6 space-y-5">
                {{-- Nama --}}
                <div class="relative">
                    <input type="text" id="edit_nama" wire:model.defer="edit_nama" placeholder=" " class="peer block w-full h-10 px-4 text-sm text-gray-100 bg-gray-800 rounded-lg border border-gray-700
                   focus:border-yellow-400 focus:outline-none placeholder-transparent" />
                    <label for="edit_nama" class="absolute left-4 top-0 -translate-y-1/2 bg-gray-900 px-1 text-xs text-gray-400
                   peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:text-xs
                   transition-all">
                        Nama
                    </label>
                    @error('edit_nama')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nomor KWH --}}
                <div class="relative">
                    <input type="text" id="edit_nomor_kwh" wire:model.defer="edit_nomor_kwh" placeholder=" " class="peer block w-full h-10 px-4 text-sm text-gray-100 bg-gray-800 rounded-lg border border-gray-700
                   focus:border-yellow-400 focus:outline-none placeholder-transparent" />
                    <label for="edit_nomor_kwh" class="absolute left-4 top-0 -translate-y-1/2 bg-gray-900 px-1 text-xs text-gray-400
                   peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:text-xs
                   transition-all">
                        Nomor KWH
                    </label>
                    @error('edit_nomor_kwh')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Alamat --}}
                <div class="relative">
                    <input type="text" id="edit_alamat" wire:model.defer="edit_alamat" placeholder=" " class="peer block w-full h-10 px-4 text-sm text-gray-100 bg-gray-800 rounded-lg border border-gray-700
                   focus:border-yellow-400 focus:outline-none placeholder-transparent" />
                    <label for="edit_alamat"
                        class="absolute left-4 top-0 -translate-y-1/2 bg-gray-900 px-1 text-xs text-gray-400 peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:text-xs transition-all">
                        Alamat
                    </label>
                    @error('edit_alamat')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- User & Tarif --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    {{-- User --}}
                    <div class="relative">
                        <select id="edit_user" wire:model.defer="edit_id_user"
                            class="peer block w-full h-10 px-4 text-sm text-gray-100 bg-gray-800 rounded-lg border border-gray-700 focus:border-yellow-400 focus:outline-none appearance-none">
                            <option value="" disabled selected hidden></option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->username }}</option>
                            @endforeach
                        </select>
                        <label for="edit_user"
                            class="absolute left-4 top-0 -translate-y-1/2 bg-gray-900 px-1 text-xs text-gray-400 peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:text-xs transition-all">
                            User
                        </label>
                        @error('edit_id_user')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tarif --}}
                    <div class="relative">
                        <select id="edit_tarif" wire:model.defer="edit_id_tarif"
                            class="peer block w-full h-10 px-4 text-sm text-gray-100 bg-gray-800 rounded-lg border border-gray-700 focus:border-yellow-400 focus:outline-none appearance-none">
                            <option value="" disabled selected hidden></option>
                            @foreach ($tarifs as $tarif)
                            <option value="{{ $tarif->id }}">
                                {{ $tarif->daya }} VA (Rp{{ number_format($tarif->tarifperkwh) }}/kWh)
                            </option>
                            @endforeach
                        </select>
                        <label for="edit_tarif"
                            class="absolute left-4 top-0 -translate-y-1/2 bg-gray-900 px-1 text-xs text-gray-400 peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-0 peer-focus:text-xs transition-all">
                            Tarif
                        </label>
                        @error('edit_id_tarif')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- FOOTER --}}
            <div class="px-6 py-4 bg-gray-800 flex justify-end gap-3">
                <button wire:click="closeModal" class="px-4 py-2 bg-gray-600 hover:bg-gray-500 rounded-lg transition">
                    Batal
                </button>
                <button wire:click="saveEdit"
                    class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 rounded-lg font-semibold transition">
                    Simpan
                </button>
            </div>

        </div>
    </div>
    @endif

    {{-- Modal Delete --}}
    @if ($showDeleteModal && $pelanggan)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm">
        <div class="bg-gray-900 text-gray-100 rounded-2xl shadow-2xl max-w-lg w-full p-8 md:p-10">

            {{-- HEADER --}}
            <div class="flex items-center gap-3 mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-500" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v2m0 4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
                </svg>
                <h3 class="text-2xl md:text-3xl font-semibold text-red-500">Hapus Pelanggan?</h3>
            </div>

            {{-- BODY --}}
            <p class="mb-8 text-base md:text-lg leading-relaxed">
                Yakin ingin menghapus pelanggan
                <span class="font-bold text-white">{{ $pelanggan->nama_pelanggan }}</span>?<br>
                Data yang dihapus tidak dapat dikembalikan.
            </p>

            {{-- FOOTER --}}
            <div class="flex justify-end gap-4">
                <button wire:click="closeModal"
                    class="px-6 py-3 bg-gray-700 hover:bg-gray-600 text-gray-200 rounded-lg transition">
                    Batal
                </button>
                <button wire:click="deletePelanggan"
                    class="px-6 py-3 bg-red-500 hover:bg-red-600 text-white rounded-lg font-semibold transition">
                    Hapus
                </button>
            </div>
        </div>
    </div>
    @endif

</div>
