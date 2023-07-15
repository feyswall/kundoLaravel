<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Sms;
use Illuminate\Http\Request;

class SmsConfigController extends Controller
{
    public static $api_key = '9e1f6010dcefe438';
    public static $sourceAddress = 'jimbo letu';
    public static $secret_key = 'ZjgyYjk2NGVhNDdiZDFhNTJkOTkzYzBhMWUxZmJiNmJiZGQ1ODhmNWYzNzEwMTZkYjI0NjZhNjEwN2RmYzQzYg==';
    private static $instance;

    /**
     * SmsServicesControlller constructor.
     * @param $postData
     */
    private function __construct() {}

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new SmsConfigController();
        }
        return self::$instance;
    }


    /**
     * Just configuration to make every thing
     * ready for action
     */
    private function configurations($postData)
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
        $response_obj = json_decode($response);
        if($response === FALSE){
            return ['status' => 'fail', 'response' => $response_obj];
        }
        return ['status' => 'success', 'response' => $response_obj];
    }



    public static function deriveryReport($dest_addr, $request_id)
    {
        $username = self::$api_key;
        $password = self::$secret_key;
        $URL = 'https://dlrapi.beem.africa/public/v1/delivery-reports';
        $body = array('request_id' => $request_id,'dest_addr' => $dest_addr);
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
            return ['status' => 'fail'];
        }
        $response = json_decode( $response );
        return ['status' => 'success', 'response' => $response];
    }



    /**
     * @return array
     */
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
            return -1;
        }
    }


    /**
     * @param $receptionist_array array('recipient_id' => $name, 'dest_addr' => $smsPhone )
     * @param string $message
     * @return array|string[]
     */
    public function send( array $receptionist_array, string $message )
    {
        // check balance first
        $resp = self::checkBalance();
        $balance = -1;
        if ( $resp['status'] == 'success' ){
            $balance = $resp['response']->data->credit_balance;
            if ( $balance ){
                if ( count($receptionist_array) > intval($balance) ){
                    return ['status' => 'error', 'message' => 'run out of sms'];
                }
                }else{
                    return ['status' => 'error', 'message' => '0 sms left'];
                }
            }

        $postData = array(
            'source_addr' => self::$sourceAddress,
            'encoding'=>0,
            'schedule_time' => '',
            'message' => $message,
            'recipients' => $receptionist_array,
        );
        $response_obj = $this->configurations( $postData );
        if ($response_obj['status'] == 'success') {
            if ( isset($response_obj['response']->successful) ){
                return (['status' => 'success' ,'response' => $response_obj['response']]);
            }
            if ( isset($response_obj['response']->message) ){
                return ['status' => 'fail', 'message' => $response_obj['response']->message];
            }elseif  ( isset($response_obj['response']->data) ){
                        return ['status' => 'fail', 'message' => $response_obj['response']->data->message];
            }
            }else {
                if ($response_obj['status'] == 'fail') {
                            return ['status' => 'fail', 'message' => $response_obj['response']->data->message];
                }else{
                    return ['status' => 'fail', 'message' => 'Unknown Error please Try again later!'];
                }
            }
    }


}
