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
    // untuk create
    public $new_nama, $new_alamat, $new_nomor_kwh, $new_id_user, $new_id_tarif;
    // Untuk edit
    public $edit_nama, $edit_alamat, $edit_nomor_kwh, $edit_id_user, $edit_id_tarif;

    #[On('showCreatePelanggan')]
    public function openCreateModal()
    {
        $this->resetValidation();
        $this->reset(['new_nama', 'new_alamat', 'new_nomor_kwh', 'new_id_user']);
        $this->new_id_user = auth()->id();
        $this->new_id_tarif = Tarif::first()?->id ?? null;
        $this->showCreateModal = true;

    }

    #[On('showDetailPelanggan')]
    public function openDetailModal($id)
    {
        $this->pelanggan       = Pelanggan::with(['user', 'tarif', 'tagihans'])->find($id);
        $this->showDetailModal = true;
    }

    public function closeModal()
    {
        $this->showCreateModal = false;
        $this->showDetailModal = false;
        $this->showEditModal   = false;
        $this->showDeleteModal = false;
        $this->pelanggan       = null;
    }

    // ----------- CRUD LOGIC -------------

    public function saveCreate()
    {
        $this->validate([
            'new_nama'      => 'required|string|max:100',
            'new_nomor_kwh' => 'required|string|max:25|unique:pelanggans,nomor_kwh',
            'new_alamat'    => 'required|string|max:255',
            'new_id_user'   => 'required|exists:users,id',
            'new_id_tarif'  => 'required|exists:tarifs,id',
        ]);

        Pelanggan::create([
            'nama_pelanggan' => $this->new_nama,
            'nomor_kwh'      => $this->new_nomor_kwh,
            'alamat'         => $this->new_alamat,
            'id_user'        => $this->new_id_user,
            'id_tarif'       => $this->new_id_tarif,
        ]);

        session()->flash('success', 'Pelanggan berhasil ditambahkan.');
        $this->closeModal();
        $this->dispatch('refreshPelangganTable');
    }

    public function openEditModal()
    {
        $this->edit_nama       = $this->pelanggan->nama_pelanggan;
        $this->edit_nomor_kwh  = $this->pelanggan->nomor_kwh;
        $this->edit_alamat     = $this->pelanggan->alamat;
        $this->edit_id_user    = $this->pelanggan->id_user;
        $this->edit_id_tarif   = $this->pelanggan->id_tarif;
        $this->showEditModal   = true;
        $this->showDetailModal = false;
    }

    public function saveEdit()
    {
        $this->validate([
            'edit_nama'      => 'required|string|max:100',
            'edit_nomor_kwh' => 'required|string|max:25|unique:pelanggans,nomor_kwh,' . $this->pelanggan->id,
            'edit_alamat'    => 'required|string|max:255',
            'edit_id_user'   => 'required|exists:users,id',
            'edit_id_tarif'  => 'required|exists:tarifs,id',
        ]);

        $this->pelanggan->update([
            'nama_pelanggan' => $this->edit_nama,
            'nomor_kwh'      => $this->edit_nomor_kwh,
            'alamat'         => $this->edit_alamat,
            'id_user'        => $this->edit_id_user,
            'id_tarif'       => $this->edit_id_tarif,
        ]);

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
        $this->pelanggan->delete();
        session()->flash('success', 'Pelanggan berhasil dihapus.');
        $this->closeModal();
        $this->dispatch('refreshPelangganTable');
    }

    public function render()
    {
        return view('livewire.pelanggan-detail', [
            'users'  => User::all(),
            'tarifs' => Tarif::all(),
        ]);
    }
}
