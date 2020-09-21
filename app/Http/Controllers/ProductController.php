<?php

namespace App\Http\Controllers;
use App\Categories;
use App\Products;
use App\Carts;
use Cart;
use Auth;
use App\Favourite;
use Illuminate\Http\Request;
class ProductController extends Controller
{
    Protected $product, $categories, $db_cart, $favourite;
    public function __construct(Products $products, Categories $categories, Carts $db_cart, Favourite $favourite){
        $this->product      = $products;
        $this->categories   = $categories;
        $this->db_cart      = $db_cart;
        $this->favourite    = $favourite;
    }
    /******************************
     ******FAVORITE PRODUCT********
    ******************************/
    public function favorite(Request $request){
        if($request->method('post')){
            $status = 0;
            $favorite = 0;
            $message = '';
            $auth_check = Auth::guard('customer')->check();
            if($auth_check){
                try {
                    \DB::beginTransaction();
                    $auth_id        = Auth::guard('customer')->user()->id;
                    $listFavourite  = $this->favourite->where('product_id', $request->product_id)->first();
                    $data = array(
                        'customer_id' =>  $auth_id,
                        'product_id'  =>  $request->product_id
                    );
                    if(!$listFavourite){
                        $this->favourite->create($data);
                        $message = 'Bạn đã thêm mục này vào danh sách yêu thích!';
                        $status = 1;
                        $favorite = 1;
                    } else {
                        $this->favourite->where('product_id', $request->product_id)->delete();
                        $status = 1;
                        $favorite = 0;
                    }
                    \DB::commit();
                } catch (\Throwable $th) {
                    \DB::rollback();
                    $status = $th->getMessage();
                }
            } else {
                $status = 0;
                $message = 'Đăng nhập ngay để thêm sản phẩm này vào danh sách yêu thích của bạn';
            }
            return response()->json(array(
                'status'    => $status,
                'favorite'  => $favorite,
                'message'   => $message
            ));
        }
    }
    /******************************
     ******QUICKVIEW PRODUCT*******
    ******************************/
    public function quickview(Request $request){
        $data['product'] = $this->product->find($request->product_id);
        if (Cart::get($data['product']->id)){
            $data['cart'] = Cart::getContent($data['product']->id)->toArray();
        }
        if($request->method('POST') && $data){
            return view('render.quickview',$data)->render();
        }
    }
    //Product category
    public function product_category()
    {
        $data['filter_cate'] = $this->categories->orderBy('order','ASC')->get();
        $data['cate']        = $this->product->where('status', 'Hiển thị')
                                      ->orderBy('id','DESC')
                                      ->paginate(12);
        return view('category.products', $data);
    }
    //Product details
    public function product_details($slug, $id)
    {
        $data['article']            = $this->product->where('slug', $slug)->first();
        $data['existsFavourite']    = $this->favourite->where('product_id', $data['article']->id)->first();

        if(Auth::guard('customer')->check()){
            $customer_id = Auth::guard('customer')->user()->id;
            $data['db_cart'] = $this->db_cart->where('product_id', $data['article']->id)
                                             ->where('customer_id', $customer_id)
                                             ->first();
        }
        
        $sessionCart = Cart::get($data['article']->id);
        $data['quantityCart'] = Cart::get($data['article']->id);
        $data['related'] = $this->product->where('slug','<>',$slug)
                                         ->where('category_id', $data['article']->category_id)
                                         ->limit(10)->get();
        return view('article.product', $data);
    }
    //Filter Product
    public function filter_product(Request $request){
        if($request->method('get')){
            $category = $this->categories->orderBy('order','ASC')->get();
            $product = Products::query();
            if ($request->has('cate'))
            {
                $product->where('category_id', $request->cate);
            }
            if($request->has('min_price') && $request->has('max_price')){
                $product->where('price','>=',$request->min_price);
                $product->where('price','<=',$request->max_price);
            }
            // if($request->has('sort')){
            //     if($request->sort == 'name'){
                    
            //     } elseif ($request->sort == 'priceASC') {
                    
            //     } elseif ($request->sort == 'priceDESC') {
                    
            //     }
                
            //     $product->orderBy($request->sort,'');
            // }
            $products = $product->orderBy('id', 'DESC')->paginate(3)->appends(array(
                'cate'  => $request->cate,
                'price' => $request->price
            )); 
            return view('category.products', ['cate' => $products, 'filter_cate' => $category]);
        }
    }
    //Filter Search Product
    public function filter_search(Request $request){
        if($request->method('post')){
            $product = Products::query();
            if ($request->has('keywords') && $request->keywords != null) {
                $product->where('title', 'LIKE', '%' . $request->keywords . '%');
            }
            if ($request->has('category_id') && $request->category_id != null){
                $product->where('category_id', $request->category_id);
            }
            // if($request->has('price') && $request->price != null){
            //     $price = explode('-',$request->price);
            //     $min_price = $price[0];
            //     $max_price = $price[1];
            //     if($product->discount_price == null){
            //         $product->where('price','>=', $min_price);
            //         $product->where('price','<=', $max_price);
            //     } else {
            //         $product->where('discount_price','>=', $min_price);
            //         $product->where('discount_price','<=', $max_price);
            //     }
                
            // }
            $data['result_search'] = $product->orderBy('id', 'DESC')->take(9)->get();
            // return response()->json(array(
            //     'result' => $products,
            //     'dd'=> $request->all()
            // ));
            return view('render.search', $data)->render();
        }
    }
}