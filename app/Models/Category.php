<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $guarded = [];


    public $timestamps =false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    public function scopeParentCategory($query){
        return $query -> whereNull("parent_id");
    }

    public function scopeSubParentCategory($query){
        return $query -> whereNotNull("parent_id");
    }

    public function subCategories()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function main()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function subProducts()
    {
        return $this->hasMany(Product::class, 'subcategory_id');
    }

}
