<?php

namespace App\Http\Controllers\Super;

use App\Models\MotorModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MotorModelsController extends Controller
{

    public function validateRequest($request)
    {
        $rules = [
            'name' => 'required|unique:motor_models,name',
        ];
        $messages = [
            'name.required' => 'Jina la Model ya Chombo Inahitajika'
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

    public function createNewModelLogic($request)
    {
        $validate = $this->validateRequest($request);
        if ( $validate['status'] == 'error'){
            return $validate['output'];
        }
        $motorModel = MotorModel::create([
            'name' => $request['name'],
            'motor_type_id' => $request['id'],
        ]);
        return ['status' => 'success', 'obj' => $motorModel];
    }

}
