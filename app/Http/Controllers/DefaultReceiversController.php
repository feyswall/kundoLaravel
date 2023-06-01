<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class DefaultReceiversController extends Controller
{
    public function receivers()
    {
        $adminRole = Role::where('name', 'super')->first();
        $userHasRole = DB::table('model_has_roles')
            ->where('role_id', $adminRole->id)
            ->where('model_type', 'App\Models\User')
            ->pluck('model_id');
        $receivers = ['id' => 1, 'phone' =>  '255628960877'];
        $users = User::whereIn('id', $userHasRole)->with('leader')->get();
    }
}
