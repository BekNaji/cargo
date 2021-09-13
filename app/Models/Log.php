<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Status;
use App\Models\Shipping;

class Log extends Model
{
    protected $guarded = ['id'];

    public function status()
    {
        return $this->hasOne(Status::class,'id','status_id');
    }

    public function shipping()
    {
        return $this->hasOne(Shipping::class,'id','shipping_id');
    }
}
