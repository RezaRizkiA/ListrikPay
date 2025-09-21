<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

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
                'id_level'          => 1, // Super Admin
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'username'          => 'operator1',
                'email'             => 'operator1@example.com',
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
                'remember_token'    => Str::random(10),
                'id_level'          => 2, // Operator
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ]);

        $faker = Faker::create('id_ID');
        $data = [];

        for ($i = 1; $i <= 20; $i++) {
            $data[] = [
                'username'          => $faker->userName,
                'email'             => $faker->unique()->safeEmail,
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
                'remember_token'    => Str::random(10),
                'id_level'          => 3, // Operator
                'created_at'        => now(),
                'updated_at'        => now(),
            ];
        }
        User::insert($data);
    }
}
