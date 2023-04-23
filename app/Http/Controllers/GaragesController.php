<?php

namespace App\Http\Controllers;

use App\Models\Garage;
use App\Rules\PhoneNumber;
use http\Env\Response;
use Illuminate\Http\Request;

class GaragesController extends Controller
{
    public function seeAllGarages()
    {
        $garages = Garage::all();
        return view('interface.motorOwner.garage.garageList')
            ->with('garages', $garages);
    }

    public function ongezaGarage(Request $request)
    {
        $rules = [
          'name' => 'required|unique:garages,name',
          'phone' => [new PhoneNumber()],
        ];
        $messages = [
            'name.unique' => 'Jina la garage limeshasajiriwa katika mfumo',
        ];
        $request->validate($rules, $messages);
        $garage = Garage::create([
            'name' => $request->name,
            'region_id' => $request->region,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);
        return redirect()->back()->with(['status' => 'success', 'message' => 'garage imetengenezwa']);
    }

    public function garageChangedApi($id)
    {
        $garage = Garage::where('id', $id)->first();
        if ( !$garage ){ return response()->json(['obj' => []], 200); }
        $types = $garage->service_types;
        return response()->json(['obj' => $types], 200);
    }
}
