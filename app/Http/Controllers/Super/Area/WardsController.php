<?php

namespace App\Http\Controllers\Super\Area;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Division $division)
    {
        $kata = $division->wards;
        return view("interface.super.maeneo.kata.orodhaKata")
            ->with('areas', $kata)
            ->with('division', $division );
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
            'kata' => 'required|string|max:50|unique:wards,name'
        ];

        $validate = Validator::make($request->all() ,$rules, $messages = []);

        if( $validate->fails() ){
            return redirect()->back()->withErrors($validate->errors());
        }

//        $region = Region::where("name", "Simiyu");
//
//        if ( ! ( $region->exists() ) ){
//            redirect()->back()->withErrors(['nullModal' =>  'Wilaya is Not Registered in The System']);
//        }

        $area = Ward::create([
            'name' => $request->kata,
            'division_id' => $request->division_id,
        ]);

        if ( $area ){
            return redirect()->back()
                ->with(['status' => 'success', 'message' => 'Kata Imetengenezwa']);
        }else{
            return redirect()->back()
                ->with(['status' => 'error', 'message' => 'Tumeshindwa Kutengeneza Tafadhali Jaribu Tena.']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ward  $ward
     * @return \Illuminate\Http\Response
     */
    public function show(Ward $ward)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ward  $ward
     * @return \Illuminate\Http\Response
     */
    public function edit(Ward $ward)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ward  $ward
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ward $ward)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ward  $ward
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ward $ward)
    {
        //
    }
}