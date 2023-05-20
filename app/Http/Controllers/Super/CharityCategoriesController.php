<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\CharityCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CharityCategoriesController extends Controller
{
    public function store( Request $request )
    {
        $rules = [
            'name' => 'required|unique:charity_categories,name'
        ];
        $validate = Validator::make( $request->all(), $rules );
        if ( $validate->fails() ){
            return redirect()->back()->withErrors($validate->errors());
        }
        $charity = new CharityCategory();
        $charity->name = $request->input('name');
        $charity->save();

        if ( !$charity ){
            return redirect()->back()->with(['status' => 'error', 'message' => 'Jaribio Limeshindikana Tafadhali Jaribu tena']);
        }
        return redirect()->back()->with(['status' => 'success', 'message' => "Usajiri Umefanikiwa"]);
    }
}
