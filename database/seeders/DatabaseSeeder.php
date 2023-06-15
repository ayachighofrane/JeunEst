<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        
        $user = User::create([
            'id'=>1,
            'nom'=>'ss',
            'prenom'=>'sss',
            'role'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('12345678'),
           // 'confirm_password'=>Hash::make('12345678'),
        
        ]);




        
    }
}
