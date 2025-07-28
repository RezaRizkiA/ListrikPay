<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tarif()
    {
        return $this->belongsTo(Tarif::class);
    }
}
