<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!User::where('email', 'admin@example.com')->exists()){
            DB::table('users')->insert([
                [
                    'username' => 'admin1',
                    'email' => 'admin1@gmail.com',
                    'city_id' => '3550308',
                    'authority' => 1,
                    'admin' => 1,
                    'password' => Hash::make('password'),
                    'full_name' => 'administrador',
                    'position' => 'admin', 
                    'approved' => 1,
                ],
    
            ]);
        }
        
    }
}
