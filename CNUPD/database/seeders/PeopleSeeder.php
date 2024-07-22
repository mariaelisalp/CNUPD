<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 20; $i++) {
            DB::table('people')->insert([
                'name' => 'Nome ' . $i,
                'eye_color' => ['castanhos', 'azuis', 'verdes'][rand(0, 2)],
                'skin_color' => ['branco', 'pardo', 'preto', 'indígena', 'amarelo'][rand(0, 4)],
                'gender' => ['M', 'F'][rand(0, 1)],
                'weight' => rand(50, 100), // peso em kg
                'birth_date' => now()->subYears(rand(15, 60))->format('Y-m-d'),
                'missing' => rand(0, 1),
                'city_id' => '3550308',
                'missing_time_date' => now()->subDays(rand(1, 365))->format('Y-m-d H:i:s'),
                'time_date' => now()->format('Y-m-d H:i:s'),
                'age' => rand(1, 60),
                'father_name' => 'Pai ' . $i,
                'mother_name' => 'Mãe ' . $i,
                'height' => rand(150, 200), // altura em cm
                'other_features' => Str::random(10),
                'circumstances' => Str::random(20),
                'motivations' => Str::random(20),
            ]);
        }
    }
}
