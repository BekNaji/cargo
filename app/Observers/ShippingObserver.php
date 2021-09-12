<?php

namespace App\Observers;

use App\Models\Shipping;
use App\Events\SendSms;
use App\Events\LogEvent;

class ShippingObserver
{
    /**
     * Handle the shipping "created" event.
     *
     * @param  \App\Shipping  $shipping
     * @return void
     */
    public function created(Shipping $shipping)
    {
        event(new LogEvent($shipping,'add'));

        if($shipping->status->is_send)
        {
            event(new SendSms(request(),$shipping));
        }
    }

    /**
     * Handle the shipping "updated" event.
     *
     * @param  \App\Shipping  $shipping
     * @return void
     */
    public function updated(Shipping $shipping)
    {

        if($shipping->isDirty('status_id'))
        {
            event(new LogEvent($shipping,'add'));

            if($shipping->status->is_send)
            {
                event(new SendSms(request(),$shipping));
            }
        }
    }

    /**
     * Handle the shipping "deleted" event.
     *
     * @param  \App\Shipping  $shipping
     * @return void
     */
    public function deleted(Shipping $shipping)
    {
        event(new LogEvent($shipping,'delete'));
    }

    /**
     * Handle the shipping "restored" event.
     *
     * @param  \App\Shipping  $shipping
     * @return void
     */
    public function restored(Shipping $shipping)
    {
        //
    }

    /**
     * Handle the shipping "force deleted" event.
     *
     * @param  \App\Shipping  $shipping
     * @return void
     */
    public function forceDeleted(Shipping $shipping)
    {
        //
    }
}
