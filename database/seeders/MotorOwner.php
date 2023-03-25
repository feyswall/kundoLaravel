<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MotorOwner extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gen = \Spatie\Permission\Models\Role::where('name', 'motorOwner')->first();

        if (!$gen) {
            $general = \Spatie\Permission\Models\Role::create([
                'name' => 'motorOwner',
            ]);
        }
    }
}
