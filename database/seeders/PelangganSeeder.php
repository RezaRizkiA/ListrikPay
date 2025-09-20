<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $data = [];

        for ($i = 1; $i <= 200; $i++) {
            $data[] = [
                'nomor_kwh'      => $faker->unique()->numerify('##########'),
                'nama_pelanggan' => $faker->name(),
                'alamat'         => $faker->address(),
                'id_tarif'       => $faker->numberBetween(1, 3), // Assuming there are 3 tariff plans
                'created_at'   => now(),
                'updated_at'   => now(),
            ];
        }
        Pelanggan::insert($data);
    }
}
