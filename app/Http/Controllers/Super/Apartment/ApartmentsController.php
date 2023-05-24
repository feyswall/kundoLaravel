<?php

namespace App\Http\Controllers\Super\Apartment;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\House;
use App\Models\Tenant;
use Carbon\Carbon;
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
            return redirect()->back()->with(['status' => 'error', 'message' => 'Kunajambo halikwenda sawa tafadhari jaribu  tena']);
        }
        return redirect()->back()
            ->with('house', $house)
            ->with(['status' => 'success', 'message' => 'Apartmenr Yenye Jina '.$apartment->name.' Imesajiriwa']);
    }

    public function unpaid(){
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
        return \view('interface.super.apartments.allUnpaidApartments')
            ->with('apartments', $unPaidApartments );
    }

    public function isApartmentPaid(Apartment $apartment)
    {
        $today = Carbon::now();
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
}
