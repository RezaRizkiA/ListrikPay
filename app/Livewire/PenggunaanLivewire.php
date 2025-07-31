<?php

namespace App\Livewire;

use App\Models\Pelanggan;
use App\Models\Penggunaan;
use Livewire\Attributes\On;
use Livewire\Component;

class PenggunaanLivewire extends Component
{
    public $showPenggunaanModal = false;

    public $new_bulan, $new_tahun, $new_id_pelanggan, $new_meterAwal, $new_meterAkhir;

    #[On('showCreatePenggunaan')]
    public function openCreateModal()
    {
        $this->resetValidation();
        $this->reset(['new_bulan', 'new_tahun', 'new_id_pelanggan', 'new_meterAwal', 'new_meterAkhir']);
        $this->new_id_pelanggan    = Pelanggan::first()?->id ?? null;
        $this->showPenggunaanModal = true;
    }

    public function closeModal()
    {
        $this->showPenggunaanModal = false;
    }

    public function saveCreate()
    {
        $this->validate([
            "new_bulan"        => 'required|string|max:10',
            "new_tahun"        => 'required|string|max:4',
            "new_id_pelanggan" => 'required|exists:pelanggans,id',
            "new_meterAwal"    => 'required|integer',
            "new_meterAkhir"   => 'required|integer',
        ]);

        Penggunaan::create([
            'id_pelanggan' => $this->new_id_pelanggan,
            'bulan'        => $this->new_bulan,
            'tahun'        => $this->new_tahun,
            'meter_awal'   => $this->new_meterAwal,
            'meter_akhir'  => $this->new_meterAkhir,
        ]);

        session()->flash('success', 'Penggunaan berhasil ditambahkan.');
        $this->closeModal();
        $this->dispatch('refreshPenggunaanTable');
    }

    public function render()
    {
        return view('livewire.penggunaan-livewire',
            [
                'pelanggans' => Pelanggan::all(),
            ]);
    }
}
