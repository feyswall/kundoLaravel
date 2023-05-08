<?php

namespace App\Http\Controllers\Super\Apartment;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\House;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ApartmentsController extends Controller
{
    public function  show($id)
    {
        $tenants = Tenant::onlyTrashed()->get();
        $apartment = Apartment::where('id', $id)->first();
        return view('interface.super.apartments.showApartment')
            ->with('apartment', $apartment)
            ->with('tenants', $tenants);
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'cost' => 'required'
        ];
        $validate = Validator::make($request->all(), $rules );
        if ( $validate->fails() ){
            return redirect()->back()->withErrors( $validate->errors() );
        }
        $apartment= Apartment::create([
            'name' => $request->name,
            'description' => $request->description,
            'cost' => $request->input('cost'),
            'house_id' => $request->house_id,
            'desc' => $request->input('description'),
        ]);
        $house = House::find( $request->house_id );
        if ( !$apartment ){
            return redirect()->back()->with(['status' => 'error', 'message' => 'Something went wrong please try again']);
        }
        return redirect()->back()
            ->with('house', $house)
            ->with(['status' => 'success', 'message' => 'Apartmenr With Tha name '.$apartment->name.' was created successfully']);
    }
}
