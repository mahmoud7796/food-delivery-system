<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Order extends Authenticatable
{
    protected $guarded = [];
    public $timestamps=true;
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}
