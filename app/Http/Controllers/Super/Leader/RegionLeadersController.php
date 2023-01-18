<?php

namespace App\Http\Controllers\Super\Leader;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Super\LeadersController;
use App\Http\Requests\ValidateRegionLeaderRequest;
use App\Models\Leader;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class RegionLeadersController extends Controller
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
    public function store(ValidateRegionLeaderRequest $request)
    {
        $obj = new LeadersController();
        $leader = $obj->store( $request );
        $obj->attachMany( $leader->regions(), $request, $leader );
        return redirect()->back()->with(['status' => 'success', 'message' => 'Kiongozi Amesajiriwa']);
    }

    /**
     * Display the specified resource.
     *side
     * @param  \App\Models\Leader  $leader
     * @return \Illuminate\Http\Response
     */
    public function show(Leader $leader)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param  \App\Models\Leader  $leader
     * @return \Illuminate\Http\Response
     */
    public function edit(Leader $leader)
    {
        return view('interface.super.viongozi.mkoa.badili_taarifa')->with('leader',$leader);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Leader  $leader
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leader $leader)
    {

        $rules = [
            'firstName' => [
                'required', 'string', 'max:50',
            ],
            'middleName' => [
                'required', 'string', 'max:50',
            ],
            'lastName' => [
                'required', 'string', 'max:50',
            ],

            'phone' => [
                'required', 'string', 'max:15',
            ],
        ];

        $messages = [
            "firstName.required" => "Jina la kwanza lazima lijazwe",
            "firstName.string"  => "Jina la kwanza lazima liwe na maneno pekee",
            "firstName.max" => "Jina la kwanza lisizidi herufi hamsini (50)",

            "middleName.required" => "Jina la kati lazima lijazwe!",
            "middleName.string"  => "Jina la kati lihusishe maneno pekee",
            "middleName.max" => "Jina la kati lisizidi herufi hamsini (50)",

            "lastName.required" => "Jina la mwisho lazima lijazwe!",
            "lastName.string"  => "Jina lazima lihusishe maneno pekee",
            "lastName.max" => "Jina la mwisho lisizidi herufi hamsini (50)",

            "phone.required" => "Ni lazima kujaza namba",
            "phone.max" => "Namba zisizidi kumi na tano(15)",
        ];

        $validate = Validator::make($request->all() ,$rules, $messages );

        if( $validate->fails() ){
            return redirect()->back()->withErrors($validate->errors());
        }


        $leader->firstName = $request->firstName;
        $leader->middleName = $request->middleName;
        $leader->lastName = $request->lastName;
        $leader->phone = $request->phone;

        $leader->save();

       return redirect()->back()->with(['status' => "success", "message" => "Taarifa zimebadilishwa"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Leader  $leader
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leader $leader)
    {
        //
    }
}
