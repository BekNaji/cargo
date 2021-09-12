<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Phone;
use App\Models\Address;
use App\Models\Passport;

class Customer extends Model
{
    protected $fillable = ['name','number','type','options'];

    public function phones()
    {
        return $this->hasMany(Phone::class);
        
    }

    public function passport()
    {
        return $this->hasOne(Passport::class);
    }

    public function addresses()
    {
        return $this->hasOne(Address::class);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d-m-Y H:i',strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('d-m-Y H:i',strtotime($value));
    }


}
