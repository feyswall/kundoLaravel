<?php

namespace App\Http\Controllers\Super;

use App\Events\GeneralSmsEvent;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Super\Apartment\ApartmentsController;
use App\Models\Receiver;
use Illuminate\Http\Request;
use App\Models\Mms;

class AutoMmsSenderController extends Controller
{
    private $today;

    public function __construct()
    {
        $this->today = \Carbon\Carbon::now()->format("Y-m-d");
    }

    public function didWeSendToday($about)
    {
        return Mms::where('created_at', '>=', $this->today )
        ->where('about', $about )
        ->exists();
    }

    public function autoMms()
    {
        $receivers = Receiver::all();
        $apartment = new ApartmentsController();
        $apartmentString = $apartment->smsStringBuilder();
        if ( $apartmentString AND !($this->didWeSendToday('apartmentRent'))){
            foreach( $receivers as $receiver ){
                $customeToPass = ['id' => $receiver->id, 'phone' => $receiver->phone ];
//                event(new GeneralSmsEvent(
//                    [$customeToPass],
//                    function($response){ info(json_encode($response)); },
//                    $apartmentString,
//                    $receiver
//                ));
                info('task execute');
            }
            event(new SendingSmsNotificationEvent($receivers, function ($data){
                info("The full callback function ". json_encode($data));
            }), $apartmentString, 'apartmentRent');
        }elseif($this->didWeSendToday('apartmentRent')){
            info("Today already sent apartment rents");
        }
        else{
            info("empty string for sending apartments rents");
        }

    }
}
