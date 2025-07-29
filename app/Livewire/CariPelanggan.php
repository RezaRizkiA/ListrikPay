<?php
namespace App\Livewire;

use App\Models\Pelanggan;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CariPelanggan extends Component
{
    public $input           = '';
    public $data            = null;
    public $notFound        = false;
    public $alreadyPaid     = false;
    public $paymentSuccess  = false;
    public $pembayaranTotal = 0;

    public function cari()
    {
        // Reset state sebelum pencarian baru
        $this->notFound        = false;
        $this->data            = null;
        $this->alreadyPaid     = false;
        $this->paymentSuccess  = false;
        $this->pembayaranTotal = 0;

        if (trim($this->input) == '') {
            return;
        }

        try {
            $pelanggan = Pelanggan::with([
                'tagihans' => fn($q) => $q->latest('tahun')->latest('bulan'),
                'penggunaan',
            ])
                ->where('id', $this->input)
                ->orWhere('nomor_kwh', $this->input)
                ->first();

            if ($pelanggan && $pelanggan->tagihans->count()) {
                $tagihan   = $pelanggan->tagihans->first();
                $tagihanId = $tagihan->id;

                // Jika Sudah Lunas
                if ($tagihan->status === 'Lunas') {
                    $this->alreadyPaid = true;
                    // Cukup data minimal untuk modal lunas
                    $this->data = [
                        'id'    => $pelanggan->nomor_kwh,
                        'bulan' => $tagihan->bulan,
                        'tahun' => $tagihan->tahun,
                    ];
                    // langsung tampilkan modal
                    return;
                }

                // Kalau belum lunas, hitung normal
                $pemakaian      = $tagihan->jumlah_meter;
                $tarifPerKwh    = $pelanggan->tarif->tarifperkwh;
                $tagihanListrik = $pemakaian * $tarifPerKwh;
                $biayaAdmin     = 2500;
                $ppn            = $tagihanListrik * 0.1;
                $totalTagihan   = $tagihanListrik + $biayaAdmin + $ppn;

                // Siapkan data untuk modal detail
                $this->data = [
                    'id'              => $pelanggan->id,
                    'nomor_kwh'       => $pelanggan->nomor_kwh,
                    'tagihan_id'      => $tagihanId,
                    'nama'            => $pelanggan->nama_pelanggan,
                    'alamat'          => $pelanggan->alamat,
                    'tarif_daya'      => $pelanggan->tarif->daya . ' VA',
                    'bulan'           => $tagihan->bulan,
                    'tahun'           => $tagihan->tahun,
                    'jumlah_meter'    => $pemakaian,
                    'tagihan_listrik' => $tagihanListrik,
                    'biaya_admin'     => $biayaAdmin,
                    'ppn'             => $ppn,
                    'total_tagihan'   => $totalTagihan,
                ];
            } else {
                $this->notFound = true;
            }
        } catch (\Exception $e) {
            Log::error('Gagal mencari pelanggan: ' . $e->getMessage());
            $this->notFound = true;
        }
    }

    public function bayarSekarang()
    {
        if (! $this->data || ! isset($this->data['tagihan_id'])) {
            return;
        }

        try {
            // simpan pembayaran
            $pembayaran = Pembayaran::create([
                'id_tagihan'         => $this->data['tagihan_id'],
                'id_pelanggan'       => $this->data['id'],
                'id_user'            => Auth::id(),
                'tanggal_pembayaran' => now()->toDateString(),
                'bulan_bayar'        => $this->data['bulan'],
                'biaya_admin'        => $this->data['biaya_admin'],
                'total_bayar'        => $this->data['total_tagihan'],
            ]);

            // update status tagihan
            Tagihan::find($this->data['tagihan_id'])
                ->update(['status' => 'Lunas']);

            // set modal sukses
            $this->paymentSuccess  = true;
            $this->pembayaranTotal = $pembayaran->total_bayar;
            // hilangkan data biar detail modal tidak muncul
            $this->data = null;

        } catch (\Exception $e) {
            Log::error('Gagal simpan pembayaran: ' . $e->getMessage());
        }
    }

    public function closeModal()
    {
        Log::info('Method closeModal() dipanggil');

        $this->data            = null;
        $this->notFound        = false;
        $this->alreadyPaid     = false;
        $this->paymentSuccess  = false;
        $this->pembayaranTotal = 0;
        $this->input           = '';
        $this->dispatch('focus-search-input');
    }

    public function render()
    {
        return view('livewire.cari-pelanggan');
    }
}
