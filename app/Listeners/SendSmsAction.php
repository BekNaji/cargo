<?php

namespace App\Listeners;

use App\Events\SendSms;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\ScheduleSms;

class SendSmsAction
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  SendSms  $event
     * @return void
     */
    public function handle(SendSms $event)
    {
        if($event->request->sender_smsconfig_id)
        {
            ScheduleSms::create([
                'shipping_id' => $event->shipping->id,
                'smsconfig_id' => $event->request->sender_smsconfig_id,
            ]);
        }
        
        if($event->request->receiver_smsconfig_id)
        {
            ScheduleSms::create([
                'shipping_id' => $event->shipping->id,
                'smsconfig_id' => $event->request->receiver_smsconfig_id,
            ]);
        }
    }

}
