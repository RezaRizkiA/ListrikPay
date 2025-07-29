<?php
namespace App\Livewire;

use App\Models\Pelanggan;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CariPelanggan extends Component
{
    public $input    = '';
    public $data     = null;
    public $notFound = false;

    public function cari()
    {
        // Debug: tambahkan logging untuk memastikan method dipanggil
        Log::info('Method cari() dipanggil dengan input: ' . $this->input);

        // Reset state sebelum pencarian baru
        $this->notFound = false;
        $this->data     = null;

        if (trim($this->input) == '') {
            Log::info('Input kosong, return');
            return;
        }

        try {
            $pelanggan = Pelanggan::with([
                'tagihans' => function ($q) {
                    $q->latest('tahun')->latest('bulan');
                },
                'penggunaan',
            ])
                ->where('id', $this->input)
                ->orWhere('nomor_kwh', $this->input)
                ->first();

            Log::info('Hasil pencarian: ' . ($pelanggan ? 'ditemukan' : 'tidak ditemukan'));
            if ($pelanggan && $pelanggan->tagihans->count()) {
                // Ambil tagihan terakhir
                $tagihan = $pelanggan->tagihans->first();

                // Siapkan data untuk modal
                $this->data = [
                    'id'              => $pelanggan->nomor_kwh,
                    'nama'            => $pelanggan->nama_pelanggan,
                    'alamat'          => $pelanggan->alamat,
                    'tarif_daya'      => $pelanggan->tarif->daya . ' VA',
                    'bulan'           => $tagihan->bulan,
                    'tahun'           => $tagihan->tahun,
                    'jumlah_meter'    => $tagihan->jumlah_meter,
                    // Silakan tambahkan logika perhitungan tagihan listrik, admin, ppn, dst.
                    'tagihan_listrik' => 500000,
                    'biaya_admin'     => 2500,
                    'ppn'             => 5000,
                ];
                // dd($this->data);
            } else {
                $this->notFound = true;
            }
        } catch (\Exception $e) {
            Log::error('Error dalam pencarian: ' . $e->getMessage());
            $this->notFound = true;
        }
    }

    public function closeModal()
    {
        Log::info('Method closeModal() dipanggil');

        $this->data     = null;
        $this->notFound = false;
        $this->input    = ''; // Reset input

        // Force re-render component
        $this->render();

        // Dispatch event untuk focus
        $this->dispatch('focus-search-input');

        Log::info('Modal ditutup, input direset ke: "' . $this->input . '"');
    }

    public function render()
    {
        return view('livewire.cari-pelanggan');
    }
}
