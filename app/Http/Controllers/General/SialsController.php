<?php

namespace App\Http\Controllers\General;

use App\Models\Sial;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Super\AreasController;
use App\Models\Leader;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SialsController extends Controller
{

    private $authLeader;

    public function  __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->authLeader = Auth::user()->leader;
            return $next($request);
        });
    }


    public function index()
    {
        $copyTo = Sial::select("*")
        ->whereHas('leaders', function ($query){
            $query->where('leader_id', $this->authLeader->id )
            ->where('titled', 'copyTo');
            })->get();

        $sendTo = Sial::select('*')
            ->whereHas('leaders', function ($query) {
                $query->where('leader_id', $this->authLeader->id);
            })->get();
        return view('interface.general.ziara.zuaraOrodha')
            ->with('copyTo', $copyTo )
            ->with('sendTo', $sendTo);
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
        //
    }




    public function show(Sial $sial)
    {
        if( !$sial ){ return redirect()->back()->with(['status' => 'error', 'message' => 'barua Haikupatikana']); }

        $fetchArea = AreasController::discoverArea($sial->area_name, $sial->area_id);

        if( $fetchArea && isset( $fetchArea['status']) && $fetchArea['status'] == 'error' ){ return redirect()->back()->with(['status' => 'error', 'message' => 'barua Haikupatikana']); }

        $areaObj = $fetchArea['data'];

        $receiverObjs = [];
        foreach( $sial->leaders()->where('titled', 'sendTo')->get() as $leader ) {
            $postId = $leader->pivot->receiver_post_id;
            $receiverObj = Leader::where('id', $leader->id)->with('posts', function ($query) use ($postId) {
                $query->where('post_id', $postId);
            })->first();
            $leader->pivot->seen = 1;
            $leader->pivot->save();
            $receiverObjs[] = $receiverObj;
        }

        $copyToLeaders = [];
        foreach( $sial->leaders()->where('titled', 'copyTo')->get() as $leader ){
            $postId = $leader->pivot->receiver_post_id;
            $copyTo = Leader::where('id', $leader->id)->with('posts', function($query) use ($postId){
                $query->where('post_id', $postId);
            })->first();
            $leader->pivot->seen = 1;
            $leader->pivot->save();
            $copyToLeaders[] = $copyTo;
        }

        return view('interface.general.ziara.ziaraMoja')
        ->with("sial", $sial)
        ->with("sendTos", $receiverObjs)
        ->with('area', $areaObj )
        ->with('copyTo', $copyToLeaders);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sial  $sial
     * @return \Illuminate\Http\Response
     */
    public function edit(Sial $sial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sial  $sial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sial $sial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sial  $sial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sial $sial)
    {
        //
    }


}
