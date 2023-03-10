<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('users')->delete();

       $user = User::create([
           'name' => "Feyswal Alphonce",
           'email' => 'owner@gmail.com',
           'password' => Hash::make('password'),
       ]);
       $user->assignRole('super');

        // $mbunge = User::create([
        //     'name' => "Juma Pesambili",
        //     'email' => 'mbunge@gmail.com',
        //     'password' => Hash::make('password'),
        //     'leader_id' => 515,
        // ]);
        // $mbunge->assignRole('mbunge');
    }
}
