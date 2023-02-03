<?php

namespace App\Http\Controllers\Super\Area;

use App\Http\Controllers\Controller;
use App\Models\Council;
use App\Models\Division;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class DivisionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Council $council)
    {
        $tarafa = $council->divisions;
        return view("interface.super.maeneo.tarafa.orodhaTarafa")
            ->with('areas', $tarafa)
            ->with('council', $council );
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
        $council_id = $request->council_id;

        $rules = [
            'tarafa' => [
                'required', 'string', 'max:50',
                Rule::unique('divisions', 'name')->where(function ($query) use ($council_id) {
                    return $query->where('council_id', $council_id);
                }),
            ]
        ];


        $messages = [
            "tarafa.required" => "Ni lazima kujaza jina la tarafa",
            "tarafa.string"  => "Jina lazima lihusishe maneno pekee",
            "tarafa.max" => "Jina Lihusishe herufi zisizozidi hamsini (50)",
            "tarafa.unique" => "Jina limeshasajiriwa"
        ];        

        $validate = Validator::make($request->all() ,$rules, $messages);

        if( $validate->fails() ){
            return redirect()->back()->withErrors($validate->errors());
        }

//        $region = Region::where("name", "Simiyu");
//
//        if ( ! ( $region->exists() ) ){
//            redirect()->back()->withErrors(['nullModal' =>  'Wilaya is Not Registered in The System']);
//        }

        $area = Division::create([
            'name' => $request->tarafa,
            'council_id' => $request->council_id,
        ]);

        if ( $area ){
            return redirect()->back()
                ->with(['status' => 'success', 'message' => 'Tarafa Imetengenezwa']);
        }else{
            return redirect()->back()
                ->with(['status' => 'error', 'message' => 'Tumeshindwa Kutengeneza Tafadhali Jaribu Tena.']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function show(Division $division)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function edit(Division $division)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Division $division)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function destroy(Division $division)
    {
        //
    }


    public function getWardsApi($id){
        $region = Division::find( $id );
        if ( $region ){
            $wards = $region->wards;
            return ['status' => 'success', 'response' => $wards ];
        }else{
            return ['status' => 'error', 'message' => 'Tarafa Haukupatikana.'];
        }
//        return ['status' => 'success'];
    }



}
