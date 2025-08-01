<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $guarded  = 'id';
    protected $fillable = [
        'nama_pelanggan',
        'nomor_kwh',
        'alamat',
        'id_user',
        'id_tarif',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'pelanggan_user');
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

    public function tagihanTerakhir(): Attribute
    {
        return Attribute::get(
            fn() => $this->tagihans()->latest('created_at')->first()
        );
    }
}
