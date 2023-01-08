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




 <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <div class="d-inline-block rounded-pill bg-dark text-white py-1 px-3 mb-3">Our Services</div>
                
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item bg-white text-center h-100 p-4 p-xl-5">
                        <img class="img-fluid mb-4" src="img/service/services1.jpeg" alt="">
                        <h4 class="mb-3"> Designing and planning </h4>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item bg-white text-center h-100 p-4 p-xl-5">
                        <img class="img-fluid mb-4" src="img/service/services2.jpeg" alt="">
                        <h4 class="mb-3"> Site analysis and consultation </h4>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item bg-white text-center h-100 p-4 p-xl-5">
                        <img class="img-fluid mb-4" src="img/service/services3.jpeg" alt="">
                        <h4 class="mb-3"> Construction services </h4>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item bg-white text-center h-100 p-4 p-xl-5">
                        <img class="img-fluid mb-4" src="img/service/services4.jpeg" alt="">
                        <h4 class="mb-3">Maitanance.</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>