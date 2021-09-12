<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsConfig extends Model
{
    protected $table = 'smsconfigs';
    protected $fillable = ['name','title','login','password','token','message','module'];
}
