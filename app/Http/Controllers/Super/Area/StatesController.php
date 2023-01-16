<?php

namespace App\Http\Controllers\Super\Area;

use App\Http\Controllers\Controller;
use App\Http\Requests\ValidateStateRequest;
use App\Models\District;
use App\Models\State;
use App\Rules\UniqueName;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class StatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(District $district)
    {
        $states = $district->states;
        $halmashauri = $district->councils;
        return view("interface.super.maeneo.halmashauri.orodhaHalmashauri")
            ->with('areas', $halmashauri)
            ->with('states', $states)
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
    public function store(ValidateStateRequest $request)
    {   
        $district_id = $request->district_id;

        $rules = [
            'jimbo' => [
                'required', 'string', 'max:50',
                Rule::unique('states', 'name')->where(function ($query) use ($district_id) {
                    return $query->where('district_id', $district_id);
                }),
            ]
        ];

        $messages = [
            "jimbo.required" => "Ni lazima kujaza jina la jimbo",
            "jimbo.string"  => "Jina lazima lihusishe maneno pekee",
            "jimbo.max" => "Jina Lihusishe herufi zisizozidi hamsini (50)",
            "jimbo.unique" => "Jina limeshasajiriwa"
        ];    

        $validate = Validator::make($request->all() ,$rules, $messages);

        if( $validate->fails() ){
            return redirect()->back()->withErrors($validate->errors());
        }

        $area = State::create([
            'name' => $request->jimbo,
            'district_id' => $request->district_id,
        ]);

        if ( $area ){
            return redirect()->back()
                ->with(['status' => 'success', 'message' => 'Jimbo Imetengenezwa']);
        }else{
            return redirect()->back()
                ->with(['status' => 'error', 'message' => 'Tumeshindwa Kutengeneza Tafadhali Jaribu Tena.']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\State  $state
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        // dd( $state );
        return view("interface.super.maeneo.jimbo.jimboMoja")
        ->with("state", $state);
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
