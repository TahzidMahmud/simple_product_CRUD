<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_name', 'product_description', 'product_brand','category_id','sub_category_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function sub_category()
    {
        return $this->belongsTo('App\SubCategory');
    }
    public function variants()
    {
        return $this->hasMany('App\ProductVariant','product_id','id');
    }
}
