<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leader;

class SmsServicesControlller extends Controller
{
    private $api_key;
    private $secret_key;

    /**
     * SmsServicesControlller constructor.
     * @param $postData
     */
    public function __construct()
    {
        $this->api_key = '9e1f6010dcefe438';
        $this->secret_key = "ZjgyYjk2NGVhNDdiZDFhNTJkOTkzYzBhMWUxZmJiNmJiZGQ1ODhmNWYzNzEwMTZkYjI0NjZhNjEwN2RmYzQzYg==";
    }

    /**
     * Sending sms in here
     * @param $postData
     */
    public function send(Request $request){
        $receptionist_array = [];
        $leaders_ids = $request->leaders_ids;
        $phones = Leader::select("id", 'phone')->whereIn('id', $leaders_ids)->get();

        foreach ($phones as $phone) {
            $smsPhone = preg_replace("/^0/", "255", $phone->phone);
            $receptionist_array[] = array('recipient_id' => $phone->id, 'dest_addr' => $smsPhone );
        }
        $postData = array(
            'source_addr' => 'INFO',
            'encoding'=>0, 
            'schedule_time' => '',
            'message' => $request->message['value'],
            'recipients' => [ array('recipient_id' => '1', 'dest_addr' => '255628960877') ]
        );
        $resp = $this->configurations( $postData );
        return $resp;
    }


    /**
     * Just configuration to make every thing
     * ready for action
     */
    public function configurations($postData)
     {
        $Url ='https://apisms.beem.africa/v1/send';

        $ch = curl_init($Url);
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt_array($ch, array(
        CURLOPT_POST => TRUE,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_HTTPHEADER => array(
        'Authorization:Basic ' . base64_encode("$this->api_key:$this->secret_key"),
        'Content-Type: application/json'
        ),
        CURLOPT_POSTFIELDS => json_encode($postData)
        ));

        $response = curl_exec($ch);

        if($response === FALSE){
        return ['status' => 'fail', 'response' => [$response, curl_error($ch)]];
        }
        return ['status' => 'success', 'response' => $response];
    }

}

?>