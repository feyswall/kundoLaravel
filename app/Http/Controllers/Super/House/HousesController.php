<?php

namespace App\Http\Controllers\Super\House;

use App\Http\Controllers\Controller;
use App\Models\House;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class HousesController extends Controller
{
    public function index()
    {;
        $houses = House::all();
        return view('interface.super.houses.allHouse')
            ->with('houses', $houses);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'location' => 'required'
        ];
        $messages = [
            'name.required' => 'The name field is required',
            'location.required' => 'The location field is required'
        ];
        $validate = Validator::make($request->all(), $rules, $messages );
        if ( $validate->fails() ){
            return redirect()->back()->withErrors( $validate->errors() ) ;
        }
        $house = House::create([
            'houseName' => $request->name,
            'location' => $request->location,
            'house_type_id' => $request->input('house_type_id'),
        ]);
        if ( !$house ){
            return redirect()->back()->with(['status' => 'error', 'message' => 'Something went wrong please Try again']);
        }
        return redirect()->back()->with(['status' => 'success', 'message' => 'House with Name '.$house->name.' was created successfully.']);
    }

    public function  show($id)
    {
        $house = House::where('id', $id)->first();
        return view('interface.super.houses.singleHouse')
            ->with('house', $house);
    }

}
