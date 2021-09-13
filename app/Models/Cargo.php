<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\Baza;
use App\Models\Branch;
use App\Models\Customer;
use App\Models\Status;

class Cargo extends Model
{
    protected $fillable = ['number','category_id','is_active','status_id','sender_id','receiver_id','user_id','branch_id','payment','baza_id','total_weight','total_price','paid','fee'];

    public function baza()
    {
        return $this->hasOne(Baza::class,'id','baza_id');
    }

    public function boxes()
    {
        return $this->hasMany(Box::class,'cargo_id','id');
    }

    public function status()
    {
        return $this->hasOne(Status::class,'id','status_id');
    }

    public function sender()
    {
        return $this->hasOne(Customer::class,'id','sender_id');
    }

    public function receiver()
    {
        return $this->hasOne(Customer::class,'id','receiver_id');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function branch()
    {
        return $this->hasOne(Branch::class,'id','branch_id');
    }

    // public function getCreatedAtAttribute($value)
    // {
    //     return date('d-m-y h:i:s',strtotime($value));
    // }


}
