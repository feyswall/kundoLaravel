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
        $assistant = Assistant::wnere('id', $id)->first();
        return view('interface.super.assistants.show')
        ->with('assistant', $assistant );
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
}
