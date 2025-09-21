<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use App\Models\Penggunaan;
use App\Models\Tagihan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class PenggunaanSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $pelangganIds = Pelanggan::orderBy('id')->pluck('id')->values()->all();

            for ($m = 1; $m <= 12; $m++) {
                $namaBulan = fn($m) => \Carbon\Carbon::create(null, $m, 1)->locale('id')->translatedFormat('F');
                Penggunaan::create([
                    'bulan' => $namaBulan($m),
                ]);
                Tagihan::create([
                    'bulan' => $namaBulan($m),
                ]);
            };

            foreach ($pelangganIds as $pid) {
                $penggunaan = Penggunaan::create([
                    'id_pelanggan' => $pid,
                    'tahun' => 2025,
                    'meter_awal' => 0,
                    'meter_akhir' => 300,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                Tagihan::create([
                    'id_pelanggan'  => $pid,
                    'id_penggunaan' => $penggunaan->id,
                    'tahun'         => 2025,
                    'jumlah_meter'  => 300, // meter_akhir - meter_awal
                    'status'        => 'Belum Lunas',
                    'created_at'    => now(),
                    'updated_at'    => now(),
                ]);
            }
        });
    }
}
