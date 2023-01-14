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
        $area = "tawi";
        $posts = array(
            /** Uwongozi Tawi */
            ['area' => $area, 'deep' => 'mwenyekiti_tawi', 'name' => 'mwenyekiti'],
            ['area' => $area, 'deep' => 'katibu_tawi', 'name' => 'katibu'],
            ['area' => $area, 'deep' => 'mwenezi_tawi', 'name' => 'mwenezi'],
            ['area' => $area, 'deep' => 'mjumbe_tawi', 'name' => 'mjumbe wilaya'],
        );

        foreach ($posts as $key => $post) {
            Post::create($post);
        }


        $area2 = "kata";
        $secPosts = array(
            /** Uwongozi Kata */
            ['area' => $area2, 'deep' => 'mwenyekiti_kata', 'name' => 'mwenyekiti'],
            ['area' => $area2, 'deep' => 'katibu_kata', 'name' => 'katibu'],
            ['area' => $area2, 'deep' => 'mwenezi_kata', 'name' => 'mwenezi'],
            ['area' => $area2, 'deep' => 'diwani', 'name' => 'diwani'],
            ['area' => $area2, 'deep' => 'diwani_vm', 'name' => 'diwani viti maalum'],
            ['area' => $area2, 'deep' => 'mj_mkutano_mkuu_M', 'name' => 'mjumbe mkutano mkuu mkoa'],
            ['area' => $area2, 'deep' => 'mj_mkutano_mkuu_W', 'name' => 'mjumbe mkutano mkuu wilaya'],

            ['area' => $area2, 'deep' => 'm_kiti_wz_K', 'name' => 'mwenyekiti wazazi'],
            ['area' => $area2, 'deep' => 'katibu_wz_K', 'name' => 'katibu wazazi'],

            ['area' => $area2, 'deep' => 'm_kiti_wk_K', 'name' => 'mwenyekiti wanawake'],
            ['area' => $area2, 'deep' => 'katibu_wk_K', 'name' => 'katibu wanawake'],

            ['area' => $area2, 'deep' => 'm_kiti_vj_K', 'name' => 'mwenyekiti vijana'],
            ['area' => $area2, 'deep' => 'katibu_vj_K', 'name' => 'katibu vijana'],
            ['area' => $area2, 'deep' => 'hamasa_vj_K', 'name' => 'hamasa vijana'],
        );
        foreach ($secPosts as $key => $post) {
            Post::create($post);
        }
    }
}
