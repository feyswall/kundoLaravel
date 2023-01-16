<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class groupPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('group_post')->delete();
        /** first group implementation */
        $uwz_chama_M = Group::where("deep", "uwz_chama_M")->first();
        /**  id collection of the required posts */
        $posts_names = [
            "mwenyekiti_mkoa", "katibu_mkoa", "mwenezi_mkoa"
        ];
        /** finding the ids selected posts */
        $fr_posts_ids = Post::whereIn('deep', $posts_names )->pluck('id');
        /** attach the values together */
        $uwz_chama_M->posts()->syncWithoutDetaching($fr_posts_ids);




        /** second group implementation */
        $jm_wke_M = Group::where("deep", "jm_wke_M")->first();
        /**  id collection of the required posts */
        $sec_posts_names = [
            "m_kiti_wk_M", "katibu_wk_M"
        ];
        /** finding the ids selected posts */
        $sec_posts_ids = Post::whereIn('deep', $sec_posts_names )->pluck('id');
        /** attach the values together */
        $jm_wke_M->posts()->syncWithoutDetaching($sec_posts_ids);



         
    }
}
