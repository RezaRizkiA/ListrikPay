<?php
namespace App\Livewire\Pelanggan;

use App\Models\Tagihan;
use Livewire\Component;
use Livewire\WithPagination;

class TagihanSaya extends Component
{
    use WithPagination;

    public function render()
    {
        $pelanggan = auth()->user()->pelanggan;
        $tagihans  = [];

        if ($pelanggan) {
            $tagihans = Tagihan::where('id_pelanggan', $pelanggan->id)
                ->with('penggunaan')
                ->latest('tahun')->latest('bulan')
                ->paginate(10);
        }

        return view('livewire.pelanggan.tagihan-saya', [
            'tagihans' => $tagihans,
        ]);
    }
}
