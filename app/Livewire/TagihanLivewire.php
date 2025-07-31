<?php
namespace App\Livewire;

use App\Models\Pelanggan;
use App\Models\Penggunaan;
use App\Models\Tagihan;
use Livewire\Component;

class TagihanLivewire extends Component
{
    public $id_pelanggan;
    public $id_penggunaan;
    public $bulan;
    public $tahun;
    public $jumlah_meter;
    public $status              = 'Belum Lunas';
    public $showTagihanModal    = false;
    public $filteredPenggunaans = [];

    protected $listeners = ['showCreateTagihan' => 'openCreateModal'];

    public function openCreateModal()
    {
        $this->resetValidation();
        $this->reset(); // Reset semua properti publik ke nilai awal
        $this->showTagihanModal = true;
    }

    public function closeModal()
    {
        $this->showTagihanModal = false;
        $this->reset();
    }

    // Method yang dipanggil ketika pelanggan berubah
    public function updatedIdPelanggan($value)
    {
        // 1. Reset semua properti anak untuk memastikan tidak ada data lama yang tertinggal
        $this->reset(['id_penggunaan', 'bulan', 'tahun', 'jumlah_meter', 'status', 'filteredPenggunaans']);

        if (! empty($value)) {
            // 2. Filter penggunaan HANYA untuk pelanggan yang dipilih
            $this->filteredPenggunaans = Penggunaan::where('id_pelanggan', $value)->get()->toArray();

            // Atur status default jika tidak ada auto-selection
            $this->status = 'Belum Lunas';

            // 3. Jika hanya ada satu penggunaan, otomatis pilih dan isi datanya
            if (count($this->filteredPenggunaans) === 1) {
                $penggunaanTunggal   = $this->filteredPenggunaans[0];
                $this->id_penggunaan = $penggunaanTunggal['id'];

                // 4. Jalankan logika pengisian form secara lengkap
                $this->bulan        = $penggunaanTunggal['bulan'];
                $this->tahun        = $penggunaanTunggal['tahun'];
                $this->jumlah_meter = $penggunaanTunggal['meter_akhir'] - $penggunaanTunggal['meter_awal'];

                $existingTagihan = Tagihan::where('id_penggunaan', $this->id_penggunaan)->first();
                $this->status    = $existingTagihan ? $existingTagihan->status : 'Belum Lunas';
            }
        }
    }

    // Method yang dipanggil ketika penggunaan berubah
    public function updatedIdPenggunaan($value)
    {
        // 1. Reset properti di bawahnya untuk memastikan kebersihan state
        $this->reset(['bulan', 'tahun', 'jumlah_meter', 'status']);

        if (! empty($value)) {
            $penggunaan = Penggunaan::find($value);

            if ($penggunaan) {
                // 2. Isi data dari model Penggunaan
                $this->bulan        = $penggunaan->bulan;
                $this->tahun        = $penggunaan->tahun;
                $this->jumlah_meter = $penggunaan->meter_akhir - $penggunaan->meter_awal;

                // 3. Cek tagihan yang terkait dengan penggunaan spesifik ini
                $existingTagihan = Tagihan::where('id_penggunaan', $value)->first();

                // 4. Atur status berdasarkan ada atau tidaknya tagihan
                $this->status = $existingTagihan ? $existingTagihan->status : 'Belum Lunas';
            }
        }
    }

    public function saveCreate()
    {
        $this->validate([
            'id_pelanggan'  => 'required|exists:pelanggans,id',
            'id_penggunaan' => 'required|exists:penggunaans,id',
            'bulan'         => 'required|string|max:10',
            'tahun'         => 'required|integer',
            'jumlah_meter'  => 'required|numeric',
            'status'        => 'required|in:Belum Lunas,Lunas',
        ]);

        $existingTagihan = Tagihan::where('id_penggunaan', $this->id_penggunaan)->first();
        if ($existingTagihan) {
            session()->flash('error', 'Tagihan untuk penggunaan ini sudah ada!');
            return;
        }

        Tagihan::create([
            'id_pelanggan'  => $this->id_pelanggan,
            'id_penggunaan' => $this->id_penggunaan,
            'bulan'         => $this->bulan,
            'tahun'         => $this->tahun,
            'jumlah_meter'  => $this->jumlah_meter,
            'status'        => $this->status,
        ]);

        session()->flash('message', 'Tagihan berhasil dibuat!');
        $this->closeModal();
        $this->dispatch('refreshTagihan');
    }

    public function render()
    {
        return view('livewire.tagihan-livewire', [
            'pelanggans' => Pelanggan::all(),
            'tagihans'   => Tagihan::with(['pelanggan', 'penggunaan'])->latest()->get(),
        ]);
    }
}
