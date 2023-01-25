<?php

namespace App\Listeners;

use App\Events\SendingSmsNotificationEvent;
use App\Models\Leader;
use App\Models\Sms;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendingSmsNotificationListener
{
    /**
     * SmsServicesControlller constructor.
     * @param $postData
     */
    public function __construct()
    {
       
    }


    /**
     * Handle the event.
     *
     * @param  \App\Events\SendingSmsNotificationEvent  $event
     * @return void
     */
    public function handle(SendingSmsNotificationEvent $event)
    {
        $request = $event->request;
        // return 'completed';
        $receptionist_array = [];
        if (!( isset($request->leaders_ids)) ){
            return ['status' => 'error', 'message' => 'no user were selected'];
        }
        $leaders_ids = $request->leaders_ids;
        $phones = Leader::select("id", 'phone')->whereIn('id', $leaders_ids)->get();

        $parr = array();
        foreach ($phones as $phone) {
            $parr[] = $phone->phone;
        }

        /**  remove redundancy in phone array */
        $trueArr = array_unique($parr);
        /** create receptionist array for sms sending */
        foreach ($trueArr as $key => $phone) {
            $smsPhone = preg_replace("/^0/", "255", $phone);
            $receptionist_array[] = array('recipient_id' => $phone, 'dest_addr' => $smsPhone );
        }

        $postData = array(
            'source_addr' => 'INFO',
            'encoding'=>0, 
            'schedule_time' => '',
            'message' => $request->message['value'],
            'recipients' => $receptionist_array
        );
        $resp = $this->configurations( $postData );
        $response_obj = json_decode($resp['response']);
        if ($resp['status'] == 'success') {
            if ( isset($response_obj->successful) ){
                $smsRequestId = Sms::create([
                    'request_id' => 6,
                    'message' => $request->message['value'],
                    'sms_amount' => count($receptionist_array)
                ]);
                return ['status' => 'success' ,'response' => $response_obj, 'object' => $smsRequestId];
            }
            return ['status' => 'fail', 'message' => $response_obj->message];
        } else {
            if ($resp['status'] == 'fail') {
            return ['status' => 'fail', 'message' => $response_obj->message];
            }
        }

    }



    /**
     * Just configuration to make every thing
     * ready for action
     */
    public function configurations($postData)
    {
        $api_key = '9e1f6010dcefe438';
        $secret_key = 'ZjgyYjk2NGVhNDdiZDFhNTJkOTkzYzBhMWUxZmJiNmJiZGQ1ODhmNWYzNzEwMTZkYjI0NjZhNjEwN2RmYzQzYg==';

        $Url = 'https://apisms.beem.africa/v1/send';

        $ch = curl_init($Url);
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt_array($ch, array(
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Authorization:Basic ' . base64_encode("$api_key:$secret_key"),
                'Content-Type: application/json'
            ),
            CURLOPT_POSTFIELDS => json_encode($postData)
        ));

        $response = curl_exec($ch);

        if ($response === FALSE) {
            return ['status' => 'fail', 'response' => [$response, curl_error($ch)]];
        }
        return ['status' => 'success', 'response' => $response];
    }

}
