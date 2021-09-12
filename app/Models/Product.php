<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class Product extends Model
{
    protected $fillable = ['shipping_id','item_id','count','price','total_price'];


    public function item()
    {
        return $this->hasOne(Item::class,'id','item_id');
    }
}
