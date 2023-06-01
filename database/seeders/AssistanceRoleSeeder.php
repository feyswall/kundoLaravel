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
         $super_role = Role::create([
           'name' => 'assistance',
           ]);
         // create permissions to assign at the roles
         $assistanceDefaultPermissions = [
            ['name' => 'index_assistance', 'presentable' => 'Ona Wasimamizi'],
            ['name' => 'create_assistance', 'presentable' => 'Tengeneza Wasimamizi'],
            ['name' => 'edit_assistance', 'presentable' => 'Badiri taarifa za Msimamizi'],
            ['name' => 'destroy_assistance', 'presentable' => 'Futa Msimamizi'],
            ['name' => 'grob_assistance', 'presentable' => 'Yote Msimamizi'],
        ];
       foreach( $assistanceDefaultPermissions as $permission ){
           Permission::create(['name' => $permission]);
       }
        $user = User::create([
            'name' => 'Feyswal Assistance',
            'email' => 'fey2@gmail.com',
            'password' => Hash::make('password'),
        ]);
        $assistance = Assistant::create([
            'fullName' => $user->name,
            'phone' => '255628960877',
            'gender' => 'male',
            'user_id' => $user->id,
        ]);
        $user->assignRole('assistance');
    }
}
