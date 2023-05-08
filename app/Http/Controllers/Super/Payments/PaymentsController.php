<?php

namespace App\Http\Controllers\Super\Payments;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentsController extends Controller
{
    public function store(Request $request)
    {
        $nextM = Carbon::parse($request->date)->next('month')->format('M-d-Y');
        $rules = [
            'received' => 'required',
            'date' => 'required'
        ];
        $validate = Validator::make( $request->all(), $rules );
        if ( $validate->fails() ){
            return redirect()->back()->withErrors( $validate->errors() );
        }
        $apartment = Apartment::where('id', $request->apartment_id )->first();
        if ( !$apartment ){
            return redirect()->back()->with(['status' => 'error', 'message' => 'apartment error please try again']);
        }
        $reminder = $request->received % $apartment->cost;
        if ( $reminder != 0 ){
            $tester = $request->received / $apartment->cost;
            $recommended = floor( $tester ) * $apartment->cost;
            $tryWith =  $recommended != 0 ? $recommended : $apartment->cost;
            return redirect()->back()->with(['status' => 'error', 'message' => 'full month payments only, please try '.$tryWith.'/= Tsh']);
        }
        // checking if the month is paid or not
        $lastTenPayment = $apartment->payments()->latest('id')->limit(100)->get();
        // taking the month count
        $month_count = ( $request->received / $apartment->cost );
        $end_month = \Carbon\Carbon::parse($request->input('date'))->addMonths( $month_count )->format("Y-m-d");

        $data = $this->dateInteraction($lastTenPayment, $request->date , $month_count);
        if ( $data['status'] == 'error' ){
            return redirect()->back()->with(['status' => 'error', 'message' => $data['message']]);
        }

        $payment = $this->createPayment($apartment->cost, $request->received, $request->date,
            $end_month, $month_count, $apartment
        );
        if ( !$payment ){
            return redirect()->back()->with(['status' => 'error', 'message' => 'Unable to save the payment']);
        }
        return redirect()->back()->with(['status' => 'success', 'message' => 'payment was registered successfully']);
    }


    private function dateInteraction( $lastTenPayment, $date, $month_count): array
    {
        foreach ( $lastTenPayment as $lastPayment ){
            $start = Carbon::parse($lastPayment->start_month);
            $end = Carbon::parse($lastPayment->end_month);
            $checkDate = Carbon::parse( $date );
            $isIt = $checkDate->between( $start, $end );
            $orIsIt = $checkDate->addMonths($month_count)->between( $start, $end);
            if( $isIt || $orIsIt){
                $trueStart = $start->format('M-Y-d');
                $trueEnd = $end->format('M-Y-d');
                return ['status' => 'error', 'message' => "Date from ".$trueStart." To ".$trueEnd." Are Already Been Paid"];
            }
        }
        return ['status' => 'success'];
    }


    private function createPayment($cost, $received, $date, $endDate, $monthCount, $object) : Payment|null
    {
        $payment = new Payment();
            $payment->perMonth_payment = $cost;
            $payment->received_payment = $received;
            $payment->start_month = $date;
            $payment->end_month = $endDate;
            $payment->month_count = $monthCount;
        return  $object->payments()->save( $payment );
    }
}
