<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\{
    Baza, 
    Box,
    Branch, 
    Customer, 
    Status,
    Product
};

class Shipping extends Model
{
    protected $guarded = ['id'];

    public function baza()
    {
        return $this->hasOne(Baza::class,'id','baza_id');
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

    public function products()
    {
        return $this->hasMany(Product::class,'shipping_id','id');
    }

    public function logs()
    {
        return $this->hasMany(Log::class,'shipping_id','id');
    }

    // public function getCreatedAtAttribute($value)
    // {
    //     return date('d-m-y h:i:s',strtotime($value));
    // }
}
