<?php

namespace App\Http\Controllers\Super;


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
        $receiver = Receiver::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone')
        ]);
        if ( !$receiver ){
            return redirect()->back()->with(['status' => 'error', 'message' => 'Unable to register a receiver. Try again later']);
        }
        $message = "You are now one of the people who will be receiving text message from
        family assets system, Please welcome";
        event(new SendingSmsNotificationEvent([$receiver], function($data){}, $message, 'registerReceiver'));
        return redirect()->back()->with(['status' => 'success', 'message' => 'Receiver created successfully']);
    }

}
