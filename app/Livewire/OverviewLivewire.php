<?php
namespace App\Livewire;

use App\Models\Pelanggan;
use App\Models\Pembayaran;
use App\Models\Penggunaan;
use App\Models\Tagihan;
use Livewire\Component;

class OverviewLivewire extends Component
{
    public $totalPelanggan    = 0;
    public $totalPenggunaan   = 0;
    public $tagihanBelumLunas = 0;
    public $totalPendapatan   = 0;

    public function mount()
    {
        // Menghitung total pelanggan terdaftar
        $this->totalPelanggan = Pelanggan::count();

        // Menghitung total record penggunaan
        $this->totalPenggunaan = Penggunaan::count();

        // Menghitung jumlah tagihan yang statusnya belum lunas
        $this->tagihanBelumLunas = Tagihan::where('status', 'Belum Lunas')->count();

        // Menjumlahkan total pendapatan dari semua pembayaran yang sudah masuk
        $this->totalPendapatan = Pembayaran::sum('total_bayar');
    }

    public function render()
    {
        return view('livewire.overview-livewire');
    }
}
