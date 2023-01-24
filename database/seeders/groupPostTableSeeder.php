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
        foreach( $fr_posts_ids as $post){
            $uwz_chama_M->posts()->attach($post);
        }

        
        /** second group implementation */
        $jm_wke_M = Group::where("deep", "jm_wke_M")->first();
        /**  id collection of the required posts */
        $sec_posts_names = [
            "m_kiti_wk_M", "katibu_wk_M"
        ];
        /** finding the ids selected posts */
        $sec_posts_ids = Post::whereIn('deep', $sec_posts_names )->pluck('id');
        /** attach the values together */
        $jm_wke_M->posts()->sync($sec_posts_ids);




        /** third group implementation */
        $jm_vjana_M = Group::where("deep", "jm_vj_M")->first();
        /**  id collection of the required posts */
        $thir_posts_names = [
            "m_kiti_vj_M", "katibu_vj_M", ["hamasa_vj_M"]
        ];
        /** finding the ids selected posts */
        $thir_posts_ids = Post::whereIn('deep', $thir_posts_names)->pluck('id');
        /** attach the values together */
        $jm_vjana_M->posts()->sync($thir_posts_ids);




        /** fourth group implementation */
        $jm_waz_M = Group::where("deep", "jm_waz_M")->first();
        /**  id collection of the required posts */
        $fourth_posts_names = [
            "m_kiti_wz_M", "katibu_wz_M"
        ];
        /** finding the ids selected posts */
        $fourth_posts_ids = Post::whereIn('deep', $fourth_posts_names)->pluck('id');
        /** attach the values together */
        $jm_waz_M->posts()->sync($fourth_posts_ids);




        /** fifth group implementation */
        $jm_wke_W = Group::where("deep", "jm_wke_W")->first();
        /**  id collection of the required posts */
        $fifth_posts_names = [
            "m_kiti_wk_W", "katibu_wk_W"
        ];
        /** finding the ids selected posts */
        $fifth_posts_ids = Post::whereIn('deep', $fifth_posts_names)->pluck('id');
        /** attach the values together */
        $jm_wke_W->posts()->sync($fifth_posts_ids);





        /** sixth group implementation */
        $jm_waz_W = Group::where("deep", "jm_waz_W")->first();
        /**  id collection of the required posts */
        $sixth_posts_names = [
            "m_kiti_wz_W", "katibu_wz_W"
        ];
        /** finding the ids selected posts */
        $sixth_posts_ids = Post::whereIn('deep', $sixth_posts_names)->pluck('id');
        /** attach the values together */
        $jm_waz_W->posts()->sync($sixth_posts_ids);





        /** sevnth group implementation */
        $jm_vj_W = Group::where("deep", "jm_vj_W")->first();
        /**  id collection of the required posts */
        $sevnth_posts_names = [
            "m_kiti_vj_W", "katibu_vj_W", "hamasa_vj_W"
        ];
        /** finding the ids selected posts */
        $sevnth_posts_ids = Post::whereIn('deep', $sevnth_posts_names)->pluck('id');
        /** attach the values together */
        $jm_vj_W->posts()->sync($sevnth_posts_ids);




        /** eighth group implementation */
        $uwz_chama_W = Group::where("deep", "uwz_chama_W")->first();
        /**  id collection of the required posts */
        $eighth_posts_names = [
            "m_kiti_vj_W", "katibu_vj_W", "hamasa_vj_W"
        ];
        /** finding the ids selected posts */
        $eighth_posts_ids = Post::whereIn('deep', $eighth_posts_names)->pluck('id');
        /** attach the values together */
        $uwz_chama_W->posts()->sync($eighth_posts_ids);





        /** nineth group implementation */
        $kmt_siasa_W = Group::where("deep", "kmt_siasa_W")->first();
        /**  id collection of the required posts */
        $nineth_posts_names = [
            "m_kiti_vj_W", "katibu_vj_W", "hamasa_vj_W", "mbunge", "m_kiti_wz_W", "m_kiti_wk_W"
            , "mkuu_wilaya", "wj_kamat_siasa", "mwenyekiti_wilaya", "katibu_wilaya", "mwenezi_wilaya"
        ];
        /** finding the ids selected posts */
        $nineth_posts_ids = Post::whereIn('deep', $nineth_posts_names)->pluck('id');
        /** attach the values together */
        $kmt_siasa_W->posts()->sync($nineth_posts_ids);






        /** tenth group implementation */
        $h_kuu_W = Group::where("deep", "h_kuu_W")->first();
        /**  id collection of the required posts */
        $tenth_posts_names = [
            "mwenyekiti_wilaya", "katibu_wilaya","mwenezi_wilaya",
            "m_kiti_wz_W", "katibu_wz_W",
            "m_kiti_wk_W", "katibu_wk_W",
            "m_kiti_vj_W", "katibu_vj_W", "hamasa_vj_W",
            "mkuu_wilaya",
            "diwani", "diwani_vm", "mwenyekiti_kata", "mwenezi_kata",
            "wj_h_kuu_wilaya"
            // sometimes wabunge ?! sina uhakika
        ];
        /** finding the ids selected posts */
        $tenth_posts_ids = Post::whereIn('deep', $tenth_posts_names)->pluck('id');
        /** attach the values together */
        $h_kuu_W->posts()->sync($tenth_posts_ids);




        /** elvnth group implementation */
        $uwz_chama_K = Group::where("deep", "uwz_chama_K")->first();
        /**  id collection of the required posts */
        $elvnth_posts_names = [
            "mwenyekiti_kata", "katibu_kata", "mwenezi_kata",
            "mj_mkutano_mkuu_W", "mj_mkutano_mkuu_M", "diwani", "diwani_vm",
            // sometime mbunge ? ! sina uhakika
        ];
        /** finding the ids selected posts */
        $elvnth_posts_ids = Post::whereIn('deep', $elvnth_posts_names)->pluck('id');
        /** attach the values together */
        $uwz_chama_K->posts()->sync($elvnth_posts_ids);




        /** twelvth group implementation */
        $kmt_siasa_M = Group::where("deep", "kmt_siasa_M")->first();
        /**  id collection of the required posts */
        $twelvth_posts_names = [
            "mwenyekiti_mkoa", "katibu_mkoa", "mwenezi_mkoa",
            "mkuu_mkoa",
            "m_kiti_wz_M", "m_kiti_wk_M", "m_kiti_vj_M", "wj_kamat_siasa_M" 
        ];
        /** finding the ids selected posts */
        $twelvth_posts_ids = Post::whereIn('deep', $twelvth_posts_names)->pluck('id');
        /** attach the values together */
        $kmt_siasa_M->posts()->sync($twelvth_posts_ids);





        /** thrth group implementation */
        $h_kuu_M = Group::where("deep", "h_kuu_M")->first();
        /**  id collection of the required posts */
        $thrth_posts_names = [
            "mwenyekiti_mkoa", "katibu_mkoa", "mwenezi_mkoa",
            "mkuu_mkoa",
            "m_kiti_wz_M", "m_kiti_wk_M", "m_kiti_vj_M", "wj_kamat_siasa_M",
            "wabunge", // wote mkoa
            "mwenyekiti_wilaya", "mkuu_wilaya", "wj_h_kuu_M"
        ];
        /** finding the ids selected posts */
        $thrth_posts_ids = Post::whereIn('deep', $thrth_posts_names)->pluck('id');
        /** attach the values together */
        $h_kuu_M->posts()->sync($thrth_posts_ids);

    }
}
