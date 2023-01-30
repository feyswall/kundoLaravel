<?php

namespace App\Http\Controllers;

use App\Events\SendingSmsNotificationEvent;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Models\Leader;
use App\Models\Post;
use App\Models\Sms;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use PHPUnit\TextUI\XmlConfiguration\Groups;

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



    public function sendj(Request $request)
    {
        $smsRequestId = Sms::create([
            'request_id' => 3,
            'message' => 'sdafsd',
            'sms_amount' => 34
        ]);
        // fill the variables in relation
//        dd( $smsRequestId->leaders );
        if ( is_object($smsRequestId) ){
            $smsRequestId->leaders()->attach(2);
        }

    }




    public function sendToGroup(Request $request){
        $posts = [];
        $groups = Group::whereIn('id', $request->groups_ids)->get();
        foreach ($groups as $key => $group) {
            $results = $group->posts->pluck('id');      
            foreach( $results as $result ) {
                $posts[] = $result;
            }
        }
        // $posts = Post::whereIn('id', $posts)
        // ->where('leaders', function($query){
        //     $query->where('isActive', true);
        // })
        // ->get();
        $leaders_id = DB::table('leader_post')
        ->where('isActive', true)
        ->whereIn('post_id', $posts)->pluck('leader_id');

        $leaders = Leader::whereIn('id', $leaders_id)->pluck('id', 'phone');
        return $leaders;
    }



    /**
     * Sending sms in here
     * @param Request $requesr
     * @return array
     */
    public function send(Request $request)
    {
        //  event(new SendingSmsNotificationEvent($request) );
        // return 'completed';
        $receptionist_array = [];
        if (!( isset($request->leaders_ids)) ){
            return ['status' => 'error', 'message' => 'Tafadhali Chagua Wa Kumtumia.'];
        }

        $leaders_ids = $request->leaders_ids;
        $list_leaders = Leader::select("id", 'phone')->whereIn('id', $leaders_ids)->get();

        $parr = array();
        $savedLeaders = array();
        foreach ($list_leaders as $leader) {
            $parr[] = $leader->phone;
            $savedLeaders[] = $leader->id;
        }

        /**  remove redundancy in phone array */
        $trueArr = array_unique($parr);
        /** create receptionist array for sms sending */
        foreach ($trueArr as $key => $phone) {
            $smsPhone = $phone;
            $receptionist_array[] = array('recipient_id' => $phone, 'dest_addr' => $smsPhone );
        }

        $postData = array(
            'source_addr' => 'INFO',
            'encoding'=>0,
            'schedule_time' => '',
            'message' => $request->message['value'],
            'recipients' => $receptionist_array
        );
        $response_obj = $this->configurations( $postData );
        if ($response_obj['status'] == 'success') {
            if ( isset($response_obj['response']->successful) ){
                // create sms object for later retrival
                $smsRequestId = Sms::create([
                    'request_id' => $response_obj['response']->request_id,
                    'message' => $request->message['value'],
                    'sms_amount' => count($receptionist_array)
                ]);
                // fill the variables in relation
                if ( $smsRequestId ){
                    foreach ( $savedLeaders as $leader ){
                        $smsRequestId->leaders()->attach($leader);
                    }
                }
                return (['status' => 'success' ,'response' => $response_obj['response'], 'obj' => $smsRequestId]);
            }
            return ['status' => 'fail', 'message' => $response_obj['response']->message];
        } else {
            if ($response_obj['status'] == 'fail') {
                return ['status' => 'fail', 'message' => $response_obj['response']->message];
            }else{
                return ['status' => 'fail', 'message' => 'Unknown Error please Try again later!'];
            }
        }
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
         $response_obj = json_decode($response);
        if($response === FALSE){
        return ['status' => 'fail', 'response' => [$response_obj, curl_error($ch)]];
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
            return "Haiukupatikana";
        }
    }



    public function orodhaGroups(){
        $smses = Sms::with('leaders')->get();
        return view("interface.super.sms.orodhaSms")->with("smses", $smses);
    }



    public function orodhaGroupMoja(Sms $sms){
        $leaders = $sms->leaders()->select('*')->paginate(100);
        return view("interface.super.sms.funguMoja")
            ->with('sms', $sms)
            ->with('leaders', $leaders);
    }


    public function selectReceivers(){
        $groups = Group::orderBy('id', 'desc')->get();
        return view("interface.super.sms.chaguaKundi")
            ->with("groups", $groups);
    }

}

?>