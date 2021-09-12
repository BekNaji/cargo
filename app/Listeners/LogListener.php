<?php

namespace App\Listeners;

use App\Events\LogEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Log;

class LogListener
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
     * @param  LogEvent  $event
     * @return void
     */
    public function handle(LogEvent $event)
    {

        if($event->action == 'add')
        {
            $this->add($event->shipping);
        }

        if($event->action == 'delete')
        {
            $this->delete($event->shipping);
        }
    }

    public function add($shipping)
    {
        Log::create([
            'shipping_id' => $shipping->id,
            'status_id' => $shipping->status->id,
            'user_id' => $shipping->user->id,
            'message' => $shipping->status->message
        ]);
    }

    public function delete($shipping)
    {
        Log::where('shipping_id',$shipping->id);
    }
}
