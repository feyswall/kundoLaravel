<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;
use Illuminate\Http\Request;

class MotorServiceTypesController extends Controller
{

    public function seeAllServiceTypes()
    {
        $serviceTypes = ServiceType::all();
        return view("interface.motorOwner.services.allServicesTypes")
            ->with('serviceTypes', $serviceTypes);
    }

    public function ongezaServiceType(Request $request)
    {
        $rules = [
            'name' => 'required|unique:service_types,name',
            'cost' => 'required',
        ];
        $request->validate($rules, ['name.unique' => 'Aina Hii ya ServicE tayari ipo kwenye mfumo']);
        $type = ServiceType::create([
            'name' => $request->name,
            'cost' => $request->cost,
            'owner_id' => auth()->user()->owner->id,
            'garage_id' => $request->garage,
        ]);
        if ($type){
            return redirect()->back()
                ->with(['status' => 'success', 'message' => 'Umefanikiwa Kusajiri']);
        }
    }

}
