<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\Assistant;
use App\Models\User;
use App\Rules\PhoneNumber;
use Database\Seeders\AssistanceRoleSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tests\Models\Permission;

class AssistantsController extends Controller
{
    public function index()
    {
        $assistants = Assistant::all();
        return view("interface.super.assistants.all")
        ->with('assistants', $assistants);
    }

    public function show($id)
    {
        $assistant = Assistant::where('id', $id)->first();
        $userId = $assistant->user->id;

        $permissionsId = \Illuminate\Support\Facades\DB::table('model_has_permissions')
            ->where('model_type', 'App\Models\User')
            ->where('model_id', $userId )
            ->pluck('permission_id');

        $nonePermissions = \Illuminate\Support\Facades\DB::table('permissions')
            ->whereIn('id', $permissionsId)
            ->get();

        $permissions = \Illuminate\Support\Facades\DB::table('permissions')
            ->whereNotIn('id', $permissionsId)
            ->get();
        return view('interface.super.assistants.show')
        ->with('assistant', $assistant )
        ->with('permissions', $permissions)
        ->with('nonePermissions', $nonePermissions);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => ['required', 'unique:assistants,fullName'],
            'phone' => ['required', 'max:15', new PhoneNumber()],
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()){
            return redirect()->back()->withErrors($validate->errors());
        }
        $phone = preg_replace("/^0/", "255", $request->input('phone'));
        $phone = preg_replace("/\s/", "", $phone );
        $structuredName = strtolower(str_replace(' ', '', $request->input('name')));
        $email = $structuredName.".assistant@kims.com";
        $userExists = User::where('email', $email)->exists();
        if($userExists){
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Mtumiaji Tayari ameshasajiriwa, Tafadhali angalia kwenye Orodha'
            ]);
        }
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $email,
            'password' => Hash::make($structuredName),
        ]);
        if ( !$user ){
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Imeshindikana tafadhali jaribu tena'
            ]);
        }
        $assistant = Assistant::create([
            'fullName' => $request->input('name'),
            'gender' => $request->input('gender'),
            'phone' => $phone,
            'user_id' => $user->id
        ]);
        if ( !$assistant ){
            return redirect()->back()->with(['status' => 'error', 'message' => 'Imeshindikana tafadhali jaribu tena']);
        }

        $user->assignRole('assistance');
        return redirect()->back()->with(['status' => 'success', 'message' => 'Msaidizi amesajiriwa']);
    }

    public function givePermission(Request $request)
    {
        $rules = [
            'assistant' => ['required'],
            'permit' => 'required'
        ];
        $messages = ['assistant.required' => 'Tafadhali chagua Msimamizi'];
        $validate = Validator::make( $request->all(), $rules, $messages );
        if( $validate->fails() ){
            return redirect()->back()->withErrors($validate->errors());
        }
        $assistant = Assistant::where('id', $request->input('assistant'))->with('user')->first();
        $user = $assistant->user;
        foreach ($request->input('permit') as $permit){
            $user->givePermissionTo($permit);
        }
        if ( $assistant->user->hasPermissionTo($permit)){
            return redirect()->back()->with(['status' => 'success', 'message' => 'Amepewa Ruksa']);
        }
        return redirect()->back()->with(['status' => 'error', 'message' => 'Imeshindikana tafadhali jaribu tena']);
    }

    public function removePermission(Request $request)
    {
        $rules = [
            'assistant' => ['required'],
            'permit' => 'required'
        ];
        $messages = ['assistant.required' => 'Tafadhali chagua Msimamizi'];
        $validate = Validator::make( $request->all(), $rules, $messages );
        if( $validate->fails() ){
            return redirect()->back()->withErrors($validate->errors());
        }
        $assistant = Assistant::where('id', $request->input('assistant'))->with('user')->first();
        $user = $assistant->user;
        $permissions = $request->input('permit');
        foreach ( $permissions as $key => $permit ){
            $permission = \Spatie\Permission\Models\Permission::find( $permit );
            $user->revokePermissionTo($permission);
        }
        if ( $assistant->user->hasPermissionTo('grob_sials')){
            return redirect()->back()->with(['status' => 'error', 'message' => 'Imeshindikana tafadhali jaribu tena']);
        }
        return redirect()->back()->with(['status' => 'success', 'message' => 'Msimamizi ameondolewa ruksa']);
    }
}
