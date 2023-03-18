<?php

namespace App\Http\Controllers;

use App\Models\PdfDoor;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Storage;


class PdfDoorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function testPdf(Request $request)
    {

    }

    public function store(Request $request)
    {
        $number = PdfDoor::all()->count();

        $year = Carbon::now()->format("Y");
        $number = $number + 1;
        $name = 'SMY-BRD/EKAM40/' . $year . '-000' . $number;

        if ( $request->btn == 'send' ) {
            $datas = [
                'address' => $request->address,
                'content' => $request->input('content'),
                'copy' => $request->copy,
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
