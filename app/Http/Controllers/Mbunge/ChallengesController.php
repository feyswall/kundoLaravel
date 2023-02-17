<?php

namespace App\Http\Controllers\Mbunge;

use App\Models\Challenge;
use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ChallengesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($from)
    {
        if ( !(\Illuminate\Support\Facades\Auth::user()) ){
            return redirect()->route('login');
        }
        $leader = \Illuminate\Support\Facades\Auth::user()->leader;
        if (!$leader ){
            return redirect()->back()->with(['status' => 'error', 'message' => 'Kujua Changamoto Yakupasa uwe kiongozi.']);
        }
        $challenges = Challenge::where('from', $from)
                        ->where('leader_id', $leader->id)->get();
        return view('interface.mbunge.changamoto.changamotoOrodha')
            ->with('challenges', $challenges);
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

    public function showExist(Challenge $challenge){
        return view('interface.mbunge.changamoto.preExist')
        ->with('challenge', $challenge);
    }


    public function preExistToExist(Challenge $challenge, Request $request)
    {

        $file = $request->file('pdfFile');

        $rules = ['pdfFile' => 'sometimes|mimes:pdf|max:10000'];

        $messages = ['mimes' => 'Tafadhali Weka Pdf Pekee'];

        $request->validate($rules, $messages);

        if ($file) {
            $path = Storage::putFile('pdfs', $file);
            $fileNamesParticles = explode('/', $path);
            $fileName = end($fileNamesParticles);
        }else{
            return redirect()->back()->with(['status' => 'error', 'message' => 'Kumetokea Tatizo Tfadhali Jaribu Tena.']);
        }

        $updata = [
            'status' => 'new',
            'form_url' => $fileName,
            ];

        $challenge->update( $updata );

        if ( !($challenge->form_url) ){
            return redirect()->back()->with(['status' => 'error', 'message' => 'Hatukuweza Kuhifadhi form tafadhali jaribu tena.']);
        }

        return redirect()->route('mbunge.challenges.fungua', $challenge);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $isImagePresent = false;
        
        $path = null;

        $user = Auth::user();

        $mbunge = $user->leader;

        $data = $mbunge->posts->where('deep', 'mbunge')->first();

        if ( !$data ){
            return redirect()->back()->with(['status' => 'error', 'message' => 'Hakikisha Umeingia Kama Mbunge']);
        }

        $file = $request->file('pdfFile');

        $rules = [
             'pdfFile' => 'sometimes|mimes:pdf|max:10000',
             'yahusu' => 'required|min:4'
             ];

        $messages = [
            'mimes' => 'Tafadhali Weka Pdf Pekee',
            'yahusu' => 'Tafadhali Jaza Yahusu'
        ];

        $request->validate($rules, $messages);

        if ( $file ){ 
            $path = Storage::putFile('pdfs', $file); 
            $fileNamesParticles = explode('/', $path );
            $isImagePresent = true;
            $fileName = end( $fileNamesParticles );
        }


        $state = $mbunge->states()->where('isActive', true)->first();
        if ( !$state ){
            return redirect()->back()->with(['status' => 'error', 'message' => 'Hakikisha Umeingia Kama Mbunge']);
        }
        $changamoto = $request->input('changamoto');

        $challenge = Challenge::create([
            'status' => 'preExist',
            'yahusu' => $request->input('yahusu'),
            'from' => $request->from,
            'challenge' => $changamoto,
            'state_id' => $state->id,
            'leader_id' => $mbunge->id,
            'feedback' => '',
        ]);

        if ( !$challenge )
        {
            if(Storage::exists("$path")){
                Storage::delete("$file");
                /*
                    Delete Multiple files this way
                    Storage::delete(['upload/test.png', 'upload/test2.png']);
                */
            }
            return redirect()->back()->with(['status' => 'error', 'message' => 'hatukuweza kuhifadhi Taalifa. Jaribu Tena']);
        }

        if ( isset($path) || $path ){ 
            if ($isImagePresent) {
                $challenge->assets()->create([
                    'type' => 'pdf',
                    'url' => $fileName,
                    'user_id' => $user->id
                ]);      
            }
         }
        return redirect()->route('mbunge.challenges.show.exist', $challenge);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Challenge  $challenge
     * @return \Illuminate\Contracts\View\View
     */
    public function submitChallenge()
    {
        return view('interface.mbunge.changamoto.wasirishaChangamoto')
            ->with('challenges');
    }


    /**
     * @param Challenge $challenge
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Challenge $challenge) :\Illuminate\Contracts\View\View
    {
       return view("interface.mbunge.changamoto.changamotoMoja")
            ->with('challenge', $challenge);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function edit(Challenge $challenge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Challenge $challenge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Challenge  $challenge
     * @return \Illuminate\Http\Response
     */
    public function destroy(Challenge $challenge)
    {
        //
    }
}
