<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PostsController extends Controller
{
   public static function postWithLeaders(Collection $leaders, $side, $area)
   {
       $postsWithLeaderCollection = [];
       $uniqueLeaders = [];
       $uniqueIds = [];
       foreach ( $leaders as $leader ){
           if (!(in_array($leader->id, $uniqueIds))){
               $uniqueLeaders[] = $leader;
               $uniqueIds[] = $leader->id;
           }
       }
       foreach ($uniqueLeaders as $leader){
            $wardPostsId = Post::where('area', $area)
                ->where('side', $side)
                ->pluck('id');
            $leaderWithPosts = $leader->posts()
                ->whereIn('post_id', $wardPostsId)
                ->get();
            foreach ($leaderWithPosts as $post) {
                $postsWithLeaderCollection[$post->name][] = $leader;
            }
        }
        return $postsWithLeaderCollection;
   }
}
