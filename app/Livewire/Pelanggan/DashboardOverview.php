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
        $user = auth()->user();
        // 1. Ambil SEMUA ID pelanggan yang terhubung dengan user ini
        $pelangganIds = $user->pelanggans()->pluck('pelanggans.id')->toArray();

        // Lanjutkan hanya jika user memiliki pelanggan yang terhubung
        if (! empty($pelangganIds)) {
            // 2. Ambil tagihan paling lama yang belum lunas DARI SEMUA PELANGGAN
            $this->tagihanTerbaru = Tagihan::whereIn('id_pelanggan', $pelangganIds)
                ->where('status', 'Belum Lunas')
                ->orderBy('tahun', 'asc')->orderBy('bulan', 'asc')
                ->first();

            // 3. Hitung total tunggakan DARI SEMUA PELANGGAN
            $this->totalTunggakan = Tagihan::whereIn('id_pelanggan', $pelangganIds)
                ->where('status', 'Belum Lunas')
                ->sum('jumlah_meter'); // Ganti 'jumlah_meter' dengan total biaya jika ada

            // 4. Ambil 5 riwayat pembayaran terakhir DARI SEMUA PELANGGAN
            $this->riwayatPembayaran = Pembayaran::whereIn('id_pelanggan', $pelangganIds)
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
