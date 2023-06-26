<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

//        $this->call( PermissionSeeder::class );
//         $this->call( UserSeeder::class );
//        $this->call( AreasTableSeeder::class );
//        $this->call( RegionTableSeeder::class );
//        $this->call( PostsTableSeeder::class );
//        $this->call(GroupsTableSeeder::class);
//        $this->call(groupPostTableSeeder::class);
//        $this->call( MotorCategorySeeder::class );
//        $this->call( MotorOwner::class );
//        $this->call( CharityCategoriesSeeder::class );
// $this->call(AssistanceRoleSeeder::class);
// $this->call(SialsTableSeeder::class );
        // $this->call( forSelectionnSeeder::class );
            $this->call( UserToAssistantsSeeder::class );

    }
}
