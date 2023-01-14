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
        dd($district);
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
        //
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
