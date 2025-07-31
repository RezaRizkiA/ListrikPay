<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penggunaan extends Model
{
    protected $guarded  = 'id';
    protected $fillable = [
        "id_pelanggan",
        "bulan",
        "tahun",
        "meter_awal",
        "meter_akhir",
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function tagihan()
    {
        return $this->hasOne(Tagihan::class, 'id_penggunaan');
    }
}
