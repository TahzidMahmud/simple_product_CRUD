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
        return $this->hasOne('App\Size','id','size_id');
    }

    public function color()
    {
        return $this->hasOne('App\Color','id','color_id');
    }
    public function product()
    {
        return $this->belongsTo('App\Product','product_id','id');
    }
}
