<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'id_tarif');
    }

    public function tagihans()
    {
        return $this->hasMany(Tagihan::class, 'id_pelanggan');
    }

    public function penggunaan()
    {
        return $this->hasMany(Penggunaan::class, 'id_pelanggan');
    }
}
