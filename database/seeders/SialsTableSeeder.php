<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class SialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create permissions to assign at the roles
        $assistanceDefaultPermissions = [
        // ['name' => 'index_sials', 'presentable' => 'Ona Barua Zote'],
        // ['name' => 'create_sials', 'presentable' => 'Tengeneza Barua'],
        // ['name' => 'destroy_sials', 'presentable' => 'Futa Barua'],
        ['name' => 'grob_sials', 'presentable' => 'Yote Barua'],
            ];
            foreach( $assistanceDefaultPermissions as $permission ){
                $permissionExists = Permission::where('name', $permission['name'])->exists();
                if ( !$permissionExists ){
                    Permission::create(['name' => $permission['name'], 'presentable' => $permission['presentable']]);
                }
            }
    }
}
