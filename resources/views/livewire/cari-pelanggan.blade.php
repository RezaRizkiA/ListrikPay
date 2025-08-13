<div>
    <!-- Form Pencarian -->
    <form wire:submit.prevent="cari" class="mb-6">
        <div class="relative max-w-screen-sm mx-auto">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <input wire:model.live="input" id="search-input"
                class="block p-3 pl-10 pr-20 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="Masukan ID Pelanggan / Nomor kWh" type="text" required>
            <button type="submit"
                class="absolute inset-y-0 right-0 flex items-center px-4 text-sm font-medium text-white bg-yellow-600 rounded-r-lg hover:bg-yellow-700 focus:ring-4 focus:outline-none focus:ring-yellow-300 dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800 transition-colors duration-200">
                <svg class="w-4 h-4 text-white inline-block mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                        d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                </svg> Cari
            </button>
        </div>
    </form>

    {{-- Pesan jika tidak ditemukan --}}
    @if ($notFound)
    <div >
        <div class="mb-4 text-red-600 text-center font-semibold">ID Pelanggan atau Nomor kWh tidak ditemukan!</div>
    </div>
    @endif

    {{-- Modal: Pembayaran Berhasil --}}
    @if($paymentSuccess)
    <div id="paymentSuccessModal" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 max-w-md w-full">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Pembayaran Berhasil</h3>
                <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600">✕</button>
            </div>
            <div class="text-center space-y-4">
                <svg class="w-16 h-16 mx-auto text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2l4-4M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z" />
                </svg>
                <p class="text-gray-700 dark:text-gray-300">
                    Total pembayaran:
                    <span class="font-semibold">Rp{{ number_format($pembayaranTotal, 0, ',', '.') }}</span>
                </p>
                <button wire:click="closeModal"
                    class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-lg transition">
                    Tutup
                </button>
            </div>
        </div>
    </div>
    @endif

    {{-- Modal untuk menampilkan detail tagihan --}}
    @if ($data)
    <div id="detailTagihanModal" tabindex="-1" aria-hidden="false"
        class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full md:inset-0 h-modal md:h-full bg-gray-900 bg-opacity-50">
        <div class="relative p-4 w-full max-w-xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <!-- Modal header -->
                <div class="flex justify-between items-start mb-4 rounded-t sm:mb-5">
                    <div class="text-lg text-gray-900 md:text-xl dark:text-white">
                        <h3 class="font-semibold">
                            {{ $alreadyPaid ? 'Status Pembayaran' : 'Detail Tagihan Listrik' }}
                        </h3>
                    </div>
                    <div>
                        <button type="button" wire:click="closeModal"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                </div>

                @if ($alreadyPaid)
                {{-- Tampilan jika tagihan sudah dibayar --}}
                <div class="text-center py-6 space-y-4">
                    <svg class="w-16 h-16 mx-auto text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2l4-4M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z" />
                    </svg>
                    <p class="text-gray-700 dark:text-gray-300">
                        Tagihan bulan
                        <span class="font-semibold">{{ $data['bulan'] . ' ' . $data['tahun'] }}</span>
                        sudah <span class="font-semibold text-green-600">lunas</span>.
                    </p>
                    <a href="{{ route('dashboard.pembayaran.riwayat') }}"
                        class="inline-block px-4 py-2 bg-green-500 hover:bg-green-600 text-white text-sm font-medium rounded-lg transition">
                        Lihat Riwayat Pembayaran
                    </a>
                </div>
                @else
                <!-- Modal body -->
                <div class="mb-4">
                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Informasi Pelanggan
                    </dt>
                    <dd class="mb-4 space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-500 dark:text-gray-400">ID Pelanggan</span>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $data['nomor_kwh'] }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500 dark:text-gray-400">Nama</span>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $data['nama'] }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500 dark:text-gray-400">Alamat</span>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $data['alamat'] }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500 dark:text-gray-400">Tarif / Daya</span>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $data['tarif_daya'] }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500 dark:text-gray-400">Bulan / Tahun</span>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $data['bulan'] . $data['tahun']
                                }}</span>
                        </div>
                    </dd>

                    <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Rincian Pembayaran
                    </dt>
                    <dd class="mb-4 space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-500 dark:text-gray-400">Tagihan Listrik</span>
                            <span class="font-semibold text-gray-900 dark:text-white">Rp{{
                                number_format($data['tagihan_listrik']) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500 dark:text-gray-400">Biaya Admin</span>
                            <span class="text-gray-900 dark:text-white">Rp{{ number_format($data['biaya_admin'])
                                }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500 dark:text-gray-400">PPN</span>
                            <span class="text-gray-900 dark:text-white">Rp{{ number_format($data['ppn']) }}</span>
                        </div>
                        <div class="flex justify-between border-t pt-2 mt-2">
                            <span class="text-gray-700 font-bold dark:text-white">Total Bayar</span>
                            <span class="text-lg font-bold text-primary-700 dark:text-primary-400">
                                Rp{{ number_format($data['total_tagihan']) }}
                            </span>
                        </div>
                    </dd>
                </div>

                <!-- Modal footer -->
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-3 sm:space-x-4">
                        <button wire:click.prevent="prosesPembayaran"
                            class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            <svg aria-hidden="true" class="mr-1 -ml-1 w-5 h-5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            Bayar Sekarang
                        </button>
                        <button type="button" wire:click="closeModal"
                            class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            Tutup
                        </button>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endif
</div>

<script>
    // Livewire v3 Event Handling
    document.addEventListener('livewire:init', () => {
        // Handle focus event dari dispatch
        Livewire.on('focus-search-input', (event) => {
            setTimeout(() => {
                const input = document.getElementById('search-input');
                if (input) {
                    input.value = ''; // Force clear input field
                    input.focus();
                    input.select(); // Select semua text (jika ada)
                }
            }, 200); // Delay lebih lama untuk memastikan DOM ready
        });
    });

    // Optional: Tutup modal ketika klik di luar modal
    document.addEventListener('click', function(event) {
        const modal = document.getElementById('detailTagihanModal');
        if (modal && event.target === modal) {
            @this.call('closeModal');
        }
    });

    // Optional: Tutup modal dengan tombol ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const modal = document.getElementById('detailTagihanModal');
            if (modal) {
                @this.call('closeModal');
            }
        }
    });

    // Force refresh input ketika Livewire update
    document.addEventListener('livewire:updated', () => {
        const input = document.getElementById('search-input');
        if (input && input.value === '') {
            // Pastikan input benar-benar kosong di DOM
            input.value = '';
        }
    });

    // Debug logging
    document.addEventListener('livewire:init', () => {
        // Log ketika component di-update
        Livewire.hook('morph.updated', ({
            el,
            component
        }) => {
            console.log('Livewire updated, current input value:', document.getElementById(
                'search-input')?.value);
        });

        // Log ketika form di-submit
        const form = document.querySelector('form[wire\\:submit\\.prevent="cari"]');
        if (form) {
            form.addEventListener('submit', function(e) {
                console.log('Form submitted with input:', document.getElementById('search-input')
                .value);
            });
        }
    });
</script>
