<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Cart extends Authenticatable
{
    protected $guarded = [];
    public $timestamps=true;

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
