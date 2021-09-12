<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cargo;
use App\Models\SmsConfig;

class ScheduleSms extends Model
{
    protected $table = 'schedulesms';
    protected $fillable = ['shipping_id','smsconfig_id','response','status','message_id'];

    public function shipping()
    {
        return $this->hasOne(Cargo::class,'id','shipping_id');
    }

    public function smsconfig()
    {
        return $this->hasOne(SmsConfig::class,'id','smsconfig_id');
    }
}
