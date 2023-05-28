<?php

namespace App\Http\Controllers\Super\Leader;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Super\LeadersController;
use App\Http\Requests\ValidateWardLeaderRequest;
use App\Models\Leader;
use App\Models\Post;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Builder\Class_;

class WardLeadersController extends Controller
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
     */
    public function store(ValidateWardLeaderRequest $request)
    {
        $obj = new LeadersController();
        $leader = null;
        if( !($request->input('withLeader'))) {
            $leader = $obj->store($request);
            if (!$leader) {
                return redirect()->back()->with([
                    'status' => 'error',
                    'message' => 'hatujaweza kumuweka kiongozi, Mtumiaji Amesha sajiriwa',
                ]);
            }
        }else {
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
        $obj->attachMany( $leader->wards(), $request, $leader );
        return redirect()->back()
            ->with(['status' => 'success', 'message' => 'Kiongozi Amepewe Madaraka']);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Leader  $leader
     * @return \Illuminate\Http\Response
     */
    public function show(Leader $leader)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Leader  $leader
     * @return \Illuminate\Http\Response
     */
    public function edit(Leader $leader)
    {
        return view('interface.super.viongozi.mkoa.badili_taarifa')->with('leader',$leader);
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
        $temp = $leaderObject->update($request, $leader);
        if ( $temp['status'] == 'error'){
            if ( $temp['name'] == 'validation' ){
                return redirect()->back()->withErrors($temp['error']);
            }
        }else{
            return redirect()->back()->with(['status' => "success", "message" => "Taarifa Zimebadirishwa."]);
        }
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
