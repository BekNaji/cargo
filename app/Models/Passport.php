<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Passport extends Model
{
    protected $fillable = ['passport','customer_id'];

    public function setPassportAttribute($value)
    {
        $this->attributes['passport'] = strtoupper($value);
    }
}
