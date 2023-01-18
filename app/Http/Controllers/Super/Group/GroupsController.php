<?php

namespace App\Http\Controllers\Super\Group;

use App\Http\Controllers\Controller;
use App\Models\Group;
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

}
