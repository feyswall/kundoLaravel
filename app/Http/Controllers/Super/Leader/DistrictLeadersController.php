<?php

namespace App\Http\Controllers\Super\Leader;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Super\LeadersController;
use App\Http\Requests\ValidateDistrictLeaderRequest;
use App\Models\District;
use App\Models\Leader;
use Illuminate\Http\Request;

class DistrictLeadersController extends Controller
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
    public function store(ValidateDistrictLeaderRequest $request)
    {
        $obj = new LeadersController();
        $leader = $obj->store( $request );
        $obj->attachMany( $leader->districts(), $request );
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
     *
     * @param  \App\Models\Leader  $leader
     * @return \Illuminate\Http\Response
     */
    public function edit(Leader $leader)
    {
        //
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
        //
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
