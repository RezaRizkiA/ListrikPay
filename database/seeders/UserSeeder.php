<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'username'          => 'superadmin',
                'email'             => 'superadmin@example.com',
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
                'remember_token'    => Str::random(10),
                'level_id'          => 1, // Super Admin
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'username'          => 'operator1',
                'email'             => 'operator1@example.com',
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
                'remember_token'    => Str::random(10),
                'level_id'          => 2, // Operator
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'username'          => 'pelanggan1',
                'email'             => 'pelanggan1@example.com',
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
                'remember_token'    => Str::random(10),
                'level_id'          => 3, // Pelanggan
                'created_at'        => now(),
                'updated_at'        => now(),
            ],

        ]);

    }
}
