@extends('layouts.header')

@section('content')
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-12">
            <a href="#"
                class="inline-flex justify-between items-center py-1 px-1 pr-4 mb-7 text-sm text-gray-700 bg-gray-100 rounded-full dark:bg-gray-800 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700"
                role="alert">
                <span class="text-xs bg-primary-600 rounded-full text-white px-4 py-1.5 mr-3">New</span> <span
                    class="text-sm font-medium">Flowbite is out! See what's new</span>
                <svg class="ml-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
            </a>
            <h1
                class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                Bayar Listrik Cukup Sekali Klik!</h1>
            <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">Here at
                Flowbite we focus on markets where technology, innovation, and capital can unlock long-term value and drive
                economic growth.</p>
            <form action="#">
                <div class="items-center mx-auto mb-3 space-y-4 max-w-screen-sm sm:flex sm:space-y-0">
                    <div class="relative w-full">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            </svg>
                        </div>
                        <input
                            class="block p-3 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:rounded-none sm:rounded-l-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Masukan ID Pelanggan / Nomor kWh" type="text" id="text" required="">
                    </div>
                    <div>
                        <button type="submit"
                            class="py-3 px-5 w-full text-sm font-medium text-center text-white rounded-lg border cursor-pointer bg-primary-700 border-primary-600 sm:rounded-none sm:rounded-r-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                            id="readProductButton" data-modal-target="readProductModal"
                            data-modal-toggle="readProductModal">Cari</button>
                    </div>
                </div>
            </form>

            <div id="readProductModal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
                <div class="relative p-4 w-full max-w-xl h-full md:h-auto">
                    <!-- Modal content -->
                    <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                        <!-- Modal header -->
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Detail Tagihan Listrik
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-toggle="readProductModal">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <div class="space-y-8">

                            <!-- Informasi Pelanggan -->
                            <div>
                                <h4 class="text-base font-semibold mb-4 text-gray-700 dark:text-gray-300 border-b pb-2">
                                    Informasi Pelanggan</h4>
                                <dl class="space-y-2">
                                    <div class="flex justify-between">
                                        <dt class="text-gray-500 dark:text-gray-400">ID Pelanggan</dt>
                                        <dd class="font-medium text-gray-900 dark:text-white">123456789123</dd>
                                    </div>
                                    <div class="flex justify-between">
                                        <dt class="text-gray-500 dark:text-gray-400">Nama</dt>
                                        <dd class="font-medium text-gray-900 dark:text-white">Joko Anwar</dd>
                                    </div>
                                    <div class="flex justify-between">
                                        <dt class="text-gray-500 dark:text-gray-400">Alamat</dt>
                                        <dd class="font-medium text-gray-900 dark:text-white">Jl. Anggrek No. 5</dd>
                                    </div>
                                    <div class="flex justify-between">
                                        <dt class="text-gray-500 dark:text-gray-400">Tarif / Daya</dt>
                                        <dd class="font-medium text-gray-900 dark:text-white">R1/1300VA</dd>
                                    </div>
                                    <div class="flex justify-between">
                                        <dt class="text-gray-500 dark:text-gray-400">Total Lembar Tagihan</dt>
                                        <dd class="font-medium text-gray-900 dark:text-white">1</dd>
                                    </div>
                                    <div class="flex justify-between">
                                        <dt class="text-gray-500 dark:text-gray-400">Bulan / Tahun</dt>
                                        <dd class="font-medium text-gray-900 dark:text-white">MAR25</dd>
                                    </div>
                                </dl>
                            </div>

                            <!-- Rincian Pembayaran -->
                            <div>
                                <h4 class="text-base font-semibold mb-4 text-gray-700 dark:text-gray-300 border-b pb-2">
                                    Rincian Pembayaran</h4>
                                <dl class="space-y-2">
                                    <div class="flex justify-between">
                                        <dt class="text-gray-500 dark:text-gray-400">Tagihan Listrik</dt>
                                        <dd class="font-semibold text-gray-900 dark:text-white">Rp500.000</dd>
                                    </div>
                                    <div class="flex justify-between">
                                        <dt class="text-gray-500 dark:text-gray-400">Biaya Admin</dt>
                                        <dd class="text-gray-900 dark:text-white">Rp2.500</dd>
                                    </div>
                                    <div class="flex justify-between">
                                        <dt class="text-gray-500 dark:text-gray-400">PPN</dt>
                                        <dd class="text-gray-900 dark:text-white">Rp5.000</dd>
                                    </div>
                                    <div class="flex justify-between border-t pt-2 mt-2">
                                        <dt class="text-gray-700 font-bold dark:text-white">Total Bayar</dt>
                                        <dd class="text-lg font-bold text-primary-700 dark:text-primary-400">Rp507.500</dd>
                                    </div>
                                </dl>
                                <button type="submit"
                                    class="mt-6 w-full rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                    Bayar Sekarang
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="px-4 py-8 mx-auto text-center md:max-w-screen-md lg:max-w-screen-lg lg:px-36">
                <div class="flex justify-center items-center mt-4 text-gray-500 sm:justify-between">
                    <div class="mr-5 mb-5 lg:mb-0 hover:text-gray-800 dark:hover:text-gray-400">
                        <div class="text-blue-600 text-5xl mb-4">⚡</div>
                        <h2 class="font-semibold text-xl mb-2">Pemakaian Real-Time</h2>
                        <p class="text-gray-500">Lihat riwayat dan pemakaian listrik Anda secara bulanan dengan mudah.
                        </p>
                    </div>
                    <div class="mr-5 mb-5 lg:mb-0 hover:text-gray-800 dark:hover:text-gray-400">
                        <div class="text-green-600 text-5xl mb-4">💳</div>
                        <h2 class="font-semibold text-xl mb-2">Pembayaran Aman</h2>
                        <p class="text-gray-500">Bayar tagihan Anda langsung dari aplikasi dengan sistem yang aman.</p>
                    </div>
                    <div class="mr-5 mb-5 lg:mb-0 hover:text-gray-800 dark:hover:text-gray-400">
                        <div class="text-yellow-500 text-5xl mb-4">📊</div>
                        <h2 class="font-semibold text-xl mb-2">Laporan Lengkap</h2>
                        <p class="text-gray-500">Dapatkan laporan penggunaan dan tagihan dalam format ringkas dan
                            jelas.
                        </p>
                    </div>
                </div>
            </div>
    </section>
@endsection
@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            document.getElementById('readProductButton').click();
        });
    </script>
@endsection
