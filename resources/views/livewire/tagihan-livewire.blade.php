<div>
    @if($showTagihanModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
        <div class="relative w-full max-w-md bg-gray-800 text-gray-100 rounded-2xl shadow-2xl overflow-hidden">
            {{-- Header --}}
            <div class="px-6 py-4 bg-green-600">
                <h3 class="text-lg font-semibold">Input Tagihan Listrik</h3>
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
                    {{-- ID Pelanggan --}}
                    <div class="relative">
                        <select wire:model.live="id_pelanggan" id="pelanggan"
                            class="peer block w-full px-3 pt-4 pb-2 bg-gray-900 rounded-lg border border-gray-700 focus:border-green-500 focus:outline-none appearance-none">
                            <option value="">Pilih Pelanggan</option>
                            @foreach ($pelanggans as $pelanggan)
                            <option value="{{ $pelanggan->id }}" wire:key="pelanggan-{{ $pelanggan->id }}">
                                {{ $pelanggan->nama_pelanggan }}
                            </option>
                            @endforeach
                        </select>
                        <label for="pelanggan"
                            class="absolute left-3 top-2 text-xs text-gray-400 peer-placeholder-shown:top-4 peer-placeholder-shown:text-sm peer-placeholder-shown:text-gray-500 transition-all">
                            Pelanggan
                        </label>
                        @error('id_pelanggan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ID Penggunaan - Tampil jika pelanggan sudah dipilih --}}
                    @if($id_pelanggan)
                    @if(count($filteredPenggunaans) > 0)
                    <div class="relative">
                        <select wire:model.live="id_penggunaan" id="penggunaan"
                            class="peer block w-full px-3 pt-4 pb-2 bg-gray-900 rounded-lg border border-gray-700 focus:border-green-500 focus:outline-none appearance-none">
                            <option value="">Pilih Penggunaan</option>
                            @foreach ($filteredPenggunaans as $penggunaan)
                            <option value="{{ $penggunaan['id'] }}" wire:key="penggunaan-{{ $penggunaan['id'] }}">
                                {{ $penggunaan['bulan'] }} {{ $penggunaan['tahun'] }}
                                ({{ number_format($penggunaan['meter_akhir'] - $penggunaan['meter_awal']) }} kWh)
                            </option>
                            @endforeach
                        </select>
                        <label for="penggunaan"
                            class="absolute left-3 top-2 text-xs text-gray-400 peer-placeholder-shown:top-4 peer-placeholder-shown:text-sm peer-placeholder-shown:text-gray-500 transition-all">
                            Penggunaan
                        </label>
                        @error('id_penggunaan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    @else
                    <div class="p-4 bg-yellow-900/20 border border-yellow-700 rounded-lg">
                        <p class="text-yellow-400 text-sm">
                            <svg class="inline w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Tidak ada data penggunaan untuk pelanggan ini.
                        </p>
                    </div>
                    @endif
                    @endif

                    {{-- Bulan - Hanya tampil jika penggunaan sudah dipilih --}}
                    @if($bulan)
                    <div class="relative">
                        <input type="text" wire:model="bulan" id="bulan"
                            class="peer block w-full px-3 pt-5 pb-2 bg-gray-900 rounded-lg border border-gray-700 focus:border-green-500 focus:outline-none"
                            placeholder=" " readonly />
                        <label for="bulan"
                            class="absolute left-3 top-2 text-xs text-gray-400 peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm peer-placeholder-shown:text-gray-500 transition-all">
                            Bulan
                        </label>
                        @error('bulan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    @endif

                    {{-- Tahun - Hanya tampil jika penggunaan sudah dipilih --}}
                    @if($tahun)
                    <div class="relative">
                        <input type="text" wire:model="tahun" id="tahun"
                            class="peer block w-full px-3 pt-5 pb-2 bg-gray-900 rounded-lg border border-gray-700 focus:border-green-500 focus:outline-none"
                            placeholder=" " readonly />
                        <label for="tahun"
                            class="absolute left-3 top-2 text-xs text-gray-400 peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm peer-placeholder-shown:text-gray-500 transition-all">
                            Tahun
                        </label>
                        @error('tahun')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    @endif

                    {{-- Jumlah Meter - Hanya tampil jika penggunaan sudah dipilih --}}
                    @if($jumlah_meter)
                    <div class="relative">
                        <input type="number" wire:model="jumlah_meter" id="jumlah_meter"
                            class="peer block w-full px-3 pt-5 pb-2 bg-gray-900 rounded-lg border border-gray-700 focus:border-green-500 focus:outline-none"
                            placeholder=" " />
                        <label for="jumlah_meter"
                            class="absolute left-3 top-2 text-xs text-gray-400 peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm peer-placeholder-shown:text-gray-500 transition-all">
                            Jumlah Meter (kWh)
                        </label>
                        @error('jumlah_meter')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    @endif

                    {{-- Status - Hanya tampil jika penggunaan sudah dipilih --}}
                    @if($id_penggunaan)
                    <div class="relative">
                        <select wire:model="status" id="status"
                            class="peer block w-full px-3 pt-4 pb-2 bg-gray-900 rounded-lg border border-gray-700 focus:border-green-500 focus:outline-none appearance-none">
                            <option value="Belum Lunas">Belum Lunas</option>
                            <option value="Lunas">Lunas</option>
                        </select>
                        <label for="status"
                            class="absolute left-3 top-2 text-xs text-gray-400 peer-placeholder-shown:top-4 peer-placeholder-shown:text-sm peer-placeholder-shown:text-gray-500 transition-all">
                            Status
                        </label>
                        @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    @endif
                </div>
            </div>

            {{-- Footer --}}
            <div class="px-6 py-4 bg-gray-700 flex justify-end gap-3">
                <button wire:click="closeModal" class="px-4 py-2 bg-gray-600 hover:bg-gray-500 rounded-lg transition">
                    Batal
                </button>
                <button wire:click="saveCreate" @if(!$id_penggunaan) disabled @endif
                    class="px-4 py-2 bg-green-500 hover:bg-green-600 disabled:bg-gray-500 disabled:cursor-not-allowed rounded-lg font-semibold transition">
                    Simpan
                </button>
            </div>
        </div>
    </div>
    @endif

    {{-- Debug panel for main page --}}
    @if(session()->has('message'))
    <div class="fixed bottom-4 right-4 p-4 bg-green-900/90 border border-green-700 rounded-lg text-green-400 text-sm">
        {{ session('message') }}
    </div>
    @endif
</div>
