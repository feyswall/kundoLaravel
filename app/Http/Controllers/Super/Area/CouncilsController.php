<?php

namespace App\Http\Controllers\Super\Area;

use App\Http\Controllers\Controller;
use App\Models\Council;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Region;

class CouncilsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(District $district)
    {
        $halmashauri = $district->councils;
        return view("interface.super.maeneo.Halmashauri.orodhaHalmashauri")
            ->with('areas', $halmashauri)
            ->with('district', $district );
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
    public function store(Request $request)
    {
        $rules = [
            'halmashauri' => 'required|string|max:50|unique:councils,name'
        ];

        $validate = Validator::make($request->all() ,$rules);

        if( $validate->fails() ){
            return redirect()->back()->withErrors($validate->errors());
        }

//        $region = Region::where("name", "Simiyu");
//
//        if ( ! ( $region->exists() ) ){
//            redirect()->back()->withErrors(['nullModal' =>  'Wilaya is Not Registered in The System']);
//        }

        $area = Council::create([
            'name' => $request->halmashauri,
            'district_id' => $request->wilaya_id
        ]);

        if ( $area ){
            return redirect()->back()
                ->with(['status' => 'success', 'message' => 'Wilaya Imetengenezwa']);
        }else{
            return redirect()->back()
                ->with(['status' => 'error', 'message' => 'Tumeshindwa Kutengeneza Tafadhali Jaribu Tena.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Council  $council
     * @return \Illuminate\Http\Response
     */
    public function show(Council $council)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Council  $council
     * @return \Illuminate\Http\Response
     */
    public function edit(Council $council)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Council  $council
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Council $council)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Council  $council
     * @return \Illuminate\Http\Response
     */
    public function destroy(Council $council)
    {
        //
    }
}
