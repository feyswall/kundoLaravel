<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use App\Models\MotorType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MotorTypesController extends Controller
{
    public function getModels($id)
    {
        $motorType = MotorType::where('id', $id)->first();
        $motorModels = $motorType ? $motorType->motor_models : null;
        return $motorModels;
    }

    public function validateRequest($request)
    {
        $rules = [
            'name' => 'required|unique:motor_types,name',
        ];
        $messages = [
            'name.required' => 'Jina la Aina ya Chombo Linahitajika',
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

    public function createNewTypeLogic($request)
    {
        $validate = $this->validateRequest(['name' => $request['name']]);
        if ( $validate['status'] == 'error'){
            return $validate['output'];
        }
    	$motorType = MotorType::create([
    		'name' => $request['name'],
            'motor_category_id' => $request['id'],
    	]);
    	return ['status' => 'success', 'obj' => $motorType];
    }
}
