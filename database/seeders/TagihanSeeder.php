<?php
namespace Database\Seeders;

use App\Models\Tagihan;
use Illuminate\Database\Seeder;

class TagihanSeeder extends Seeder
{
    public function run(): void
    {
        Tagihan::insert([
            [
                'id_pelanggan'  => 1,
                'id_penggunaan' => 1, // id di tabel penggunaans
                'bulan'         => 'Juli',
                'tahun'         => 2025,
                'jumlah_meter'  => 300, // meter_akhir - meter_awal
                'status'        => 'Belum Lunas',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}
