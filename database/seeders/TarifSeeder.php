<?php
namespace Database\Seeders;

use App\Models\Tarif;
use Illuminate\Database\Seeder;

class TarifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tarif::insert([
            [
                'kode_tarif'  => 'R-1/TR 900 VA',
                'daya'        => 900,
                'tarifperkwh' => 1352.00,
            ],
            [
                'kode_tarif'  => 'R-1/TR 1.300 VA',
                'daya'        => 1300,
                'tarifperkwh' => 1444.70,
            ],
            [
                'kode_tarif'  => 'R-1/TR 2.200 VA',
                'daya'        => 2200,
                'tarifperkwh' => 1444.70,
            ],
            [
                'kode_tarif'  => 'R-2/TR 3.500-5.500 VA',
                'daya'        => 3500,
                'tarifperkwh' => 1699.53,
            ],
            [
                'kode_tarif'  => 'R-3/TR 6.600 VA ke atas',
                'daya'        => 6600,
                'tarifperkwh' => 1699.53,
            ],
        ]);

    }
}
