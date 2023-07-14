<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use function Webmozart\Assert\Tests\StaticAnalysis\true;

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
                ->where('isActive', true )
                ->get();
            foreach ($leaderWithPosts as $post) {
                $postsWithLeaderCollection[$post->id][] = $leader;
            }
        }
        return $postsWithLeaderCollection;
   }

   public function areaChangeApi(Request $request)
   {
       $area = $request->area;
       $finalPosts = Post::where('area', $area)->get();
       return \Illuminate\Support\Facades\Response::json(['status' => 'success', 'response' => $finalPosts]);
   }

   public function areaLocationsApi(Request $request)
   {
        $apiData = json_decode(  $request->areaObj );
        $model = "\\App\\Models\\".$apiData->model;
        $areas = $model::all();
        return ['status' => 'success', 'response' => $areas];
   }
}
