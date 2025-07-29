<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    public function penggunaan()
    {
        return $this->belongsTo(Penggunaan::class, 'id_penggunaan');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_tagihan');
    }
}
