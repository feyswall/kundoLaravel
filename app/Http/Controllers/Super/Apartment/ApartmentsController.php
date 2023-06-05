<?php

namespace App\Http\Controllers\Super\Apartment;

use App\Http\Controllers\Controller;
use App\Http\Controllers\SmsConfigController;
use App\Models\Apartment;
use App\Models\House;
use App\Models\Tenant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ApartmentsController extends Controller
{
    private $today;

    public function __construct(){
        $this->today = Carbon::now()->addDays(10);
    }

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
            return redirect()->back()->with(['status' => 'error', 'message' => 'Kunajambo halikwenda sawa tafadhari jaribu  tena']);
        }
        return redirect()->back()
            ->with('house', $house)
            ->with(['status' => 'success', 'message' => 'Apartment Yenye Jina '.$apartment->name.' Imesajiriwa']);
    }

    public function queryUnpaid(){
        $apartments = Apartment::whereHas('tenant', function ($query){
            $query->where('deleted_at', null);
        })
            ->with('payments', function ($query){
                $query->latest()->limit(30)->get();
            })
            ->get();
        $unPaidApartments = [];
        foreach ( $apartments as $apartment ){
            $obj = $this->isApartmentPaid( $apartment );
            if (!($obj['status'])){
                $unPaidApartments[] = $apartment;
            }
        }
        return $unPaidApartments;
    }

    public function unpaid(){
       $unPaidApartments = $this->queryUnpaid();
        return \view('interface.super.apartments.allUnpaidApartments')
            ->with('apartments', $unPaidApartments );
    }

    public function isApartmentPaid(Apartment $apartment)
    {
        $today = $this->today;
        // getting each payment
        foreach ( $apartment->payments as $payment ){
            // checking if this month is paid
            $start = Carbon::parse($payment->start_month);
            $end = Carbon::parse($payment->end_month);
            $doesIt = $today->between( $start, $end );
            if ( $doesIt ){
                return ['status' => true, 'payment' => $payment];
            }
        }
        return ['status' => false ];
    }


    public function houseRentInspector()
    {
        // checking for the all houses whose end time is neal
        $apartments = Apartment::whereHas('tenant', function ($query){
        $query->where('deleted_at', null );
        })
        ->with('payments', function ($query){
            $query->latest()->limit(30)->get();
        })->get();
            $unPaidApartments = [];
            foreach ( $apartments as $apartment ){
                $obj = $this->isApartmentPaid( $apartment );
                 if ($obj['status']){
                     // checking if there is any payment that exceed this one
                     $anyOneGreater = $this->greaterThanPaid( $apartment, $obj['payment'] );
                 if ( $anyOneGreater['status'] ){
                    $obj['payment'] = $anyOneGreater['payment'];
                }else {
                     if (true) {
                         $today = $this->today;
                         // checking the remaining time
                         $paidEnd = Carbon::parse($obj['payment']->end_month);
                         $months = $today->diffInMonths($paidEnd);
                         // if ( $months < 1 ){
                         if (true) {
                             $days = $today->diffInDays($paidEnd);
                             $consideredDays = [30, 7];
                             if ( in_array($days, $consideredDays) ) {
                                 $unPaidApartments[] = [
                                     'apartment' => $apartment,
                                     'finalPayment' => $obj['payment'],
                                     'days' => $days
                                 ];
                             }
                         }
                     }
                }
            }
        }
        return $unPaidApartments ;
    }

    public function greaterThanPaid($apartment, $currentPaid)
    {
        $lastPayment = null;
        foreach ( $apartment->payments as $payment ){
            // checking if this month is paid
            $testEnd = Carbon::parse( $payment->end_month );
            $currentEnd = $currentPaid->end_month;
            $doesIt = $testEnd->greaterThan( $currentEnd );
            if ( $doesIt ){
                $lastPayment = $payment;
                break;
            }
        }
        if ( $lastPayment )
        {
            return ['status' => true, 'payment' => $lastPayment ];
        }
        return ['status' => false ];
    }

    public function  smsStringBuilder()
        {
            $message = null;
            $resonableObjects = 5;
            $houses = $this->houseRentInspector();
            if ( $houses ){
                $lastLoopHouse = null;
                if ( count($houses) < $resonableObjects ){
                    $message .= "Apartments: \n";
                    foreach ( $houses as $house ){
                        $lastLoopHouse = $house;
                        $message .= " ".$house['apartment']->house->houseName."-". $house['apartment']->name." \n";
                    }
                    $message .=  "Zimebaki siku ".$lastLoopHouse['days']."  kuisha kodi, ";
                    }else{
                        $message .= "Apartments: \n";
                        foreach ( $houses as $key => $house ){
                            $lastLoopHouse = $house;
                            $message .= " ".$house['apartment']->house->houseName."-". $house['apartment']->name." \n";
                            if ( $key == $resonableObjects ){ break; }
                        }
                        $message .= " na ".count($houses) - $resonableObjects. " Nyingine Zina siku ".$lastLoopHouse['days']." kuisha kodi, ";
                    }
                }
            return $message;
            }
    }


