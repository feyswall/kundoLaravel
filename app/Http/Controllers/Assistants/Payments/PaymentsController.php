<?php

namespace App\Http\Controllers\Assistants\Payments;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            return redirect()->back()->with(
                ['status' => 'error', 'message' => 'Tatizo limetokea tafadhali jaribu tena']);
        }
        $reminder = $request->received % $apartment->cost;
        if ( $reminder != 0 ){
            $tester = $request->received / $apartment->cost;
            $recommended = floor( $tester ) * $apartment->cost;
            $tryWith =  $recommended != 0 ? $recommended : $apartment->cost;
            return redirect()->back()->with([
                'status' => 'error',
                'message' => 'Malipo yanatakiwa kuwa ni ya miezi kamili, mf. mwezi 1,2,3,.., Unaweza Kulipia '.$tryWith.'/= Tsh'
            ]);
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

        $payment = $this->createPayment(
            $apartment->cost, $request->received, $request->date,
            $end_month, $month_count, $apartment, $apartment->tenant->id
        );
        if ( !$payment ){
            return redirect()->back()->with(['status' => 'error', 'message' => 'Malipo hayakuweza kuhifadhiwa']);
        }
        return redirect()->back()->with(['status' => 'success', 'message' => 'Umefanikiwa kuweka malipo']);
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
                return ['status' => 'error', 'message' => "Tarehe Kuanzia ".$trueStart." To ".$trueEnd." Zimeshalipiwa katika Apartment hii."];
            }
        }
        return ['status' => 'success'];
    }

    private function createPayment($cost, $received, $date, $endDate, $monthCount, $object, $tenant_id)
    {
        $authUser = Auth::user();
        $payment = new Payment();
            $payment->perMonth_payment = $cost;
            $payment->received_payment = $received;
            $payment->start_month = $date;
            $payment->end_month = $endDate;
            $payment->month_count = $monthCount;
            $payment->tenant_id = $tenant_id;
            $payment->sendable_type = $authUser::class;
            $payment->sendable_id = $authUser->id;
        return  $object->payments()->save( $payment );
    }
}
