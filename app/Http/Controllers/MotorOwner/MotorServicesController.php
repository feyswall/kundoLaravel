<?php

namespace App\Http\Controllers\MotorOwner;

use App\Events\GeneralSmsEvent;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Super\ReceiversController;
use App\Models\Motor;
use App\Models\Service;
use App\Models\ServiceType;
use Carbon\Carbon;
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
        $motor = $owner->motors->first();
        $cat = $motor->motor_category;
        $message = "Service:\n";
        $message .= ucfirst($cat->name).": ".ucfirst($motor->identity_name)."\n";
        $userTotal = 0;
        $systemTotal = 0;
        foreach( $request->serviceType as $key => $type ){
            $typeObj = ServiceType::find($type);
            $typeObj->cost;
            $request->itemCount[$key];
            $count = $request->itemCount[$key];
            $message .= ucwords($typeObj->name)."-".$count."(".($count > 1 ? 'times':'time').")-Cost@(Tsh ".number_format($typeObj->cost, 0, '.', ',')."/=)\n";
            $userTotal += ($count * $request->cost[$key]);
            $systemTotal += ($count * $typeObj->cost);
        }
        $lastTimeService = Service::latest()->first();
        $lastTimeDate = null;
        if ( $lastTimeService ){
            $lastTimeDate = Carbon::parse($lastTimeService->created_at)->format('M-d-Y');
        }
        $message .= "Jumla ".number_format($userTotal, 0, '.', ',')."/=\n";
        $message .= "Jumla(System) ".number_format($systemTotal, 0, '.', ',')."/=\n";
        $message .= $lastTimeDate ? "Service ya mwisho ilikuwa Tar. ".$lastTimeDate."\n" : '';
        $message .= "Fungua\n";

        $service = Service::create([
            'motor_id' => $request->motor,
            'owner_id' => $owner->id,
            'garage_id' => $request->garage,
        ]);
        $message .= route('super.services.moja', $service->id );

        foreach( $request->serviceType as $key => $type ){
            $typeObj = ServiceType::find($type);
            $service->service_types()->attach($type,
                ['cost' => $request->cost[$key],
                 'prevCost' => $typeObj->cost,
                 'itemCount' => $request->itemCount[$key],
                ]);
        }
        $receivers = ReceiversController::myReceivers();
        foreach ( $receivers as  $receiver ){
            event(new GeneralSmsEvent(
                [$receiver],
                function($response){ info(json_encode($response)); },
                $message,
                $receiver['rec'],
                'submitService'
            ));
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
