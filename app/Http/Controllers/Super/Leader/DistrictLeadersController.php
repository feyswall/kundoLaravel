<?php

namespace App\Http\Controllers\Super\Leader;

use App\Http\Controllers\Controller;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidateDistrictLeaderRequest $request)
    {
        $leader = Leader::create([
            'firstName' => $request->firstName,
            'middleName' => $request->middleName,
            'lastName' => $request->lastName,
            'phone' => $request->phone
        ]);
        $leader->districts()->attach($request->side_id, [
            'isActive' => true,
            'post_id' => $request->post_id,
            'created_at' => now()
        ]);
        return redirect()->back()->with(['status' => 'success', 'message' => 'Kiongozi Amesajiriwa']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function show(District $district)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function edit(District $district)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, District $district)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function destroy(District $district)
    {
        //
    }
}
