<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("groups")->delete();
        $groups = [
            ['name' => 'uwongozi wa chama mkoa', 'deep' => 'uwz_chama_M'], // done
            ['name' => 'kamati ya siasa mkoa', 'deep' => 'kmt_siasa_M'], // done
            ['name' => 'halmashauri kuu ya mkoa', 'deep' => 'h_kuu_M'], 

            ['deep' => 'jm_wke_M', 'name' => 'jumuiya ya wanawake mkoa'], // done
            ['deep' => 'jm_waz_M', 'name' => 'jumuiya ya wazazi mkoa'], // done
            ['deep' => 'jm_vj_M', 'name' => 'jumuiya ya vijana mkoa'], // done

            ['deep' => 'jm_wke_W', 'name' => 'jumuiya ya wanawake wilaya'], //done
            ['deep' => 'jm_waz_W', 'name' => 'jumuiya ya wazazi wilaya'],  // done
            ['deep' => 'jm_vj_W', 'name' => 'jumuiya ya vijana wilaya'],  // done

            ['name' => 'uwongozi wa chama wilaya', 'deep' => 'uwz_chama_W'], // done
            ['name' => 'kamati ya siasa wilaya', 'deep' => 'kmt_siasa_W'], // done
            ['name' => 'halmashauri kuu ya wilaya', 'deep' => 'h_kuu_W'], // done

            ['deep' => 'uwz_chama_K', 'name' => 'Uwongozi wa chama kata'],  // done
        ];

        foreach ( $groups as $group ){
            Group::create( $group );
        }
    }
}
