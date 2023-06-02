<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Mms;
use App\Models\Sms;
use Illuminate\Http\Request;

class SmsNotificationsController extends Controller
{
    /**
     * @param $receivers
     */
    public function __construct(){}


    private $receivers;

    /**
     * @return mixed
     */
    public function getReceivers()
    {
        return $this->receivers;
    }

    /**
     * @param mixed $receivers
     */
    public function setReceivers($receivers): void
    {
        $recArray = [];
        foreach ( $receivers as $receiver ){
            $recArray[] = ['recipient_id' => $receiver['id'], 'dest_addr' => $receiver['phone'] ];
        }
        $this->receivers = $recArray;
    }


    public function smsNotify($receivers, $message, $about, $obj)
    {
        $instance = SmsConfigController::getInstance();
        $this->setReceivers($receivers);
        $out = $instance->send($this->receivers, $message);
        if ($out['status'] == 'success') {
            if (isset($out['response']->successful)){
                // create sms object for later retrieve
                $mms = new Mms();
                $mms->request_id = $out['response']->request_id;
                $mms->message = $message;
                $mms->sms_amount = count($receivers);
                $mms->about = $about;
                $obj->mmses()->save($mms);
            }
        }
//        return $out;
        return ['response' => 'success'];
    }

}
