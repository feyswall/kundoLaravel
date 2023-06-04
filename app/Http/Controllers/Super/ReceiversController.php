<?php

namespace App\Http\Controllers\Super;


use App\Events\GeneralSmsEvent;
use App\Events\SendingSmsNotificationEvent;
use App\Http\Controllers\Controller;
use App\Models\Receiver;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReceiversController extends Controller
{
    public function index()
    {
        $receivers = Receiver::all();
        return view('interface.super.receivers.allReceivers')
            ->with('receivers', $receivers);
    }

    public function store( Request $request ){
        $rules = [
            'name' => 'required',
            'phone' => ['required', new PhoneNumber()],
        ];
        $messages = [
            'name:unique' => 'The name already exist in receivers list',
        ];
        $validate = Validator::make($request->all(), $rules );
        if ( $validate->fails() ){
            return redirect()->back()->withErrors($validate->errors());
        }
        $phone = preg_replace("/^0/", "255", $request->input('phone'));
        $phone = preg_replace("/\s/", "", $phone );
        $receiver = Receiver::create([
            'name' => $request->input('name'),
            'phone' => $phone
        ]);
        if ( !$receiver ){
            return redirect()->back()->with(['status' => 'error', 'message' => 'Unable to register a receiver. Try again later']);
        }
        $message = "Habari ".ucwords($request->input('name'))." \n";
        $message .= "Sasa umekuwa Miongoni mwa watu watakokuwa wakijuzwa yale yanayokuwa yakiendelea kwenye KIMS SYSTEM";
        event(new GeneralSmsEvent(
            [ ['id' => $receiver->id , 'phone' => $phone] ],
            function($response){ info(json_encode($response)); },
            $message,
            $receiver
        ));
        return redirect()->back()->with(['status' => 'success', 'message' => 'Receiver created successfully']);
    }

    public function destroy($id){
        $receiver = Receiver::find($id);
        $receiver->delete();
        return redirect()->back()->with(['status' => 'success', 'message' => 'Mpoaji Ametolewa']);
    }
}
