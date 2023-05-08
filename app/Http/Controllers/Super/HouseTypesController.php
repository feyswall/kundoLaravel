<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\HouseType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HouseTypesController extends Controller
{
    public function showAll()
    {
        $houseTypes = HouseType::all();
        return view('interface.super.houseTypes.allHouseTypes')
            ->with('houseTypes', $houseTypes);
    }

    public function storeHouseType(Request $request)
    {
        $rules = [
          'name' => 'required|unique:house_types,type_name'
        ];
        $message = [
          'name:unique' => 'The name already exists in the system'
        ];
        $validate = Validator::make($request->all(), $rules , $message );
        if ( $validate->fails() ){ return redirect()->back()->withErrors($validate->errors()); }
        $houseType = HouseType::create([
            'type_name' => $request->input('name'),
        ]);
        if ( !$houseType ){ return redirect()->back()->with(['status' => 'error', 'message' => 'some error occur please try again']); }
        return redirect()->back()->with(['status' => 'success', 'message' => 'House Category was created successfully...']);
    }
}
