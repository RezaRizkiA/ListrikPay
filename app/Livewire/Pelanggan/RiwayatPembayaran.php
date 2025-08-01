<?php
namespace App\Livewire\Pelanggan;

use App\Models\Pembayaran;
use Livewire\Component;
use Livewire\WithPagination;

class RiwayatPembayaran extends Component
{
    use WithPagination;

    public function render()
{
    $user = auth()->user();
    // 1. Dapatkan SEMUA ID pelanggan yang terhubung dengan user ini
    $pelangganIds = $user->pelanggans()->pluck('pelanggans.id')->toArray();

    if (!empty($pelangganIds)) {
        // 2. Cari semua pembayaran yang id_pelanggan-nya ada di dalam array $pelangganIds
        $pembayarans = Pembayaran::whereIn('id_pelanggan', $pelangganIds)
            ->with('tagihan.pelanggan') // Load juga data pelanggan untuk ditampilkan di tabel
            ->latest()
            ->paginate(10);
    } else {
        $pembayarans = Pembayaran::where('id', false)->paginate(10);
    }

    return view('livewire.pelanggan.riwayat-pembayaran', [
        'pembayarans' => $pembayarans,
    ]);
}
}
