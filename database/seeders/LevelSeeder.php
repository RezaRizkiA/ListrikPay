<?php
namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Level::insert([
            ['nama_level' => 'Super Admin',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            ['nama_level' => 'Operator',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            ['nama_level' => 'Pelanggan',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
