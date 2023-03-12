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
            $query->where('leader_id', $this->authLeader->id );
            })->get();
        $sendTo = Sial::where('receiver_id', $this->authLeader->id )->get();
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
        $this->authorize('view', $sial);

        if (!$sial) {
            return redirect()->back()->with(['status' => 'error', 'message' => 'barua Haikupatikana ziara']);
        }

        $fetchArea = AreasController::discoverArea($sial->area_name, $sial->area_id);

        if ($fetchArea && isset($fetchArea['status']) && $fetchArea['status'] == 'error') {
            return redirect()->back()->with(['status' => 'error', 'message' => 'barua Haikupatikana eneo']);
        }

        $areaObj = $fetchArea['data'];

        $receiverObj = Leader::where('id',  $sial->receiver_id)
        ->with('posts', function ($query) use ($sial) {
            $query->where('post_id', $sial->receiver_post_id);
        })->first();

        $copyToLeaders = [];
        foreach ($sial->leaders as $leader) {
            $postId = $leader->pivot->receiver_post_id;
            $copyTo = Leader::where('id', $leader->id)
            ->with('posts', function ($query) use ($postId) {
                $query->where('post_id', $postId);
            })
            ->first();
            $copyToLeaders[] = $copyTo;
        }

        $copyToObj = DB::table('leader_sial')
        ->where('sial_id', $sial->id)
        ->where('leader_id', $this->authLeader->id )
        ->update([
            'seen' => true
        ]);

        return view('interface.general.ziara.ziaraMoja')
        ->with('sial', $sial)
        ->with("sendTo", $receiverObj)
        ->with('area', $areaObj)
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
