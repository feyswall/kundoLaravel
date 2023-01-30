<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("posts")->delete();
        
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
            ['area' => $area2, 'deep' => 'mj_mkutano_mkuu_M', 'name' => 'mjumbe mkutano mkuu mkoa'],  // yupo mmoja
            ['area' => $area2, 'deep' => 'mj_mkutano_mkuu_W', 'name' => 'mjumbe mkutano mkuu wilaya'], // wapo watano

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


        $area3 = "tarafa";
        $thirdPosts = array(
            ['area' => $area3, 'deep' => 'af_tarafa', 'name' => 'afisa tarafa'],
        );
        foreach ($thirdPosts as $key => $post) {
            Post::create($post);
        }


        $area4 = "halmashauri";
        $fourthPosts = array(
            ['area' => $area4, 'deep' => 'mkulugenzi', 'name' => 'mkulugenzi'],
            ['area' => $area4, 'deep' => 'mtendaji', 'name' => 'mtendaji'],
        );
        foreach ($fourthPosts as $key => $post) {
            Post::create($post);
        }




        $area5 = "wilaya";
        $fifthPosts = array(
            /** Uwongozi Kata */
            ['area' => $area5, 'deep' => 'mwenyekiti_wilaya', 'name' => 'mwenyekiti'],
            ['area' => $area5, 'deep' => 'katibu_wilaya', 'name' => 'katibu'],
            ['area' => $area5, 'deep' => 'mwenezi_wilaya', 'name' => 'mwenezi'],
            ['area' => $area5, 'deep' => 'wj_mkt_kuu_taifa', 'name' => 'mjumbe wa mkutano mkuu taifa'], // wapo watatu
            ['area' => $area5, 'deep' => 'mkuu_wilaya', 'name' => 'mkuu wa wilaya'],
            ['area' => $area5, 'deep' => 'mbunge', 'name' => 'mbunge'],

            ['area' => $area5, 'deep' => 'm_kiti_wz_W', 'name' => 'mwenyekiti wazazi'],
            ['area' => $area5, 'deep' => 'katibu_wz_W', 'name' => 'katibu wazazi'],

            ['area' => $area5, 'deep' => 'm_kiti_wk_W', 'name' => 'mwenyekiti wanawake'],
            ['area' => $area5, 'deep' => 'katibu_wk_W', 'name' => 'katibu wanawake'],

            ['area' => $area5, 'deep' => 'm_kiti_vj_W', 'name' => 'mwenyekiti vijana'],
            ['area' => $area5, 'deep' => 'katibu_vj_W', 'name' => 'katibu vijana'],
            ['area' => $area5, 'deep' => 'hamasa_vj_W', 'name' => 'hamasa vijana'],

            ['area' => $area5, 'deep' => 'wj_kamat_siasa', 'name' => 'mjumbe wa kamati ya siasa'], // wapo watatu
            ['area' => $area5, 'deep' => 'wj_h_kuu_wilaya', 'name' => 'mjumbe wa halmashauri ya CCM wilaya'], // wapo kumi na tatu
        );
        foreach ($fifthPosts as $key => $post) {
            Post::create($post);
        }



        $area6 = "mkoa";
        $fifthPosts = array(
            /** Uwongozi Kata */
            ['area' => $area6, 'deep' => 'mwenyekiti_mkoa', 'name' => 'mwenyekiti'],
            ['area' => $area6, 'deep' => 'katibu_mkoa', 'name' => 'katibu'],
            ['area' => $area6, 'deep' => 'mwenezi_mkoa', 'name' => 'katibu wa itikadi na uenezi mkoa'],
            ['area' => $area6, 'deep' => 'wj_h_kuu_taifa_M', 'name' => 'mjumbe wa halmashauri kuu taifa (MNEC)'], // wapo watatu
            ['area' => $area6, 'deep' => 'mkuu_mkoa', 'name' => 'mkuu wa mkoa'],


            ['area' => $area6, 'deep' => 'm_kiti_wz_M', 'name' => 'mwenyekiti wazazi'],
            ['area' => $area6, 'deep' => 'katibu_wz_M', 'name' => 'katibu wazazi'],

            ['area' => $area6, 'deep' => 'm_kiti_wk_M', 'name' => 'mwenyekiti wanawake'],
            ['area' => $area6, 'deep' => 'katibu_wk_M', 'name' => 'katibu wanawake'],

            ['area' => $area6, 'deep' => 'm_kiti_vj_M', 'name' => 'mwenyekiti vijana'],
            ['area' => $area6, 'deep' => 'katibu_vj_M', 'name' => 'katibu vijana'],
            ['area' => $area6, 'deep' => 'hamasa_vj_M', 'name' => 'hamasa vijana'],

            ['area' => $area6, 'deep' => 'wj_kamat_siasa_M', 'name' => 'mjumbe wa kamati ya siasa'], // wapo watatu
            ['area' => $area6, 'deep' => 'wj_h_kuu_M', 'name' => 'mjumbe wa halmashauri ya CCM wilaya'], // wapo kumi na tatu
        );
        foreach ($fifthPosts as $key => $post) {
            Post::create($post);
        }


        $area7 = "jimbo";
        $sixth = array(
            /** Uwongozi Jimbo */
            ['area' => $area7, 'deep' => 'mbunge', 'name' => 'mbunge'],
        );
        foreach ($sixth as $key => $post) {
            Post::create($post);
        }



    }
}
