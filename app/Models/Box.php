<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cargo;
use App\Models\Status;
use App\Models\Product;

class Box extends Model
{
    protected $fillable = ['total_weight','total_price','cargo_id','status_id','number','category_id'];


    public function cargo()
    {
        return $this->hasOne(Cargo::class,'id','cargo_id');
    }

    public function status()
    {
        return $this->hasOne(Status::class,'id','status_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class,'box_id','id');
    }
}
