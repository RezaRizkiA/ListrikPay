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
            ['nama_level' => 'Super Admin'],
            ['nama_level' => 'Operator'],
            ['nama_level' => 'Pelanggan'],
        ]);
    }
}
