<?php
namespace Database\Seeders;

use App\Models\Tagihan;
use Illuminate\Database\Seeder;

class TagihanSeeder extends Seeder
{
    public function run(): void
    {
        for($i = 1; $i <= 200; $i++){
            Tagihan::create([
                'id_pelanggan'  => $i,
                'id_penggunaan' => $i, // id di tabel penggunaans
                'bulan'         => 'January',
                'tahun'         => 2025,
                'jumlah_meter'  => 300, // meter_akhir - meter_awal
                'status'        => 'Belum Lunas',
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }
}
