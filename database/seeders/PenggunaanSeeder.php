<?php
namespace Database\Seeders;

use App\Models\Penggunaan;
use Illuminate\Database\Seeder;

class PenggunaanSeeder extends Seeder
{
    public function run(): void
    {
     
        $data = [];
        for ($i = 1; $i <= 200; $i++){
            $data[] = [
                'id_pelanggan' => $i, // id di tabel pelanggans
                'bulan'        => 'January',
                'tahun'        => 2025,
                'meter_awal'   => 0,
                'meter_akhir'  => 300,
                'created_at'   => now(),
                'updated_at'   => now(),
            ];
        }
        Penggunaan::insert($data);
    }
}
