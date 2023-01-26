<?php

namespace App\Http\Controllers\Super\Group;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;


class GroupsController extends Controller
{
    /**
     * this function displas all the grops that are 
     * found in our system
     * @return 
     */
    public function index() {
        $groups = Group::orderBy('id', 'desc')->get();
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




    public function editGroup(Request $request, Group $group)
    {
        $rule = [
            'group' => ['required', Rule::unique('groups', 'name')->ignore($group->id)],
        ];
        $messages = [];
        $request->validate($rule);

        // updating the name
        $group->name = $request->group;
        $group->save();

        return redirect()->back()->with(['status' => 'success', 'message' => 'Kamati Umebadirishwa.']);
    }



    public function storeWadhifa(Request $request)
    {
        $rule = [
            'group_name' => ['required', Rule::unique('groups', 'name')],
            'basedOn' => 'required'
        ];
        $messages = [];
        $request->validate($rule);

        $deep = preg_replace("/\s/", "_", $request->group_name);
        // updating the name
        Group::create([
            'name' => $request->group_name,
            'basedOn' => $request->basedOn,
            'deep' => $deep.'_gp',
        ]);
        return redirect()->back()->with(['status' => 'success', 'message' => 'Kamati Umetengenezwa.']);
    }

}
