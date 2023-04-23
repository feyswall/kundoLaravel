<?php

namespace App\Http\Controllers\MotorOwner;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegionsController extends Controller
{
    public function ongezaMkoa(Request $request){
        $rules = [
            'region' => [
                'required', 'string', 'max:50', 'unique:regions,name'
            ]
        ];

//        Rule::unique('councils', 'name')->where(function ($query) use ($district_id) {
//            return $query->where('district_id', $district_id);
//        }),

        $messages = [
            'unique' => 'Mkoa Huu Tayari Umeshasajiriwa kwenye Mfumo',
        ];

        $validate = Validator::make($request->all() ,$rules, $messages );

        if( $validate->fails() ){
            return redirect()->back()->withErrors($validate->errors());
        }

        $region = Region::create([
            'name' => $request->region,
        ]);

        if ( !$region ){ return redirect()->back()->with(['status' => 'error', 'message' => 'Tumeshindwa Kutengeneza mkoa tafadhali jaribu tena']); }

        return redirect()->back()->with(['status' => 'success', 'message' => 'Mkoa Umesajiriwa']);
    }
}
