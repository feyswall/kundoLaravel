<?php

namespace App\Http\Controllers\Super\Area;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\AreaDescription;
use App\Models\District;
use App\Models\Region;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function Symfony\Component\Console\Helper\removeDecoration;

class DistrictsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wilaya = District::all();
        return view("interface.super.maeneo.wilaya.orodhaWilaya")
            ->with('areas', $wilaya);
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
          'wilaya' => 'required|string|max:50|unique:districts,name'
        ];

        $validate = Validator::make($request->all() ,$rules);

        if( $validate->fails() ){
            return redirect()->back()->withErrors($validate->errors());
        }

        $region = Region::where("name", "Simiyu");

        if ( ! ( $region->exists() ) ){
            redirect()->back()->withErrors(['nullModal' =>  'Wilaya is Not Registered in The System']);
        }

        $area = District::create([
            'name' => $request->wilaya,
            'region_id' => $region->first()->id
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
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Area $area)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        //
    }
}
