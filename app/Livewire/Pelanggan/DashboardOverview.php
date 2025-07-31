<?php
namespace App\Livewire\Pelanggan;

use App\Models\Pembayaran;
use App\Models\Tagihan;
use Livewire\Component;

class DashboardOverview extends Component
{
    public $tagihanTerbaru;
    public $totalTunggakan    = 0;
    public $riwayatPembayaran = [];

    public function mount()
    {
        $user      = auth()->user();
        $pelanggan = $user->pelanggan; // Asumsi relasi 'pelanggan' ada di model User

        if ($pelanggan) {
            // 1. Ambil tagihan paling lama yang belum lunas
            $this->tagihanTerbaru = Tagihan::where('id_pelanggan', $pelanggan->id)
                ->where('status', 'Belum Lunas')
                ->orderBy('tahun', 'asc')->orderBy('bulan', 'asc')
                ->first();

            // 2. Hitung total tunggakan dari semua tagihan yang belum lunas
            $this->totalTunggakan = Tagihan::where('id_pelanggan', $pelanggan->id)
                ->where('status', 'Belum Lunas')
                ->sum('jumlah_meter'); // Ganti 'jumlah_meter' dengan total biaya jika ada

            // 3. Ambil 5 riwayat pembayaran terakhir
            $this->riwayatPembayaran = Pembayaran::where('id_pelanggan', $pelanggan->id)
                ->with('tagihan')
                ->latest()
                ->limit(5)
                ->get();
        }
    }

    public function render()
    {
        return view('livewire.pelanggan.dashboard-overview');
    }
}
