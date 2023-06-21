<?php

namespace App\Http\Controllers\Assistants\Leader;

use App\Http\Controllers\Super\LeadersController;
use App\Http\Requests\ValidateTrunkLeaderRequest;
use App\Models\Trunk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TrunkLeadersController extends Controller
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



    public function store(ValidateTrunkLeaderRequest $request)
    {
        $obj = new LeadersController();
        $leader = $obj->store( $request );
        if ( !$leader ){
            return redirect()->back()->with(['status' => 'error', 'message' =>
            'hatujaweza kumuweka kiongozi Jina '.$request->firstName.' '.$request->lastName.' Limejirudia kwenye Mfumo']);
        }
        $obj->attachMany( $leader->trunks(), $request, $leader );
        return redirect()->back()
            ->with(['status' => 'success', 'message' => 'Kiongozi Amesajiriwa']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trunk  $trunk
     * @return \Illuminate\Http\Response
     */
    public function show(Trunk $trunk)
    {
        //
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
