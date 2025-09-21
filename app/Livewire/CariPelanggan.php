<?php

namespace App\Livewire;

use App\Models\Pelanggan;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CariPelanggan extends Component
{
    public $input           = '';
    public $data            = null;
    public $notFound        = false;
    public $notFoundMessage = '';
    public $alreadyPaid     = false;
    public $paymentSuccess  = false;
    public $pembayaranTotal = 0;

    /**
     * Method ini berjalan saat komponen pertama kali dimuat.
     */
    public function mount()
    {
        // Cek jika ada pencarian yang tersimpan di session setelah login
        // Hapus session agar tidak dicari lagi
        // Langsung jalankan pencarian
        if (session()->has('customer_search')) {
            $this->input = session('customer_search');
            session()->forget('customer_search');
            $this->cari();
        }
    }

    /**
     * Method "pintar" yang akan dipanggil oleh tombol.
     */
    public function prosesPembayaran()
    {
        if (Auth::check()) {
            // Jika pengguna sudah login, langsung jalankan fungsi pembayaran
            $this->bayarSekarang();
        } else {
            // Jika belum login (guest):
            // 1. Simpan ID pelanggan yang dicari ke dalam session.
            session(['customer_search' => $this->input]);
            // 2. Arahkan pengguna ke halaman login.
            $this->redirect(route('login'), navigate: true);
        }
    }

    public function cari()
    {
        // Reset state sebelum pencarian baru
        $this->reset(['data', 'notFound', 'notFoundMessage', 'alreadyPaid', 'paymentSuccess', 'pembayaranTotal']);

        if (trim($this->input) == '') {
            return;
        }

        try {
            // 1. Cari data pelanggan terlebih dahulu
            $pelanggan = Pelanggan::with('tarif')->where(function ($q) {
                $q->where('nomor_kwh', $this->input);
            })->first();
            // Jika pelanggan tidak ditemukan sama sekali
            if (!$pelanggan) {
                $this->notFound = true;
                $this->notFoundMessage = 'ID Pelanggan atau Nomor KWH tidak ditemukan!';
                return;
            }

            // 2. Prioritaskan mencari tagihan PALING LAMA yang BELUM LUNAS
            $tagihanUntukDibayar = Tagihan::where('id_pelanggan', $pelanggan->id)
                ->where('status', 'Belum Lunas')
                ->orderBy('tahun', 'asc')
                ->orderBy('bulan', 'asc')
                ->first();

            // 3. JIKA DITEMUKAN tagihan yang belum lunas
            if ($tagihanUntukDibayar) {
                $this->alreadyPaid = false; // Pastikan status lunas di-reset

                // Hitung detail tagihan yang belum lunas
                $pemakaian      = $tagihanUntukDibayar->jumlah_meter;
                $tarifPerKwh    = $pelanggan->tarif->tarifperkwh;
                $tagihanListrik = $pemakaian * $tarifPerKwh;
                $biayaAdmin     = 2500;
                $ppn            = $tagihanListrik * 0.1;
                $totalTagihan   = $tagihanListrik + $biayaAdmin + $ppn;

                // Siapkan data untuk modal detail pembayaran
                $this->data = [
                    'id'              => $pelanggan->id,
                    'nomor_kwh'       => $pelanggan->nomor_kwh,
                    'tagihan_id'      => $tagihanUntukDibayar->id,
                    'nama'            => $pelanggan->nama_pelanggan,
                    'alamat'          => $pelanggan->alamat,
                    'tarif_daya'      => $pelanggan->tarif->daya . ' VA',
                    'bulan'           => $tagihanUntukDibayar->bulan,
                    'tahun'           => $tagihanUntukDibayar->tahun,
                    'jumlah_meter'    => $pemakaian,
                    'tagihan_listrik' => $tagihanListrik,
                    'biaya_admin'     => $biayaAdmin,
                    'ppn'             => $ppn,
                    'total_tagihan'   => $totalTagihan,
                ];
            } else {
                // 4. JIKA TIDAK DITEMUKAN tagihan belum lunas, berarti semua sudah lunas atau belum ada tagihan sama sekali
                $tagihanTerakhir = Tagihan::where('id_pelanggan', $pelanggan->id)
                    ->latest('created_at')
                    ->first();

                if ($tagihanTerakhir) {
                    // Jika ada riwayat tagihan, tampilkan pesan lunas untuk tagihan terakhir
                    $this->alreadyPaid = true;
                    $this->data        = [
                        'id'    => $pelanggan->nomor_kwh,
                        'bulan' => $tagihanTerakhir->bulan,
                        'tahun' => $tagihanTerakhir->tahun,
                    ];
                } else {
                    // Jika pelanggan ada tapi sama sekali belum punya tagihan
                    $this->notFound = true; // Tampilkan pesan 'tidak ditemukan'
                    $this->notFoundMessage = 'Pelanggan ditemukan, tapi belum ada tagihan';
                }
            }
        } catch (\Exception $e) {
            Log::error('Gagal mencari pelanggan: ' . $e->getMessage());
            $this->notFound = true;
            $this->notFoundMessage = 'Terjadi kesalahan saat mencari. Coba lagi nanti.';
        }
    }

    public function bayarSekarang()
    {
        if (! $this->data || ! isset($this->data['tagihan_id'])) return;

        DB::transaction(function () {
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

            $pelanggan = Pelanggan::findOrFail($this->data['id']);
            $pelanggan->users()->syncWithoutDetaching([Auth::id() => ['created_at' => now(), 'updated_at' => now()]]);

            // set modal sukses
            $this->paymentSuccess  = true;
            $this->pembayaranTotal = $pembayaran->total_bayar;
            // hilangkan data biar detail modal tidak muncul
            $this->data = null;
        });
    }

    public function closeModal()
    {
        $this->data            = null;
        $this->notFound        = false;
        $this->notFoundMessage = '';
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
