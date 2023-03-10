<?php

namespace App\Http\Controllers\Super;

use App\Models\MotorType;
use App\Models\Owner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OwnersController extends Controller
{
    public function createNewOwnerLogic($request)
    {
        $validate = $this->validateRequest($request);
        if ( $validate['status'] == 'error'){
            return $validate['output'];
        }
        $motorType = Owner::create([
            'name' => $request['name'],
            'gender' => $request['gender'],
        ]);
        if (!$motorType ) { return ['status' => 'fail', 'messages' => ['Tafadhali Jaribu Tena']]; }
        return ['status' => 'success', 'obj' => $motorType];
    }

    public function validateRequest($request)
    {
        $rules = [
            'name' => 'required|unique:owners,name',
        ];

        $messages = [
            'name.required' => 'Jina la Mmilikiwa wa chombo Linahitajika',
        ];
        $validate = Validator::make($request, $rules, $messages);
        if ( $validate->fails() ){
            return [
                'status' => 'error',
                'output' => ['status' => 'fail', 'messages' => $validate->errors()->all() ],
            ];
        }
        return ['status' => 'success'];
    }

}
