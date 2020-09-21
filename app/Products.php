<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Products extends Model
{
  protected $table = 'products';

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
}
