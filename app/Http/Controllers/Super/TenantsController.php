<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Tenant;
use App\Rules\PhoneNumber;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TenantsController extends Controller
{
    public function  assignTenant(Request $request){
        $tenant = Tenant::onlyTrashed('id', $request->input('tenant_'))->first();
        $obj = null;
        if ($request->input('apartment_id') !== null){
            $obj = Apartment::where('id', $request->input('apartment_id'))->first();
        }
        $tenant->tenable_type = get_class($obj);
        $tenant->tenable_id = $obj->id;
        $tenant->save();
         $tenant->restore();
        return redirect()->back()->with(['status' => 'success', 'message' => 'tenant was assigned apartment']);
    }

    public function storeTenant(Request $request) {
        $rules = [
            'name' => 'required|string',
            'phone' => ['required', new PhoneNumber()],
//            'apartment_id' => ['required', new ApartmentId() ]
        ];
        $messages = [];
        $validate = Validator::make($request->all(), $rules, $messages);
        if ( $validate->fails() ){
            return redirect()->back()->withErrors($validate->errors());
        }
        // selecting the tenant table
        $apart = Apartment::where('id', $request->input('apartment_id') )->first();
        if ( !$apart ) {
            return redirect()->back()->with(['status' => 'error', 'message' => 'apartment error, please trt again.']);
        }
        $tenant = new Tenant;
        $tenant->name = $request->input('name');
        $tenant->gender = $request->input('gender');
        $tenant->phoneNumber = $request->input('phone');
        $tenant = $apart->tenant()->save( $tenant );

        if ( $tenant ){
            return redirect()->back()->with(['status' => 'success', 'message' => 'Tenant Created Successfully']);
        }
        return redirect()->back()->with(['status' => 'error', 'message' => 'error in creating tenant please try again']);
    }


    public function storeTenantForShop(Request $request) {
        $rules = [
            'name' => 'required|string',
            'phone' => ['required', new PhoneNumber()],
//            'apartment_id' => ['required', new ApartmentId() ]
        ];
        $messages = [];
        $validate = Validator::make($request->all(), $rules, $messages);
        if ( $validate->fails() ){
            return redirect()->back()->withErrors($validate->errors());
        }
        // selecting the tenant table
        $shop = Shop::where('id', $request->input('shop_id') )->first();
        if ( !$shop ) {
            return redirect()->back()->with(['status' => 'error', 'message' => 'shop error, please trt again.']);
        }
        $tenant = new Tenant();
        $tenant->name = $request->input('name');
        $tenant->gender = $request->input('gender');
        $tenant->phoneNumber = $request->input('phone');
        $tenant = $shop->tenant()->save( $tenant );

        if ( $tenant ){
            return redirect()->back()->with(['status' => 'success', 'message' => 'Tenant Created Successfully']);
        }
        return redirect()->back()->with(['status' => 'error', 'message' => 'error in creating tenant please try again']);
    }


    public function deleteTenant($id)
    {
        $tenant = Tenant::where('id', $id)->first();
        $tenant->delete();
        return redirect()->back()->with(['status' => 'success', 'message' => 'Tenant was deleted successfully']);
    }
}
