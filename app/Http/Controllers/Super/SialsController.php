<?php

namespace App\Http\Controllers\Super;

use App\Events\GeneralSmsEvent;
use App\Models\LetterNumber;
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
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PDF;
use Illuminate\Http\Request;

class SialsController extends Controller
{
    protected $auth_user;

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
    public function storeTrue(Request $request)
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
    }


    public function store(Request $request){
        $authUser = Auth::user();
        $areaToBeSend = json_decode($request->input('area'));
        $selectedCopyToLeaders = [];
        if ( $request->copyTo ){
            foreach($request->copyTo as $requestCopyTo ){
                $selected = explode(',', $requestCopyTo);
                $selectedLeaderId = $selected[0];
                $selectedPostId = $selected[1];
                $copyToLeader = Leader::where('id', $selectedLeaderId)
                    ->with('posts', function ($query) use ($selectedPostId) {
                        $query->where('post_id', $selectedPostId)->first();
                    })
                    ->first();
                $selectedCopyToLeaders[] = $copyToLeader;
            }
        }
        $selectedSendToLeaders = [];
        foreach($request->sendTo as $requestSendTo ){
            $selected = explode(',', $requestSendTo);
            $selectedLeaderId = $selected[0];
            $selectedPostId = $selected[1];
            $sendToLeader = Leader::where('id', $selectedLeaderId)
                ->with('posts', function ($query) use ($selectedPostId) {
                    $query->where('post_id', $selectedPostId)->first();
                })
                ->first();
            $selectedSendToLeaders[] = $sendToLeader;
        }

        $number = 1;
        $latestLetter = LetterNumber::latest()->first();
        $year = Carbon::now()->format("Y");
        if ( $latestLetter ){
            $currentYear = Carbon::now();
            $lastIntranceYear = Carbon::parse( $latestLetter->created_at );
            $number = !($currentYear->isSameYear($lastIntranceYear)) ? 1 : ($latestLetter->numberCount + 1);
        }
        $name = 'SMY-BRD/EKAM40/' . $year . '-0' . $number;

        if($request->input('btn') != 'send'){
            $datas = [
                'sials' => $request->input('content'),
                'title' => $request->input('title'),
                'copyTo' => $selectedCopyToLeaders,
                'sendTo' => $selectedSendToLeaders,
                'name' => $name,
            ];
            $pdf = PDF::loadView('interface.super.ziara.ziaraPdf', $datas);
            return $pdf->stream("challenge_No_".str_replace(['\s', '.', '/', '-', ':'], '_', now() ).".pdf");
        }
        LetterNumber::create([
            'number' => 'SMY-BRD/EKAM40/' . $year . '-0' . $number,
            'numberCount' => $number,
        ]);
        $datas = [
            'sials' => $request->input('content'),
            'title' => $request->input('title'),
            'copyTo' => $selectedCopyToLeaders,
            'sendTo' => $selectedSendToLeaders,
            'name' => $name,
         ];
        $pdf = PDF::loadView('interface.super.ziara.ziaraPdf', $datas);
        $pdfFile = $pdf->stream("challenge_No_".str_replace(['\s', '.', '/', '-', ':'], '_', now() ).".pdf");
        $path = "ziara/ziara_No_".str_replace(['\s', '.', '/', '-', ':'], '_', now() ).".pdf";
        Storage::put($path, $pdfFile );
        $rules = [
            'title' => 'required|min:4'
        ];
        $messages = [
            'title' => 'Tafadhali Jaza Yahusu'
        ];
        // $request->validate($rules, $messages);
        $vals = [
            'status' => 'fail',
            'message' => 'tatizo Halikufahamika Tafadhali Jaribu Tena'
        ];
        $image_path_particles = explode('/', $path);
        $image_name = end( $image_path_particles );
        if (Storage::exists("$path")) {
            $sialObjectData = [
                'letter_url' => $image_name,
                'note' => $request->input('content'),
                'title' => $request->input('title'),
                'area_name' => $areaToBeSend->area,
                'area_id' =>  $areaToBeSend->id,
                'letterNumber' => $name,
            ];

            $ziara = new Sial();
            $ziara->letter_url = $image_name;
            $ziara->note = $request->input('content');
            $ziara->title = $request->input('title');
            $ziara->area_name = $areaToBeSend->area;
            $ziara->area_id =  $areaToBeSend->id;
            $ziara->letterNumber = $name;

            $authUser->sials()->save($ziara);

            if ( $ziara ){
                foreach($selectedCopyToLeaders as $requestCopyTo ){
                    $selectedLeaderId = $requestCopyTo->id;
                    $selectedPostId = $requestCopyTo->posts->first()->id;
                    $copyToLeader = Leader::where('id', $selectedLeaderId)
                    ->with('posts', function ($query) use ($selectedPostId) {
                        $query->where('post_id', $selectedPostId);
                    })
                        ->first();
                    if ( $copyToLeader ) {
                        $ziara->leaders()->attach($copyToLeader->id, ['titled' => 'copyTo', 'receiver_post_id' => $selectedPostId]);
                    }
                }
                foreach($selectedSendToLeaders as $requestSendTo ){
                    $selectedLeaderId = $requestSendTo->id;
                    $selectedPostId = $requestSendTo->posts->first()->id;
                    $sendToLeader = Leader::where('id', $selectedLeaderId)
                        ->with('posts', function ($query) use ($selectedPostId) {
                            $query->where('post_id', $selectedPostId);
                        })
                        ->first();
                    if ( $sendToLeader ) {
                        $ziara->leaders()->attach($sendToLeader->id, ['titled' => 'sendTo', 'receiver_post_id' => $selectedPostId]);
                    }
                }


                $message = "KIMS Barua \n";
                $message .= "yah: ".$request->input('title')." \n";
                $message .= "Bonyeza Link kusoma zaidi \n";
                $message .= "".route('general.sial.show', $ziara->id)."\n";
                foreach($selectedCopyToLeaders as $copyToLeader ){
                    $message .= "Umepokea Nakala";
                    event(new GeneralSmsEvent(
                        [ ['id' => $copyToLeader->id , 'phone' => $copyToLeader->phone] ],
                        function($response){ info(json_encode($response)); },
                        $message,
                        $copyToLeader
                    ));
                }
                foreach($selectedSendToLeaders as $sendToLeader ){
                    event(new GeneralSmsEvent(
                        [ ['id' => $sendToLeader->id , 'phone' => $sendToLeader->phone] ],
                        function($response){ info(json_encode($response)); },
                        $message,
                        $sendToLeader
                    ));
                }

                return redirect()->route("super.sial.show", $ziara->id)->with([
                    'status' => 'success',
                    'message' => 'Barua Imetumwa',
                    'sialId' => $ziara->id,
                ]);
            }else{
                return redirect()->back()->with($vals);
            }
        }else{
            return redirect()->back()->with( $vals );
        }
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

        $receiverObjs = [];
        foreach( $sial->leaders()->where('titled', 'sendTo')->get() as $leader ) {
            $postId = $leader->pivot->receiver_post_id;
            $receiverObj = Leader::where('id', $leader->id)->with('posts', function ($query) use ($postId) {
                    $query->where('post_id', $postId);
                })->first();
            $receiverObjs[] = $receiverObj;
        }

        $copyToLeaders = [];
        foreach( $sial->leaders()->where('titled', 'sendTo')->get() as $leader ){
            $postId = $leader->pivot->receiver_post_id;
            $copyTo = Leader::where('id', $leader->id)->with('posts', function($query) use ($postId){
                $query->where('post_id', $postId);
            })->first();
            $copyToLeaders[] = $copyTo;
         }
        return view("interface.super.ziara.ziaraMoja")
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
