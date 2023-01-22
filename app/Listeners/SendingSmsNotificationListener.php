<?php

namespace App\Listeners;

use App\Events\SendingSmsNotificationEvent;
use App\Models\Leader;
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
        if ( !($event->request->leaders_ids) ){
            return;
            }
        $request = $event->request;
        $receptionist_array = [];
        $leaders_ids = $request->leaders_ids;
        $phones = Leader::select("id", 'phone')->whereIn('id', $leaders_ids)->get();

        foreach ($phones as $phone) {
            $smsPhone = preg_replace("/^0/", "255", $phone->phone);
            $receptionist_array[] = array('recipient_id' => $phone->id, 'dest_addr' => $smsPhone);
        }
        $postData = array(
            'source_addr' => 'INFO',
            'encoding' => 0,
            'schedule_time' => '',
            'message' => 'EastCoders Inakukaribisha ndugu feyswal',
            'recipients' => $receptionist_array
        );
        return $postData;
        $resp = $this->configurations($postData);
    }




    /**
     * Just configuration to make every thing
     * ready for action
     */
    public function configurations($postData)
    {
        $api_key = '9e1f6010dcefe438';
        $secret_key = "ZjgyYjk2NGVhNDdiZDFhNTJkOTkzYzBhMWUxZmJiNmJiZGQ1ODhmNWYzNzEwMTZkYjI0NjZhNjEwN2RmYzQzYg==";

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
        dd("reaching far enought");
        if ($response === FALSE) {
            return ['status' => 'fail', 'response' => [$response, curl_error($ch)]];
        }
        return ['status' => 'success', 'response' => $response];
    }

}
