<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Products;

class Products extends Model
{
  protected $table = 'products';
  protected $p;
  protected $fillable = [
    'title', 'slug', 'body', 'excerpt', 'image', 'multi_image', 'seo_title', 'meta_description', 'meta_keywords', 'price', 'status', 'order', 'favorite', 'featured', 'discount_price', 'category_id', 'barter'
  ];
  // public function scopeCategory($query, $request){
  //   if ($request->has('category')) {
  //       $query->where('category_id', $request->category);
  //   }
  //   return $query;
  // }
  // public function scopeName($query, $request){
  //     if ($request->has('keywords')) {
  //         $query->where('title','LIKE','%',$request->keywords,'%')
  //               ->orWhere('slug', 'LIKE', '%' . $request->keywords . '%');
  //     }
  //     return $query;
  // }
  // public static function boot()
  //   {
  //       parent::boot();

  //       self::creating(function($model){
  //           // ... code here
  //       });

  //       self::created(function($model){
  //           $model->price = 320000;
  //       });

  //       self::updating(function($model){
  //           // ... code here
  //           dd($model);
  //       });

  //       self::updated(function($model){
  //           // ... code here
  //           dd($model);

  //       });

  //       self::deleting(function($model){
  //           // ... code here
  //       });

  //       self::deleted(function($model){
  //           // ... code here
  //       });
  //   }
}
