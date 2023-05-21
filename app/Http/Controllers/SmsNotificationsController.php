<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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


    public function smsNotify($receivers, $message, $about )
    {
        $instance = SmsConfigController::getInstance();
        $this->setReceivers($receivers);
        $out = $instance->send($this->receivers, $message);
        if ($out['status'] == 'success') {
            if ( isset($out['response']->successful) ){
//                $smsRequestId = Sms::create([
//                    'request_id' => $out['response']->request_id,
//                    'message' => $message,
//                    'smsCount' => count($receivers),
//                    'about' => $about
//                ]);
            }
        }
        return $out;
    }

}
