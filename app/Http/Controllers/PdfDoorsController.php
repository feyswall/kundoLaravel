<?php

namespace App\Http\Controllers;

use App\Models\LetterNumber;
use App\Models\PdfDoor;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Storage;


class PdfDoorsController extends Controller
{

    public function index()
    {
        $pdfs = PdfDoor::all();
        return view('pdfDoorAll')
            ->with('pdfs', $pdfs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pdfDoorCreate");
    }


    public function store(Request $request)
    {
        $number = 1;
        $latestLetter = LetterNumber::latest()->first();
        $year = Carbon::now()->format("Y");
        if ( $latestLetter ){
            $currentYear = Carbon::now();
            $lastIntranceYear = Carbon::parse( $latestLetter->created_at );
            $number = !($currentYear->isSameYear($lastIntranceYear)) ? 1 : ($latestLetter->numberCount + 1);
        }

        $name = 'SMY-BRD/EKAM40/' . $year . '-0' . $number;
        if ( !($request->copy) ){
            $request->copy = 'null';
        }
        if ( $request->btn == 'send' ) {
            $letter = LetterNumber::create([
                'number' => 'SMY-BRD/EKAM40/' . $year . '-0' . $number,
                'numberCount' => $number,
            ]);
            $datas = [
                'address' => $request->address,
                'content' => $request->input('content'),
                'copy' => $request->copy,
                'name' => $name,
            ];

            $pdf = PDF::loadView('pdfDoorGenerate', $datas);

            $pdfFile = $pdf->stream("myPdf_No_" . str_replace(['\s', '.', '/', '-', ':'], '_', now()) . ".pdf");
            $path = "pdfs/pdf_No_" . str_replace(['\s', '.', '/', '-', ':'], '_', now()) . ".pdf";
            Storage::put($path, $pdfFile);

            $image_path_particles = explode('/', $path);

            $image_name = end($image_path_particles);

            if (Storage::exists("$path")) {
                $padf = PdfDoor::create([
                    'url' => $image_name,
                    'content' => $request->input('content'),
                    'copy' => $request->copy,
                    'address' => $request->address,
                    'name' => $name,
                ]);
                return redirect()->route('pdf.door.index');
            } else {
                return redirect()->back()->with(['status' => 'error', 'message' => 'tafadhali jaribu tena']);
            }
        }else{
            $datas = [
                'address' => $request->address,
                'content' => $request->input('content'),
                'copy' => $request->copy,
                'name' => $name,
            ];
            $pdf = PDF::loadView('pdfDoorGenerate', $datas);
            return $pdf->stream("myPdf_No_" . str_replace(['\s', '.', '/', '-', ':'], '_', now()) . ".pdf");
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PdfDoor  $pdfDoor
     * @return \Illuminate\Http\Response
     */
    public function show(PdfDoor $pdfDoor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PdfDoor  $pdfDoor
     * @return \Illuminate\Http\Response
     */
    public function edit(PdfDoor $pdfDoor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PdfDoor  $pdfDoor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PdfDoor $pdfDoor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PdfDoor  $pdfDoor
     * @return \Illuminate\Http\Response
     */
    public function destroy(PdfDoor $pdfDoor)
    {
        //
    }
}
