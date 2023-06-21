<?php

namespace App\Http\Controllers\Assistants\Area;

use App\Http\Controllers\Controller;
use App\Models\Leader;
use App\Models\Post;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit(Region $region)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Region $region)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        //
    }

    /**
     * return
     */
    public function getDistrictsApi($id){
        $region = Region::find( $id );
        if ( $region ){
            $districts = $region->districts;
            $leaders = $region->leaders;
            $leadersWithPosts = [];
            foreach( $leaders as $leader ){
                if ( $leader->pivot->isActive == true ){
                    $post = $this->apiPostObj($leader->pivot->post_id);
                    $leadersWithPosts[] = ['leader' => $leader, 'post' => $post, 'region' => $region];
                }
            }
            $leadersWithPosts = collect($leadersWithPosts)->groupBy('leader.side');
            return ['status' => 'success', 'response' => $districts, 'leaders' => $leadersWithPosts, 'region' => $region ];
        }else{
            return ['status' => 'error', 'message' => 'Mkoak Haukupatikana.'];
        }
//        return ['status' => 'success'];
    }

    /**
     * @param $id
     * @return mixed
     */
    public function apiPostObj($id) {
        $post = Post::find( $id );
        return $post;
    }
}
