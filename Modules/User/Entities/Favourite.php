<?php

namespace Modules\User\Entities;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
  public $table = 'favourite';
  protected $fillable = [
    'product_id', 'customer_id'
  ];
}
