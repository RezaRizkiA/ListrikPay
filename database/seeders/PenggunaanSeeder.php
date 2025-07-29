<?php
namespace Database\Seeders;

use App\Models\Penggunaan;
use Illuminate\Database\Seeder;

class PenggunaanSeeder extends Seeder
{
    public function run(): void
    {
        Penggunaan::insert([
            [
                'id_pelanggan' => 1, // id di tabel pelanggans
                'bulan'        => 'Juli',
                'tahun'        => 2025,
                'meter_awal'   => 0,
                'meter_akhir'  => 300,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
    }
}
