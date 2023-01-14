<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wilaya_area_snapshot = Area::where("name", "TAWI");

        if( $wilaya_area_snapshot->exists() ){
            $area_id = $wilaya_area_snapshot->first()->id;
            $posts = array(
                ['area_id' => $area_id, 'name' => 'mwenyekiti wa tawi', 'deep' => 'mwenyekiti'],
                ['area_id' => $area_id, 'name' => 'katibu wa tawi', 'deep' => 'katibu'],
                ['area_id' => $area_id, 'name' => 'mwenezi wa tawi', 'deep' => 'mwenezi'],
                ['area_id' => $area_id, 'name' => 'mjumbe wa tawi', 'deep' => 'mjumbe wilaya']
            );
            foreach( $posts as $key => $post ){
                Post::create( $post );
            }
        }
    }
}
