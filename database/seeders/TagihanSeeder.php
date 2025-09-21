<?php
namespace Database\Seeders;

use App\Models\Tagihan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class TagihanSeeder extends Seeder
{
    public function run(): void
    {
        for($i = 1; $i <= 200; $i++){
            Tagihan::create([
                'id_pelanggan'  => $i,
                'id_penggunaan' => $i, // id di tabel penggunaans
                'bulan'         => Arr::random(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']),
                'tahun'         => 2025,
                'jumlah_meter'  => 300, // meter_akhir - meter_awal
                'status'        => 'Belum Lunas',
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }
}
