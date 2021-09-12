<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\District;
use App\Models\Region;

class Address extends Model
{
    protected $fillable = ['region_id','district_id','customer_id','open_address'];

    public function region()
    {
        return $this->hasOne(Region::class,'id','region_id');
    }

    public function district()
    {
        return $this->hasOne(District::class,'id','district_id');
    }
}
