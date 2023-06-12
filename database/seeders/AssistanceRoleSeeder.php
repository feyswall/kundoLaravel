<?php

namespace Database\Seeders;

use App\Models\Assistant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class AssistanceRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          // create your roles
        //  $super_role = Role::create([
        //    'name' => 'assistance',
        //    ]);
         // create permissions to assign at the roles
         $assistanceDefaultPermissions = [
            ['name' => 'grob_assistance', 'presentable' => 'Yote Msimamizi'],
            ['name' => 'grob_house_apartments', 'presentable' => 'Yote Katika Nyumba'],
        ];
       foreach( $assistanceDefaultPermissions as $permission ){
        $permission_exists = Permission::where('name', $permission['name'])->exists();
        if( $permission_exists ){ continue; }
           Permission::create([
            'name' => $permission['name'],
             'presentable' => $permission['presentable'
             ]]);
        }

        // $user = User::create([
        //     'name' => 'Feyswal Assistance',
        //     'email' => 'fey2@gmail.com',
        //     'password' => Hash::make('password'),
        // ]);
        $assistance = Assistant::create([
            'fullName' => $user->name,
            'phone' => '255628960877',
            'gender' => 'male',
            'user_id' => $user->id,
        ]);
        $user->assignRole('assistance');
    }
}
