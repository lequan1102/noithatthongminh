<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Carts extends Model
{
    protected $table = 'carts';
    protected $fillable = [
        'name', 'price', 'discount_price', 'quantity', 'image', 'total', 'customer_id', 'product_id'
    ];
    public function product()
    {
        return $this->belongsTo('App\Products');
    }
}
