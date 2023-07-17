<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create('lt_LT');

        DB::table('users')->insert([
            'name' => 'Saulius',
            'email' => 'saulius@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        foreach (range(1, 20) as $_) {
            DB::table('clients')->insert([
                'name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'personal_id' => $faker ->numerify('###########')
                
            ]);
        }
    }

   
}
