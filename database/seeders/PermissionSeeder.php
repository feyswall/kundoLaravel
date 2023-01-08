<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // delete all the roles at first
        DB::table('roles')->delete();

        // create your roles
        $super_role = Role::create([
            'name' => 'super',
        ]);
        $mbunge_role = Role::create([
            'name' => 'mbunge'
        ]);

        // delete all permissions to start create a new ones
        DB::table('permissions')->delete();

        // create permissions to assign at the roles
        $superDefaultPermissions = [
            'index_users',
            'create_users',
            'show_users',
            'edit_users',
            'update_users',
            'destroy_users',
            'grob_users',
        ];
        $mbungeDefaultPermissions = [
            'index_users'
        ];
        foreach( $superDefaultPermissions as $permission ){
            Permission::create( ['name' => $permission] );
        }

        // assign permissions to a roles
        $super_role->syncPermissions( $superDefaultPermissions );
        $mbunge_role->syncPermissions( $mbungeDefaultPermissions );

    }
}
