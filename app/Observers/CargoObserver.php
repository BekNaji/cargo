<?php

namespace App\Observers;

use App\Events\SendSms;
use App\Models\Cargo;
use App\Models\Box;

class CargoObserver
{
    /**
     * Handle the cargo "created" event.
     *
     * @param  \App\Cargo  $cargo
     * @return void
     */
    public function created(Cargo $cargo)
    {
        //
    }

    /**
     * Handle the cargo "updated" event.
     *
     * @param  \App\Cargo  $cargo
     * @return void
     */
    public function updated(Cargo $cargo)
    {
        Box::where('cargo_id',$cargo->id)->update(['status_id' => $cargo->status->id]);
        if($cargo->isDirty('status_id'))
        {
            event(new SendSms(request()));
        }
    }

    /**
     * Handle the cargo "deleted" event.
     *
     * @param  \App\Cargo  $cargo
     * @return void
     */
    public function deleted(Cargo $cargo)
    {
        //
    }

    /**
     * Handle the cargo "restored" event.
     *
     * @param  \App\Cargo  $cargo
     * @return void
     */
    public function restored(Cargo $cargo)
    {
        //
    }

    /**
     * Handle the cargo "force deleted" event.
     *
     * @param  \App\Cargo  $cargo
     * @return void
     */
    public function forceDeleted(Cargo $cargo)
    {
        //
    }
}
