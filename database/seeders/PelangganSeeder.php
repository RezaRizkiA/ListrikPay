<?php
namespace Database\Seeders;

use App\Models\Pelanggan;
use Illuminate\Database\Seeder;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pelanggan::insert([
            [
                'id_user'        => 3, // pelanggan1
                'nomor_kwh'      => '1234567890',
                'nama_pelanggan' => 'Budi Santoso',
                'alamat'         => 'Jl. Merdeka No. 1',
                'id_tarif'       => 1,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
    }
}
