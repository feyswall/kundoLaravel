<?php

namespace App\Listeners;

use App\Events\GeneralSmsEvent;
use App\Http\Controllers\SmsNotificationsController;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GeneralSmsListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\GeneralSmsEvent  $event
     * @return void
     */
    public function handle(GeneralSmsEvent $event)
    {
        $receivers = $event->receivers;
        $smsObj = new SmsNotificationsController();
        $response  = $smsObj->smsNotify($receivers, $event->message, $event->about, $event->obj);
        $callback = $event->callback;
        $callback($response);
        info("the event  is triggered and start to execute, waiting for the callback");
    }
}
