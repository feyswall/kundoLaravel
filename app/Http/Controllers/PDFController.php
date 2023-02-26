<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use PDF;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF(Request $request)
    {
        $changamoto = $request->input('changamoto');
        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');

        $changamoto = explode('-', $changamoto );
//        $data = [
//            'title' => 'Welcome to ItSolutionStuff.com',
//            'date' => date('m/d/Y'),
//            'users' => $users
//        ];
//
        $data = ['changamotos' => $changamoto, 'firstName' => $firstName, 'lastName' => $lastName ];

        $pdf = PDF::loadView('interface.mbunge.changamoto.changamotoPDF', $data);
        return $pdf->stream("challenge_No_".str_replace(['\s', '.', '/', '-', ':'], '_', now() ).".pdf");
    }



    public function downloadPdf(Request $request)
    {
        /**this will force download your file**/
        return Storage::download($request->pdf);
    }

}


