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
        $pelanggan   = auth()->user()->pelanggan;
        $pembayarans = [];

        if ($pelanggan) {
            $pembayarans = Pembayaran::where('id_pelanggan', $pelanggan->id)
                ->with('tagihan')
                ->latest()
                ->paginate(10);
        }

        return view('livewire.pelanggan.riwayat-pembayaran', [
            'pembayarans' => $pembayarans,
        ]);
    }
}
