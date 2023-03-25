<?php

namespace Database\Seeders;

use App\Models\MotorCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MotorCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('motors')->delete();
        DB::table('motor_models')->delete();
        DB::table('motor_types')->delete();
        DB::table('motor_categories')->delete();
        MotorCategory::create(['name' => 'pikipiki']);
        MotorCategory::create(['name' => 'gari']);
    }
}
