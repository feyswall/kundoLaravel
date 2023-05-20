<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\Charity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CharitiesController extends Controller
{
    public function index()
    {
        $charities = Charity::all();
        return view('interface.super.charities.allCharities')
            ->with('charities', $charities);
    }

    public function show($id)
    {
        $charity = Charity::where('id', $id)->first();
        return view("interface.super.charities.showCharity")
            ->with('charity', $charity);
    }

    public function store(Request $request)
    {
       $rules = [
           'name' => 'required',
           'cost' => 'required',
           'description' => 'required',
           'charityType_id' => 'required',
           'inDate' => 'required',
       ];

       $validate = Validator::make( $request->all(), $rules );
       if ($validate->fails() ){
           return redirect()->back()->withErrors( $validate->errors() );
       }
       $charity = Charity::create([
            'name' => $request->input('name'),
            'cost' => $request->input( 'cost'),
            'description' => $request->input('description'),
            'inDate' => $request->input( 'inDate'),
            'charity_categories_id' => $request->input('charityType_id'),
       ]);
       if ( !$charity ){
           return redirect()->back()->with(['status' => 'error', 'message' => 'Mfuko wa msaada umeshinndwa kutengenezwa tafadhali jaribu tene..']);
       }
       return redirect()->back()->with(['status' => 'success', 'message' => 'Msaada umesajiriwa ...']);
    }
}
