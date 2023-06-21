<?php

namespace App\Http\Controllers\Assistants\Leader;

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
        $leader = null;
        if( !($request->input('withLeader'))) {
            $leader = $obj->store($request);
            if (!$leader) {
                return redirect()->back()->with(['status' => 'error', 'message' => 'hatujaweza kumuweka kiongozi']);
            }
        }else{
            $leader = Leader::where('id', $request->input('leader_id'))->first();
            $output = $obj->assignPowerToPresentLeader(
                $request->input('leader_id'),
                $request->input('table'),
                $request->input('post_id'),
                $request->input('side_id'),
                $request->input('side_column')
            );
            if ($output['status'] == 'error') { return redirect()->back()->with($output); }
        }
        $responce = $obj->attachMany( $leader->districts(), $request, $leader );
        if ( $responce['response'] == 'failure'){
            return redirect()->back()->with(['status' => 'error', 'message' => 'Jaribio limeshindikana Tafadhali Jaribu Tena']);
        }
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
        return view('interface.assistants.viongozi.mkoa.badili_taarifa')->with('leader',$leader);
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
        $leaderObject->update($request, $leader);
        return redirect()->back()->with(['status' => "success", "message" => "Taarifa Zimebadirishwa."]);
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
