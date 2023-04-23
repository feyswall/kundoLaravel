<?php

namespace App\Http\Controllers\Super;

use App\Models\Motor;
use App\Http\Controllers\Controller;
use App\Models\User;

use function App\Repositories\rules;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class MotorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $motors = Motor::all();
        return view('interface.super.vyomboMoto.vyomboOrodha')
            ->with('motors', $motors);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'identityName' => 'required',
            'writeTypeBool' => 'required',
            'year' => 'required',
            'color' => 'required',
            'gender' => 'required',
            'motorCategory' => 'required',
        ];

        $messages = [
            'identityName.required' => 'Jina la Utambulisho wa Chombo Linahitajika',
            'writeTypeBool.required' => 'Tafadhali azisha ukurasa upya na ujaribu tena',
            'year.required' => 'Tafadhali Jaza Mwaka Wa Kutengezezwa Chombo',
            'color' => 'Tafadhali jaza rangi ya gari',
        ];
        $validate = Validator::make($request->all(), $rules, $messages);

        if ( $validate->fails() ){
            return response()->json(['status' => 'fail', 'messages' => $validate->errors()->all() ]);
        }

        // Initialize all data required to create motor
        $motorTypeId = $request->input('motorType');
        $motorModelId = $request->input('motorModel');
        $ownerId = $request->input('owner');

        if ( $request->writeTypeBool ){
            //  create new motor type
            $motorType = new MotorTypesController();
            $motorTypeFunct = $motorType->createNewTypeLogic([
                'name' => $request->input('type_name'),
                'id' => $request->input('motorCategory'),
            ]);
            if ( $motorTypeFunct['status'] == 'fail'){
                return response()->json( $motorTypeFunct );
            }
            $motorTypeObj = $motorTypeFunct['obj'];

            // create new motor model
            $motorModel = new MotorModelsController();
            $motorModelFunct = $motorModel->createNewModelLogic(['name' => $request->input('model_name'), 'id' => $motorTypeObj->id ]);
            if ( $motorModelFunct['status'] == 'fail'){
                return response()->json( $motorModelFunct );
            }
            $motorModelObj = $motorModelFunct['obj'];
            $motorTypeId = $motorTypeObj->id;
            $motorModelId = $motorModelObj->id;
        }

        if ( $request->writeOwner ){

            // The owner should also have a user Account in the system
            $userObj = new UsersController();
            $userRequestData = [];
            $userRequestData['name'] = $request->input('owner_name');
            $nameString = str_replace('\s', '', $request->input('owner_name'));
            $userRequestData['email'] = strtolower( $nameString.".motor@kims.com" );
            $userRequestData['password'] = strtolower( $nameString );
            $userFunct = $userObj->createApi($userRequestData);
            if( $userFunct['status'] == 'fail' ){
                return response()->json( $userFunct );
            }
            $userFunct['obj']->assignRole('motorOwner');


            // create owner
            $owner = new OwnersController();
            $ownerFunct = $owner->createNewOwnerLogic([
                'name' => $request->input('owner_name'),
                'gender' => $request->input('gender'),
                'user_id' => $userFunct['obj']->id,
            ]);

            if ( $ownerFunct['status'] == 'fail'){
                return response()->json( $ownerFunct);
            }
            $ownerObj = $ownerFunct['obj'];
            $ownerId = $ownerObj->id;

        }
        // create motor
        $motor = Motor::create([
            'owner_id' => $ownerId,
            'motor_type_id' => $motorTypeId,
            'motor_model_id' => $motorModelId,
            'identity_name' => $request->input('identityName'),
            'year' => $request->input('year'),
            'color' => $request->input('color'),
            'motor_category_id' => $request->input('motorCategory'),
        ]);
        if ( !$motor ){
            return response()->json(['status' => 'fail', 'messages' => ['Imeshindikana kusajiri kwa sasa tafadhari jaribu tena']]);
        }
        return response()->json(['status' => 'success', 'messages' => ['Chombo kimesajiriwa']], 201);

    }

    public function orodhaMotorServices($id)
    {
        $motor = Motor::where('id', $id)->first();
        return view('interface.super.vyomboMoto.motorServiceList')
            ->with('motor', $motor);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Motor  $motor
     * @return \Illuminate\Http\Response
     */
    public function show(Motor $motor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Motor  $motor
     * @return \Illuminate\Http\Response
     */
    public function edit(Motor $motor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Motor  $motor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Motor $motor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Motor  $motor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Motor $motor)
    {
        //
    }
}
