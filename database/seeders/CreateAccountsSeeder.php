<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateAccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $general = Role::create([
            'name' => 'general',
        ]);

        $leaders = Leader::all();

        foreach ( $leaders as $leader )
        {

        }

        $user = User::create([
            'name' => "Feyswal Alphonce",
            'email' => 'owner@gmail.com',
            'password' => Hash::make('password'),
        ]);

        $user->assignRole('general');

         $mbunge = User::create([
             'name' => "Juma Pesambili",
             'email' => 'mbunge@gmail.com',
             'password' => Hash::make('password'),
             'leader_id' => 515,
         ]);
         $mbunge->assignRole('mbunge');
    }
}
