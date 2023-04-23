<?php

namespace App\Http\Controllers\MotorOwner;

use App\Http\Controllers\Controller;
use App\Models\Motor;
use App\Models\Service;
use App\Models\ServiceType;
use Database\Seeders\MotorOwner;
use Illuminate\Http\Request;

class MotorServicesController extends Controller
{
    public function motorService()
    {

    }

    public function seeAllMotors()
    {
        $authUser = auth()->user();
        if ( auth()->user() == null ){
            return redirect()->back()->with(['status' => 'error', 'message' => 'toka kwenye mfumo kisha login']);
        }
        $motors = $authUser->owner->motors;
        return view("interface.motorOwner.motors.allMotors")
            ->with('motors', $motors);
    }

    public function seeAllService(){
        $allServices = Service::all();
        return view('interface.motorOwner.services.allServices')
            ->with('services', $allServices);
    }

    public function createService(Motor $motor){
        return view("interface.motorOwner.services.motorToService")
            ->with('motor', $motor);
    }

    public function ongezaService(Request $request){
        $owner = auth()->user()->owner;
        if ( !$owner ){ return redirect()->back()->with(
            ['status' => 'error', 'message' => 'Wewe si Mmiliki wa chombo']);
        }
        $service = Service::create([
            'motor_id' => $request->motor,
            'owner_id' => $owner->id,
            'garage_id' => $request->garage,
        ]);
        foreach( $request->serviceType as $key => $type ){
            $typeObj = ServiceType::find($type);
            $service->service_types()->attach($type,
                ['cost' => $request->cost[$key],
                 'prevCost' => $typeObj->cost,
                 'itemCount' => $request->itemCount[$key],
                ]);
        }
        return redirect()->back()->with(['status' => 'success', 'message' => 'service zimesajiriwa']);
    }

    public function serviceMoja($id)
    {
        $service = Service::where('id', $id)->first();
        return view('interface.motorOwner.services.serviceMoja')
            ->with('service', $service);
    }
}
