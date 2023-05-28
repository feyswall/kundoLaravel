<?php

namespace App\Http\Controllers\Super\Leader;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Super\LeadersController;
use App\Http\Requests\ValidateStateLeaderRequest;
use App\Models\Leader;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StateLeadersController extends Controller
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
     */
    public function store(ValidateStateLeaderRequest $request)
    {
        $firstAndLastName = strtolower($request->firstName)."".strtolower($request->lastName);
        $email = strtolower($firstAndLastName.".mbunge@kims.com" );
        $rules = [
            'email' => 'unique:users,email',
        ];
        $validate = Validator::make( ['email' => $email], $rules );
        if ( $validate->fails() ) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Email Imejirudia Katika Mfumo, Mtumiaji mwenye majina haya ameshasajiriwa'
            ]);
        }
        $user = \App\Models\User::create([
            'name' => $firstAndLastName,
            'email' => $email,
            'password' => Hash::make($firstAndLastName),
        ]);
        $obj = new LeadersController();
        $phone = preg_replace("/^0/", "255", $request->phone);
        $phone = preg_replace("/\s/", "", $phone );
        $leader = Leader::create([
            'firstName' => $request->firstName,
            'middleName' => $request->middleName,
            'lastName' => $request->lastName,
            'phone' => $phone,
            'side' => $request->side,
            'user_id' => $user->id,
        ]);
        if ( !$leader ){
            return redirect()->back()->with(['status' => 'error', 'message' => 'Usajiri umeshindikana  tafadhali jaribu tena.']);
        }
        $obj->attachMany( $leader->states(), $request, $leader );
         $user = $leader->user;
        $user->assignRole("mbunge");
        return redirect()->back()->with(['status' => 'success', 'message' => 'Kiongozi Amesajiriwa']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function edit(State $state)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, State $state)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        //
    }
}
