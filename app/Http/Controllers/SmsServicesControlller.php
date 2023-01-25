<?php

namespace App\Http\Controllers;

use App\Events\SendingSmsNotificationEvent;
use Illuminate\Http\Request;
use App\Models\Leader;
use App\Models\Sms;

class SmsServicesControlller extends Controller
{
    public static $api_key = '9e1f6010dcefe438';
    public static $secret_key = 'ZjgyYjk2NGVhNDdiZDFhNTJkOTkzYzBhMWUxZmJiNmJiZGQ1ODhmNWYzNzEwMTZkYjI0NjZhNjEwN2RmYzQzYg==';

    /**
     * SmsServicesControlller constructor.
     * @param $postData
     */
    public function __construct()
    {

    }

    /**
     * Sending sms in here
     * @param $postData
     */
    public function send(Request $request)
    {


       event(new SendingSmsNotificationEvent($request) );

        $leaders_ids = $request->leaders_ids;
        $phones = Leader::select("id", 'phone')->whereIn('id', $leaders_ids)->get();

        $parr = array();
        foreach ($phones as $phone) {
            $parr[] = $phone->phone;
        }

        /**  remove redundancy in phone array */
        $trueArr = array_unique($parr);


        return ['status' => 'success'];
    }


    /**
     * Just configuration to make every thing
     * ready for action
     */
    public function configurations($postData)
     {
         $api_key = self::$api_key;
         $secret_key  = self::$secret_key;

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
        'Authorization:Basic ' . base64_encode("$api_key:$secret_key"),
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



    public function deriveryReport($dest_addr, $request_id)
    {
        $username = self::$api_key;
        $password = self::$secret_key;

        $URL = 'https://dlrapi.beem.africa/public/v1/delivery-reports';

        $body = array('request_id' => $request_id, 'dest_addr' => $dest_addr);

        // Setup cURL
        $ch = curl_init();
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        $URL = $URL . '?' . http_build_query($body);

        curl_setopt($ch, CURLOPT_URL, $URL);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt_array($ch, array(
            CURLOPT_HTTPGET => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                'Authorization:Basic ' . base64_encode("$username:$password"),
                'Content-Type: application/json',
            ),
        ));

        // Send the request
        $response = curl_exec($ch);

        // Check for errors
        if ($response === false) {
            dd([$response, curl_error($ch)]);
        }
        dd($response);
    }



    public static function checkBalance(){
        $username= self::$api_key;
        $password = self::$secret_key;

        $Url ='https://apisms.beem.africa/public/v1/vendors/balance';

        $ch = curl_init($Url);
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt_array($ch, array(
            CURLOPT_HTTPGET => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_HTTPHEADER => array(
                'Authorization:Basic ' . base64_encode("$username:$password"),
                'Content-Type: application/json'
            ),
        ));
        // Send the request
        $response = curl_exec($ch);

        if($response === FALSE){
                $responseObj = json_decode($response);
                return ['status' => 'fail', "response" => $responseObj ];
        }
        $responseObj = json_decode($response);
        return ['status' => 'success', "response" => $responseObj ];
    }


    /**
     * @return mixed
     */
    public static function supportedSms(){
        $checkBalance = self::checkBalance();
        if ( $checkBalance['status'] == 'success' ){
            $balance = $checkBalance['response']->data->credit_balance;
            return $balance;
        }else{
            return "Haiukupatikana";
        }
    }


}

?>