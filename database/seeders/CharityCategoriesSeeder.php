<?php

namespace Database\Seeders;

use App\Models\Charity;
use App\Models\CharityCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CharityCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $charities = [
            ['name' => 'Afya'],
            ['name' => 'Elimu'],
            ['name' => 'Usafirishaji'],
        ];
        foreach ( $charities as $charity ){
            CharityCategory::create([
                'name' => $charity['name'],
            ]);
        }
    }
}
