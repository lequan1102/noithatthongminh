<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class CustomerLocation extends Model
{
    protected $table = 'customer_location';
    protected $fillable = [
        'full_name', 'number_phone', 'location', 'province', 'district', 'wards', 'default', 'customer_id'
    ];
    public $timestamps = false;
}
