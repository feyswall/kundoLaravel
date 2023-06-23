<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class forSelectionnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::where('id', '!=', -2)->get();
        foreach( $posts as $post ){
            $post->update(['for_selection' => $post->name]);
            $post->save;
        }
    }
}
