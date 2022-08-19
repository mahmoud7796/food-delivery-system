<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Product extends Authenticatable
{
    protected $guarded = [];
    public $timestamps=true;

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function subcategory(){
        return $this->belongsTo(Category::class,'subcategory_id');
    }

}
