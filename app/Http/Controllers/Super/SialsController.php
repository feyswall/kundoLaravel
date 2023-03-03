<?php

namespace App\Http\Controllers\Super;

use App\Models\Sial;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Council;
use App\Models\District;
use App\Models\Division;
use App\Models\Leader;
use App\Models\Post;
use App\Models\Region;
use App\Models\Ward;
use Illuminate\Support\Facades\Storage;
use PDF;
use Illuminate\Http\Request;

class SialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sials = Sial::all();
        return view('interface.super.ziara.orodhaZiara')
        ->with('sials', $sials);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('interface.super.ziara.ingizaZiara');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $selectedCopyToLeaders = [];
        foreach($request->selectedCopyToOptions as $requestCopyTo ){
            $selected = explode(',', $requestCopyTo);
            $selectedLeaderId = $selected[0];
            $selectedPostId = $selected[1];
            $copyToLeader = Leader::where('id', $selectedLeaderId)
                ->with('posts', function ($query) use ($selectedPostId) {
                    $query->where('post_id', $selectedPostId);
                })
                ->first();
            $selectedCopyToLeaders[] = $copyToLeader;
        }

        $sendToPieces = explode(',', $request->selectedSendToOptions);
        $leaderId = $sendToPieces[0];
        $postId = $sendToPieces[1];

        $sendToLeader = Leader::where('id', $leaderId)
        ->with('posts', function($query) use ($postId){
            $query->where('post_id', $postId);
        })
        ->first();

        $sials = explode('-', $request->ziara );

        $datas = [
            'sials' => $sials,
            'title' => $request->yahusu,
            'copyTo' => $selectedCopyToLeaders,
            'sendTo' => $sendToLeader
         ];

        $pdf = PDF::loadView('interface.super.ziara.ziaraPdf', $datas);
        $pdfFile = $pdf->stream("challenge_No_".str_replace(['\s', '.', '/', '-', ':'], '_', now() ).".pdf");
        $path = "ziara/ziara_No_".str_replace(['\s', '.', '/', '-', ':'], '_', now() ).".pdf";
        Storage::put($path, $pdfFile );

        $rules = [
            'yahusu' => 'required|min:4'
        ];

        $messages = [
            'yahusu' => 'Tafadhali Jaza Yahusu'
        ];

        // $request->validate($rules, $messages);

        $vals = [
            'status' => 'fail',
            'message' => 'tatizo Halikufahamika Tafadhali Jaribu Tena'
        ];

        $image_path_particles = explode('/', $path);

        $image_name = end( $image_path_particles );

        if (Storage::exists("$path")) {
            $ziara = Sial::create([
                'letter_url' => $image_name,
                'note' => $request->ziara,
                'title' => $request->yahusu,
                'receiver_id' =>  $sendToLeader->id,
                'receiver_post_id' => $sendToLeader->posts->first()->id,
                'area_name' => $request->area['area'],
                'area_id' =>  $request->area['id'],
            ]);
            if ( $ziara ){
                foreach($request->selectedCopyToOptions as $requestCopyTo ){
                    $selected = explode(',', $requestCopyTo);
                    $selectedLeaderId = $selected[0];
                    $selectedPostId = $selected[1];
                    $copyToLeader = Leader::where('id', $selectedLeaderId)
                    ->with('posts', function ($query) use ($selectedPostId) {
                        $query->where('post_id', $selectedPostId);
                    })
                        ->first();
                    $ziara->leaders()->attach($copyToLeader->id , ['titled' => 'copyTo', 'receiver_post_id' => $selectedPostId]);                    
                }
                return json_encode([
                    'status' => 'success',
                    'message' => 'Barua Imetumwa',
                    'sialId' => $ziara->id,
                ]);
            }else{
                return json_encode($vals);
            }
        }else{
            return json_encode( $vals );
        }
;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sial  $sial
     * @return \Illuminate\Http\Response
     */
    public function show(Sial $sial)
    {
        if( !$sial ){ return redirect()->back()->with(['status' => 'error', 'message' => 'barua Haikupatikana']); }

        $fetchArea = AreasController::discoverArea($sial->area_name, $sial->area_id);

        if( $fetchArea && isset( $fetchArea['status']) && $fetchArea['status'] == 'error' ){ return redirect()->back()->with(['status' => 'error', 'message' => 'barua Haikupatikana']); }

        $areaObj = $fetchArea['data'];

        $receiverObj = Leader::where('id',  $sial->receiver_id )
        ->with('posts', function($query) use ($sial) {
            $query->where('post_id', $sial->receiver_post_id);
        })->first();

        $copyToLeaders = [];
        foreach( $sial->leaders as $leader ){
            $postId = $leader->pivot->receiver_post_id;
            $copyTo = Leader::where('id', $leader->id)->with('posts', function($query) use ($postId){
                $query->where('post_id', $postId);
            })->first();
            $copyToLeaders[] = $copyTo;
         }
        return view("interface.super.ziara.ziaraMoja")
        ->with("sial", $sial)
        ->with("sendTo", $receiverObj)
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
