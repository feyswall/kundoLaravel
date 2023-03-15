<?php

namespace App\Http\Controllers\Super\Area;

use App\Models\Trunk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TrunksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Branch $branch)
    {
        $trunks = $branch->trunk;
        return view("interface.super.maeneo.shina.orodhaShina")
            ->with('areas', $trunks)
            ->with('branch', $branch );
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
        $branch_id = $request->branch_id;
        $rules = [
            'shina' => [
                'required', 'string', 'max:50',
                Rule::unique('trunks', 'name')->where(function ($query) use ($branch_id) {
                    return $query->where('branch_id', $branch_id);
                }),
            ]
        ];

        $messages = [
            "shina.required" => "Ni lazima kujaza jina la kata",
            "shina.string"  => "Jina lazima lihusishe maneno pekee",
            "shina.max" => "Jina Lihusishe herufi zisizozidi hamsini (50)",
            "shina.unique" => "Jina limeshasajiriwa"
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

        $area = Trunk::create([
            'name' => $request->shina,
            'branch_id' => $request->branch_id,
        ]);

        if ( $area ){
            return redirect()->back()
                ->with(['status' => 'success', 'message' => 'Shina Imetengenezwa']);
        }else{
            return redirect()->back()
                ->with(['status' => 'error', 'message' => 'Tumeshindwa Kutengeneza Tafadhali Jaribu Tena.']);
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trunk  $trunk
     * @return \Illuminate\Http\Response
     */
    public function show(Trunk $trunk)
    {
        // dd( $state );
        return view("interface.super.maeneo.shina.shinaMoja")
            ->with("trunk", $trunk);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trunk  $trunk
     * @return \Illuminate\Http\Response
     */
    public function edit(Trunk $trunk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trunk  $trunk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trunk $trunk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trunk  $trunk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trunk $trunk)
    {
        //
    }
}
