<?php
namespace App\Livewire;

use App\Models\Pelanggan;
use App\Models\Tarif;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class PelangganDetail extends Component
{
    public $showCreateModal = false;
    public $showDetailModal = false;
    public $showEditModal   = false;
    public $showDeleteModal = false;
    public $pelanggan;

    // Untuk create
    public $new_nama, $new_alamat, $new_nomor_kwh, $new_id_tarif;
    public $new_user_ids = []; // Berubah menjadi array untuk menampung banyak user

    // Untuk edit
    public $edit_nama, $edit_alamat, $edit_nomor_kwh, $edit_id_tarif;
    public $edit_user_ids = []; // Berubah menjadi array

    // TAMBAHKAN PROPERTI INI untuk menampung user yang akan dihubungkan
    public $link_user_ids = [];

    #[On('showCreatePelanggan')]
    public function openCreateModal()
    {
        $this->resetValidation();
        $this->reset('new_nama', 'new_alamat', 'new_nomor_kwh', 'new_id_tarif', 'new_user_ids');
        $this->showCreateModal = true;
    }

    #[On('showDetailPelanggan')]
    public function openDetailModal($id)
    {
        // DIUBAH: Eager load relasi 'users' (jamak), bukan 'user'
        $this->pelanggan       = Pelanggan::with(['users', 'tarif', 'tagihans'])->find($id);
        $this->showDetailModal = true;
        // TAMBAHKAN INI: Memberi sinyal ke AlpineJS untuk mereset dropdown
        $this->dispatch('resetLinkUserSelect');

    }

    public function linkUsers()
    {
        $this->validate([
            'link_user_ids'   => 'required|array|min:1',
            'link_user_ids.*' => 'exists:users,id',
        ], [
            'link_user_ids.required' => 'Anda harus memilih setidaknya satu user.',
        ]);

        if ($this->pelanggan) {
            // Hubungkan user yang dipilih ke pelanggan ini
            // syncWithoutDetaching akan menambahkan koneksi baru tanpa menghapus yang lama
            $this->pelanggan->users()->syncWithoutDetaching($this->link_user_ids);

            // Beri pesan sukses sementara di dalam modal
            session()->flash('detail_success', 'User berhasil dihubungkan!');

            // Muat ulang data modal untuk menampilkan user yang baru terhubung
            $this->openDetailModal($this->pelanggan->id);

            // Kosongkan kembali pilihan dropdown
            $this->reset('link_user_ids');
        }
    }

    public function closeModal()
    {
        $this->showCreateModal = false;
        $this->showDetailModal = false;
        $this->showEditModal   = false;
        $this->showDeleteModal = false;
        $this->pelanggan       = null;
    }

    public function saveCreate()
    {
        $this->validate([
            'new_nama'       => 'required|string|max:100',
            'new_nomor_kwh'  => 'required|string|max:25|unique:pelanggans,nomor_kwh',
            'new_alamat'     => 'required|string|max:255',
            'new_id_tarif'   => 'required|exists:tarifs,id',
            'new_user_ids'   => 'nullable|array',  // Validasi sebagai array
            'new_user_ids.*' => 'exists:users,id', // Validasi setiap id di dalam array
        ]);

        // 1. Buat data pelanggan terlebih dahulu
        $pelanggan = Pelanggan::create([
            'nama_pelanggan' => $this->new_nama,
            'nomor_kwh'      => $this->new_nomor_kwh,
            'alamat'         => $this->new_alamat,
            'id_tarif'       => $this->new_id_tarif,
        ]);

        // 2. Jika ada user yang dipilih, hubungkan melalui tabel pivot
        if (! empty($this->new_user_ids)) {
            $pelanggan->users()->attach($this->new_user_ids);
        }

        session()->flash('success', 'Pelanggan berhasil ditambahkan.');
        $this->closeModal();
        $this->dispatch('refreshPelangganTable');
    }

    public function openEditModal()
    {
        $this->edit_nama      = $this->pelanggan->nama_pelanggan;
        $this->edit_nomor_kwh = $this->pelanggan->nomor_kwh;
        $this->edit_alamat    = $this->pelanggan->alamat;
        $this->edit_id_tarif  = $this->pelanggan->id_tarif;
        // Ambil semua ID user yang terhubung ke pelanggan ini
        $this->edit_user_ids = $this->pelanggan->users->pluck('id')->toArray();

        $this->showEditModal   = true;
        $this->showDetailModal = false;
    }

    public function saveEdit()
    {
        $this->validate([
            'edit_nama'       => 'required|string|max:100',
            'edit_nomor_kwh'  => 'required|string|max:25|unique:pelanggans,nomor_kwh,' . $this->pelanggan->id,
            'edit_alamat'     => 'required|string|max:255',
            'edit_id_tarif'   => 'required|exists:tarifs,id',
            'edit_user_ids'   => 'nullable|array',
            'edit_user_ids.*' => 'exists:users,id',
        ]);

        // 1. Update data pelanggan
        $this->pelanggan->update([
            'nama_pelanggan' => $this->edit_nama,
            'nomor_kwh'      => $this->edit_nomor_kwh,
            'alamat'         => $this->edit_alamat,
            'id_tarif'       => $this->edit_id_tarif,
        ]);

        // 2. Sinkronkan user yang terhubung di tabel pivot
        $this->pelanggan->users()->sync($this->edit_user_ids);

        session()->flash('success', 'Pelanggan berhasil diupdate.');
        $this->closeModal();
        $this->dispatch('refreshPelangganTable');
    }

    public function openDeleteModal()
    {
        $this->showDeleteModal = true;
        $this->showDetailModal = false;
    }

    public function deletePelanggan()
    {
        // Relasi di pivot table akan terhapus otomatis karena onDelete('cascade')
        $this->pelanggan->delete();
        session()->flash('success', 'Pelanggan berhasil dihapus.');
        $this->closeModal();
        $this->dispatch('refreshPelangganTable');
    }

    public function render()
    {
        return view('livewire.pelanggan-detail', [
            // Ambil hanya user dengan role pelanggan untuk dihubungkan
            'users'  => User::where('id_level', 3)->orderBy('username')->get(),
            'tarifs' => Tarif::all(),
        ]);
    }
}
