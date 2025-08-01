<?php
namespace App\Livewire\Pelanggan;

use App\Models\Tagihan;
use Livewire\Component;
use Livewire\WithPagination;

class TagihanSaya extends Component
{
    use WithPagination;

    // Di dalam class TagihanSaya

    public function render()
    {
        $pelanggan = auth()->user()->pelanggan;

        if ($pelanggan) {
            $tagihans = Tagihan::where('id_pelanggan', $pelanggan->id)
                ->with('penggunaan')
                ->latest('tahun')->latest('bulan')
                ->paginate(10);
        } else {
            // Jika pelanggan tidak ada, buat objek paginasi KOSONG
            $tagihans = Tagihan::where('id', false)->paginate(10);
        }

        return view('livewire.pelanggan.tagihan-saya', [
            'tagihans' => $tagihans,
        ]);
    }
}
