<?php
namespace App\Livewire;

use App\Models\Pelanggan;
use App\Models\Penggunaan;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Livewire\Component;

class PenggunaanLivewire extends Component
{
    public $pelanggans          = [];
    public $showPenggunaanModal = false;

    // Properti untuk form, diawali 'new_' untuk menghindari konflik
    public $new_id_pelanggan;
    public $new_bulan;
    public $new_tahun;
    public $new_meterAwal = 0;
    public $new_meterAkhir;

    // Listener untuk membuka modal dari komponen lain
    protected $listeners = ['showCreatePenggunaan' => 'openCreateModal'];

    public function mount()
    {
        // Ambil data pelanggan saat komponen dimuat
        $this->pelanggans = Pelanggan::orderBy('nama_pelanggan')->get();

    }

    public function openCreateModal()
    {

        $this->resetValidation();
        $this->reset(['new_id_pelanggan', 'new_bulan', 'new_tahun', 'new_meterAwal', 'new_meterAkhir']);
        $this->new_meterAwal       = 0;
        $this->showPenggunaanModal = true;
    }

    public function closeModal()
    {
        $this->showPenggunaanModal = false;
    }

    // --- INI ADALAH BAGIAN PALING PENTING ---
    // Method ini akan berjalan setiap kali pelanggan dipilih
    public function updatedNewIdPelanggan($pelangganId)
    {

        if (! empty($pelangganId)) {
            $penggunaanTerakhir = Penggunaan::where('id_pelanggan', $pelangganId)
                ->latest('created_at') // Urutkan berdasarkan yang paling baru dibuat
                ->first();

            $this->new_meterAwal = $penggunaanTerakhir ? $penggunaanTerakhir->meter_akhir : 0;
        } else {
            $this->new_meterAwal = 0;
        }
        Log::info('info meter awal ' . $this->new_meterAwal);

        // Reset meter akhir agar user mengisi ulang
        $this->new_meterAkhir = null;
    }

    public function saveCreate()
    {
        // Validasi data sebelum disimpan
        $this->validate([
            'new_id_pelanggan' => 'required|exists:pelanggans,id',
            'new_bulan'        => [
                'required',
                'string',
                // Pastikan tidak ada duplikat penggunaan untuk bulan & tahun yang sama
                Rule::unique('penggunaans', 'bulan')->where(function ($query) {
                    return $query->where('id_pelanggan', $this->new_id_pelanggan)
                        ->where('tahun', $this->new_tahun);
                }),
            ],
            'new_tahun'        => 'required|numeric|digits:4',
            'new_meterAwal'    => 'required|numeric',
            // Meter akhir harus diisi dan tidak boleh lebih kecil dari meter awal
            'new_meterAkhir'   => 'required|numeric|gte:new_meterAwal',
        ], [
            'new_meterAkhir.gte' => 'Meter akhir tidak boleh lebih kecil dari meter awal.',
            'new_bulan.unique'   => 'Data penggunaan untuk bulan dan tahun ini sudah ada.',
        ]);

        // Simpan data ke database
        Penggunaan::create([
            'id_pelanggan' => $this->new_id_pelanggan,
            'bulan'        => $this->new_bulan,
            'tahun'        => $this->new_tahun,
            'meter_awal'   => $this->new_meterAwal,
            'meter_akhir'  => $this->new_meterAkhir,
        ]);

        // Beri pesan sukses
        session()->flash('message', 'Data penggunaan berhasil ditambahkan!');
        // Tutup modal
        $this->closeModal();
        // Refresh data di tabel utama (jika ada)
        $this->dispatch('refreshPenggunaanTable');
    }

    public function render()
    {
        // Render view modal
        return view('livewire.penggunaan-livewire', ['pelanggans' => Pelanggan::all()]);
    }
}
