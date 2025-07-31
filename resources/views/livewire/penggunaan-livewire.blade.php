<div>
    @if($showPenggunaanModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
        <div class="relative w-full max-w-md bg-gray-800 text-gray-100 rounded-2xl shadow-2xl overflow-hidden">
            {{-- Header --}}
            <div class="px-6 py-4 bg-green-600">
                <h3 class="text-lg font-semibold">Input Penggunaan Listrik</h3>
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
                        <select wire:model.live="new_id_pelanggan" id="pelanggan"
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
                        @error('new_id_pelanggan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Bulan --}}
                    <div class="relative">
                        <select wire:model.live="new_bulan" id="bulan"
                            class="peer block w-full px-3 pt-4 pb-2 bg-gray-900 rounded-lg border border-gray-700 focus:border-green-500 focus:outline-none appearance-none">
                            <option value="">Pilih Bulan</option>
                            {{-- Loop untuk setiap bulan dari Januari sampai Desember --}}
                            @foreach($this->daftarBulan as $bulan)
                            <option value="{{ $bulan }}">{{ $bulan }}</option>
                            @endforeach
                        </select>
                        <label for="bulan"
                            class="absolute left-3 top-2 text-xs text-gray-400 peer-placeholder-shown:top-4 peer-placeholder-shown:text-sm peer-placeholder-shown:text-gray-500 transition-all">
                            Bulan
                        </label>
                        @error('new_bulan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tahun --}}
                    <div class="relative">
                        <select wire:model.live="new_tahun" id="tahun"
                            class="peer block w-full px-3 pt-4 pb-2 bg-gray-900 rounded-lg border border-gray-700 focus:border-green-500 focus:outline-none appearance-none">
                            <option value="">Pilih Tahun</option>
                            {{-- Loop untuk setiap tahun yang kita buat di komponen --}}
                            @foreach($this->daftarTahun as $tahun)
                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                            @endforeach
                        </select>
                        <label for="tahun"
                            class="absolute left-3 top-2 text-xs text-gray-400 peer-placeholder-shown:top-4 peer-placeholder-shown:text-sm peer-placeholder-shown:text-gray-500 transition-all">
                            Tahun
                        </label>
                        @error('new_tahun')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Meter Awal --}}
                    <div class="relative">
                        <input type="number" wire:model.live="new_meterAwal" id="meter_awal" readonly
                            class="peer block w-full px-3 pt-5 pb-2 bg-gray-900 rounded-lg border border-gray-700 focus:border-green-500 focus:outline-none cursor-not-allowed"
                            placeholder=" " />
                        <label for="meter_awal"
                            class="absolute left-3 top-2 text-xs text-gray-400 peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm peer-placeholder-shown:text-gray-500 transition-all">
                            Meter Awal
                        </label>
                        @error('new_meterAwal')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Meter Akhir --}}
                    <div class="relative">
                        <input type="number" wire:model.live="new_meterAkhir" id="meter_akhir"
                            class="peer block w-full px-3 pt-5 pb-2 bg-gray-900 rounded-lg border border-gray-700 focus:border-green-500 focus:outline-none"
                            placeholder=" " />
                        <label for="meter_akhir"
                            class="absolute left-3 top-2 text-xs text-gray-400 peer-placeholder-shown:top-3 peer-placeholder-shown:text-sm peer-placeholder-shown:text-gray-500 transition-all">
                            Meter Akhir
                        </label>
                        @error('new_meterAkhir')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
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
</div>
