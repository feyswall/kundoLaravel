<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->delete();
        Area::create(['name' => 'MKOA']);
        Area::create(['name' => 'WILAYA']);
        Area::create(['name' => 'ALMASHAURI']);
        Area::create(['name' => 'JIMBO']);
        Area::create(['name' => 'TARAFA']);
        Area::create(['name' => 'KATA']);
        Area::create(['name' => 'TAWI']);
    }
}
