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
        $obj->attachMany( $leader->regions(), $request );
        return redirect()->back()->with(['status' => 'success', 'message' => 'Kiongozi Amesajiriwa']);
    }

    /**
     * Display the specified resource.
     *
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
           $leaderObject = new LeadersController;
           $leaderObject->update($request,$leader);
          
           return redirect()->back()->with(['status' => "success", "message" => "Taarifa zimesasishwa!"]);
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
