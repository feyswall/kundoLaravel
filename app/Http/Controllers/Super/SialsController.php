<?php

namespace App\Http\Controllers\Super;

use App\Models\Sial;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use PDF;
use \Dompdf\Dompdf;
use Dompdf\Options;
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

        $ziara = explode('-', $request->ziara );

        $sials = $ziara;

       $datas = [ 'sials' => $sials, 'yahusu' => $request->yahusu ];

//        $pdf->loadHtml('interface.super.ziara.ziaraPdf.blade.php', $data);

        $pdf = PDF::loadView('interface.super.ziara.ziaraPdf', $datas);

        $pdfFile = $pdf->stream("challenge_No_".str_replace(['\s', '.', '/', '-', ':'], '_', now() ).".pdf");

        $path = "app/ziara_No_".str_replace(['\s', '.', '/', '-', ':'], '_', now() ).".pdf";

        Storage::put($path, $pdfFile );

        dd( $path );

        $isImagePresent = false;

        $path = null;

//        $file = $request->file('pdfFile');

        $rules = [
//            'pdfFile' => 'sometimes|mimes:pdf|max:10000',
            'yahusu' => 'required|min:4'
        ];

        $messages = [
//            'mimes' => 'Tafadhali Weka Pdf Pekee',
            'yahusu' => 'Tafadhali Jaza Yahusu'
        ];

        $request->validate($rules, $messages);

//        if ( $file ){
//            $path = Storage::putFile('ziara', $file);
//            $fileNamesParticles = explode('/', $path );
//            $isImagePresent = true;
//            $fileName = end( $fileNamesParticles );
//        }

        $ziara = $request->input('ziara');

        $ziara = Sial::create([
            'letter_url' => 'http://letter.pdf',
            'note' => $request->ziara,
            'title' => $request->yahusu
        ]);

        if ( !$ziara )
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

//        if ( isset($path) || $path ){
//            if ($isImagePresent) {
//                $challenge->assets()->create([
//                    'type' => 'pdf',
//                    'url' => $fileName,
//                    'user_id' => $user->id
//                ]);
//            }
//        }
        return redirect()->route('mbunge.challenges.show.exist', $ziara);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sial  $sial
     * @return \Illuminate\Http\Response
     */
    public function show(Sial $sial)
    {
        //
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
