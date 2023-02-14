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
        $challenges = \Illuminate\Support\Facades\Auth::user()->leader;
        if (!$challenges ){
            return redirect()->back()->with(['status' => 'error', 'message' => 'Kujua Changamoto Yakupasa uwe kiongozi.']);
        }
        $challenges = Challenge::where('from', $from)->get();
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

        $rules = [ 'pdfFile' => 'sometimes|mimes:pdf|max:10000' ];

        $messages = ['mimes' => 'Tafadhali Weka Pdf Pekee'];

        $request->validate($rules, $messages);

        $file = $request->file('pdfFile');

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
            'status' => 'new',
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
        return redirect()->route('mbunge.challenges.fungua', $challenge);
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
