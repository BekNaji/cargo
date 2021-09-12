<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['name','color','is_send','sort','message','options'];

    public function shippings()
    {
        return $this->hasMany(Shipping::class,'status_id','id');
    }


    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }
}
