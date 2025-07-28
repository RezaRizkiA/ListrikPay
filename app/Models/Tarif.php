<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    public function pelanggans()
    {
        return $this->hasMany(Pelanggan::class);
    }
}
