<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'size_id', 'color_id','variant_price','variant_image','variant_qty'
    ];
    public function size()
    {
        return $this->hasOne('App\Size');
    }

    public function colors()
    {
        return $this->hasOne('App\Color');
    }
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
