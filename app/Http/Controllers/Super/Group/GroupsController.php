<?php

namespace App\Http\Controllers\Super\Group;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Post;
use Illuminate\Http\Request;


class GroupsController extends Controller
{
    /**
     * this function displas all the grops that are 
     * found in our system
     * @return 
     */
    public function index() {
        $groups = Group::all();
        return view("interface.super.vikundi.orodhaMakundi")
        ->with("groups", $groups);
    }


    public function removePost(Request $request){
        $group = Group::find($request->group);
        $group->posts()->detach( $request->post );
        return redirect()->back()->with(['status' => 'success', 'message' => 'Umefanikiwa Kutoa Wathifa']);
    }


    public function addPost( Request $request ){
        // dd( $request->all() );
        $group = Group::find($request->group);
        $group->posts()->attach($request->post);
        return redirect()->back()->with(['status' => 'success', 'message' => 'Umefanikiwa Kuongeza Wathifa']);
    }

}
